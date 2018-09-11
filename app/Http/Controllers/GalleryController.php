<?php

namespace App\Http\Controllers;

use App\{AppTreid\MatchSort, AppTreid\StreamApi, Gallery, Image, Stream, Team, Video};
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use StreamApi, MatchSort;

    public function index(){
        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);
        $teams = Team::all();
        $latest_gallery = Gallery::orderByDesc('created_at')->limit(6)->get();
        $latest_img = Image::orderByDesc('created_at')->limit(12)->get();
        $video = Video::orderByDesc('created_at')->get();

        return view('gallery.index', compact('streams_output','teams','latest_img','latest_gallery','video'))
            ->with(['sort_match' => $this->selectMatch()]);
    }

    public function gallery(Request $request){
        $streams = Stream::where('show_homepage','on')->get();
        $streams_output = $this->getStream($streams);
        $teams = Team::all();

        $buff = str_replace('_',' ',$request->name);

        $gallery = Gallery::where('name',$buff)->first();
        $images = Image::where('gallery_id',$gallery->id)->paginate(21);

        return view('gallery.gallery_page', compact('streams_output','teams','gallery','images'))
            ->with(['sort_match' => $this->selectMatch()]);
    }
}