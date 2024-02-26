<?php

namespace App\AppPlugin\SiteMap;

use App\Http\Controllers\AdminMainController;
use App\Models\admin\Category;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Location;
use App\Models\admin\Page;
use App\Models\admin\Post;
use App\Models\data\ContactUsForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class SiteMapController extends AdminMainController {
    function __construct() {
        $this->middleware('permission:sitemap_view', ['only' => ['index']]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # index
    public function index() {

        $rowData = SiteMap::get()->keyBy('cat_id');
        return view('AppPlugin.SiteMap.index', compact('rowData'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UpdateIndex
    public function UpdateIndex(Request $request) {
        $cat_id = $request->input('cat_id');
        SiteMapTools::updateIndexSiteOneFile($cat_id);
        $xmlFileList = SiteMap::where('cat_id', $cat_id)->firstOrFail();
        $xmlFileName = public_path($xmlFileList->name);

        $siteMapTools = new SiteMapTools();
        $siteMapTools->urlRoute = "page_locationView";
        $siteMapTools->langAr = true;
        $siteMapTools->langEn = true;
        $siteMapTools->addAlternate = true;
        $siteMapTools->addPhoto = true;

        $fh = fopen($xmlFileName, 'w') or die("can't open file");
        $stringData = $siteMapTools->XML_Header();

        $stringData .= $siteMapTools->AddSinglePage('en', 'page_index');
        $stringData .= $siteMapTools->AddSinglePage('en', 'page_compounds');
        $stringData .= $siteMapTools->AddSinglePage('en', 'page_for_sale');
        $stringData .= $siteMapTools->AddSinglePage('en', 'page_blog');
        $stringData .= $siteMapTools->AddSinglePage('en', 'page_developers');
        $stringData .= $siteMapTools->AddSinglePage('en', 'page_ContactUs');

        $stringData .= $siteMapTools->AddSinglePage('ar', 'page_index');
        $stringData .= $siteMapTools->AddSinglePage('ar', 'page_compounds');
        $stringData .= $siteMapTools->AddSinglePage('ar', 'page_for_sale');
        $stringData .= $siteMapTools->AddSinglePage('ar', 'page_blog');
        $stringData .= $siteMapTools->AddSinglePage('ar', 'page_developers');
        $stringData .= $siteMapTools->AddSinglePage('ar', 'page_ContactUs');


        $dataRows = Location::orderBy('id')
            ->with('tablename')
            ->where('is_active', true)
            ->get();

        $siteMapTools->dataRows = $dataRows;
        $stringData .= $siteMapTools->Create_XML_Code();


        $stringData .= "</urlset>\n";
        fwrite($fh, $stringData);
        fclose($fh);

        SiteMapTools::updateIndexSiteMapXmlFile();
        return redirect()->back();

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UpdateBlog
    public function UpdateBlog(Request $request) {
        $cat_id = $request->input('cat_id');
        SiteMapTools::updateIndexSiteOneFile($cat_id);
        $xmlFileList = SiteMap::where('cat_id', $cat_id)->firstOrFail();
        $xmlFileName = public_path($xmlFileList->name);

        $siteMapTools = new SiteMapTools();
        $siteMapTools->urlRoute = "page_blogCatList";
        $siteMapTools->langAr = true;
        $siteMapTools->langEn = true;
        $siteMapTools->addAlternate = true;
        $siteMapTools->addPhoto = true;

        $fh = fopen($xmlFileName, 'w') or die("can't open file");
        $stringData = $siteMapTools->XML_Header();

        $dataRows = Category::orderBy('id')
            ->with('tablename')
            ->where('is_active', true)
            ->get();

        $siteMapTools->dataRows = $dataRows;
        $stringData .= $siteMapTools->Create_XML_Code();

        $dataRows = Post::orderBy('id')
            ->with('tablename')
            ->with('getCatName')
            ->where('is_published', true)
//            ->take(20)
            ->get();

        $siteMapTools->urlRoute = "page_blogView";
        $siteMapTools->blogslug = true;
        $siteMapTools->dataRows = $dataRows;
        $stringData .= $siteMapTools->Create_XML_Code();

        $stringData .= "</urlset>\n";
        fwrite($fh, $stringData);
        fclose($fh);

        SiteMapTools::updateIndexSiteMapXmlFile();
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   UpdateDeveloper
    public function UpdateDeveloper(Request $request) {

        $cat_id = $request->input('cat_id');
        $siteMap_PerFile = '500';
        $countTable = Developer::where('is_active', true)->count();

        SiteMapTools::updateIndexSiteMapTable($cat_id, $siteMap_PerFile, $countTable);
        $xmlFileList = SiteMap::where('cat_id', $cat_id)->get()->toArray();

        if(count($xmlFileList) > 0) {
            for ($i = 0; $i < count($xmlFileList); $i++) {
                $xmlFileName = public_path($xmlFileList[$i]['name']);

                if($i == '0') {
                    $EndTo = $siteMap_PerFile;
                    $dataRows = Developer::orderBy('id')
                        ->with('tablename')
                        ->limit($EndTo)
                        ->get();
                } else {
                    $StartFrom = $i * $siteMap_PerFile;
                    $EndTo = $siteMap_PerFile;
                    $dataRows = Developer::orderBy('id')
                        ->with('tablename')
                        ->offset($StartFrom)
                        ->limit($EndTo)
                        ->get();
                }

                $siteMapTools = new SiteMapTools();
                $siteMapTools->xmlFileName = $xmlFileName;
                $siteMapTools->dataRows = $dataRows;
                $siteMapTools->urlRoute = "page_developer_view";
                $siteMapTools->langAr = true;
                $siteMapTools->langEn = true;
                $siteMapTools->addAlternate = true;
                $siteMapTools->Create_XML_File();

            }
        }

        SiteMapTools::updateIndexSiteMapXmlFile();
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UpdateListing
    public function UpdateListing(Request $request) {
        ini_set('max_execution_time', 0);
        $cat_id = $request->input('cat_id');
        $siteMap_PerFile = '15000';
        $countTable = Listing::where('is_published', true)->count();

        SiteMapTools::updateIndexSiteMapTable($cat_id, $siteMap_PerFile, $countTable);
        $xmlFileList = SiteMap::where('cat_id', $cat_id)->get()->toArray();
        if(count($xmlFileList) > 0) {
            for ($i = 0; $i < count($xmlFileList); $i++) {
                $xmlFileName = public_path($xmlFileList[$i]['name']);

                if($i == '0') {
                    $EndTo = $siteMap_PerFile;
                    $dataRows = Listing::orderBy('id')
                        ->with('tablename')
//                        ->where('id','<',10)
                        ->limit($EndTo)
                        ->get();
                } else {
                    $StartFrom = $i * $siteMap_PerFile;
                    $EndTo = $siteMap_PerFile;
                    $dataRows = Listing::orderBy('id')
                        ->with('tablename')
//                        ->where('id','<',10)
                        ->offset($StartFrom)
                        ->limit($EndTo)
                        ->get();
                }

                $siteMapTools = new SiteMapTools();
                $siteMapTools->xmlFileName = $xmlFileName;
                $siteMapTools->dataRows = $dataRows;
                $siteMapTools->urlRoute = "page_ListView";
                if(Route::currentRouteName() == 'config.SiteMap.UpdateListingAr') {
                    $siteMapTools->langAr = true;
                }
                if(Route::currentRouteName() == 'config.SiteMap.UpdateListingEn') {
                    $siteMapTools->langEn = true;
                }
                $siteMapTools->addAlternate = true;
                $siteMapTools->Create_XML_File();
            }
        }

        SiteMapTools::updateIndexSiteMapXmlFile();
        return redirect()->back();


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UpdateIndex
    public function UpdateForSale(Request $request) {
        $cat_id = $request->input('cat_id');
        SiteMapTools::updateIndexSiteOneFile($cat_id);
        $xmlFileList = SiteMap::where('cat_id', $cat_id)->firstOrFail();
        $xmlFileName = public_path($xmlFileList->name);

        $siteMapTools = new SiteMapTools();


        $dataRows = Page::orderBy('id')
            ->where('is_active', true)
//            ->take(2)
            ->get();

        $fh = fopen($xmlFileName, 'w') or die("can't open file");
        $stringData = $siteMapTools->XML_Header();
        $stringData .= $siteMapTools->ForSaleCode($dataRows, "en", 'ar');
        $stringData .= $siteMapTools->ForSaleCode($dataRows, "ar", 'en');

        $stringData .= "</urlset>\n";
        fwrite($fh, $stringData);
        fclose($fh);

        SiteMapTools::updateIndexSiteMapXmlFile();
        return redirect()->back();

    }


}
















