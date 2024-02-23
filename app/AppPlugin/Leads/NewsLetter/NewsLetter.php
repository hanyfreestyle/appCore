<?php

namespace App\AppPlugin\Leads\NewsLetter;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NewsLetter extends Model
{
    use HasFactory;
    protected $table = "config_news_letters";
    protected $fillable = ['email'];
    protected $primaryKey = 'id';
    public $timestamps = false;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function getFormatteDate(){
        return Carbon::parse($this->created_at )->locale(app()->getLocale())->translatedFormat('jS M Y') ;
    }
}
