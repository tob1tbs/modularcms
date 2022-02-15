<?php

namespace App\Modules\Orders\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Orders\Models\Order;

class OrdersController extends Controller
{

    public function __construct() {
        //
    }

    public function actionOrdersIndex(Request $Request) {
        if (view()->exists('orders.orders_index')) {

            $Order = new Order();
            $OrderList = $Order::where('deleted_at_int', '!=', 0)->get();

            $data = [
                'order_list' => $OrderList,
            ];

            return view('orders.orders_index', $data);
        } else {
            abort('404');
        }
    }

    public function actionOrdersAdd() {
        if (view()->exists('orders.orders_add')) {

            $data = [
            ];

            return view('orders.orders_add', $data);
        } else {
            abort('404');
        }
    }

    public function actionOrdersEdit(Request $Request) {
        if (view()->exists('orders.orders_edit')) {

            $data = [
            ];

            return view('orders.orders_edit', $data);
        } else {
            abort('404');
        }
    }

    public function actionOrdersView(Request $Request) {
        if (view()->exists('orders.orders_view')) {

            $data = [
            ];

            return view('orders.orders_view', $data);
        } else {
            abort('404');
        }
    }
}
