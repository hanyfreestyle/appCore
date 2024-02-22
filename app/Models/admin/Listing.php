<?php

namespace App\Models\admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model implements TranslatableContract
{

    use SoftDeletes;
    use Translatable;
    public array $translatedAttributes = ['name','des','g_title','g_des','body_h1','breadcrumb'];
    protected $table = "listings";
    protected $primaryKey = 'id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function tablename(): HasMany{
        return $this->hasMany(ListingTranslation::class)->select('id','listing_id','name');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     amenity
    protected function amenity() :Attribute{
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Relations Web
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function web_units():HasMany{
        return $this->hasMany(Listing::class,'parent_id','id')
            ->where('is_published',true)
            ->with('translation');
    }
    public function slider():HasMany{
        return $this->hasMany(ListingPhoto::class,'listing_id','id')->orderBy('position');
    }
    public function faqs():HasMany{
        return $this->hasMany(Question::class,'project_id','id')->with('translation');
    }
    public function pro_units():HasMany{
        return $this->hasMany(Listing::class,'parent_id','id')->with('translation');
    }


    public function scopeWebProjects(Builder $query): Builder{
        return $query->where('is_published' ,true)
            ->where('listing_type','Project')
            ->translatedIn()
            ->with('locationName')
            ->with('developerName');
    }

    public function scopeWebUnits(Builder $query): Builder{
        return $query->where('is_published' ,true)
            ->where('listing_type','!=','Project')
            ->translatedIn()
            ->with('locationName')
            ->with('projectName')
            ->with('developerName');
    }


//    public function project() :BelongsTo{
//        return $this->belongsTo(Listing::class,'parent_id','id')
//            ->with('developerName')
//            ->withCount('slider')
//            ->with('slider')
//            ->translatedIn()
//            ->with('locationName')
//            ->with('translations');
//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Scope Web
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function scopeDef(Builder $query): Builder{
        return $query->where('is_published' ,true)
            ->translatedIn()
            ->with('locationName')
            ->with('translations');
    }

    public function scopeProject(Builder $query): Builder{
        return $query->where('listing_type','Project');
    }

    public function scopeUnit(Builder $query): Builder{
        return $query->where('listing_type','Unit');
    }

    public function scopeForSale(Builder $query): Builder{
        return $query->where('listing_type','ForSale');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Scope Admin
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function scopeProjectAdmin(Builder $query): Builder{
        return $query->where('listing_type','Project')
            ->with('translations')
            ->withCount('admin_more_photos')
            ->withCount('admin_units')
            ->withCount('admin_faqs');
    }

    public function scopeUnitsAdmin(Builder $query): Builder{
        return $query->where('listing_type','Unit')
            ->with('translations')
            ->withCount('admin_more_photos');

    }

    public function scopeForSaleAdmin(Builder $query): Builder{
        return $query->where('listing_type','ForSale')
            ->withCount('admin_more_photos')
            ->with('translations');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Admin Relations
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function admin_units():HasMany{
        return $this->hasMany(Listing::class,'parent_id','id');
    }
    public function admin_more_photos(): HasMany{
        return $this->hasMany(ListingPhoto::class,'listing_id','id');
    }
    public function admin_faqs():HasMany{
        return $this->hasMany(Question::class,'project_id','id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Main Relations
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function developerName() :BelongsTo {
        return $this->belongsTo(Developer::class,'developer_id','id')->with('translation');
    }

    public function locationName():BelongsTo{
        return $this->belongsTo(Location::class,'location_id','id')->with('translation');
    }

    public function projectName() :BelongsTo {
        return $this->belongsTo(Listing::class,'parent_id','id');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function del_units(): HasMany{
        return $this->hasMany(Listing::class,'parent_id')->withTrashed();
    }
    public function del_pages(): HasMany{
        return $this->hasMany(Page::class,'compound_id')->withTrashed();
    }
    public function del_posts(): HasMany{
        return $this->hasMany(Post::class,'listing_id')->withTrashed();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Cash CashCompoundList
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function scopeCashCompoundList(Builder $query): array|\Illuminate\Database\Eloquent\Collection
    {
        return $query->select('id')->with(['translations'=>function($query){
            $query->select('listing_id','locale','name');
        }])->get();
    }

}
