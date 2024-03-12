<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['info_map', 'info_contact','info_image','info_fanpage'];
    protected $primaryKey = 'info_id';
    protected $table = 'tbl_information';
}
