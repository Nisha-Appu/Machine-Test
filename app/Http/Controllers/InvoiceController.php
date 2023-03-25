<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use PDF;
use DB;
use Illuminate\Support\Collection;

class InvoiceController extends Controller
{


    public function view(Request $request,$id){
       
       
        $product = Product::all();

        $product = DB::table('products')
        ->Join('categories', 'categories.id', '=', 'products.category')
        ->select('products.*', 'categories.Category')
        ->get();

        $order= DB::table('orders')
        ->Join('products', 'orders.product', '=', 'products.id')
        ->Join('customers', 'orders.customer_id', '=', 'customers.id')
        ->select('products.*', 'orders.quantity','orders.id','products.productname','customers.order_id')
      
        ->where('orders.customer_id', '=', $id)
       
        ->get( );
        $total = 0;
        foreach ($order as $ord)
        {

            // $cart->total = $cart->product_price * $cart->cart_list_quantity;
            // $cart->total_sum = $cart->sum('total');
$order_id = $ord->order_id;
     $ord->total =  $ord->price * $ord->quantity;
     $ord->total_sum = $order->sum('total'); 
 
        }
       
        
        /// return   $ord->total_sum; 
        // $order =select `orders`.`orderid`, `orders`.`quantity`, `products`.`productname`, `products`.`id` from `orders` inner join `products` on `products`.`id` = `orders`.`product`;

              //  $storedItem['price'] = $order->price * $order['qty'];
//  return  $order;
//  exit;

    $pdf =   PDF::loadView('invoice_pdf',['product'=>$product,'order'=>$order,'total'=> $ord->total_sum,'order_id'=>$order_id]);
    return $pdf->download(filename : 'invoice_pdf');
        }


    public function Invoice(Request $request,$orderid)
    {
     
       
        $pdf = PDF::loadView(view : 'invoice');

        return $pdf->download(filename : 'invoice_pdf');
    }
}