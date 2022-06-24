<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function showReport( Request $request ) {
        $user_id = auth()->user()->id;

        $dataToSend = [
            'title' => 'Report'
        ];

        if( $request->has('fromDate') && $request->has('toDate') ) {
            $request->validate([
                'fromDate' => 'required',
                'toDate' => 'required'
            ]);

            $allIncomes = Income::getIncomesForSpecificPeriod( $user_id, $request->fromDate, $request->toDate );
            $allExpenses = Expense::getExpensesForSpecificPeriod( $user_id, $request->fromDate, $request->toDate );
            $balance = $allIncomes['total'] - $allExpenses['total'];
            
            $dataToSend['fromDate'] = $request->fromDate;
            $dataToSend['toDate'] = $request->toDate;
            
        } else {
            $allIncomes = Income::getAllIncomes( $user_id );
            $allExpenses = Expense::getAllExpenses( $user_id );
            $balance = $allIncomes['total'] - $allExpenses['total'];
        }

        $dataToSend['incomes'] = $allIncomes['incomes'];
        $dataToSend['expenses'] = $allExpenses['expenses'];
        $dataToSend['currentBalance'] = $balance;

        return view('layout.report', $dataToSend);
    }
}
