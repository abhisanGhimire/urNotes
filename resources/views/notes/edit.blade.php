@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Note</h2>
            </div>

        </div>
    </div>



    <form action="{{ route('notes.update', $note) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $note->title) }}"
                        placeholder="Title">
                    <span class="text-danger small">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Note:</strong>
                    <textarea type="text" name="note" class="invisible form-control tinyMCE" placeholder="Note">{{ old('note', $note->note) }} </textarea>
                    <span class="text-danger small">
                        @error('note')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="my-4 col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('notes.index') }}"> Back</a>
            </div>
        </div>

    </form>
@endsection
