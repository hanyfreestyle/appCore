<?php

namespace App\AppPlugin\Product\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model implements TranslatableContract {

    use SoftDeletes;
    use Translatable;
    use HasRecursiveRelationships;


    protected $table = "pro_categories";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'category_id';
    public $translatedAttributes = ['name', 'slug', 'des', 'g_title', 'g_des', 'body_h1', 'breadcrumb'];
    protected $fillable = ['parent_id', 'photo', 'photo_thum_1', 'is_active'];



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     scopeDef
    public function scopeDef(Builder $query): Builder {
        return $query->with('translations')->withCount('children');
    }
    
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     children
    public function children(): hasMany {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->with('translations');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     scopeRoot
    public function scopeRoot(Builder $query): Builder {
        return $query->whereNull('parent_id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function recursive_product_shop() {
        return $this->belongsToManyOfDescendantsAndSelf(Product::class, 'pro_category_product')
            ->with('translation')
            ->with('categories')
            ->where('is_active', true)
            ->where('is_archived', false);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  products
    public function products() {
        return $this->belongsToMany(Product::class, 'pro_category_product', 'category_id', 'product_id')
            ->where('is_active', true)
            ->where('is_archived', false)
            ->with('translation');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function del_category(): HasMany {
        return $this->hasMany(Category::class, 'parent_id')->withTrashed();
    }

    public function del_product() {
        return $this->belongsToMany(Product::class, 'pro_category_product', 'category_id', 'product_id')
            ->withTrashed();
    }


}


/*

     public function countTotalProducts()
      {
          $query = DB::table('categories')->selectRaw('categories.*')->where('id', $this->id)->unionAll(
              DB::table('categories')->selectRaw('categories.*')->join('tree', 'tree.id', '=', 'categories.parent_id')
          );

          $tree = DB::table('products')->withRecursiveExpression('tree', $query)
              ->join('product_category', 'product_category.product_id', '=', 'products.id')
              ->whereIn(
                  'product_category.category_id',
                  DB::table('tree')->select('id')
              )
              ->count('products.id');

          return $tree;
      }
*/

