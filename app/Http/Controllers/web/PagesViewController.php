<?php

namespace App\Http\Controllers\web;

use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;
use App\Models\admin\Listing;
use App\Models\admin\Page;
use Illuminate\Http\Request;

class PagesViewController extends WebMainController{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    ListingPageView

    public function ListingPageView(Request $request){

        $hash = '?';
        if($location = $request->get('location')){
            $hash .= 'location='.intval($location).'&';
        }

        if($compound = $request->get('compound')){
            $hash .= 'compound='.intval($compound).'&';
        }

        if($property_type = $request->get('property_type')){
            $property_type = AdminHelper::Url_Slug($property_type);
            $hash .= 'property_type='.$property_type.'&';
        }

        $hash = substr($hash, 0 , -1);

        try {
            $page = Page::with(['translations'])
                ->where('hash', $hash)
                ->firstOrFail();
        }
        catch (\Exception $e){
            self::abortError404('Pages');
        }

        $units = self::buildQuery(Listing::def(),$page)->paginate(12)->appends(request()->query());

        if ($units->isEmpty()) {
            self::abortError404('Empty');
        }


        if($page->links != null){
            $PagesLinks = Page::where('is_active',true)
                ->whereIn('id',$page->links)
                ->with('translation')
                ->with('loaction')
                ->with('project')
                ->get();
        }else{
            $PagesLinks = array();
        }

        parent::printSeoMeta($page,'page_ListingPageView','blog',['sendRows'=> $units ]);
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'ForSale' ;

        return view('web.pages_links_view')->with(
            [
                'pageView'=>$pageView,
                'units'=>$units,
                'page'=>$page ,
                'PagesLinks'=>$PagesLinks,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   buildQuery
    public function buildQuery($query,$page){

        $query->where('listing_type','!=','Project');

        if($page->location_id != null){
            $query->where('location_id','=',$page->location_id);
        }
        if($page->compound_id != null){
            $query->where('parent_id','=',$page->compound_id);
        }

        if($page->property_type != null){
            $query->whereIn('property_type',$page->property_type);
        }
        $query->with('developerName');
        $query->orderBy('id','desc');
        return $query;
    }
}
