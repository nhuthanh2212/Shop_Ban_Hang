<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     use HasFactory;
    public $timestamps = false;
    protected $fillable=['product_name','product_slug','product_desc','product_content', 'product_price','product_sold','product_image', 'product_status','category_id','brand_id','product_quantity','product_tags','product_view','price_cost'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
