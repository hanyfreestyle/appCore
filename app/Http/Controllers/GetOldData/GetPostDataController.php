<?php

namespace App\Http\Controllers\GetOldData;

use App\Http\Controllers\Controller;
use App\Models\admin\Post;
use App\Models\admin\PostTranslation;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetPostDataController extends Controller
{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   GetPostOldData
    public function GetPostOldData(){
        dd('hi');
        $old_Posts = DB::connection('mysql2')->table('posts')->get();
        foreach ($old_Posts as $onePost){
            $saveData =  new Post();
            $saveData->id = $onePost->id ;
            $saveData->category_id = $onePost->category_id ;
            $saveData->developer_id = $onePost->developer_id ;
            $saveData->listing_id = $onePost->listing_id ;
            $saveData->slug = $onePost->slug ;
            $saveData->slider_images_dir = $onePost->slider_images_dir ;
            $saveData->is_published = $onePost->is_published ;
            $saveData->published_at = $onePost->published_at ;
            $saveData->created_at = $onePost->created_at ;
            $saveData->deleted_at = $onePost->deleted_at ;
            $saveData->updated_at = $onePost->updated_at ;
            $saveData->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   GetPostPhotos
    public function GetPostPhotos(){
        dd('hi');
        $Post_List = Post::withTrashed()->get();
        foreach ($Post_List as $Post_is){
            $old_Post = DB::connection('mysql2')->table('images')
                ->where('imageable_type','=',"App\Post")
                ->where('imageable_id',"=",$Post_is->id)
                ->get();
            if(count($old_Post) == '1'){
                $Update = Post::withTrashed()->findOrFail($Post_is->id);
                $Update->photo = $old_Post->first()->image_url;
                $Update->photo_thum_1 = $old_Post->first()->thumb_url;
                $Update->save();
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   GetPostTranslations
    public function GetPostTranslations(){
        dd('hi');
        $old_PostTranslations = DB::connection('mysql2')->table('post_translations')->get();
        //dd($old_PostTranslations);
        foreach ($old_PostTranslations as $old_Post)
        {
            $saveData =  new PostTranslation();
            $saveData->post_id = $old_Post->post_id ;
            $saveData->locale = $old_Post->locale ;
            $saveData->name = $old_Post->title ;
            $saveData->des = $old_Post->content ;
            $saveData->g_des = $old_Post->meta_description ;
            $saveData->save() ;
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # RemoveTrashed
    public function RemoveTrashed(){
        dd('hi');
        $posts = Post::onlyTrashed()->get();
        foreach ($posts as $post){
            $post->forceDelete();
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     PostRemovePhotos
    public function PostRemovePhotos(){
        dd('hi');

        $allData = Post::withTrashed()->get();

        foreach ($allData as $data){
            if($data->photo != null){

                $oldfile = public_path($data->photo);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('posts/', 'newposts/', $data->photo));
                    echo $oldfile;
                    echo "<br>";
                    echo $newFile;
                    echo "<br>";
                    echo '<hr>';
                    File::move($oldfile, $newFile);
                }

                $oldfile = public_path($data->photo_thum_1);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('posts/', 'newposts/', $data->photo_thum_1));
                    echo $oldfile;
                    echo "<br>";
                    echo $newFile;
                    echo "<br>";
                    echo '<hr>';
                    File::move($oldfile, $newFile);
                }
            }
        }
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function PostUpdateMeta(){
        dd('hi');
        $Posts = PostTranslation::where('g_title', null)->get();
        foreach ($Posts as $post){
            $post->g_title = $post->name ;
            $post->save();
        }


    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #


//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     sliderGet
//    public function sliderGet()
//    {
//
//        $Posts = Post::where('slider_images_dir','!=',null)
//            ->where('slider_get',"=","0")
//            ->where('id','!=',"0")
//            ->paginate(10000);
//
//        $foreign_name = "post_id";
//        $save_table_name = "post_photos";
//
//
//        foreach ($Posts as $post){
//
//            $oldPath = public_path("ckfinder/userfiles_old/".$post->slider_images_dir);
//            $newPath =  public_path("ckfinder/userfiles/".$post->slider_images_dir) ;
//
//            if(File::exists($oldPath)){
//                Update_createDirectory($newPath);
//
//                if(File::exists($newPath)){
//                    $files = File::files($oldPath);
//                    if( count( $files) >0 ) {
//                        foreach ($files as $file){
//                            $filename = File::name($file).".".File::extension($file);
//                            $OldFileWillCopyFrom = $oldPath."/".$filename;
//                            $newFileWillCopy = $newPath."/".$filename;
//
//                            if(!File::exists($newFileWillCopy)){
//
//                                File::copy($OldFileWillCopyFrom,$newFileWillCopy);
//                                DB::connection('mysql2')->table($save_table_name)->insert([
//                                    $foreign_name => $post->id,
//                                    'photo' => "ckfinder/userfiles/".$post->slider_images_dir."/".$filename ,
//                                    'file_extension' =>  File::extension($file),
//                                    'file_size' => File::size($file),
//
//                                ]);
//
//                                $post->slider_get = 1 ;
//                                $post->save();
//
//                                echobr("save");
//                            }
//                        }
//                    }
//                }
//            }else{
//                $post->slider_get = 2 ;
//                $post->save();
//                echobr("Error");
//            }
//        }
//
//
//
//        dd(count($Posts));
//
//    }
//

}
