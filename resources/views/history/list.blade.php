@extends('layouts.master')

@include('history.menu')

<div class="col-md-12 clear">
    <h1>Series History</h1>
</div>

<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>Name</th>
                <th>Season</th>
                <th>Episode</th>
                <th>Platform</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($seriesHistoryList as $seriesHistory)
                <tr>
                    <td>{{ $seriesHistory->series->name }}</td>
                    <td>{{ $seriesHistory->current_season }}</td>
                    <td>{{ $seriesHistory->current_episode }}</td>
                    <td>{{ $seriesHistory->platform->name }}</td>
                    <td class="media">
                        <a href="{{ route('seriesHistory.edit', $seriesHistory->series_history_id) }}" alt="Edit" title="Edit" class="btn btn-primary btn-icon">
                            <i class="glyphicon glyphicon-edit"  aria-hidden="true"></i>
                        </a>
                        <form class="inline m-0" action="{{ route('seriesHistory.delete', $seriesHistory->series_history_id) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" alt="Delete" title="Delete" class="btn btn-danger btn-icon">
                                <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-md-12">
        <a href="{{ route('seriesHistory.new') }}" alt="New" title="New" class="btn btn-primary btn-icon">
            <i class="glyphicon glyphicon-plus"  aria-hidden="true"></i>
            New
        </a>
    </div>
</div>

@include('layouts.alerts')
