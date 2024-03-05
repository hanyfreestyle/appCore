<?php

namespace App\AppPlugin\Faq\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqPhoto extends Model {


    protected $table = "faq_photos";
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function faqName(): BelongsTo {
        return $this->belongsTo(Faq::class, 'faq_id', 'id');
    }


}
