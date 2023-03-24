<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use PDF;
use DB;

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
        // $total = 0;
        // foreach ($order as $key=>$ord)
        // {
    

            
        //     $total =  $ord->price * $ord->quantity;
           
   
           
          
        // }
       
        
        // return   sum($total); 
        // $order =select `orders`.`orderid`, `orders`.`quantity`, `products`.`productname`, `products`.`id` from `orders` inner join `products` on `products`.`id` = `orders`.`product`;

              //  $storedItem['price'] = $order->price * $order['qty'];
//  return  $order;
//  exit;

    $pdf =   PDF::loadView('invoice_pdf',['product'=>$product,'order'=>$order]);
    return $pdf->download(filename : 'invoice_pdf');
        }


    public function Invoice(Request $request,$orderid)
    {
     
       
        $pdf = PDF::loadView(view : 'invoice');

        return $pdf->download(filename : 'invoice_pdf');
    }
}