@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-3">
                <h2 class="mb-4 text-center">Create User</h2>
                <form action="{{ route('admin_create_user') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="floatingName">
                        <label for="floatingName">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingEmail">
                        <label for="floatingEmail">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="floatingPassword">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password_confirmation" class="form-control">
                        <label for="floatingConfirmPassword">Confirm Password</label>
                    </div>
                    <button class="btn btn-primary form-control" type="submit">Create</button>
                </form>
            </div> {{-- col-3 end --}}
        </div> {{-- row end --}}
    </div> {{-- container end --}}
@endsection