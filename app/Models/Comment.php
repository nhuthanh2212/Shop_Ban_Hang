<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['comment_name', 'comment_date', 'comment',' product_id','comment_status','comment_parent_comment'];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
