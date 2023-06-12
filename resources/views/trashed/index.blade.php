@extends('layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <div class="card-header">
        <h3>Trashed Notes
            <button id="restoreAll" class="btn btn-success" disabled>Restore All</button>
            <button id="selectAll" class="btn btn-info">Select All</button>
            <button id="deleteAll" class="btn btn-danger" disabled>Delete All</button>
        </h3>
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
                    <h5 class="card-title"> <input class="form-check-input" type="checkbox" id="{{ $note->id }}"
                            name="{{ $note->id }}" value="{{ $note->id }}">
                        {{ $note->title }}
                    </h5>

                    <p class="card-text">{!! $note->note !!}</p>
                    <h6 class="card-subtitle mb-2 text-white">{{ $note->deleted_at->diffForHumans() }}</h6>
                    <div class='float-right'>
                        <form action="{{ route('trashed.update', $note) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="restore_button" type="submit"><i class="bi bi-reply-fill"
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
            <div>No Notes Found</div>
        @endforelse
    </div>
    {!! $notes->render('pagination::bootstrap-4') !!}
@endsection

<script>
    var ids = [];

    document.addEventListener('DOMContentLoaded', function() {
        var deleteButton = document.getElementById('deleteAll');
        var restoreButton = document.getElementById('restoreAll');
        document.getElementById('deleteAll').addEventListener('click',
            onClick);
        document.getElementById('restoreAll').addEventListener('click',
            onresClick);
        var checkboxes = document.querySelectorAll('input[type=checkbox]');
        var flag = 0;
        var flagforselect = false;
        document.getElementById('selectAll').addEventListener('click', function(e) {
            if (!flagforselect) {
                flagforselect = true;
                checkboxes.forEach(function(checkbox) {
                    ids=[]
                    checkbox.checked = true
                });
                deleteButton.disabled = false;
                restoreButton.disabled = false;
                document.getElementById('selectAll').innerHTML = 'Unselect All';
                @foreach ($notes as $note)
                    ids.push('{{ $note->id }}')
                @endforeach
                console.log(ids);

            } else {
                flagforselect = false;
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false
                });
                deleteButton.disabled = true;
                restoreButton.disabled = true;
                document.getElementById('selectAll').innerHTML = 'Select All';
                ids=[]
                console.log(ids);
            }
        });

        checkboxes.forEach(function(checkbox) {

            checkbox.addEventListener('change', function(event) {
                var isChecked = event.target.checked;
                var checkboxId = event.target.id;
                if (isChecked) {
                    flag += 1;
                    console.log('Checkbox with ID', checkboxId, 'is checked.' +
                        flag);
                    ids.push(checkboxId);
                    // Perform additional actions for checked checkboxes
                } else {
                    flag -= 1;
                    console.log('Checkbox with ID', checkboxId, 'is unchecked.' +
                        flag);
                    ids = ids.filter(function(id) {
                        return id !== checkboxId;
                    }); // Perform additional actions for unchecked checkboxes
                }
                if (flag == 0) {
                    deleteButton.disabled = true;
                    restoreButton.disabled = true;
                } else {
                    deleteButton.disabled = false;
                    restoreButton.disabled = false;

                    document.getElementById('deleteAll').addEventListener('click',
                        onClick);
                    document.getElementById('restoreAll').addEventListener('click',
                        onresClick);
                }
                console.log(ids);
            });
        });
    });

    let url = '{{ route('trashed.destroyAll') }}';
    let resurl = '{{ route('trashed.restoreAll') }}';


    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function onClick() {
        fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    ids
                })
            })
            .then(response => response.json()) // second step
            .then(data => {
                if (data.result == 'success') {
                    window.location.href = "{{ route('all.deleted') }}";
                }
            })
            .catch(function(error) {
                console.log(error);
            });
    }


    function onresClick() {
        fetch(resurl, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    ids
                })
            })
            .then(response => response.json()) // second step
            .then(data => {
                if (data.result == 'success') {
                    window.location.href = "{{ route('all.restored') }}";
                }
            })
            .catch(function(error) {
                console.log(error);
            });
    }
</script>
