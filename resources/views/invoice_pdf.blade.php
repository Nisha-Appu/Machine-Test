<html>
    <body>
    <table border = "1">
    <title>View Order</title>
<tr>

<th>Order ID</th>
<th>Products</th>

<th></th>
<th>Total</th>
</tr>



<tr>
<td>{{ $order_id }}</td>

@foreach ($order as $ord)


<td>{{ $ord->productname }}</td>



@endforeach
<td>{{$total}} </td>

</tr>
</table>
</body>
</html>
