@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <h3 class="mb-4 text-center">Create Category</h3>
                <form action="{{ route('create_category') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="floatingName">
                        <label for="floatingName">Category Name</label>
                    </div>
                    <div class="form-floating mb-3">                        
                        <select class="form-select" name="group" aria-label="Default select example" id="floatingGroup">
                            <option value="" selected hidden disabled></option>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                        <label for="floatingGroup">Category Group</label>
                    </div>
                    <button class="btn btn-primary form-control" type="submit">Create</button>
                </form>
            </div> {{-- col-4 end --}}
        </div> {{-- row end --}}
    </div> {{-- container end --}}
@endsection