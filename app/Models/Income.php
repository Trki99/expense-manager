<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Income extends Model
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

    public static function getIncomesForDashboard( $user_id ) {
        $incomes = DB::table('categories')
            ->join('incomes', 'incomes.category_id', '=', 'categories.id')
            ->select('title', 'amount', DB::raw('cast(incomes.created_at as date) as date'), 'categories.name as category')
            ->where('incomes.user_id', '=', $user_id)
            ->whereMonth('incomes.created_at', date('m'))
            ->whereYear('incomes.created_at', date('Y'))
            ->get();
        
        $total = 0;
        foreach($incomes as $income) {
            $total += $income->amount;
        }

        return [
            'incomes' => $incomes,
            'total' => $total
        ];
    }

    public static function getAllIncomes( $user_id ) {
        $incomes = DB::table('categories')
            ->join('incomes', 'incomes.category_id', '=', 'categories.id')
            ->select('incomes.id as id', 'title', 'amount', DB::raw('cast(incomes.created_at as date) as date'), 'categories.name as category')
            ->where('incomes.user_id', '=', $user_id)
            ->get();

        $total = 0;
        foreach($incomes as $income) {
            $total += $income->amount;
        }

        return [
            'incomes' => $incomes,
            'total' => $total
        ];
    }

    public static function getIncomesForSpecificPeriod( $user_id, $fromDate, $toDate ) {
        $incomes = DB::table('categories')
            ->join('incomes', 'incomes.category_id', '=', 'categories.id')
            ->select('incomes.id as id', 'title', 'amount', DB::raw('cast(incomes.created_at as date) as date'), 'categories.name as category')
            ->where([ 
                ['incomes.user_id', '=', $user_id],
                ['incomes.created_at', '>=', $fromDate],
                ['incomes.created_at', '<=', $toDate]
                    ])
            ->orderBy('date')
            ->get();

        $total = 0;
        foreach($incomes as $income) {
            $total += $income->amount;
        }

        return [
            'incomes' => $incomes,
            'total' => $total
        ];
    }

    public function updateIncome( $request ) {
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
