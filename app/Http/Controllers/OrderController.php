<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use DB;
use App\VSE;
use Carbon\Carbon;




class OrderController extends Controller
{
    public function view(){
       
        $product = Product::all();
        // SELECT DISTINCT column_name
        // FROM table_name;
        $orders = DB::table('orders')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->select('orders.*','orders.quantity', 'products.*', 'customers.*')
        ->join('products', 'products.id', '=', 'orders.product')
        ->get();

        $order = DB::table('orders')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->join('products', 'products.id', '=', 'orders.product')
        ->select('orders.*','orders.quantity', 'products.*', 'customers.*')
        
        ->get()->unique('customername');
        
        // $order = Order::join('products', 'products.id', '=', 'orders.product')
        //         ->get(['products.*', 'orders.*'])->unique('customername');
              //  $storedItem['price'] = $order->price * $order['qty'];
//  return  $order;
//  exit;
foreach ($orders as $ord)
{

    // $cart->total = $cart->product_price * $cart->cart_list_quantity;

$order_id = $ord->order_id;
$ord->total =  $ord->price * $ord->quantity;
$ord->total_sum = $orders->sum('total'); 

}

//return $ord->total_sum ;
           $orderid =  random_int(1000, 9999);

        return view('add_order',['product'=>$product,'order'=>$order,'orders'=>$orders,'orderid'=>$orderid,'total'=> $ord->total_sum]);
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
      
    DB::delete('delete from customers where id = ?',[$id]);

    return redirect()->back()
    ->with(['delete_msg' => 'Record Deleted']);
   
 }

 public function edit($id)
 {
   
   $customer = Customer::select('*')
                ->where('id', '=', $id)
                
                ->first();

   $order = Order::select('*')
                ->where('customer_id', '=', $id)
                
                ->get();

    // foreach($order as $key=>$product)
    //             {
    //                 return $order;
    //                 exit;
    //             }
                // return $order;
                // exit;
    //  $product = DB::table('orders')
    //         ->join('products', 'orders.product', '=', 'products.id')
    //         ->select('orders.*', 'products.productname', 'products.price','products.id')
    //         ->where('id', '=', $id)
    //         ->get();
              //  return  $product;
   $products = Product::all();
    // return $order_edit;
    // exit;
        // $order = Order::join('products', 'products.id', '=', 'orders.product')
        //         ->get(['products.*', 'orders.*']);
  
     return view('order_edit',['orders'=>$order,'customers'=>$customer,'allproducts'=>$products]);  // -> resources/views/stocks/edit.blade.php
 }

   
 public function update(Request $request,$id)
 {
    try{
     
       $data = $request->input();
        $orders = DB::table('orders')
        ->where('customer_id', '=', $id)
      
        ->get();
//    return $data;
//    exit;
        $data = $request->all();
     
            $date = Carbon::now()->format('Y-m-d');
             $ids =$request->id;

             $order = Customer::where('id',$id)->update([
                'phone' => $request->phone,
                'customername' => $request->customername,
                'order_id'=>$request->orderid,
                'created_at' =>  $date,
            ]);

          
            foreach($orders as $key=>$order)

            {
                // $id =[4,5];
  
                //  return $order;
                // exit;   
                
          Order::where('id', $order->id)
                   ->update([
                    'product' => $request->product[$key],
                    'quantity' => $request->quantity[$key],
                       'created_at' =>  $date,
                   ]);
     
       
       }
  

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
            // return  $data ;
            // exit;
            // $data->quantity = $request->quantity;
            $order_id = random_int(1000, 9999);
            $date = Carbon::now()->format('d-m-y');
            $saverecord = [
              
              
               
                'phone' => $request->phone,
                'customername' => $request->customername,
                'order_id'=>    $order_id,
                'created_at' =>  $date,
            ];
            
            DB::table('customers')->insert( $saverecord);
            $last_id = DB::table('customers')->latest('id')->first();
        
         foreach($request->product as $key=>$product)
         {

        
            //$ids[] = DB::table('customers')->insertGetId(...);
         //  $id = DB::table('customers')->whereIn('id', $ids)->get();
          
          
           $saveorder = [
              
              
                'product' => $request->product[$key],
                'quantity' => $request->quantity[$key],
                'customer_id'=> $last_id->id,
                'created_at' =>  $date,
               
            ];

        //   dd($saveorder);
        //   exit;
            DB::table('orders')->insert( $saveorder);
            // $data = new Order();
            // $data->productname = $productname;
            // $data->phone = $request->phone;
            // $data->quantity = $request->quantity;
            // $data->customername = $request->customername;
            // $data->save();

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
