<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DateTime;

class WorkingTime extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'work_date',
        'time_first',
        'time_second',
        'time_third',
        'time_four',
        'worked_time',
        'editable',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function calculateWorkedTime()
    {
        // calculate and create worked time
        $firstTime = new DateTime($this->time_first);
        $secondTime = new DateTime($this->time_second);
        $thirdTime = new DateTime($this->time_third);
        $fourTime = new DateTime($this->time_four);

        $pointFirst = $secondTime->diff($firstTime);
        $pointSecond = $fourTime->diff($thirdTime);

        $times = [$pointFirst->h . ":" . $pointFirst->i . ":" . $pointFirst->s, $pointSecond->h . ":" . $pointSecond->i . ":" . $pointSecond->s];

        $this->worked_time = $this->workedHour($times);
        $this->save();
    }

    public function workedHour(array $times)
    {
        $total = 0;
        // Loop the data items
        foreach ($times as $time) {

            // Explode by separator :
            $temp = explode(":", $time);

            // Convert the hours into seconds
            // and add to total
            $total += (int) $temp[0] * 3600;

            // Convert the minutes to seconds
            // and add to total
            $total += (int) $temp[1] * 60;

            // Add the seconds to total
            $total += (int) $temp[2];
        }
        // Format the seconds back into HH:MM:SS
        $formatted = sprintf(
            '%02d:%02d:%01d',
            ($total / 3600),
            ($total / 60 % 60),
            $total % 60
        );

        return $formatted;
    }
}
