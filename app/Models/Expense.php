<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'amount',
        'created_at',
        'updated_at'
    ];

    public static function getExpensesForDashboard( $user_id ) {
        $expenses = DB::table('categories')
            ->join('expenses', 'expenses.category_id', '=', 'categories.id')
            ->select('title', 'amount', DB::raw('cast(expenses.created_at as date) as date'), 'categories.name as category')
            ->where('expenses.user_id', '=', $user_id)
            ->whereMonth('expenses.created_at', date('m'))
            ->whereYear('expenses.created_at', date('Y'))
            ->get();

        $total = 0;
        foreach($expenses as $expense) {
            $total += $expense->amount;
        }

        return [
            'expenses' => $expenses,
            'total' => $total
        ];
    }

    public static function getAllExpenses( $user_id ) {
        $expenses = DB::table('categories')
            ->join('expenses', 'expenses.category_id', '=', 'categories.id')
            ->select('expenses.id as id', 'title', 'amount', DB::raw('cast(expenses.created_at as date) as date'), 'categories.name as category')
            ->where('expenses.user_id', '=', $user_id)
            ->get();

        $total = 0;
        foreach($expenses as $expense) {
            $total += $expense->amount;
        }

        return [
            'expenses' => $expenses,
            'total' => $total
        ];
    }

    public static function getExpensesForSpecificPeriod( $user_id, $dateFrom, $dateTo ) {
        $expenses = DB::table('categories')
            ->join('expenses', 'expenses.category_id', '=', 'categories.id')
            ->select('expenses.id as id', 'title', 'amount', DB::raw('cast(expenses.created_at as date) as date'), 'categories.name as category')
            ->where([ 
                ['expenses.user_id', '=', $user_id],
                ['expenses.created_at', '>=', $dateFrom],
                ['expenses.created_at', '<=', $dateTo]
                    ])
            ->orderBy('date')
            ->get();

        $total = 0;
        foreach($expenses as $expense) {
            $total += $expense->amount;
        }

        return [
            'expenses' => $expenses,
            'total' => $total
        ];
    }

    public function updateExpense( $request ) {
        if( $request->has('title') ) {
            $this->title = $request->title;
        }
        if( $request->has('amount') ) {
            $this->amount = $request->amount;
        }
        if( $request->has('date') && !is_null($request->date) ) {
            $this->created_at = $request->date;
        }
        if( $request->has('category') ) {
            $this->category_id = $request->category;
        }

        $this->save();
    }
}
