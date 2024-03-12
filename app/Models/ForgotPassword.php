<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['email','auth_code'];
    protected $primaryKey = 'forgot_id';
    protected $table = 'tbl_forgot_password';
}
