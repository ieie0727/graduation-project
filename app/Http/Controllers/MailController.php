<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use PhpParser\Node\Expr\Cast\String_;


class MailController extends Controller
{

    /**
     * 発注メール
     */
    public function orderMail($order_id)
    {
        $order = Order::find($order_id);
        $company = Company::find($order->company_id);
        $order_items = OrderItem::where('order_id', $order->id)->get();

        //送信先とモデルの指定
        if ($company && $company->email) {
            Mail::to($company->email)->send(new OrderMail($order, $company, $order_items));
        }

        //メール送信後の処理
        return to_route('orders.index')->with('flash_message', '新規発注をしました。');
    }
}
