<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "page_translations";
    protected $fillable = ['page_id','locale','name','des','g_title','g_des'];

}
