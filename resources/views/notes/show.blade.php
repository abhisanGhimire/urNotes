@extends('layouts.main')

@section('content')
<div class="row text-center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left text-white">
            <h2>Show Note</h2>
        </div>
        @if (session('success'))
        <div class="mt-2 alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    </div>
</div>


    <div class="row text-center text-white bg-dark mx-auto" style="width: 30%;"">
        <div class="col-xs-12 col-sm-12 col-md-12 text-white">
            <div class="form-group">
                <strong>Id:</strong>
                {{ $note->id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-white">
            <div class="form-group">
                <strong>Note:</strong>
                {{ $note->note }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-white">
            <div class="form-group">
                <strong>Updated:</strong>
                {{ $note->updated_at->diffForHumans() }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-white">
            <div class="form-group">
                <strong>Created:</strong>
                {{ $note->created_at->diffForHumans() }}
            </div>
        </div>
        <div class="my-4 col-xs-12 col-sm-12 col-md-12 text-center text-white">
                <a class="btn border-3 border-danger text-danger" href="{{ route('notes.index') }}"> Back</a>
        </div>
    </div>


@endsection
