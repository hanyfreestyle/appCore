<?php

namespace App\Models\admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Location extends Model implements TranslatableContract
{

    use Translatable;
    use SoftDeletes;
    use HasRecursiveRelationships;

    public $translatedAttributes = ['name','g_title','g_des','body_h1','breadcrumb'];
    protected $fillable = ['slug','photo','photo_thum_1','is_active'];
    protected $table = "locations";
    protected $primaryKey = 'id';


    public function tablename(): HasMany{
        return $this->hasMany(LocationTranslation::class)->select('id','location_id','name');
    }



    /*
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  locations
    public function locations()
    {
        return $this->hasMany(Location::class,'parent_id');
    }

    public function childrenlocations()
    {
        return $this->hasMany(Location::class,'parent_id')->with('locations');
    }

    public function getProjectToLocation()
    {
        return $this->hasMany(Listing::class,'location_id', 'id')
            ->where('listing_type','Project');
    }

    public function getProjectUnitsToLocation()
    {
        return $this->hasMany(Listing::class,'location_id', 'id')
            ->where('listing_type','Unit');
    }


    public function getUnitsForSaleToLocation()
    {
        return $this->hasMany(Listing::class,'location_id', 'id')
            ->where('listing_type','ForSale');
    }


    public function getUnitsCount():HasMany
    {
        return $this->hasMany(Listing::class,'location_id', 'id')
            ->select(['location_id','listing_type']);
            //->select('listing_type AS type')
            //->groupBy('type')
    }
*/
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Main Relations
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function parentName(){
        return $this->belongsTo(Location::class,'parent_id','id')->with('translation');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function del_locations(){
        return $this->hasMany(Location::class,'parent_id')->withTrashed();
    }
    public function del_listings(){
        return $this->hasMany(Listing::class,'location_id')->withTrashed();
    }
    public function del_pages(){
        return $this->hasMany(Page::class,'location_id')->withTrashed();
    }
    public function del_posts(){
        return $this->hasMany(Post::class,'location_id')->withTrashed();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Cash CashLocationList
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function scopeCashLocationList(Builder $query): array|\Illuminate\Database\Eloquent\Collection
    {
        return $query->select(['id','slug'])->with(['translations'=>function($query){
            $query->select('location_id','locale','name');
        }])->get();
    }

}
