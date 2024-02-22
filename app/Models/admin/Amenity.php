<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model implements TranslatableContract
{
    //use HasFactory;
    use Translatable;
    use SoftDeletes;
    public $translatedAttributes = ['name'];
    protected $fillable = ['icon','photo','photo_thum_1'];
    protected $table = "amenities";
    protected $primaryKey = 'id';


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Cash CashAmenityList
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function scopeCashAmenityList(Builder $query): array|\Illuminate\Database\Eloquent\Collection
    {
        return $query->with(['translations'=>function($query){
            $query->select('amenity_id','locale','name');
        }])->get();
    }

}
