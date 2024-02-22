<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebMainController;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Post;


class DevelopersViewController extends WebMainController{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DevelopersList
    public function DevelopersList(){

        $Developers = Developer::getDeveloperList()->paginate(20);
        if ($Developers->isEmpty()) {
            self::abortError404('Empty');
        }

        $Meta = parent::getMeatByCatId('developer');
        parent::printSeoMeta($Meta,'page_developers');
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Developers' ;

        return view('web.developer.index')->with(
            [
                'pageView'=>$pageView,
                'Developers'=>$Developers,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DeveloperView
    public function DeveloperView($slug){
        try {
            $developer = Developer::getDeveloperList()
                ->where('slug',$slug)
                ->firstOrFail();
        }
        catch (\Exception $e){
            self::abortError404('Developer');
        }

        parent::printSeoMeta($developer,'page_developer_view');
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Developers' ;

        $projects= Listing::def()
            ->where('developer_id',$developer->id)
            ->where('listing_type','Project')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'compound_page');
        if ($projects->isEmpty()) {
            self::abortError404('Empty');
        }

        $units= Listing::def()
            ->where('developer_id',$developer->id)
            ->where('listing_type','Unit')
            ->orderBy('id','desc')
            ->paginate(12, ['*'], 'property_page');
        if ($units->isEmpty()) {
            self::abortError404('Empty');
        }

        $posts = Post::def()
            ->where('developer_id',$developer->id)
            ->with('getCatName')
            ->orderBy('published_at','desc')
            ->limit(15)
            ->get();

        return view('web.developer.view')->with(
            [
                'pageView'=>$pageView,
                'developer'=>$developer,
                'projects'=>$projects,
                'units'=>$units,
                'posts'=>$posts,
            ]
        );
    }
}
