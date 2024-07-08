<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Settings;
use Validator;
class OrderController extends Controller
{
    public function orderTrack(Request $request)
    {
        // dd($request->OrderTrackId);

        $status = Order::where('track_id',$request->OrderTrackId)->get()->first();
        //dd($status->status);
        if ($status->status){
            return response()->json(['response' => true, 'trackStatus' => $status->status]);
        }else{
            return response()->json(['response' => false]);
        }
    }
    public function placeOrder(Request $request)
    {
        //dd($request->all());
        // Validator::make($request->all(), [
        //     'name' => 'required',
        //     'address' =>'required',
        //     'phone' =>'required|min:11|numeric',
        //     'size_id' =>'required',
        //     'subtotal' =>'required',
        //     'shipping_method' =>'required',
        // ])->validate();
        // $wishlistData = JSON.parse(localStorage.getItem("wishlist"));
            $order = new Order();
            $order->name = $request->name;
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->size_id = $request->size_id;
            $order->subtotal = $request->totalSubtotal;
            $order->shipping = $request->shippingCharge;
            $order->total = $request->totalSubtotal + $request->shippingCharge;

            $order->status= 'Order';
            $order->track_id= Settings::orderTrackId();
            $order->save();
            foreach ($request->cartData as $item) {

                $orderItem = new OrderItem();

                $orderItem->product_id = $item['product_id'];
                $orderItem->order_id = $order->id;
                $orderItem->price = $item['price'];
                $orderItem->qty = $item['cusQty'];
                $orderItem->total = $item['cusQty'] * $item['price'];
                $orderItem->save();
            }
        // if(isset($req->is_shipping_different))
        // {
        //     $shipping = new Shipping();
        //     $shipping->order_id = $order->id;
        //     $shipping->mobile = $req->mobile;
        //     $shipping->line1 = $req->line1;
        //     $shipping->line2 = $req->line2;
        //     $shipping->city = $req->city;
        //     $shipping->save();
        // }
        // if($req->paymentMethod == 'cod')
        // {
        //     $transaction = new Transaction();
        //     $transaction->user_id = Auth::user()->id;
        //     $transaction->order_id = $order->id;
        //     $transaction->mode = 'cod';
        //     $transaction->status = 'pending';
        //     $transaction->save();
        // }

//        Cart::instance('cart')->destroy();
//        session()->forget('checkout');
        if ($order){
            return response()->json(['response' => true, 'orderId' => $order->track_id]);
        }else{
            return response()->json(['response' => false]);
        }

    }
    public function orderTable()
    {

        $orderlist = Order::where('user_id',Auth::user()->id)->get()->all();
        return view('server.order.index')->with(compact('orderlist'));
    }
    public function list(string $status=null)

    {
//        $orderlist = Order::with('user')->get()->all();
//        return view('server.order.index')->with(compact('orderlist'));
        //dd($status);
        if($status == 'Order')
        {

            $orderlist = Order::with('size')->where('status','Order')->get()->all();
            return view('server.order.order')->with(compact('orderlist'));
        }
        elseif($status == 'Confirm')
        {

            $orderlist = Order::with('size')->where('status','Confirm')->get()->all();
            return view('server.order.confirm')->with(compact('orderlist'));
        }
        elseif($status == 'Shipping')
        {

            $orderlist = Order::with('user')->where('status','Shipping')->get()->all();
            return view('server.order.shipping')->with(compact('orderlist'));
        }
        elseif($status == 'Delivered')
        {

            $orderlist = Order::with('size')->where('status','Delivered')->get()->all();
            return view('server.order.delivered')->with(compact('orderlist'));
        }
        elseif($status == 'Cancel')
        {

            $orderlist = Order::with('size')->where('status','Cancel')->get()->all();
            return view('server.order.cancel')->with(compact('orderlist'));
        }
        else
        {
            $orderlist = Order::with('size')->get()->all();
            return view('server.order.index')->with(compact('orderlist'));
        }

    }
    public function editStatus(string $id)
    {
        $order = Order::where('id',$id)->get()->first();
        return view('server.order.edit')->with(compact('order'));
    }
    public function updateStatus(Request $request, string $id)
    {

        // if($request->status == 'shipping')
        // {
        //     $orderItem = OrderItem::where('order_id',$id)->get()->all();
        //     //dd($orderItem);
        //     foreach ($orderItem as $key => $item) {
        //         $product_variant = ProductVariationDetails::where('id',$item->product_variations_id)->get()->first();
        //         $product_variant->quantity -= $item->quantity;
        //         $product_variant->update();
        //     }
        // }
        $order = Order::findorFail($id);
        $order->status = $request->status;
        $order->update();
        return redirect()->route('order.index')->with('success','Order Status Update Successfully!');
    }

    public function orderDetails(string $id)
    {
        $orderItems = OrderItem::with('product')->where('order_id',$id)->get()->all();
        //dd($orderItems);
        return view('server.order.orderdetails')->with(compact('orderItems'));
    }
}
