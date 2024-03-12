<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['role_id','admin_id','role_id'];
    protected $primaryKey = 'id_roles_user';
    protected $table = 'tbl_roles_user';
    
}
