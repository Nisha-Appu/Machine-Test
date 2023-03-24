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
           
<input type="button" class="addRow" value="ADD PRODUCT" />
<input type="button" onclick="remProd()" value="REMOVE"/>
<hr />
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
                    
                        <form method="POST" action="{{route('order-store')}}"  >
                            {{ csrf_field() }}
                              
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Customer Name:</strong>
                                        <input type="text" name="customername" class="form-control" placeholder="Customer Name" value="{{ old('customername') }}">
                                      
                                        <input type="hidden" name="orderid" class="form-control" placeholder="Customer Name" value="{{$orderid}}"> 
                                        @if ($errors->has('customername'))
                                            <span class="text-danger">{{ $errors->first('customername') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Phone Number:</strong>
                                        
                                        <input  type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Quantity:</strong>
                                        <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" value="{{ old('quantity') }}">
                                        @if ($errors->has('quantity'))
                                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Product:</strong>

                                        <select id='product' name="product[]" class="form-control">
                                        @foreach($product as $pro)
                                      
                                     <option value="{{ $pro->id }}">{{$pro->productname}}</option>

                                     @endforeach
                                        </select>
                                      

                                    </div>
                                </div>
                            </div>
                          
                            <div id="dynamicRow" style="display: none">
                             
                            </div>
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

    <table border = "1">
    <title>View Order</title>
<tr>
<td>ID</td>
<td>Order ID</td>
<td>Customer Name</td>
<td>Phone</td>
<td>Net Amount</td>
<td>Order Date</td>
<td>Actions</td>
</tr>
@foreach ($order as $ord)

<tr>
<td>{{ $ord->id }}</td>
<td>{{ $ord->order_id }}</td>
<td>{{ $ord->customername }}</td>
<td>{{$ord->phone}}</td>
<td>{{$ord->price * $ord->quantity }}</td>
<td>{{$ord->created_at}}</td>
<td><a href = 'delete_order/{{ $ord->id }}'>Delete</a></td>
<td><a href = 'edit_order/{{ $ord->id }}'>Edit</a></td>
<td><a href = 'invoice/{{ $ord->id }}'>Invoice</a></td>
@endforeach
</table>
</body>
</html>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
$('.addRow').on("click",function()
{
    addRow();
});
function addRow()
{
    $("form").append(
        ' <div id="hidden" class="row">'+
        ' <div class="col-md-6">'+
        '<div class="form-group">'+
                                        '<strong>Quantity:</strong>'+
                                       '<input type="text" id="quantity" class="race"name="quantity[]" class="form-control" placeholder="Quantity" value="{{ old("quantity") }}">'+
                                        '@if ($errors->has("quantity"))'+
                                            '<span class="text-danger">{{ $errors->first("quantity") }}</span>'+
                                        '@endif'+
                                    '</div>'+
                                    '</div>'+
                                   ' <div class="col-md-6">'+
                                    '<div class="form-group">'+
                                        '<strong>Product:</strong>'+

                                        '<select id="product" name="product[]" class="form-control">'+
                                        '@foreach($product as $pro)'+
                                      
                                     '<option value="{{ $pro->id }}">{{$pro->productname}}</option>'+

                                     '@endforeach'+
                                       '</select>'+
                                      

                                   '</div>'+
                                '</div>'+
                                '</div>'
                                    
                                    
                                    
                                    );
  

}

function remProd()
{
   $("#hidden").last().remove();
}
</script>


           