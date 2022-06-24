@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="mb-4">Expenses</h3>
                @if( sizeof($expenses) != 0 )
                <table class="table table-info table-bordered border-dark">
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->title }}</td>
                            <td>${{ $expense->amount }}</td>
                            <td>{{ $expense->date }}</td>
                            <td>{{ $expense->category }}</td>
                            <td>
                                <button type="button" class="btn btn-primary button-update" data-id="{{ $expense->id }}" data-title="{{ $expense->title }}" data-amount="{{ $expense->amount }}" data-date="{{ $expense->date }}" data-category="{{ $expense->category }}" data-bs-toggle="modal" data-bs-target="#expenseUpdate">Update</button>
                            </td>
                            <td>
                                <form action="{{ route('delete_expense') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $expense->id }}">
                                    <button type="submit" onclick="return confirmDelete()" class="btn btn-primary">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <h4 class="mt-5">Total Expense: ${{ $total }}</h4>
                @else
                    <p>You don't have any expenses added.</p>
                @endif
            </div> {{-- col-12 end --}}
        </div> {{-- row end --}}
    </div> {{-- container end --}}

    <script>
        function confirmDelete() {
            return confirm("Are you sure?");
        }
    </script>

    @include('modal.update_expense_modal')
@endsection