<?php

namespace App\Modules\Content\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\Content\Models\Slider;

use Validator;
use Response;
use Carbon\Carbon;

class SliderAjaxController extends Controller
{
    //
    public function __construct() {

    }

    public function ajaxSliderViewPhoto(Request $Request) {
        if($Request->isMethod('GET') && !empty($Request->slider_id)) {
            $Slider = new Slider();
            $SliderPhoto = $Slider::find($Request->slider_id);

            return Response::json(['status' => true, 'SliderPhoto' => $SliderPhoto]);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxSliderUploadPhoto(Request $Request) {
        if($Request->isMethod('POST')) {

            $messages = array(
                'required' => 'გთხოვთ შეავსოთ ყველა აუცილებელი ველი!!!',
                'slider_photo.required' => 'გთხოვთ აირჩიოთ ფოტო !!!',
            );

            $validator = Validator::make($Request->all(), [
                'slider_small_text_ge' => 'required|max:255',
                'slider_big_text_ge' => 'required|max:255',
                'slider_photo' => 'required|max:255',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => true, 'errors' => true, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                $Array = [
                    'small_text_ge' => $Request->slider_small_text_ge,
                    'small_text_en' => $Request->slider_small_text_en,
                    'big_text_ge' => $Request->slider_big_text_ge,
                    'big_text_en' => $Request->slider_big_text_en,
                ];

                $Slider = new Slider();
                $SliderPhoto = $Slider::updateOrCreate(
                    ['id' => $Request->slider_id],
                    [
                        'id' => $Request->slider_id,
                        'text' => json_encode($Array),
                        'path' => $Request->slider_photo,
                        'is_banner' => $Request->is_banner,
                        'url' => $Request->slider_url,
                    ],
                );
            }

            return Response::json(['status' => true, 'errors' => false, 'message' => 'სურათი წარმატებით დაემატა.']);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxSliderDeletePhoto(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->slider_id)) {
            $Slider = new Slider();
            $Slider::find($Request->slider_id)->update([
                'deleted_at' => Carbon::now(),
                'deleted_at_int' => 0,
            ]);

            return Response::json(['status' => true, 'message' => 'სურათი წარმატებით წაიშალა !!!']);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxSliderActiveChange(Request $Request) {
        
    }
}
