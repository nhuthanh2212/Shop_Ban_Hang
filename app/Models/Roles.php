<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $primaryKey = 'id_roles';
    protected $table = 'tbl_roles';
    public function admin(){
        return $this->belongsToMany('App\Models\Admin');
    }
}
