@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="mb-4">Incomes</h3>
                @if( sizeof($incomes) != 0 )
                <table class="table table-info table-bordered border-dark">
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($incomes as $income)
                        <tr>
                            <td>{{ $income->title }}</td>
                            <td>${{ $income->amount }}</td>
                            <td>{{ $income->date }}</td>
                            <td>{{ $income->category }}</td>
                            <td>
                                <button type="button" class="btn btn-primary button-update" data-id="{{ $income->id }}" data-title="{{ $income->title }}" data-amount="{{ $income->amount }}" data-date="{{ $income->date }}" data-category="{{ $income->category }}" data-bs-toggle="modal" data-bs-target="#incomeUpdate">Update</button>
                            </td>
                            <td>
                                <form action="{{ route('delete_income') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $income->id }}">
                                    <button type="submit" onclick="return confirmDelete()" class="btn btn-primary">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <h4 class="mt-5">Total Income: ${{ $total }}</h4>
                @else
                    <p>You don't have any incomes added.</p>
                @endif
            </div> {{-- col-12 end --}}
        </div> {{-- row end --}}
    </div> {{-- container end --}}

    <script>
        function confirmDelete() {
            return confirm("Are you sure?");
        }
    </script>

    @include('modal.update_income_modal')
@endsection