<?php

namespace App\Http\Controllers\GetOldData;

use App\Http\Controllers\Controller;
use App\Models\admin\Developer;
use App\Models\admin\DeveloperTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use File;

class GetDeveloperController extends Controller
{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # GetDeveloperOldData
    public function GetDeveloperOldData($update=1){
        $count = Developer::count();
        if ($update == 1 and $count == 0){
            $old_Developer = DB::connection('mysql2')->table('developers')->get();
            foreach ($old_Developer as $oneDeveloper)
            {
                $data = [
                    'id'=>$oneDeveloper->id ,
                    'slug'=>$oneDeveloper->slug ,
                    'is_active'=>$oneDeveloper->is_active ,
                    'created_at'=>$oneDeveloper->created_at ,
                    'deleted_at'=>$oneDeveloper->deleted_at ,
                    'updated_at'=>$oneDeveloper->updated_at  ,
                ];
                Developer::create($data);
            }
        }else{
            dd('done');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # GetDeveloperPhotos
    public function GetDeveloperPhotos(){
        dd('hi');
        $Developer_List = Developer::withTrashed()->get();
       // dd($Developer_List);
        foreach ($Developer_List as $Developer_is){
            $old_Developer = DB::connection('mysql2')->table('images')
                ->where('imageable_type','=',"App\Developer")
                ->where('imageable_id',"=",$Developer_is->id)
                ->get();

            if(count($old_Developer) == '1'){
                $Update = Developer::withTrashed()->findOrFail($Developer_is->id);
                $Update->photo = $old_Developer->first()->image_url;
                $Update->photo_thum_1 = $old_Developer->first()->thumb_url;
                $Update->save();
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # GetDeveloperTranslations
    public function GetDeveloperTranslations(){
        dd('hi');
        $old_DeveloperTranslations = DB::connection('mysql2')->table('developer_translations')->get();

        foreach ($old_DeveloperTranslations as $old_Developer){

            if($old_Developer->meta_description == null and  $old_Developer->description != null){
                $g_des = strip_tags($old_Developer->description) ;
                $g_des = str_replace('&nbsp;', ' ', $g_des);
                $g_des = trim(preg_replace('/[\t\n\r\s]+/', ' ', $g_des)) ;
                $g_des = Str::limit($g_des,150,"");
            }else{
                $g_des = $old_Developer->meta_description ;
            }

            $data = [
                'developer_id'=> $old_Developer->developer_id ,
                'locale'=> $old_Developer->locale ,
                'name'=> $old_Developer->name  ,
                'des'=> $old_Developer->description ,
                'g_des'=>$old_Developer->meta_description  ,
                'g_title'=> $old_Developer->name ,
            ];

            DeveloperTranslation::create($data);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RemovePhotos
    public function RemovePhotos(){
        dd('hi');
        $allData = Developer::withTrashed()->get();

        foreach ($allData as $data){
            if($data->photo != null){

                $oldfile = public_path($data->photo);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('developers/', 'newdevelopers/', $data->photo));
                    echo $oldfile;
                    echo "<br>";
                    echo $newFile;
                    echo "<br>";
                    echo '<hr>';
                    File::move($oldfile, $newFile);
                }

                $oldfile = public_path($data->photo_thum_1);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('developers/', 'newdevelopers/', $data->photo_thum_1));
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
#|||||||||||||||||||||||||||||||||||||| #     sliderGet
    public function sliderGet()
    {
        // $Developers = self::getSelectQuery(Developer::query());
        $Developers = Developer::where('slider_images_dir','!=',null)
            ->where('slider_get',"=","0")
            ->where('id','!=',"191")
            ->paginate(100);

        $foreign_name = "developer_id";
        $save_table_name = "developer_photos";


        foreach ($Developers as $developer){

            $oldPath = public_path("ckfinder/userfiles_old/".$developer->slider_images_dir);
            $newPath =  public_path("ckfinder/userfiles/".$developer->slider_images_dir) ;

            if(File::exists($oldPath)){
                Update_createDirectory($newPath);

                if(File::exists($newPath)){
                    $files = File::files($oldPath);
                    if( count( $files) >0 ) {
                        foreach ($files as $file){
                            $filename = File::name($file).".".File::extension($file);
                            $OldFileWillCopyFrom = $oldPath."/".$filename;
                            $newFileWillCopy = $newPath."/".$filename;

                            if(!File::exists($newFileWillCopy)){

                                File::copy($OldFileWillCopyFrom,$newFileWillCopy);
                                DB::connection('mysql2')->table($save_table_name)->insert([
                                    $foreign_name => $developer->id,
                                    'photo' => "ckfinder/userfiles/".$developer->slider_images_dir."/".$filename ,
                                    'file_extension' =>  File::extension($file),
                                    'file_size' => File::size($file),

                                ]);

                                $developer->slider_get = 1 ;
                                $developer->save();

                                echobr("save");
                            }
                        }
                    }
                }
            }else{
                $developer->slider_get = 2 ;
                $developer->save();
                echobr("Error");
            }
        }
        dd(count($Developers));
        return view('admin.developer.index',compact('pageData','Developers'));
    }

}
