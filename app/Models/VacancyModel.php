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

    protected $fillable =['status'];
    public function department()
    {
       return $this->belongsTo(Department::class,'department_id','uniq_id');
    }
}
