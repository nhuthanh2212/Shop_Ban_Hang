<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['category_name', 'category_desc', 'category_status',' category_keyword','category_parent','category_slug','category_order'];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category';

    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
