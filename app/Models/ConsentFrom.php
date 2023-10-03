<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsentFrom extends Model
{
    public $timestamps = false;
    protected $table = 'consent_froms';
    use HasFactory;
    protected $fillable = [
        'formName',
        'formContent',
        'hospitalId',
        'branchId',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function getConsentFormList($hospitalId,$branchId){
        $new_branchId=(isset($branchId) && !empty($branchId)) ?$branchId : NULL;
        $where_sts="is_active=1 and hospitalId=".$hospitalId.((isset($branchId) && !empty($branchId)) ?" and branchId=".$new_branchId:"");
        return DB::table('consent_froms')->select("id","formName")->whereRaw($where_sts)->get();
    }
}
