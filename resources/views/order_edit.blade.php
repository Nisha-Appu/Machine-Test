<!DOCTYPE html>
<html>
<head>
<center><title>Edit Order</title></center>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>

    <div class="container">
        <div class="row mt-5 mb-5">
               <span>ADD PRODUCT</span>
<input type="button" id="btnYes" value="Yes" />
<input type="button" id="btnNo" value="No"/>
<hr />
            <div class="col-10 offset-1 mt-5">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Edit Order</h3>
                    </div>
                    <div class="card-body">
  
                    @if ($errors->any())
                    <div class="alert alert-danger">
                     <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                     @endforeach
                    </ul>
                    </div>
                     <br /> 
                  @endif
                  <form method="post" action="{{ url('update-order', $orders->id) }}">
                       
                  @csrf
                   @method('PUT')   
                              
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Customer Name:</strong>
                                        <input type="text" name="customername" class="form-control" placeholder="Customer Name" 
                                        value="{{ $orders->customername }}" >
                                        @if ($errors->has('customername'))
                                            <span class="text-danger">{{ $errors->first('customername') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                        <strong>Phone Number:</strong>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone"value="{{ $orders->phone }}">
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
                                        <input type="text" name="quantity" class="form-control" placeholder="Quantity" value="{{ $orders->quantity }}">
                                        @if ($errors->has('quantity'))
                                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                        <strong>Product:</strong>

                                        <select id='product' name="product" class="form-control">
                                        @foreach($product as $pro)
                                      
                                     <option value="{{ $pro->id }}">{{$pro->productname}}</option>

                                     @endforeach
                                        </select>
                                      

                                    </div>
                                </div>
                                <div id="divAdhar" style="display: none">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Quantity:</strong>
                                        <input type="text" id="quantity1" name="quantity1" class="form-control" placeholder="Quantity" value="">
                                        @if ($errors->has('quantity'))
                                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Product:</strong>

                                        <select id='product' name="product1" class="form-control">
                                        @foreach($product as $pro)
                                      
                                     <option value="{{ $pro->id }}">{{$pro->productname}}</option>

                                     @endforeach
                                        </select>
                                      

                                    </div>
                                </div>
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

  
</body>
</html>




<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
debugger;
//Show Hide TextBox on Button Click using jQuery
$(function () {
debugger;
$("#btnYes").click(function () {
if ($(this).val() == "Yes") {
$("#divAdhar").show();
}
});
$("#btnNo").click(function () {
if ($(this).val() == "No") {
$("#divAdhar").hide();
}
});
});
</script>