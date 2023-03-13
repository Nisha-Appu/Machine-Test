<html>
    <body>
    <table border = "1">
    <title>View Order</title>
<tr>
<td>ID</td>
<td>Order ID</td>

<td>Net Amount</td>


</tr>
@foreach ($order as $ord)

<tr>
<td>{{ $ord->id }}</td>
<td>{{ $ord->orderid }}</td>


<td>{{$ord->price * $ord->quantity }}</td>


@endforeach
</table>
</body>
</html>
