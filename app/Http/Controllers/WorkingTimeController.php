<?php

namespace App\Http\Controllers;

use App\Models\WorkingTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkingTimeController extends Controller
{
    /**
     * Filter working
     */
    public function point(Request $request)
    {
        $workingTimes = WorkingTime::where('user_id', '=', Auth::user()->id)->whereDate('work_date', '=', date("Y-m-d H:i:s"))->first();
        return view('working.point', ['workingTimes' => $workingTimes]);
    }

    public function reports(Request $request)
    {
        $workDate = $request->input('work_date');
        if (!empty($workDate)) {
            $workingTimes = WorkingTime::where('user_id', '=', Auth::user()->id)->whereDate('work_date', '=', $workDate)->paginate(15);
        } else {
            $workingTimes = WorkingTime::where('user_id', '=', Auth::user()->id)->paginate(15);
        }
        return view('working.reports', ['workingTimes' => $workingTimes]);
    }

    /**
     * Register and Updated time
     */
    public function register(Request $request)
    {
        // Get for second, third and four working time;
        $updatedWorking = WorkingTime::find(['id' => $request['working_id']])->first();

        // Save time second
        if (empty($updatedWorking->time_second)) {
            $updatedWorking->time_second = date("Y-m-d H:i:s");
            $updatedWorking->save();
            return redirect()->route('point')->with(['color' => 'success', 'message' => 'Second working time created successfully.']);
        }

        // Save time third
        if (empty($updatedWorking->time_third)) {
            $updatedWorking->time_third = date("Y-m-d H:i:s");
            $updatedWorking->save();
            return redirect()->route('point')->with(['color' => 'success', 'message' => 'Third working time created successfully.']);
        }
        // Save time four
        if (empty($updatedWorking->time_four)) {
            //calculate worked time
            $updatedWorking->time_four = date("Y-m-d H:i:s");
            $updatedWorking->save();

            $updatedWorking->calculateWorkedTime();
            return redirect()->route('point')->with(['color' => 'success', 'message' => 'Four working time created successfully.']);
        }

        if (!empty($updatedWorking) > 0) {
            return redirect()->route('point')->with(['color' => 'info', 'message' => 'No more creating working time for today.']);
        }

        // First Working Time
        $newWorking = new WorkingTime();
        $newWorking->user_id = Auth::user()->id;
        $newWorking->time_first = date("Y-m-d H:i:s");
        $newWorking->save();
        return redirect()->route('point')->with(['color' => 'success', 'message' => 'First working time created successfully.']);
    }
}
