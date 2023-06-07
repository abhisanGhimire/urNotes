@extends('layouts.main')

@section('content')
<div class="row text-center">
    <div class="col-lg-12">
        <div class="pull-left">
            <h2>Show Note</h2>
        </div>

        @if (session('success'))
        <div class="mt-2 alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    </div>
</div>


    <div class="row">
        <div class="my-4 col-xs-12 col-sm-12 col-md-12  text-white">
            <a class="btn btn-primary" href="{{ route('notes.index') }}"><<</a>
    </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Id:</strong>
                {{ $note->id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="form-group">
                <strong>Note:</strong>
                {!! $note->note !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Updated:</strong>
                {{ $note->updated_at->diffForHumans() }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Created:</strong>
                {{ $note->created_at->diffForHumans() }}
            </div>
        </div>

    </div>


@endsection
