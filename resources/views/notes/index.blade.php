@extends('layouts.main')

@section('content')

        <div class="card-header margin-tb text-white">
            <h3>List Notes</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="mt-2 alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="my-2 pull-right">
                <a class="btn fw-bold border-success text-success " href="{{ route('notes.create') }}"> Create New Note</a>
            </div>


        </div>
        <div class="row">
            @forelse ($notes as $note)
                <div class="card my-3 mx-3" style="width: 26rem; background-color: #408697;">
                    <div class="card-body">
                        <h5 class="card-title text-white ">{{ $note->title }}</h5>
                        <p class="card-text text-white">{!! $note->note !!}</p>

                    <div class="row d-flex justify-content-between">
                            <div class="col-auto">
                            <h6 class="card-subtitle text-white">{{ $note->updated_at->diffForHumans() }}</h6   >
                            </div>

                            <div class="col-auto">

                                  <a class="mx-2" href="{{ route('notes.show', $note) }}">
                                  <i class="bi bi-eye-fill " style="font-size: 1.1rem; color: rgb(60, 207, 248)">  </i>
                                  </a>
                                  <a class="mx-2" href="{{ route('notes.edit', $note) }}">
                                  <i class="bi bi-pencil-fill" style="font-size: 1.1rem; color: rgb(60, 207, 248)">  </i>
                                  </a>
                                  <a class="mx-2" data-toggle="modal" data-target="#deletemodal{{$note->id}}" href=" "><i class="bi bi-trash3-fill " style="font-size: 1.1rem; color: red;" ></i>
                                  </a>
                            </div>
                        </div>
                    </div>
                        @include('notes.modal')

                    </div>
            @empty
                <div>No Notes Found</div>
            @endforelse
        </div>



    {!! $notes->render('pagination::bootstrap-4') !!}
@endsection
