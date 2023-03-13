<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use DB;



class ProductController extends Controller
{
    // public function store(Request $request)
    // {
    //  $request->validate([
    //         'productname'=>'required',
    //         'price'=>'required',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'category'=>'required',

    //     ]);
       
    //     $imageName = time().'.'.$request->image->extension();  
       
    //    $request->image->move(public_path('images'), $imageName);
    
    //     Product::create($request->all());
  
    //     return redirect()->back()
    //                      ->with(['success' => 'Product Added Successfully.']);
    // }

    public function store(Request $request)
    {
    try{

        $request->validate([
                    'productname'=>'required',
                    'price'=>'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'category'=>'required',
        
                ]);
        $data = $request->input();
          $product = new Product;
          $product->productname = $data['productname'];
          $product->price = $data['price'];
          $product->category = $data['category'];
          $product->image =request('image');

          $imageName = time().'.'.$product->image->extension();  

          $product->image->move(public_path('images/product'), $imageName);
       //   $student->email = $data['user-email'];
           $product->image = $imageName;
          $product->save();
       //   $student->email = $data['user-email'];
       return redirect()->back()
                           ->with(['success' => 'Product Added Successfully.']);
}
catch(Exception $e){
    return redirect()->back()
                        ->with(['failed' => 'Failed.']);
}

}

    public function view(){
        $category= DB::select('select * from categories');

        // $product = DB::table('products')
        //     ->join('categories', 'products.id', '=', 'categories.id')
           
        //     ->select('products.*', 'categories.Category')
        //     ->get();

        $product = DB::table('products')
            ->Join('categories', 'categories.id', '=', 'products.category')
            ->select('products.*', 'categories.Category')
            ->get();
       // $product = Product::all();
    
        return view('welcome',['category'=>$category,'product'=>$product]);
        }


        public function edit($id)
         {
            $category= DB::select('select * from categories');
            $product = Product::find($id);
             
          
             return view('product_edit',['category'=>$category,'product'=>$product]);  // -> resources/views/stocks/edit.blade.php
         }



         public function update(Request $request,$product_id)
         {
            try{
                $data = $request->input();
             $cat =   $data['category'];
        //    exit;
          //  $id=  $request->id;
            $data =   $request->validate([
             'productname'=>'required',
             'price'=>'required',
             'image'=>'required',
            // 'category'=>'required',
             
         ]);
     
         $image =request('image');
         $imageName = time().'.'.$image->extension();  

         $image->move(public_path('images/product'), $imageName);
        

             $product = Product::where('id',$product_id)->update([
           
              // 'id'=>$product_id,
                 'category' => $cat,
                 'productname'  =>  $data['productname'],
                 'price'  => $data['price'],
                 'image'  => $imageName,
                
                 
                
             ]);
             return redirect('/')->with('success','Product  Has Been updated successfully');
            }
            catch(Exception $e){
                return redirect()->back()
                                    ->with(['failed' => 'Failed.']);
            }
         }
         public function destroy($id) {
           
            DB::delete('delete from products where id = ?',[$id]);
      
            return redirect()->back()
            ->with(['delete_msg' => 'Record Deleted']);
           
         }

}
