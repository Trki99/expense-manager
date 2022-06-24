<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showDashboard() {
        $user_id = auth()->user()->id;
        $incomes = Income::getIncomesForDashboard( $user_id );
        $expenses = Expense::getExpensesForDashboard( $user_id );

        $dataToSend = [
            'title' => 'Dashboard',
            'incomes' => $incomes['incomes'],
            'expenses' => $expenses['expenses'],
            'currentBalance' => $incomes['total'] - $expenses['total']
        ];

        return view('layout.dashboard', $dataToSend);
    }
}
