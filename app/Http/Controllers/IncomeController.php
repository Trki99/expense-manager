<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IncomeController extends Controller
{
    public function showIncomes() {
        $user_id = auth()->user()->id;
        $incomes = Income::getAllIncomes( $user_id );

        $dataToSend = [
            'title' => 'Income',
            'incomes' => $incomes['incomes'],
            'total' => $incomes['total'],
            'incomeCategories' => Category::getCategoriesFromIncomeGroup( $user_id )
        ];

        return view('layout.incomes', $dataToSend);
    }

    public function showAddNewIncome() {
        $dataToSend = [
            'title' => 'Add Income',
            'incomeCategories' => Category::getCategoriesFromIncomeGroup( auth()->user()->id )
        ];

        return view('layout.income_add_new', $dataToSend);
    }

    public function createIncome( Request $request ) {
        $request->validate([
            'title' => ['required', 'string', 'max:40'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'string'],
            'category' => ['required', 'numeric']
        ]);

        try {
            Income::create([
                'user_id' => auth()->user()->id,
                'category_id' => $request->category,
                'title' => $request->title,
                'amount' => $request->amount,
                'created_at' => $request->date,
                'updated_at' => $request->date
            ]);
        }
        catch (\Exception $exception) {
            Log::error('Can\'t create income: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'Income is added successfully.');

        return redirect('incomes');
    }

    public function updateIncome( Request $request ) {
        $request->validate([
            'id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'max:40'],
            'amount' => ['required', 'numeric'],
            'date' => ['nullable', 'date'],
            'category' => ['required', 'numeric']
        ]);

        try {
            $income = Income::findOrFail( $request->post('id') );
            $income->updateIncome( $request );
        }
        catch (\Exception $exception) {
            Log::error('Can\'t update income: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'Income is updated successfully.');

        return redirect('incomes');
    }

    public function deleteIncome( Request $request ) {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        Income::destroy($request->id);

        $request->session()->flash('messageForModal', 'Income is deleted successfully.');

        return redirect('incomes');
    }
}
