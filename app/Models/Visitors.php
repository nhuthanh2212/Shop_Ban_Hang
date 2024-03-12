<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['ip_address', 'date_visitor'];
    protected $primaryKey = 'visitors_id';
    protected $table = 'tbl_visitors';
}
