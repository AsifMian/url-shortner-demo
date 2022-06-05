<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShortLink;
use Illuminate\Support\Str;
class ShortLinksController extends Controller
{
    public function index(Request $request){
        return view('links.create');
    }

    public function createShortLink(Request $request){
        $validated = $request->validate([
            'original_url' => 'required|url'
        ]);

        if($validated){
            $hash =  Str::random(5);
            $original_url =  trim(strip_tags($request->original_url));
            // check if url has already been created and in db
            $alreadyShortend = ShortLink::where('original_url',$original_url)->first();
            if($alreadyShortend){
                return redirect()->back()->with(['status'=>'success','msg'=>'Short Link Created','link'=>url($alreadyShortend->short_url)]);
            }else{
                 //we can check if hash already been assigned to another url --- this is extra check so no links manipulation but this is rare case
                $checkHash = ShortLink::where('short_url',$hash)->first();
                if($checkHash){
                    $hash =  Str::random(5);
                }
                $shortlink = new ShortLink();
                $shortlink->original_url = $original_url;
                $shortlink->short_url = $hash;

                if($shortlink->save()){
                    return redirect()->back()->with(['status'=>'success','msg'=>'Short Link Created','link'=>url($shortlink->short_url)]);
                }
                return redirect()->back()->with(['status'=>'error','msg'=>'Something went wrong please try again','link'=>'']);
            }

        }
        return redirect()->back()->with(['status'=>'error','msg'=>'Something went wrong please try again','link'=>'']);
    }

    public function decodeShortLink(Request $request,$hash){
        if($hash && strlen($hash) == 5){ //since we are always creating short link hash of 5 char
            // so can avoid extra db query in case hash is manipulated and have diferent count
            $hash = trim(strip_tags($hash));
            $shortLink = ShortLink::where('short_url',$hash)->first();
            if($shortLink){
                // update visitor count
                $shortLink->visit_count = $shortLink->visit_count+1;
                $shortLink->save();
                // $viewData['org_link'] = $shortLink->original_url; //for demostration i am using below
                $viewData['link'] = $shortLink;
                return view('links.decode',$viewData);
            }
            return redirect()->back()->with(['status'=>'error','msg'=>'Unable to find link, link may have been deleted!']);
        }
        return redirect()->back()->with(['status'=>'error','msg'=>'Unable to find link, link may have been deleted!']);
    }
}
