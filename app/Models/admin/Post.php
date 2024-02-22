<?php

namespace App\Models\admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model implements TranslatableContract{

    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','des','g_title','g_des','body_h1','breadcrumb'];
    protected $fillable = ['slug','photo','photo_thum_1'];
    protected $table = "posts";
    protected $primaryKey = 'id';

    public function tablename(): HasMany{
        return $this->hasMany(PostTranslation::class)->select('id','post_id','name');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Web Scope
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function scopeDef(Builder $query): Builder{
        return $query
            ->where('is_published' ,true)
            ->translatedIn()
            ->with('translation');
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Web Relations
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function getFormatteDate(){
        return Carbon::parse($this->published_at)->locale(app()->getLocale())->translatedFormat('jS M Y') ;
    }
    public function getCatName(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function location(){
        return $this->belongsTo(Location::class,'location_id','id');
    }
    public function developerName(): BelongsTo{
        return $this->belongsTo(Developer::class,'developer_id','id');
    }


/*
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   getMorePhoto
    public function getMorePhoto() :HasMany
    {
        return $this->hasMany(PostPhoto::class,'post_id','id');
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   getLoationName
    public function getLoationName()
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }


*/





#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Admin Relations
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function admin_more_photos(): HasMany{
        return $this->hasMany(ListingPhoto::class,'listing_id','id');
    }




}
