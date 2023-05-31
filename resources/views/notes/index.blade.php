@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List Notes</h2>
            </div>
            <div class="my-2 pull-right">
                <a class="btn btn-success" href="{{ route('notes.create') }}"> Create New Note</a>
            </div>
            @if(session('success'))
            <div class="mt-2 alert alert-success">
                {{session('success')}}
            </div>
            @endif
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Note</th>
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
                <form action="{{ route('notes.destroy',$note) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('notes.show',$note)}}">Show</a>
                    <a class="btn btn-primary" href="{{ route('notes.edit',$note)}}">Edit</a>
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
            </td>
        </tr>
        @empty
        <div>No Notes Found</div>
        @endforelse
    </table>
{!! $notes->render("pagination::bootstrap-4") !!}
@endsection
