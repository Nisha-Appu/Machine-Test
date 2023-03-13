<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use DB;
use App\VSE;



class OrderController extends Controller
{
    public function view(){
       
        $product = Product::all();

        $order = Order::join('products', 'products.id', '=', 'orders.product')
                ->get(['products.*', 'orders.*']);
              //  $storedItem['price'] = $order->price * $order['qty'];
//  return  $order;
//  exit;

        return view('add_order',['product'=>$product,'order'=>$order]);
        }




    //     public function store(Request $request)
    //     {
    //     try{
    
    //         $request->validate([
    //                     'customername'=>'required',
    //                     'quantity'=>'required',
    //                     'phone' => 'required',
            
    //                 ]);
    //         $data = $request->input();
            
    //           $order = new Order;
    //           $order->customername = $data['customername'];
    //           $order->quantity = $data['quantity'];
    //           $order->product = $data['product'];
    //           $order->phone = $data['phone'];
    //           $order->orderid = random_int(1000, 9999);
    //           //$order->orderid = '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT);
         
    //           $order->save();
    //        //   $student->email = $data['user-email'];
    //        return redirect()->back()
    //                            ->with(['success' => 'Order Added Successfully.']);
    //      }
    //         catch(Exception $e){
    //          return redirect()->back()
    //                         ->with(['failed' => 'Failed.']);
    //      }
    // }

public function destroy($id) {
           
    DB::delete('delete from orders where id = ?',[$id]);

    return redirect()->back()
    ->with(['delete_msg' => 'Record Deleted']);
   
 }

 public function edit($id)
 {
   
    $order = Order::find($id);
    $product = Product::all();
    // return $order_edit;
    // exit;
        // $order = Order::join('products', 'products.id', '=', 'orders.product')
        //         ->get(['products.*', 'orders.*']);
  
     return view('order_edit',['orders'=>$order,'product'=>$product]);  // -> resources/views/stocks/edit.blade.php
 }

   
 public function update(Request $request,$order_id)
 {
    try{
        $data = $request->input();
      
  //  $id=  $request->id;
    $data =   $request->validate([
     'customername'=>'required',
     'phone'=>'required',
     'quantity'=>'required',
   
     
 ]);
$order = Order::where('id',$order_id)->update([
   
      // 'id'=>$product_id,
         'customername'  =>  $data['customername'],
         'phone'  => $data['phone'],
         'quantity'  => $data['quantity'],
       //  'product'  => $data['product'],
        
         
        
     ]);
     return redirect('add_order')->with('success','Order  Has Been updated successfully');
    }
    catch(Exception $e){
        return redirect()->back()
                            ->with(['failed' => 'Failed.']);
    }
 }
 

        public function store(Request $request)
        {
        try{
            $data = $request->input();
            // $data->quantity = $request->quantity;
           
         return  $data;
         foreach($request->productname as $key=>$productname)
         {

            
            $data = new Order();
            $data->productname = $productname;
            $data->phone = $request->phone;
            $data->quantity = $request->quantity;
            $data->customername = $request->customername;
            $data->save();

         }
           return redirect()->back()
                               ->with(['success' => 'Order Added Successfully.']);
         }
            catch(Exception $e){
             return redirect()->back()
                            ->with(['failed' => 'Failed.']);
         }
    }



}
