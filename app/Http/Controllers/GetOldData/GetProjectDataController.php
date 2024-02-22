<?php

namespace App\Http\Controllers\GetOldData;

use App\Helpers\AdminHelper;
use App\Http\Controllers\Controller;
use App\Models\admin\Amenitable;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\ListingTranslation;
use App\Models\admin\Location;
use App\Models\admin\Page;
use App\Models\admin\Post;
use App\Models\admin\Question;
use App\Models\admin\QuestionTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class GetProjectDataController extends Controller{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # GetProjectData
    public function UpdateProjectData(){
        set_time_limit(0);
        ini_set('memory_limit', '512M');

//        $Projects = Listing::count();
//        echobr($Projects);
//        $Projects = Listing::where('listing_type',"Project")->count();
//        echobr($Projects);
//        $Projects = Listing::where('listing_type',"Unit")->count();
//        echobr($Projects);
//        $Projects = Listing::where('listing_type',"ForSale")->count();
//        echobr($Projects);

        $Posts = Page::where('dev',null)->where('compound_id','!=',null)->count();
        echobr($Posts);

//        $Posts = Page::where('dev',null)->where('compound_id','!=',null)->get();
//        foreach ($Posts as $post){
//            $countDev = Listing::where('id',$post->compound_id)->count();
//            if($countDev == 0){
//                $post->forceDelete();
////                echobr($countDev);
//
//
////                $post->listing_id = null;
////                $post->save();
//            }
//        }

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # RemovePostDev
    public function RemovePostLoc(){
        $Posts = Post::where('dev',null)->where('listing_id','!=',null)->count();
        echobr($Posts);

        $Posts = Post::where('dev',null)->where('listing_id','!=',null)->get();
        foreach ($Posts as $post){
            $countDev = Listing::where('id',$post->listing_id)->count();
            if($countDev == 0){
                echobr($countDev);
                $post->listing_id = null;
                $post->save();
            }
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # RemovePostDev
    public function RemovePostDev(){
        $Posts = Post::where('dev',null)->where('developer_id','!=',null)->count();
        echobr($Posts);

        $Posts = Post::where('dev',null)->where('developer_id','!=',null)->get();
        foreach ($Posts as $post){
            $countDev = Developer::where('id',$post->developer_id)->count();
            if($countDev == 0){
                // echobr($countDev);
                $post->developer_id = null;
                $post->save();
            }
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function EmptyUnits(){
        $Projects = Listing::where('listing_type',"Unit")
            ->where('dev_check',0)
            ->take(2000)
            ->get();
        echobr(count($Projects));


        foreach ($Projects as $project){
            $project->youtube_url = null ;
            $project->latitude = null ;
            $project->longitude = null ;
            $project->project_type = null ;
            $project->status = null ;
            $project->dev_check = 1 ;
            $project->save() ;
        }


        $Projects = Listing::where('listing_type',"Unit")
            ->where('dev_check',0)
            ->count();
        echobr(($Projects));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #       EmptyProject
    public function EmptyProject(){

        $Projects = Listing::where('listing_type',"Project")->get();
        echobr(count($Projects));



        foreach ($Projects as $project){
            $project->area = null ;
            $project->baths = null ;
            $project->rooms = null ;
            $project->unit_status = null ;
            $project->property_type = null ;
            $project->view = null ;
            $project->save() ;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function UpdateListingInfoFromDev(){
        $DeveloperId = Developer::where('id','!=',0)->pluck('id')->toArray();
        $LocationId = Location::where('id','!=',0)->pluck('id')->toArray();

        $Projects = Listing::where('listing_type',"Project")
            ->where('loc_check','0')
            ->take(200)
            ->get();

        foreach ($Projects as $project){
            $Units = Listing::where('parent_id',$project->id)->get();
            $project->units_count = count($Units) ;
            $project->loc_check = 1 ;
            if(count($Units) > 0 ){
                foreach ($Units as $unit){
                    $unit->location_id = $project->location_id ;
                    $unit->developer_id = $project->developer_id ;
                    $unit->delivery_date = $project->delivery_date ;
                    $unit->save() ;
                }
            }

            // echobr(count($Units));

            $project->save();
        }






        $Projects = Listing::where('listing_type',"Project")
            ->where('loc_check','0')
            ->count();
        echobr($Projects);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UpdateSlug
    public function UpdateSlug(){

//        $Projects = Listing::where('slug_count',null)->take(2500)->get();
//        foreach ($Projects as $project){
//            if($project->slug_new == $project->slug){
//                $project->slug_check = 1 ;
//            }else{
//                $project->slug_check = 2 ;
//            }
//
//            $slugCount = Listing::where('slug',$project->slug)->count();
//            $project->slug_count = $slugCount;
//            $project->save();
//        }
//
//        $Projects = Listing::where('slug_count',null)->count();
//        echobr($Projects);


        $Projects = Listing::where('slug_check','=',2)->count();
        echobr($Projects);

        $Projects = Listing::where('slug_check','=',2)->take(50)->get();

        foreach ($Projects as $project){
            $project->slug = AdminHelper::Url_Slug($project->slug);

            if($project->slug_new == $project->slug){
                $project->slug_check = 1 ;
            }else{
                $project->slug_check = 2 ;
            }

            //  $project->save();
        }


        foreach ($Projects as $project){
            echobr($project->slug);
            echobr($project->slug_new);
            echobr('---------------------------------------------------------------------------------');
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    function UpdateStausForTypes(){
        $Projects = Listing::where('listing_type','!=',"Project")
            ->where('property_type', null)
            ->count();
        echobr($Projects);

        $Projects = Listing::where('listing_type','!=',"Project")
            ->where('property_type', null)
            ->get();
        foreach ($Projects as $Project){
            echobr($Project->id."---------->".$Project->name);
        }


        $storeId = ['15774','20052','29880','29883','29881','29882','29885','29886','29887','29888','29884',];
        $Projects = Listing::whereIn('id',$storeId)->where('property_type', null)->get();
        echobr(count($Projects));
        if(count($Projects)>0){
            foreach ($Projects as $Project){
                $Project->property_type = 'store';
                $Project->save();
            }
        }

        $officeId = ['26658','27633','29158','29214','29891','29892','29894','29895','29896','29897','29898','29899','29890',];
        $Projects = Listing::whereIn('id',$officeId)->where('property_type', null)->get();
        echobr(count($Projects));
        if(count($Projects)>0){
            foreach ($Projects as $Project){
                $Project->property_type = 'office';
                $Project->save();
            }
        }



        $apartmentId = ['319','10179','10379','10415','17529','23786','25259','3846','5729','29492','29893','29889','0',];
        $Projects = Listing::whereIn('id',$apartmentId)->where('property_type', null)->get();
        echobr(count($Projects));
        if(count($Projects)>0){
            foreach ($Projects as $Project){
                $Project->property_type = 'apartment';
                $Project->save();
            }
        }

        $villaId = ['3997','13108','5050470','0','0','0','0','0','0',];
        $Projects = Listing::whereIn('id',$villaId)->where('property_type', null)->get();
        echobr(count($Projects));
        if(count($Projects)>0){
            foreach ($Projects as $Project){
                $Project->property_type = 'villa';
                $Project->save();
            }
        }

        $chaletId = ['7940','21105','5050216','0','0','0','0','0','0',];
        $Projects = Listing::whereIn('id',$chaletId)->where('property_type', null)->get();
        echobr(count($Projects));
        if(count($Projects)>0){
            foreach ($Projects as $Project){
                $Project->property_type = 'chalet';
                $Project->save();
            }
        }

        $town_houseId = ['15943','0','0','0','0','0',];
        $Projects = Listing::whereIn('id',$town_houseId)->where('property_type', null)->get();
        echobr(count($Projects));
        if(count($Projects)>0){
            foreach ($Projects as $Project){
                $Project->property_type = 'town-house';
                $Project->save();
            }
        }

        $twin_houseId = ['5050427','0','0','0','0','0',];
        $Projects = Listing::whereIn('id',$twin_houseId)->where('property_type', null)->get();
        echobr(count($Projects));
        if(count($Projects)>0){
            foreach ($Projects as $Project){
                $Project->property_type = 'twin-house';
                $Project->save();
            }
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   GetQuestionData
    public function GetQuestionTranslationData(){
        $old_QuestionTranslations = DB::connection('mysql2')->table('question_translations')
            ->where('question_id', '!=', 29)
            ->where('question_id', '!=', 1057)
            ->where('question_id', '!=', 1058)
            ->where('question_id', '!=', 1059)
            ->where('question_id', '!=', 1060)
            ->where('question_id', '!=', 1061)
            ->where('question_id', '!=', 1062)
            ->where('question_id', '!=', 1063)
            ->where('question_id', '!=', 1064)
            ->get();
        foreach ($old_QuestionTranslations as $old_Question ){
            $saveData =  new QuestionTranslation();
            $saveData->id = $old_Question->id ;
            $saveData->question_id = $old_Question->question_id ;
            $saveData->locale = $old_Question->locale ;
            $saveData->answer = $old_Question->answer ;
            $saveData->question  = $old_Question->question  ;
            $saveData->save() ;
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   GetQuestionData
    public function GetQuestionData(){
        $old_Questions = DB::connection('mysql2')->table('questions')
            ->where('project_id', '!=',3)
            ->where('project_id', '!=', 27207)
            ->get();
        foreach ($old_Questions as $oneQuestions){
            $saveData =  new Question();
            $saveData->id = $oneQuestions->id ;
            $saveData->project_id = $oneQuestions->project_id ;
            $saveData->created_at = $oneQuestions->created_at ;
            $saveData->deleted_at = $oneQuestions->deleted_at ;
            $saveData->updated_at = $oneQuestions->updated_at ;
            $saveData->save();
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   SetNullDeveloper
    public function SetNullDeveloper(){
        $Projects = Listing::where('listing_type' , 'Project' )
            ->where("developer_id",null)
            ->get();

        if(count($Projects) > 0 ){
            foreach ($Projects as $project){
                $project->developer_id = 365 ;
                $project->save() ;
            }
        }
        dd(count($Projects));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # GetAmenityForSale
    public function GetAmenityForSale(){

        $Projects = Listing::where('listing_type' , 'ForSale' )
            ->where("get_amenity",0)
            ->with('getoldtools')
            ->limit(500)
            ->get();

        if(count($Projects) > 0 ){
            foreach ($Projects as $project){

                if(count($project->getoldtools) > 0){
                    $savedataAm = "[";
                    foreach ( $project->getoldtools as $item){
                        $savedataAm .= '"'.$item->amenity_id.'",' ;
                    }
                    $savedataAm =  substr($savedataAm, 0, -1);
                    $savedataAm .= "]";
                    $project->amenity = $savedataAm ;
                }

                $project->get_amenity = 1 ;
                $project->save() ;
            }
        }

        $Projects = Listing::where('listing_type' , 'ForSale' )
            ->where("get_amenity",0)
            ->count();
        echobr($Projects);

        $Projects = Listing::where('listing_type' , 'ForSale' )
            ->where("get_amenity",1)
            ->count();
        echobr($Projects);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # GetAmenityProject
    public function GetAmenityProject(){
        $Projects = Listing::where('listing_type' , 'Project' )
            ->where("get_amenity",0)
            ->with('getoldtools')
            ->limit(500)
            ->get();


//        dd(count($Projects));
        if(count($Projects) > 0 ){
            foreach ($Projects as $project){

                if(count($project->getoldtools) > 0){
                    $savedataAm = "[";
                    foreach ( $project->getoldtools as $item){
                        $savedataAm .= '"'.$item->amenity_id.'",' ;
                    }
                    $savedataAm =  substr($savedataAm, 0, -1);
                    $savedataAm .= "]";
                    $project->amenity = $savedataAm ;
                }

                $project->get_amenity = 1 ;
                $project->save() ;
            }
        }

        $Projects = Listing::where('listing_type' , 'Project' )
            ->where("get_amenity",0)
            ->count();
        echobr($Projects);

        $Projects = Listing::where('listing_type' , 'Project' )
            ->where("get_amenity",1)
            ->count();
        echobr($Projects);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AmenitableRemoveData(){
        Amenitable::where('amenitable_type',"=","App\Post")->delete();
        Amenitable::where('amenitable_type',"=","App\Promotion")->delete();
        Amenitable::where('amenitable_type',"=","App\Category")->delete();
        Amenitable::where('amenitable_type',"=","App\Location")->delete();


        $ListTools = Amenitable::query()
            ->where('amenitable_type',"=","App\Listing")
            ->count();

        echobr($ListTools);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public  function GetSliderActive(){
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        $Listings = Listing::where('slider_active',"=","0")->count();
        echobr("Not Active ".$Listings);


        $Listings = Listing::where('slider_active',"=","0")
            ->where('slider_images_dir','!=',null)
            ->limit(2000)
            ->get();

        if(count($Listings) > 0 ){
            foreach ($Listings as $list){
                $folderPath = public_path("ckfinder/userfiles/".$list->slider_images_dir);
                if(File::isDirectory($folderPath)){
                    $files = File::files($folderPath);
                    if( count($files) > 0 ) {
                        $list->slider_active = 1;
                        $list->save();
                    }else{
                        $list->slider_active = 2;
                        $list->save();
                    }
                }else{
                    $list->slider_active = 2;
                    $list->save();
                }
            }
        }

        $Listings = Listing::where('slider_active',"=","0")
            ->where('slider_images_dir','!=',null)
            ->count();
        echobr($Listings);

        $Listings = Listing::where('slider_active',">","0")
            ->where('slider_images_dir','!=',null)
            ->count();
        echobr($Listings);


        $Listings = Listing::where('slider_active',"=","2")
            ->where('slider_images_dir','!=',null)
            ->limit(1000)
            ->get();

        if(count($Listings) > 0){
            foreach ($Listings as $Listing){
                $Listing->slider_images_dir = null;
                $Listing->slider_active = 0;
                $Listing->save();
            }
        }

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RemovePhotos
    public function RemovePhotos(){

        set_time_limit(0);
        ini_set('memory_limit', '512M');

        $allData = Listing::where('getphoto',1)->take(500000000000000)->get();
        dd(count($allData));
        foreach ($allData as $data){
            if($data->photo != null){

                $oldfile = public_path($data->photo);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('listings/', 'listings_new/', $data->photo));
//                    echo $oldfile;
//                    echo "<br>";
//                    echo $newFile;
//                    echo "<br>";
//                    echo '<hr>';
                    File::move($oldfile, $newFile);
                }

                $oldfile = public_path($data->photo_thum_1);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('listings/', 'listings_new/', $data->photo_thum_1));
//                    echo $oldfile;
//                    echo "<br>";
//                    echo $newFile;
//                    echo "<br>";
//                    echo '<hr>';
                    File::move($oldfile, $newFile);
                }
            }
            $data->getphoto = 2;
            $data->save();
        }

        $ProjectList = Listing::where('getphoto',2)->count();
        echobr($ProjectList);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # UpdateProjectDataCount2
    public function UpdateProjectDataCount2(){
        $AllProjects = Listing::all()->count();
        echobr("All : ".$AllProjects);

        $Projects = Listing::where('listing_type','Project')->count();
        echobr("Projects : ".$Projects);

        $Units = Listing::where('listing_type','Unit')->count();
        echobr("Units : ".$Units);

        $ForSale = Listing::where('listing_type','ForSale')->count();
        echobr("ForSale : ".$ForSale);

        $countAll = $Projects+$Units+$ForSale ;
        echobr("countAll : ".$countAll);

        $brek =  $AllProjects - $countAll ;
        echobr("brek : ".$brek);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # UpdateProjectDataCount
    public function UpdateProjectDataCount(){


        $is_published = Listing::where('id' , '!=', 0 )
            ->where('is_published' , false )
            ->count();

        echobr("All : ".$is_published);


        $AllProjects = Listing::where('id' , '!=', 0 )
            ->count();

        echobr("All : ".$AllProjects);

        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->where('project_type','!=',null)
            ->where('status','!=',null)
            ->count();

        echobr("Projects : ".$Projects);

        $Units = Listing::where('parent_id' , '!=', null )
            ->where('property_type','!=',null)
            ->where('project_type','=',null)
            ->count();

        echobr("Units : ".$Units);

        $ForSale = Listing::where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->where('project_type','=',null)
            ->count();
        echobr("ForSale : ".$ForSale);


        $countAll = $Projects+$Units+$ForSale ;
        echobr("countAll : ".$countAll);

        $brek =  $AllProjects - $countAll ;
        echobr("brek : ".$brek);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # UpdateListingType
    public function UpdateListingType(){

        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->where('project_type','!=',null)
            ->where('status','!=',null)
            ->get();

        foreach ($Projects as $project){
            $project->listing_type = "Project";
            $project->save();
        }


        $Units = Listing::where('parent_id' , '!=', null )
            ->where('listing_type','=',"NotSet")
            ->where('property_type','!=',null)
            ->where('project_type','=',null)
            ->take(2000)
            ->get();
        if(count($Units) > 0){
            foreach ($Units as $Unit){
                $Unit->listing_type = "Unit";
                $Unit->save();
            }
        }

        $Units = Listing::where('parent_id' , '!=', null )
            ->where('listing_type','=',"NotSet")
            ->where('property_type','!=',null)
            ->where('project_type','=',null)
            ->count();

        echobr("Units : ".$Units);

        $ForSales = Listing::where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->where('project_type','=',null)
            ->where('listing_type','=',"NotSet")
            ->get();

        if(count($ForSales) > 0){
            foreach ($ForSales as $ForSale){
                $ForSale->listing_type = "ForSale";
                $ForSale->save();
            }
        }

        $parent_idList = [
            '28370','4050','11','202','161','1156','4031','212','71','173','9755','10',
            '17675','20972','7593','25720','27120','28442','28444','28651','5050179','5050407','5050404'
        ];
        $UpdateParents = Listing::where('listing_type','=',"NotSet")
            ->whereIn('parent_id',$parent_idList)
            ->get();
        if(count($UpdateParents)){
            foreach ($UpdateParents as $UpdateParent){
                $UpdateParent->listing_type = "Unit";
                $UpdateParent->save();
            }
        }

        $project_Ids = ['1159','13317','5053832','5053845','5054244','5054925'];
        $UpdateToProject = Listing::where('listing_type','=',"NotSet")
            ->whereIn('id',$project_Ids)
            ->get();
        if(count($UpdateToProject)){
            foreach ($UpdateToProject as $Update){
                $Update->listing_type = "Project";
                $Update->save();
            }
        }


        $forSale_Ids = ['25259'];
        $UpdateToForSale = Listing::where('listing_type','=',"NotSet")
            ->whereIn('id',$forSale_Ids)
            ->get();

        if(count($UpdateToForSale)){
            foreach ($UpdateToForSale as $Update){
                $Update->listing_type = "ForSale";
                $Update->save();
            }
        }


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function NoLangFound(){
        $NoLangs = Listing::where('getlang',0)->get();
        foreach ($NoLangs as $noLang ){
            echobr($noLang->id);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function GetProjetPhoto(){
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        $ProjectList = Listing::where('getphoto',0)->take(500)->get();
        if(count($ProjectList) > 0){
            foreach ($ProjectList as $thisProject){
                $old_Photo = DB::connection('mysql2')->table('images')
                    ->where('imageable_type','=',"App\Listing")
                    ->where('imageable_id',"=",$thisProject->id)
                    ->get();

                if(count($old_Photo) == '1'){
                    $Update = Listing::withTrashed()->findOrFail($thisProject->id);
                    $Update->photo = $old_Photo->first()->image_url;
                    $Update->photo_thum_1 = $old_Photo->first()->thumb_url;
                    $Update->getphoto = 1;
                    $Update->save();
                }else{
                    $Update = Listing::withTrashed()->findOrFail($thisProject->id);
                    $Update->getphoto = 1;
                    $Update->save();
                }
            }
        }
        $ProjectList = Listing::where('getphoto',0)->count();
        echobr($ProjectList);
    }





#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public  function GetProjectTransData(){
         ini_set('memory_limit', '912M');
         set_time_limit(0);

//        $oldDataTrans = DB::connection('mysql2')->table('listing_translations')->where('deleted_at','!=', null)->count();
        $getLang =  Listing::where('getlang',null)->take(500)->get();
        if(count($getLang) > 0){
            foreach ($getLang as $thisList){
                $oldDataTrans = DB::connection('mysql2')->table('listing_translations')
                    ->where('listing_id', $thisList->id)->get();
                if(count($oldDataTrans) > 0 ){
                    foreach ($oldDataTrans as $oldData){
                        $saveData = new ListingTranslation();
                        $saveData->listing_id = $oldData->listing_id ;
                        $saveData->locale = $oldData->locale ;
                        $saveData->name = $oldData->title ;
                        $saveData->des = $oldData->description ;
                        $saveData->g_des = $oldData->meta_description ;
                        $saveData->g_title = $oldData->title ;
                        $saveData->save() ;
                    }
                    $thisList->getlang = count($oldDataTrans);
                    $thisList->save();
                }else{
                    $thisList->getlang = 0;
                    $thisList->save();
                }
            }
        }

        $LangDone = Listing::where('getlang',null)->count();
        echobr($LangDone);

        $LangDone = Listing::where('getlang','!=',null)->count();
        echobr($LangDone);

    }
}
