@extends('layouts.main')

@section('content')
    <div class="card-header margin-tb text-white">
        <h3>Trashed Notes</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="mt-2 alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="row">
        @forelse ($notes as $note)
            <div class="card my-3 mx-3" style="width: 26rem; background-color: #408697;">
                <div class="card-body">
                    <h5 class="card-title text-white ">{{ $note->title }}</h5>
                    <p class="card-text text-white">{{ $note->note }}</p>

                    <h6 class="card-subtitle mb-2 text-white">{{ $note->deleted_at->diffForHumans() }}</h6>
                    <div class='float-right'>
                        <form action="{{ route('trashed.update', $note) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button
                                class="restore_button"
                                type="submit"><i class="bi bi-reply-fill"
                                    style="font-size: 1.1rem; color: rgb(60, 207, 248)"></i></button>

                            <a class="mx-2" data-toggle="modal" data-target="#deletemodal{{ $note->id }}"
                                href=" "><i class="bi bi-trash3-fill " style="font-size: 1.1rem; color: red;"></i>
                            </a>
                        </form>
                    </div>


                    @include('notes.modal')





                </div>
            </div>
        @empty
            <div class='text-white'>No Notes Found</div>
        @endforelse
    </div>




    {!! $notes->render('pagination::bootstrap-4') !!}
@endsection
