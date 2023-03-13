<!DOCTYPE html>
<html>
<head>
<center><title>Edit Products</title></center>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>

    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-10 offset-1 mt-5">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Edit Products</h3>
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
                  <form method="post" action="{{ url('update-product', $product->id) }}" enctype="multipart/form-data">
                       
                  @csrf
                   @method('PUT')   
                              
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Product Name:</strong>
                                        <input type="text" name="productname" class="form-control" placeholder="Product Name" 
                                        value="{{ $product->productname }}" >
                                        @if ($errors->has('productname'))
                                            <span class="text-danger">{{ $errors->first('productname') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Image:</strong>
                                        
                                        <input  type="file"id="image" name="image" class="form-control" placeholder="Image" value="{{ $product->image }}">
                                         <img src="/images/product/{{ $product->image }}" width="100px">
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Price:</strong>
                                        <input type="text" name="price" class="form-control" placeholder="Price"value="{{ $product->price }}">
                                        @if ($errors->has('price'))
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Category:</strong>
                                        

                                        <select id='category' name="category" class="form-control">
                                            
                                        @foreach($category as $cat)
                        <option value="{{$cat->id}}" {{ $cat->id == $product->category ? 'selected' : '' }}>{{$cat->Category}}</option>                      
                

                                       @endforeach
                                        </select>
                                      

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



