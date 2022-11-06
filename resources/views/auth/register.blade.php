@extends('layout.main')

@section('content')
<div class="col-md-6 offset-md-3 mt-5">
    <form class="form-control" action="{{ route('auth.createUser') }}" method="post" autocomplete="off">
        {!! csrf_field() !!}
        <legend>Sign Up</legend>
        @if(session()->exists('message'))
            <x-alert color="{{ session()->get('color') }}" message="{{ session()->get('message') }}"/>
        @endif
        <div class="mb-3">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inputRememberPassword" class="form-label">Repeat password</label>
            <input type="password" class="form-control" id="password" name="remember_password">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection