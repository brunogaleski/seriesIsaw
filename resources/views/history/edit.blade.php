@extends('layouts.master')

@include('layouts.logout')

<div class="col-md-12 clear">
    <h1>Edit Series History</h1>
</div>

<form action="{{ route('seriesHistory.update', $seriesHistory->series_history_id) }}" method="POST">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label" for="series">Series</label>
            <select name="series_id" class="form-control">
                @foreach($seriesList as $series)
                    <option value="{{$series->id}}" @if($series->name == $seriesHistory->series->name) selected @endif>{{ $series->name }}</option>
                @endforeach
            </select>

            <label class="control-label" for="series">Platform</label>
            <select name="platform_id" class="form-control">
                @foreach($platformList as $platform)
                    <option value="{{$platform->id}}" @if($platform->name == $seriesHistory->platform->name) selected @endif>{{$platform->name}}</option>
                @endforeach
            </select>


            <label class="control-label" for="current_season">Current Season</label>
            <input type="number" name="current_season" value="{{ $seriesHistory->current_season }}" class="form-control" id="current_season" placeholder="Current Season">

            <label class="control-label" for="current_episode">Current Episode</label>
            <input type="number" name="current_episode" value="{{ $seriesHistory->current_episode }}" class="form-control" id="current_episode" placeholder="Current Episode">
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
