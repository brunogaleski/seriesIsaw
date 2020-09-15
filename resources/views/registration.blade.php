@extends('layouts.master')

<h1>Registration</h1>

<form action="/registration" method="POST">
    @csrf

    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label" for="username">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="username" placeholder="Username">

            <label class="control-label" for="password">Password</label>
            <input type="password" name="password"  class="form-control" id="password" placeholder="Password">
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>


    <div class="col-md-12">
        <a href="/login" class="btn btn-primary btn-icon btn-plus">
            <i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i>
            Back
        </a>

        <button type="submit" class="btn btn-primary btn-icon btn-plus">
            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
            Confirm
        </button>
    </div>
</form>

@include('layouts.alerts')
