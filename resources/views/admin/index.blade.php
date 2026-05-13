@extends('admin.layout.main')

@section('main-container')

<div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
    <h2 class="tm-block-title">Orders List</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ORDER NO.</th>
                <th scope="col">STATUS</th>
                <th scope="col">CUSTOMER</th>
                <th scope="col">PRODUCTS</th>
                <th scope="col">TOTAL</th>
                <th scope="col">ORDER DATE</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
           
        <tbody>
            @foreach($orders as $o)
            <tr>
                <th scope="row">
                    <b>#{{ $o->id }}</b>
                </th>

                <td>
                    <div class="tm-status-circle 
                        {{ $o->status == 'pending' ? 'pending' : 
                           ($o->status == 'cancelled' ? 'cancelled' : 'moving') }}">
                    </div>
                    {{ ucfirst($o->status) }}
                </td>

                <td>
                    <b>{{ $o->user->name ?? 'N/A' }}</b>
                </td>

                <td>
                    @foreach($o->items as $item)
                    {{ $item->product->name ?? 'Product' }}<br>
                    @endforeach
                </td>

                <td>
                    <b>₹{{ number_format($o->total_amount, 2) }}</b>
                </td>
                                                        
                <td>
                    {{ \Carbon\Carbon::parse($o->order_date)->format('d M Y') }}
                </td>
               
                <td>
                    <a href="{{ route('admin.order.details', $o->id) }}" class="btn btn-sm btn-primary">
                        Details
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection