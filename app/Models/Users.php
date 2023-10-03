<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'password',
        'user_type_id',
        'is_login',
        'is_active',
        'user_id',
        'created_by'
    ];
    protected $hidden = [
        'password',
    ];
    public function getLoginUser($request) {
        
        $users = DB::table('users')->selectRaw("HEX(AES_ENCRYPT(id,UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))) as id,name,password,user_type_id,HEX(AES_ENCRYPT(user_id,UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))) as user_id")
                                   ->where('name','=',$request->userName)
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
      public function createLogin($request,$userTypeTd,$id){
        $userId=$this->getDecryptedId($request->userId);

        $hashed = Hash::make($request->password, [
            'rounds' => 12,
        ]);
        
        return static::create(
            ['name'=>$request->email,
             'password'=>$hashed,
             'user_type_id' => $userTypeTd,
             'created_by'=>$userId,
             'user_id'=>$id
            ]
        );
      }
      public function checkEmailId($email){
        return DB::table('users')->where('name','=',$email)
                                ->where('is_active','=',1)->get();
      }
      public function getDecryptedId($encryptedId){
        return DB::statement("SELECT AES_DECRYPT(UNHEX('" . $encryptedId . "'), UNHEX(SHA2('" . config('constant.mysql_custom_encrypt_key') . "',512))) as id");
      }
      public function getEncryptedId($id){
        return DB::statement("SELECT HEX(AES_ENCRYPT(".$id.",UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512))))");
      }
}
