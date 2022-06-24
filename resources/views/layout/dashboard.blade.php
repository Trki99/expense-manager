@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 text-center">
                <h3 class="mb-4">Incomes</h3>
                @if( sizeof($incomes) != 0 )
                <table class="table table-info table-bordered border-dark">
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Category</th>
                    </tr>
                    @foreach ($incomes as $income)
                        <tr>
                            <td>{{ $income->title }}</td>
                            <td>${{ $income->amount }}</td>
                            <td>{{ $income->date }}</td>
                            <td>{{ $income->category }}</td>
                        </tr>
                    @endforeach
                </table>
                @else
                    <p>You don't have any incomes added.</p>
                @endif
            </div>

            <div class="col-6 text-center">
                <h3 class="mb-4">Expenses</h3>
                @if( sizeof($expenses) != 0 )
                <table class="table table-info table-bordered border-dark">
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Category</th>
                    </tr>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->title }}</td>
                            <td>${{ $expense->amount }}</td>
                            <td>{{ $expense->date }}</td>
                            <td>{{ $expense->category }}</td>
                        </tr>
                    @endforeach
                </table>
                @else
                    <p>You don't have any expenses added.</p>
                @endif
            </div>

            <div class="col-12 text-center my-4">
                <h4>Current Balance: ${{ $currentBalance }}</h4>
            </div>
        </div> {{-- row end --}}
    </div> {{-- container end --}}
@endsection