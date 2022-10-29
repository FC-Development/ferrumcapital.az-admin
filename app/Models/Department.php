<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__department';
    protected $primaryKey='uniq_id';
    public $incrementing = false;
    public function vacancies()
    {
       return $this->hasMany(VacancyModel::class,'department_id','uniq_id');
    }
}
