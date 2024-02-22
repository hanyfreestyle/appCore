<?php

namespace App\Models\admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model implements TranslatableContract
{

    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','des','g_title','g_des'];
    protected $fillable = ['links','slug','hash'];
    protected $table = "pages";
    protected $primaryKey = 'id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     links
    protected function links() :Attribute{
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }

    protected function propertyType() :Attribute{
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }

    public function loaction_slug(): BelongsTo
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }

    public function project_slug(): BelongsTo
    {
        return $this->belongsTo(Listing::class,'compound_id','id');
    }

    public function loaction(): BelongsTo
    {
        return $this->belongsTo(Location::class,'location_id','id')->with('translation');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Listing::class,'compound_id','id')->with('translation');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # teans_en
    public function teans_en(){
        return $this->hasOne(PageTranslation::class,'page_id','id')
            ->where('locale','en');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   teans_ar
    public function teans_ar(){
        return $this->hasOne(PageTranslation::class,'page_id','id')
            ->where('locale','ar');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Cash CashPagesList
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function scopeCashPagesList(Builder $query): array|\Illuminate\Database\Eloquent\Collection
    {
        return $query->select('id')->with(['translations'=>function($query){
            $query->select('page_id','locale','name');
        }])->get();
    }

}
