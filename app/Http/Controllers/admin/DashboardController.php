<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\AdminMainController;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use App\Helpers\PDF;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Sitemap;



class DashboardController extends AdminMainController{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function adminTest(){
//        Sitemap::create()
//            ->add(Url::create(route('page_ContactUs')->addImage('https://example.com/images/home.jpg', 'Home page image'))
//                ->setLastModificationDate(Carbon::create('2016', '1', '1')))
//
//            ->writeToFile(public_path('sitemap.xml'));


        $siteMap = Sitemap::create();

//            ->add(
//                Url::create('https://example.com')
//                ->addImage('https://example.com/images/home.jpg', 'Home page image')
//            );

           $Developers = Developer::where('id','<',20)->get();
//           dd($Developers);

           foreach ($Developers as $Developer){
               $siteMap->add(
                   Url::create(LaravelLocalization::getLocalizedURL('ar',route('page_developer_view',$Developer->slug)))
                       ->addImage($Developer->photo, $Developer->translate('ar')->name)
               );
           }



            $siteMap->writeToFile(public_path('sitemap.xml'));

    }



    public function testpdf(){
        $pdf = new PDF();
        $data = [
            'foo' => 'bar'
        ];
        $pdf->addArCustomFont();
        $pdf->addEnCustomFont();
        $pdf->loadView('pdf.test', $data);
        //$pdf->SetProtection(['copy', 'print'], 'user_pass', 'owner_pass');
        return $pdf->stream('document.pdf');
       // return $pdf->download("hany.pdf");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Home
    public function Dashboard(){
       if(App::environment('production')){
           $PostsCount = Cache::remember('Dashboard_PostsCount_Cash',config('app.def_24h_cash'), function (){
               return  [
                   'all'=> Post::withTrashed()->count(),
                   'Trashed'=> Post::onlyTrashed()->count(),
                   'noPhoto'=> Post::withTrashed()->where('photo',null)->count(),
                   'slugErr'=> Post::withTrashed()->where('slug_count','>',1)->count(),
                   'unActive'=> Post::withTrashed()->where('is_published',false)->count(),
                   'noEn'=> Post::withTrashed()->notTranslatedIn('en')->count(),
                   'noAr'=> Post::withTrashed()->notTranslatedIn('ar')->count(),
               ];
           });

           $DevelopersCount = Cache::remember('Dashboard_DevelopersCount_Cash',config('app.def_24h_cash'), function (){
               return  [
                   'all'=> Developer::withTrashed()->count(),
                   'Trashed'=> Developer::onlyTrashed()->count(),
                   'noPhoto'=> Developer::withTrashed()->where('photo',null)->count(),
                   'slugErr'=> Developer::withTrashed()->where('slug_count','>',1)->count(),
                   'unActive'=> Developer::withTrashed()->where('is_active',false)->count(),
                   'noEn'=> Developer::withTrashed()->whereHas('teans_en', function ($query) {$query->where('des', '=', null);})->count(),
                   'noAr'=> Developer::withTrashed()->whereHas('teans_ar', function ($query) {$query->where('des', '=', null);})->count(),
               ];
           });

           $ProjectsCount = Cache::remember('Dashboard_ProjectsCount_Cash',config('app.def_24h_cash'), function (){
               return  [
                   'all'=> Listing::withTrashed()->Project()->count(),
                   'Trashed'=> Listing::onlyTrashed()->Project()->count(),
                   'noPhoto'=> Listing::withTrashed()->Project()->where('photo',null)->count(),
                   'slugErr'=> '0',
                   'unActive'=> Listing::withTrashed()->Project()->where('is_published',false)->count(),
                   'noEn'=> Listing::withTrashed()->Project()->notTranslatedIn('en')->count(),
                   'noAr'=> Listing::withTrashed()->Project()->notTranslatedIn('ar')->count(),
               ];
           });

           $ProjectUnitsCount = Cache::remember('Dashboard_ProjectUnitsCount_Cash',config('app.def_24h_cash'), function (){
               return  [
                   'all'=> Listing::withTrashed()->unit()->count(),
                   'Trashed'=> Listing::onlyTrashed()->unit()->count(),
                   'noPhoto'=> Listing::withTrashed()->unit()->where('photo',null)->count(),
                   'slugErr'=> '0',
                   'unActive'=> Listing::withTrashed()->unit()->where('is_published',false)->count(),
                   'noEn'=> Listing::withTrashed()->unit()->notTranslatedIn('en')->count(),
                   'noAr'=> Listing::withTrashed()->unit()->notTranslatedIn('ar')->count(),
               ];
           });

           $ForSaleCount = Cache::remember('Dashboard_ForSaleCount_Cash',config('app.def_24h_cash'), function (){
               return  [
                   'all'=> Listing::withTrashed()->ForSale()->count(),
                   'Trashed'=> Listing::onlyTrashed()->ForSale()->count(),
                   'noPhoto'=> Listing::withTrashed()->ForSale()->where('photo',null)->count(),
                   'slugErr'=> '0',
                   'unActive'=> Listing::withTrashed()->ForSale()->where('is_published',false)->count(),
                   'noEn'=> Listing::withTrashed()->ForSale()->notTranslatedIn('en')->count(),
                   'noAr'=> Listing::withTrashed()->ForSale()->notTranslatedIn('ar')->count(),
               ];
           });
       }else{
           $PostsCount =[];
           $DevelopersCount =[];
           $ProjectsCount =[];
           $ProjectUnitsCount =[];
           $ForSaleCount =[];
       }

        return view('admin.dashbord')->with(
            [
             'PostsCount'=>$PostsCount,
             'DevelopersCount'=>$DevelopersCount,
             'ProjectsCount'=>$ProjectsCount,
             'ProjectUnitsCount'=>$ProjectUnitsCount,
             'ForSaleCount'=>$ForSaleCount,
            ]
        );

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
    public function Update(){
        Cache::forget('Dashboard_PostsCount_Cash');
        Cache::forget('Dashboard_DevelopersCount_Cash');
        Cache::forget('Dashboard_ProjectsCount_Cash');
        Cache::forget('Dashboard_ProjectUnitsCount_Cash');
        Cache::forget('Dashboard_ForSaleCount_Cash');
        return back();
    }




}
