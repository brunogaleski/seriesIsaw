@extends('layouts.master')

@include('layouts.menu', ['active' => 'platform'])

<div class="col-md-12">
    <h1>Create Platform</h1>
</div>

<form action="/platform" method="POST">
    @csrf

    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label" for="platform_name">Name</label>

            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="platform_name" placeholder="Name">
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>


    <div class="col-md-12">
        <a href="{{ route('platform.list') }}" alt="Back" title="Back" class="btn btn-primary btn-icon">
            <i class="glyphicon glyphicon-arrow-left"  aria-hidden="true"></i>
            Back
        </a>

        <button type="submit" class="btn btn-primary btn-icon btn-plus">
            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
            Add
        </button>
    </div>
</form>

@include('layouts.alerts')

