<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    public function showExpenses() {
        $user_id = auth()->user()->id;
        $expenses = Expense::getAllExpenses( $user_id );

        $dataToSend = [
            'title' => 'Expense',
            'expenses' => $expenses['expenses'],
            'total' => $expenses['total'],
            'expenseCategories' => Category::getCategoriesFromExpenseGroup( $user_id )
        ];

        return view('layout.expenses', $dataToSend);
    }

    public function showAddNewExpense() {
        $dataToSend = [
            'title' => 'Add Expense',
            'expenseCategories' => Category::getCategoriesFromExpenseGroup( auth()->user()->id )
        ];

        return view('layout.expense_add_new', $dataToSend);
    }

    public function createExpense( Request $request ) {
        $request->validate([
            'title' => ['required', 'string', 'max:40'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'string'],
            'category' => ['required', 'numeric']
        ]);

        try {
            Expense::create([
                'user_id' => auth()->user()->id,
                'category_id' => $request->category,
                'title' => $request->title,
                'amount' => $request->amount,
                'created_at' => $request->date,
                'updated_at' => $request->date
            ]);
        }
        catch (\Exception $exception) {
            Log::error('Can\'t create expense: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'Expense is added successfully.');

        return redirect('expenses');
    }

    public function updateExpense( Request $request ) {
        $request->validate([
            'id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'max:40'],
            'amount' => ['required', 'numeric'],
            'date' => ['nullable', 'date'],
            'category' => ['required', 'numeric']
        ]);

        try {
            $expense = Expense::findOrFail( $request->post('id') );
            $expense->updateExpense( $request );
        }
        catch (\Exception $exception) {
            Log::error('Can\'t update expense: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'Expense is updated successfully.');

        return redirect('expenses');
    }

    public function deleteExpense( Request $request ) {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        Expense::destroy($request->id);

        $request->session()->flash('messageForModal', 'Expense is deleted successfully.');

        return redirect('expenses');
    }
}
