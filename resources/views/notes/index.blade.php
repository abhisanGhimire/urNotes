@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>List Notes</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="mt-2 alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="my-2 pull-right">
                <a class="btn btn-success" href="{{ route('notes.create') }}"> Create New Note</a>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th class="">Note</th>
                    <th>Updated</th>
                    <th width="280px">Action</th>
                </tr>
                @forelse ($notes as $note)
                    <tr>
                        <td>{{ $note->id }}</td>
                        <td>{{ $note->title }}</td>
                        <td>{{ $note->note }}</td>
                        <td>{{ $note->updated_at->diffForHumans() }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('notes.show', $note) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('notes.edit', $note) }}">Edit</a>
                            <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</a>
                            @include('notes.modal')
                        </td>
                    </tr>
                @empty
                    <div>No Notes Found</div>
                @endforelse
            </table>
        </div>
    </div>

    {!! $notes->render('pagination::bootstrap-4') !!}
@endsection
