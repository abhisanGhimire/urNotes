@extends('layouts.main')
@section('content')
    <div class="card text-center text-white bg-dark mx-auto" style="width: 30%; back">
        <div class="card-header">
            <h5 class="card-title">urNotes</h5>
        </div>
        <div class="card-body">

            <p class="card-text ">urNotes: Streamline productivity with effortless note-taking.
                Capture, organize, and access notes effortlessly.
                Perfect for students, professionals, and creatives.
                Simplify digital organization, boost productivity.</p>

            <p class="card-text">Capture, Organize, Succeed – Note-taking made effortless with urNotes!</p>
            @guest
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary btn-light">Create Account</a>
                @endif
            @endguest
            @auth
                @if (Route::has('notes.index'))
                    <a href="{{ route('notes.index') }}" class="btn border-3 border-success text-success">View Notes</a>
                @endif
            @endauth


        </div>
    </div>
@endsection
