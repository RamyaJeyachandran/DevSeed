<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'password',
        'user_type_id',
        'is_login',
        'is_active'
    ];
    protected $hidden = [
        'password',
    ];
    public function getLoginUser($request) {
        $users = DB::table('users')->where('name',$request->userName)
                                   ->where('is_active',1)
                                   ->first();
        if(!$users==null)
        {
            if (Hash::check($request->password, $users->password)) 
            {
                return $users;
            }
        }
        return null; 
      }
    //   public function updPassword($id,$password){
    //     $affectedRows = Users::where('id', '=', $id)->update(array('password' => Hash::make($password)));
    //   }
}
