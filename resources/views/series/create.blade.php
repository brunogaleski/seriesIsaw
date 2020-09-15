@extends('layouts.master')

@include('layouts.menu', ['active' => 'series'])

<div class="col-md-12">
    <h1>Create Series</h1>
</div>

<form action="/series" method="POST">
    @csrf

    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label" for="series_name">Name</label>

            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="series_name" placeholder="Name">
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>


    <div class="col-md-12">
        <a href="{{ route('series.list') }}" alt="Back" title="Back" class="btn btn-primary btn-icon">
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

