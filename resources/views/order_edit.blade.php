<!DOCTYPE html>
<html>
<head>
<center><title>ORDER MANAGEMENT</title></center>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>



    <div class="container">

        <div class="row mt-5 mb-5">
        <a  href="/" value="">Back To Product</a>
        
            <div class="col-10 offset-1 mt-5">
        
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">ORDER MANAGEMENT</h3>
                    </div>
                    <div class="card-body">
  
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::has('failed'))
                            <div class="alert alert-success">
                                {{Session::get('failed')}}
                            </div>
                        @endif
                        
                        <form method="post" action="{{ url('update-order', $customers->id) }}">
                       
                       @csrf
                        @method('PUT')  
                        
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Customer Name:</strong>
                                        <input type="text" name="customername" class="form-control" placeholder="Customer Name" value="{{ $customers->customername }}">
                                        <input type="hidden" name="id" class="form-control" placeholder="Customer Name" value="{{ $customers->id }}"> 
                                        <input type="hidden" name="orderid" class="form-control" placeholder="Customer Name" value="{{ $customers->order_id }}"> 
                                        @if ($errors->has('customername'))
                                            <span class="text-danger">{{ $errors->first('customername') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Phone Number:</strong>
                                        
                                        <input  type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="{{ $customers->phone }}">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                          
     

                            <div class="row">
                            @foreach($orders as $order)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Quantity:</strong>
                                        <input type="hidden" name="id[]" class="form-control" placeholder="Quantity" value="{{ $order->id }}">
                                        <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" value="{{ $order->quantity }}">
                                        @if ($errors->has('quantity'))
                                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Product:</strong>

                                        <select id='product' name="product[]" class="form-control">
                                        @foreach($allproducts as $pro)
<option value="{{$pro->id}}" {{ $pro->id == $order->product ? 'selected' : '' }}>{{$pro->productname}}</option>                      
                               
                                    
@endforeach
                                     
                                        </select>
                                      
                                      

                                    </div>
                                </div>
                                @endforeach
                            </div>
                          
                            <!-- <div id="divAdhar" style="display: none">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Quantity:</strong>
                                        <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Quantity" value="{{ $order->quantity }}">
                                        @if ($errors->has('quantity'))
                                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Product:</strong>

                                        <select id='product' name="product" class="form-control">
                                        @foreach($allproducts as $pro)
                                      
                                     <option value="{{ $pro->id }}">{{$pro->productname}}</option>

                                     @endforeach
                                        </select>
                                      

                                    </div>
                                </div>
                            </div> -->
                            </div>
                         
                            <div class="form-group text-center">
                                <button class="btn btn-success btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


