<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'block_message'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function updateUserProfile( $request ) {
        if( $request->has('name') ) {
            $this->name = $request->name;
        }
        if( $request->has('email') ) {
            $this->email = $request->email;
        }
        if( $request->has('password') && !is_null($request->password)) {
            $this->password = Hash::make($request->password);
        }

        $this->save();
    }

    public function blockUser( $request ) {
        if( $request->has('block_message') && !is_null($request->block_message)) {
            $this->block_message = $request->block_message;
        }

        $this->save();
    }
}
