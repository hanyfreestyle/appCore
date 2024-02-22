<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebMainController;
use App\Models\admin\Listing;
use App\Models\admin\Page;
use Illuminate\Http\Request;

class ListingsListController extends WebMainController{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CompoundsList
    public function CompoundsList(){

        $projects = Listing::def()
            ->where('listing_type','Project')
            ->with('developerName')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'compound_page');

        if ($projects->isEmpty()) {
            self::abortError404('Empty');
        }

        $units= Listing::def()
            ->where('listing_type','!=','Project')
            ->with('developerName')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'property_page');


        if ($units->isEmpty()) {
            self::abortError404('Empty');
        }

        $Meta = parent::getMeatByCatId('compounds');
        parent::printSeoMeta($Meta,'page_compounds','blog',['sendRows'=>$projects , 'sendRows2'=> $units ]);
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Compounds' ;

        return view('web.compounds_list')->with(
            [
                'pageView'=>$pageView,
                'projects'=>$projects,
                'units'=>$units,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForSaleList
    public function ForSaleList(Request $request){


        $search = new SearchController();

        $units = $search->SearchQuery($request,Listing::WebUnits(),'units')
            ->orderBy('id','desc')
            ->paginate(12)->appends(request()->query());

//        $units = Listing::def()
//          ->where('listing_type','!=','Project')
//            ->orderBy('id','desc')
//            ->paginate(12);

        if ($units->isEmpty() and isset($request->page)) {
           self::abortError404('Empty');
        }

        $PagesLinks = Page::where('is_active',true)
            ->with('translation')
            ->with('loaction_slug')
            ->with('project_slug')
            ->get();

        $Meta = parent::getMeatByCatId('for-sale');
        parent::printSeoMeta($Meta,'page_for_sale','blog',['sendRows'=>$units]);
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'ForSale' ;


        return view('web.for_sale_list')->with(
            [
                'pageView'=>$pageView,
                'units'=>$units,
                'PagesLinks'=>$PagesLinks,
            ]
        );
    }

}
