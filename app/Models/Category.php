<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'group'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public static function getCategoriesForView( $user_id ) {
        return self::all()->where('user_id', '=', $user_id)->sortBy('id');
    }

    public static function getCategoriesFromIncomeGroup( $user_id ) {
        return self::where([ ['user_id', '=', $user_id], ['group', '=', 'income'] ])->get();
    }

    public static function getCategoriesFromExpenseGroup( $user_id ) {
        return self::where([ ['user_id', '=', $user_id], ['group', '=', 'expense'] ])->get();
    }

    public function updateCategory( $request ) {
        if( $request->has('name') ) {
            $this->name = $request->name;
        }
        if( $request->has('group') ) {
            $this->group = $request->group;
        }

        $this->save();
    }
}
