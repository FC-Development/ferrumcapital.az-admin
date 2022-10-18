<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\User;
class Permission extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'adminpanel_permission';
    protected $primaryKey = 'uniq_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uniq_id',
        'permission',
        'role'
    ];
    public function users(){
        return $this->hasMany(User::class,'uniq_id');
    }
}
