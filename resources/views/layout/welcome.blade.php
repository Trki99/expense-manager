@extends('app')

@section('content')
    <div class="position-relative overflow-hidden p-3 text-center">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal">Simple way to manage finances</h1>
        <p class="lead fw-normal">It takes seconds to record daily transactions. Put them into clear and visualized categories such as Expense: Food, Shopping or Income: Salary, Gift.</p>
        <a class="btn btn-outline-secondary" href="{{ route('register') }}">Join us</a>
        </div>
    </div>
@endsection