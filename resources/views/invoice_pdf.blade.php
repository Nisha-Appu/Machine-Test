<html>
    <body>
    <table border = "1">
    <title>View Order</title>
<tr>

<th>Order ID</th>
<th>Product Name</th>
<th>Net Amount</th>
<!-- <th>Total</th> -->


</tr>
@foreach ($order as $ord)

<tr>

<td>{{ $ord->order_id }}</td>

<td>{{ $ord->productname }}</td>
<td>{{$ord->price * $ord->quantity }} </td>


@endforeach
</table>
</body>
</html>
