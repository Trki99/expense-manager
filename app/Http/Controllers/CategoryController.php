<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function showCategories() {
        $dataToSend = [
            'title' => 'Categories',
            'categories' => Category::getCategoriesForView( auth()->user()->id )
        ];

        return view('layout.categories', $dataToSend);
    }

    public function showAddNewCategory() {
        $dataToSend = [
            'title' => 'Add Category'
        ];

        return view('layout.category_add_new', $dataToSend);
    }

    public function createCategory( Request $request ) {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'group' => ['required', 'string']
        ]);

        try {
            Category::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'group' => $request->group
            ]);
        }
        catch (\Exception $exception) {
            Log::error('Can\'t create category: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'Category is created successfully.');

        return redirect('categories');
    }

    public function updateCategory( Request $request ) {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'group' => ['required', 'string']
        ]);

        try {
            $category = Category::findOrFail( $request->post('id') );
            $category->updateCategory( $request );
        }
        catch (\Exception $exception) {
            Log::error('Can\'t update category: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'Category is updated successfully.');

        return redirect('categories');
    }

    public function deleteCategory( Request $request ) {
        $request->validate([
            'category_id' => 'required|numeric',
            'category_group' => 'required|string',
            'reassign_category' => 'required|numeric'
        ]);

        $user_id = auth()->user()->id;

        if( $request->post('category_group') == 'Income' ) {

            if( !is_null($request->post('reassign_category')) ) {
                Income::where([
                        ['category_id', '=', $request->post('category_id')],
                        ['user_id', '=', $user_id]
                    ])->update(['category_id' => $request->post('reassign_category')]);
            }

        } else if( $request->post('category_group') == 'Expense' ) {

            if( !is_null($request->post('reassign_category')) ) {
                Expense::where([
                        ['category_id', '=', $request->post('category_id')],
                        ['user_id', '=', $user_id]
                    ])->update(['category_id' => $request->post('reassign_category')]);
            }
            
        } else {
            return redirect()->back()->withErrors('Something went wrong. Category is not deleted, please try again.');
        }

        Category::where([
                    ['id', '=', $request->post('category_id')],
                    ['user_id', '=', $user_id]
                ])->delete();

        $request->session()->flash('messageForModal', 'Category is deleted successfully.');

        return redirect('categories');
    }
}
