@extends('layouts.master')

<div>
    @include('layouts.logout')
</div>


<div class="col-md-12 clear">
    <h1>Create Series History</h1>
</div>

<form action="/new" method="POST">
    @csrf

    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label" for="series">Series</label>
            <select name="series_id" class="form-control">
                @foreach($seriesList as $series)
                    <option value="{{$series->id}}">{{$series->name}}</option>
                @endforeach
            </select>

            <label class="control-label" for="series">Platform</label>
            <select name="platform_id" class="form-control">
                @foreach($platformList as $platform)
                    <option value="{{$platform->id}}">{{$platform->name}}</option>
                @endforeach
            </select>

            <label class="control-label" for="current_season">Current Season</label>
            <input type="number" name="current_season" value="{{ old('current_season') }}" class="form-control" id="current_season" placeholder="Current Season">

            <label class="control-label" for="current_episode">Current Episode</label>
            <input type="number" name="current_episode" value="{{ old('current_episode') }}" class="form-control" id="current_episode" placeholder="Current Episode">
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>


    <div class="col-md-12">
        <a href="{{ route('seriesHistory.list') }}" alt="Back" title="Back" class="btn btn-primary btn-icon">
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

