@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Trashed Notes</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="mt-2 alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Note</th>
                    <th>Deleted</th>
                    <th width="280px">Action</th>
                </tr>
                @forelse ($notes as $note)
                    <tr>
                        <td>{{ $note->id }}</td>
                        <td>{{ $note->title }}</td>
                        <td>{{ $note->note }}</td>
                        <td>{{ $note->deleted_at->diffForHumans() }}</td>
                        <td>
                            <form action="{{ route('trashed.update', $note) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                                <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete Forever</a>
                            </form>
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
