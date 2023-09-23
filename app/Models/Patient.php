<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'samplepatient';
    
    public function getpatient()
    {
        $cities=DB::table('samplepatient')->select('id','name','age','bloodGrp','phoneNo','email','gender')
                                   ->get();
        return $cities;
    }
    public function gethospital()
    {
        $cities=DB::table('samplehospital')->select('id','name','address','phoneNo','email')
                                   ->get();
        return $cities;
    }
    public function getdoctor()
    {
        $cities=DB::table('sampledoctor')->select('id','name','department','designation','education','phoneNo','email')
                                   ->get();
        return $cities;
    }
}
