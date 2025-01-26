@extends('master')
@section('content')
    <div class="container">
        <h2>Return List</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice Number</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Amount Refunded</th>
                    <th>Reason</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($returns as $return)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $return->sale->invoice_number }}</td>
                        <td>{{ $return->salesItem->product->name }}</td>
                        <td>{{ $return->quantity }}</td>
                        <td>৳{{ number_format($return->amount_refunded, 2) }}</td>
                        <td>{{ $return->reason ?? 'N/A' }}</td>
                        <td>{{ $return->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No returns found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
