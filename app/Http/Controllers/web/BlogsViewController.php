<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebMainController;
use App\Models\admin\Category;
use App\Models\admin\Listing;
use App\Models\admin\Post;


class BlogsViewController extends WebMainController{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     BlogList
    public function BlogList(){
        $posts = Post::def()
            ->with('getCatName')
            ->orderBy('id','desc')
            ->paginate(12);
        if ($posts->isEmpty()) {
            self::abortError404('Empty');
        }

        $Meta = parent::getMeatByCatId('blog');
        parent::printSeoMeta($Meta,'page_blog');
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Blog' ;

        return view('web.blog.index')->with(
            [
                'pageView'=>$pageView,
                'posts'=>$posts,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     BlogCatList
    public function BlogCatList($catSlug){
        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Blog' ;

        try{
            $category = Category::query()
                ->where('is_active',true)
                ->where('slug',$catSlug)
                ->with('translations')
                ->firstOrFail();
        }
        catch (\Exception $e){
            self::abortError404('Blog');
        }

        parent::printSeoMeta($category,'page_blogCatList');

        $posts = Post::def()
            ->where('category_id',$category->id)
            ->with('getCatName')
            ->orderBy('id','desc')
            ->paginate(12);

        if ($posts->isEmpty()) {
            self::abortError404('Empty');
        }

        return view('web.blog.index_category')->with(
            [
                'pageView'=>$pageView,
                'category'=>$category,
                'posts'=>$posts,
            ]
        );
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     BlogView
    public function BlogView($catSlug,$postSlug){

        $pageView = $this->pageView ;
        $pageView['SelMenu'] = 'Blog' ;

        try{
            $post = Post::query()
                ->where('slug',$postSlug)
                ->with('location')
                ->with('translations')
                ->translatedIn()
                ->firstOrFail();
        }
        catch (\Exception $e){
            self::abortError404('Blog');
        }


        if(count($post->translations) == 1){
            $pageView['go_home'] = route('page_index') ;
        }


        parent::printSeoMeta($post,'page_blogView');

        try{
            $category = Category::query()
                ->where('is_active',true)
                ->where('slug',$catSlug)
                ->with('translations')
                ->firstOrFail();
        }
        catch (\Exception $e){
            self::abortError404('Blog');
        }


        if($post->listing_id == null){
            $project_tag = null ;
        }else{
            $project_tag = Listing::query()
                ->where('id',$post->listing_id)
                ->withCount('web_units')
                ->with('locationName')
                ->translatedIn()
                ->first();
        }



        if($post->location_id == null){
            $relatedProjects = null;
        }else{
            $relatedProjects = Listing::query()
                ->where('listing_type','Project')
                ->where('location_id',$post->location_id)
                ->with('locationName')
                ->with('web_units')
                ->withCount('web_units')
                ->translatedIn()
                ->limit(9)
                ->get();
            if(count($relatedProjects) == 0){
                $relatedProjects = null;
            }
        }

        $relatedPosts = Post::def()
            ->where('category_id',$category->id)
            ->where('id','!=',$post->id)
            ->with('getCatName')
            ->translatedIn()
            ->orderBy('id','desc')
            ->limit('9')
            ->get();

        $other_project = Listing::query()
            ->where('listing_type','Project')
            ->where('is_published',true)
            ->translatedIn()
            ->inRandomOrder()
            ->limit(6)
            ->get();


        return view('web.blog.view')->with(
            [
                'pageView'=>$pageView,
                'post'=>$post,
                'category'=>$category,
                'project_tag'=>$project_tag,
                'relatedProjects'=>$relatedProjects,
                'relatedPosts'=>$relatedPosts,
                'other_project'=>$other_project,
            ]
        );
    }

}
