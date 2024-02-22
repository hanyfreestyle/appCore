<?php

namespace App\Models\admin\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UploadFilterSize extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "config_upload_filter_sizes";

    public function filter(): BelongsTo
    {
        return $this->belongsTo(UploadFilter::class);
    }
}
