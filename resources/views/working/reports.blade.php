@extends('layout.main')

@section('content')
<div class="d-flex justify-content-between mt-5">
    <h3>My Working Times (Reports)</h3>
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Reports</li>
            </ol>
          </nav>
    </div>
</div>
<hr/>
@if(session()->exists('message'))
<x-alert color="{{ session()->get('color') }}" message="{{ session()->get('message') }}"/>
@endif
@include('working.search')
<hr/>
<table class="table table-striped">
    <thead>
        <th>#</th>
        <th>Work Date</th>
        <th>First Time</th>
        <th>Second Time</th>
        <th>Third Time</th>
        <th>Four Time</th>
        <th>Worked Time</th>
    </thead>
    <tbody>
        @if(!empty($workingTimes))
            @foreach($workingTimes as $working)
            <tr>
                <td>{{ $working->id }}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($working->work_date)); }}</td>
                <td>{{ date('H:i:s', strtotime($working->time_first)); }}</td>
                <td>{{ date('H:i:s', strtotime($working->time_second)); }}</td>
                <td>{{ date('H:i:s', strtotime($working->time_third)); }}</td>
                <td>{{ date('H:i:s', strtotime($working->time_four)); }}</td>
                <td class="text-success">{{ $working->worked_time }}</td>
            </tr>
            @endforeach
        @else
            No results....
        @endif
    </tbody>
    
    {{ $workingTimes->links() }}
</table>
@endsection