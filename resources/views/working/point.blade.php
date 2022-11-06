@extends('layout.main')

@section('content')
<div class="d-flex justify-content-between mt-5">
    <h3>Register Point</h3>
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Register Point</li>
            </ol>
          </nav>
    </div>
</div>
<hr/>
@if(session()->exists('message'))
<x-alert color="{{ session()->get('color') }}" message="{{ session()->get('message') }}"/>
@endif
<div class="card">
    <form action="{{ route('point.register') }}" method="POST" autocomplete="off">
        {!! csrf_field() !!}
        <div class="card-header">
            <b>Today:</b> <?= date("F j, Y, g:i a"); ?>
        </div>
        <div class="card-body">
            @if(!empty($workingTimes))
                <input type="hidden" name="working_id" value="{{ $workingTimes->id }}"/>
                <div class="card" style="width: 30rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            @if(!empty($workingTimes->time_first))
                                First Point: {{ date('d/m/Y H:i:s', strtotime($workingTimes->time_first)); }}
                            @else
                                <span>Click register for first point</span>
                            @endif
                        </li>
                        <li class="list-group-item">
                            @if(!empty($workingTimes->time_second))
                                Second Point: {{ date('d/m/Y H:i:s', strtotime($workingTimes->time_second)); }}
                            @else
                                <span>Click register for second point</span>
                            @endif
                        </li>
                        <li class="list-group-item">
                            @if(!empty($workingTimes->time_third))
                                Third Point: {{ date('d/m/Y H:i:s', strtotime($workingTimes->time_third)); }}
                            @else
                                <span>Click register for third point</span>
                            @endif
                        </li>
                        <li class="list-group-item">
                            @if(!empty($workingTimes->time_four))
                                Four Point: {{ date('d/m/Y H:i:s', strtotime($workingTimes->time_four)); }}
                            @else
                                <span>Click register for four point</span>
                            @endif
                        </li>
                    </ul>
                </div>
            @else
                <span class="text-danger">Click button for first point...</span>
            @endif
            <div class="mt-3">
                <button href="submit" class="btn btn-success">Register</button><br>
                <small>Please click button register</small>
            </div>
        </div>
    </form>
    <div class="card-footer">
        Last login: {{ Auth::user()->last_login_at }}
    </div>
</div>
@endsection