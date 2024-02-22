<?php

namespace App\Models\admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract{

    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','g_title','g_des'];
    protected $fillable = ['slug','photo','photo_thum_1','is_active'];
    protected $table = "categories";
    protected $primaryKey = 'id';

    public function tablename(): HasMany{
        return $this->hasMany(CategoryTranslation::class)->select('id','category_id','name');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function posts() :HasMany{
        return $this->hasMany(Post::class,'category_id','id')
            ->where('is_published', true)
            ->translatedIn()
            ->with('translation');
    }

    public function wbe_posts() :HasMany{
        return $this->hasMany(Post::class,'category_id','id')
            ->where('is_published', true);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function del_posts(): HasMany{
        return $this->hasMany(Post::class,"category_id")->withTrashed();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Cash PostCategoryList
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function scopePostCategoryList(Builder $query): array|\Illuminate\Database\Eloquent\Collection
    {
        return $query->select('id')->with(['translations'=>function($query){
            $query->select('category_id','locale','name');
        }])->get();
    }

}
