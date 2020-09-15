@extends('layouts.master')

@include('layouts.menu', ['active' => 'series'])

<form action="{{ route('series.update', $series->id) }}" method="POST">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label" for="series_name">Nome</label>

            <input type="text" name="name" class="form-control" id="series_name" value="{{ $series->name }}" placeholder="Name">
        </div>

        {{ csrf_field() }}
        <input type="hidden" name="_method" value="POST">
    </div>


    <div class="col-md-12">
        <a href="{{ route('series.list') }}" alt="Back" title="Back" class="btn btn-primary btn-icon">
            <i class="glyphicon glyphicon-arrow-left"  aria-hidden="true"></i>
            Back
        </a>

        <button type="submit" class="btn btn-primary btn-icon btn-plus">
            <i class="glyphicon glyphicon-plus"  aria-hidden="true"></i>
            Edit
        </button>
    </div>
</form>

@include('layouts.alerts')
