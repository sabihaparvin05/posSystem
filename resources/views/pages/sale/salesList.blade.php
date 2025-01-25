@extends('master')
@section('content')

<div class="container">
    <h2>Sales List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Phone Number</th>
                <th>Products</th>
                <th>Subtotal</th>
                <th>VAT</th>
                <th>Tax</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sale->customer_name }}</td>
                    <td>{{ $sale->phone_no }}</td>
                    <td>
                        <ul>
                            @foreach($sale->items as $item)
                                <li>{{ $item->product->name }} (x{{ $item->quantity }}) - ৳{{ number_format($item->subtotal, 2) }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>৳{{ number_format($sale->items->sum('subtotal'), 2) }}</td>
                    <td>৳{{ number_format($sale->vat, 2) }}</td>
                    <td>৳{{ number_format($sale->tax, 2) }}</td>
                    <td>৳{{ number_format($sale->total, 2) }}</td>
                    <td>{{ $sale->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('sales.bill', $sale->id) }}" class="btn btn-primary btn-sm">View Bill</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">No sales found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
