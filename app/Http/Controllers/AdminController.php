<?php

namespace App\Http\Controllers;

use App\Mail\MailBlockUser;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function showUsersList() {
        $dataToSend = [
            'title' => 'Admin Panel',
            'users' => User::all()
        ];

        return view('layout.admin_panel', $dataToSend);
    }

    public function showAddNewUser() {
        $dataToSend = [
            'title' => 'Add User'
        ];

        return view('layout.user_add_new', $dataToSend);
    }

    public function updateUser( Request $request ) {
        $request->validate([
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()]
        ]);

        try {
            $user = User::findOrFail( $request->id );
            $user->updateUserProfile( $request );
        }
        catch (\Exception $exception) {
            Log::error('Can\'t update user: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'User is updated successfully.');

        return redirect('admin/users_list');
    }

    public function createNewUser( Request $request ) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $userID = User::select('id')->where('email', '=', $request->email)->first();

            Category::insert([
                ['user_id' => $userID->id, 'name' => 'Income', 'group' => 'Income', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['user_id' => $userID->id, 'name' => 'Expense', 'group' => 'Expense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            ]);
        }
        catch (\Exception $exception) {
            Log::error('Can\'t create user: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'User is created successfully.');

        return redirect('admin/users_list');
    }

    public function deleteUser( Request $request ) {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        try {
            DB::table("incomes")->where("user_id", $request->id)->delete();
            DB::table("expenses")->where("user_id", $request->id)->delete();
            DB::table("categories")->where("user_id", $request->id)->delete();
            DB::table("users")->where("id", $request->id)->delete();

        } catch (\Exception $exception) {
            Log::error('Can\'t delete user: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'User is deleted successfully.');

        return redirect('admin/users_list');
    }

    public function blockUser( Request $request ) {
        $request->validate([
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'block_message' => ['required', 'string', 'max:100']
        ]);

        try {
            $user = User::findOrFail( $request->id );
            $user->blockUser( $request );
        }
        catch (\Exception $exception) {
            Log::error('Can\'t block user: '.$exception->getMessage());

            return redirect()->back();
        }

        $mail = new MailBlockUser($request);
        Mail::to($request->email)->send($mail);
        $request->session()->flash('messageForModal', 'User is blocked successfully.');

        return redirect('admin/users_list');
    }

    public function unblockUser( Request $request ) {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        try {
            User::where('id', $request->id)->update(['block_message' => null]);

        } catch (\Exception $exception) {
            Log::error('Can\'t unblock user: '.$exception->getMessage());

            return redirect()->back();
        }

        $request->session()->flash('messageForModal', 'User is unblocked successfully.');

        return redirect('admin/users_list');
    }
}
