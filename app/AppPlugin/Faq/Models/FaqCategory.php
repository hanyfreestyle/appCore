<?php

namespace App\AppPlugin\Faq\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class FaqCategory extends Model implements TranslatableContract, LocalizedUrlRoutable {

    use Translatable;

    public $translatedAttributes = ['slug', 'name', 'des', 'g_title', 'g_des'];
    protected $fillable = [''];
    protected $table = "faq_categories";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'category_id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function faqs() {
        return $this->belongsToMany(Faq::class, 'faqcategory_faq', 'category_id', 'faq_id')->with('more_photos')
            ->withPivot('postion')->orderBy('postion');
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefquery(Builder $query): Builder {
        return $query->with('translations');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #

    public function scopeDefWeb(Builder $query): Builder {
        return $query->where('is_active', true)
            ->with('translation')
            ->with('faqs')
            ->withCount('faqs')
            ->orderBy('faqs_count', 'desc');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function slugs(): HasMany {
        return $this->hasMany(FaqCategoryTranslation::class, 'category_id', 'id');
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function getLocalizedRouteKey($locale) {
        return $this->slugs()->where('locale', $locale)->first()->slug;
    }
}
