<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: DejaVu Sans; }
        .container { width: 100%; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>Invoice #{{ $order->id }}</h2>
        <p>Date: {{ $order->created_at->format('d M Y') }}</p>
    </div>

    <div class="section">
        <strong>From (Seller):</strong><br>
        Your Company Name <br>
        support@yourcompany.com <br>
        +91-XXXXXXXXXX
    </div>

    <div class="section">
        <strong>To (Customer):</strong><br>
        {{ $order->user->name ?? 'Customer' }} <br>
        {{ $order->user->email ?? '' }}
    </div>

    <div class="section">
        <strong>Shipping Address:</strong><br>
        {{ $order->address->full_name ?? '' }}, <br>
        {{ $order->address->address_line1 ?? '' }}
    </div>

    <div class="section">
        <strong>Payment:</strong><br>
        {{-- Method: {{ $order->payment_method }} <br> --}}
        Status: {{ $order->status }}
    </div>

    <div class="section">
        <strong>Order Items:</strong>

        <table>
    <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach($order->items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->product->name ?? '' }}</td>
            <td>{{ $item->qty ?? 0 }}</td>
            <td>₹{{ number_format($item->price, 0) }}</td>
            <td>₹{{ number_format($order->final_amount, 0) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>

    <div class="section">
        <strong>Total Amount:</strong> ₹{{ number_format($order->final_amount, 0) }}
    </div>

</div>

</body>
</html>
