@extends('app')

@section('content')
    <div class="container text-center mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-3">  
                <h2 class="mb-4">Profile Info</h2>
                <p class="mb-4">Name: <b>{{ $userData->name }}</b></p>
                <p class="mb-4">Email: <b>{{ $userData->email }}</b></p>
                <p class="mb-4">Password: <b>Hidden</b></p>
                <button type="button" class="btn btn-primary button-update" data-name="{{ $userData->name }}" data-email="{{ $userData->email }}" data-bs-toggle="modal" data-bs-target="#profileUpdate">Update</button>
            </div>
        </div> {{-- row end --}}
    </div> {{-- container end --}}

    @include('modal.update_profile_modal')
@endsection