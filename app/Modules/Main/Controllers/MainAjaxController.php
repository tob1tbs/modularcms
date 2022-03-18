<?php

namespace App\Modules\Main\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Main\Models\Notification;

class MainAjaxController extends Controller
{

    public function __construct() {
        //
    }

    public function ajaxViewNotification(Request $Request) {
        if($Request->isMethod('GET')) {

        	$Notification = new Notification();
        	$NotificationData = $Notification::find($Request->notification_id);

        	$NotificationData->update(['seen' => 1]);

        	return Response::json(['status' => true, 'NotificationData' => $NotificationData]);
        } else {
        	return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }
}
