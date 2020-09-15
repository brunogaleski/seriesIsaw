@extends('layouts.master')

@include('layouts.menu', ['active' => 'platform'])

<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($platformList as $platform)
                <tr>
                    <td>{{ $platform->name }}</td>
                    <td class="media">
                        <a href="{{ route('platform.edit', $platform->id) }}" alt="Edit" title="Edit" class="btn btn-primary btn-icon">
                            <i class="glyphicon glyphicon-edit"  aria-hidden="true"></i>
                        </a>
                        <form class="inline m-0" action="{{ route('platform.delete', $platform->id) }}" method="POST">
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
        <a href="{{ route('platform.new') }}" alt="New" title="New" class="btn btn-primary btn-icon">
            <i class="glyphicon glyphicon-plus"  aria-hidden="true"></i>
            New
        </a>
    </div>
</div>

@include('layouts.alerts')

