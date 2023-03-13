<!DOCTYPE html>
<html>
<head>
<center><title>Add Products</title></center>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>



    <div class="container">

        <div class="row mt-5 mb-5">
        <a  href="/add_order" value="">ORDER MANAGEMENT</a>
        
            <div class="col-10 offset-1 mt-5">
           
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Add Products</h3>
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
                    
                        <form method="POST" action="{{route('store')}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                              
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Product Name:</strong>
                                        <input type="text" name="productname" class="form-control" placeholder="Product Name" value="{{ old('productname') }}">
                                        @if ($errors->has('productname'))
                                            <span class="text-danger">{{ $errors->first('productname') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Image:</strong>
                                        
                                        <input  type="file"id="image" name="image" class="form-control" placeholder="Image" value="{{ old('image') }}">
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
                                        <input type="text" name="price" class="form-control" placeholder="Price" value="{{ old('price') }}">
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
                                      
                                     <option value="{{ $cat->id }}">{{$cat->Category}}</option>

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

    <table border = "1">
    <title>View Products</title>
<tr>
<td>Id</td>
<td>Product Name</td>
<td>Price</td>
<td>Category</td>
<td>Actions</td>
</tr>
@foreach ($product as $pro)

<tr>
<td>{{ $pro->id }}</td>
<td>{{ $pro->productname }}</td>
<td>{{ $pro->price }}</td>
<td>{{$pro->Category}}</td>
<td><a href = 'delete/{{ $pro->id }}'>Delete</a></td>
<td><a href = 'edit/{{ $pro->id }}'>Edit</a></td>

@endforeach
</table>
</body>
</html>




                     