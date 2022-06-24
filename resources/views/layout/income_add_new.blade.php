@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <h3 class="mb-4 text-center">Add Income</h3>
                <form action="{{ route('create_income') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="title" class="form-control" id="floatingTitle">
                        <label for="floatingTitle">Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="amount" class="form-control" id="floatingAmount">
                        <label for="floatingAmount">Amount</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="datetime-local" name="date" class="form-control" id="floatingDate">
                        <label for="floatingDate">Date</label>
                    </div>
                    <div class="form-floating mb-3">                        
                        <select class="form-select" name="category" id="floatingCategory">
                            @foreach ($incomeCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingCategory">Select Category</label>
                    </div>
                    <button class="btn btn-primary form-control" type="submit">Add</button>
                </form>
            </div> {{-- col-4 end --}}
        </div> {{-- row end --}}
    </div> {{-- container end --}}
@endsection