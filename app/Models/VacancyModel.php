<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
class VacancyModel extends Model
{
    use HasFactory;
    protected $table = 'nc_a5um__vacancy';
    protected $hidden = ['id'];

    protected $fillable =["uniq_id","status","title","department_id","date_duration","description","description_punkt","responsibility","respons_punkt","extra_info","slug","department_slug"];
    public function department()
    {
       return $this->belongsTo(Department::class,'department_id','uniq_id');
    }
}
