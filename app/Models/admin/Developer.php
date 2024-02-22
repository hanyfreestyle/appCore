<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Developer extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','des','g_title','g_des','body_h1','breadcrumb'];
    protected $fillable = ['slug','photo','photo_thum_1','is_active','created_at','updated_at','deleted_at'];
    protected $table = "developers";
    protected $primaryKey = 'id';




    public function enName(){
        return $this->hasOne(DeveloperTranslation::class)->where('locale','en');
    }
    public function arName(){
        return $this->hasOne(DeveloperTranslation::class)->where('locale','ar');
    }

    public function tablename(): HasMany{
        return $this->hasMany(DeveloperTranslation::class)->select('id','developer_id','name');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Web Scope
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function scopeGetDeveloperList(Builder $query): Builder{
        return $query->where('is_active',true)
            ->translatedIn()
            ->with('translation')
            ->orderBy('projects_count','desc');
    }


/*
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
    public function projectCount()
    {
        return $this->hasMany(Listing::class,'developer_id','id')
            ->where('listing_type','!=','ForSale')
            ->select(['developer_id','listing_type'])

            ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     seoDes
    public function seoDes():string
    {
        $str = $this->des ;
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', ' ', $str);
        return Str::limit($str,250);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text


*/

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Admin Relations
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function admin_more_photos(): HasMany{
        return $this->hasMany(DeveloperPhoto::class,'developer_id','id');
    }
    public function teans_en(){
        return $this->hasOne(DeveloperTranslation::class,'developer_id','id')->where('locale','en');
    }

    public function teans_ar(){
        return $this->hasOne(DeveloperTranslation::class,'developer_id','id')->where('locale','ar');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function del_listings(): HasMany{
        return $this->hasMany(Listing::class,'developer_id')->withTrashed();
    }

    public function del_posts(): HasMany{
        return $this->hasMany(Post::class,'developer_id')->withTrashed();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Cash CashDeveloperList
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function scopeCashDeveloperList(Builder $query): array|\Illuminate\Database\Eloquent\Collection
    {
        return $query->select(['id','slug'])->with(['translations'=>function($query){
            $query->select('developer_id','locale','name');
        }])->get();
    }

}
