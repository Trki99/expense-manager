@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center mb-4">
            <div class="col-3">
                <p class="text-center my-3">Filter your Incomes and Expenses for a specific period.</p>
                <form action="{{ route('post_report') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="date" name="fromDate" class="form-control">
                        <label for="">From</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="toDate" class="form-control">
                        <label for="">To</label>
                    </div>
                    <button type="submit" class="btn btn-primary form-control">Filter</button>
                </form>
            </div> {{-- col-3 end --}}
        </div> {{-- row end --}}

        @if( isset($fromDate) && isset($toDate) ) 
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center my-4">Your report from {{ $fromDate }} to {{ $toDate }}</h5>
                </div> {{-- col-12 --}}
            </div> {{-- row end --}}
        @endif

        <div class="row mt-4">
            <div class="col-6 text-center">
                <h3 class="mb-3">Incomes</h3>
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
                    <p>You don't have any incomes for selected period.</p>
                @endif
            </div>

            <div class="col-6 text-center">
                <h3 class="mb-3">Expenses</h3>
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
                    <p>You don't have any expenses for selected period.</p>
                @endif
            </div>

            <div class="col-12 text-center my-4">
                <h4>Balance: ${{ $currentBalance }}</h4>
            </div>
        </div> {{-- row end --}}
    </div> {{-- container end --}}
@endsection