<!-- <table class="table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Customer Name</th>
            <th>Products</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>#{{ $order->id }} </td>
            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
            <td>{{ $order->user->name ?? 'N/A'}}</td>

            <td>
                @foreach($order->items as $item)
                {{ $item->product->name ?? 'Product'}} (*{{ $item->qty}}) <br>
                @endforeach
            </td>

            <td>₹{{ $order->total_amount }}</td>
        </tr>
        @endforeach
    </tbody>
</table> -->

<!-- resources/views/admin/orders.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3>Orders</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Order ID</th>
                            <th>Order Date</th>
                            <th class="text-center">Customer Name</th>
                            <th>Products</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $o)
                        <tr>
                            <td class="text-center">{{ $o->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($o->order_date)->format('d M Y') }}</td>
                            <td class="text-center">{{ $o->user->name ?? 'N/A' }}</td>
                            <td>
                                @foreach($o->items as $item)
                                {{ $item->product->name ?? 'Product' }}<br>
                                @endforeach   
                            </td>
                            <td>₹{{ number_format($o->total_amount, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.order.details', $o->id) }}" class="btn btn-sm btn-primary">
                                    Details 
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>