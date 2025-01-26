@extends('master')
@section('content')
    <div class="container">
        <div class="text-right mb-3">
            <button class="btn btn-success" onclick="window.print()">Print Receipt</button>
        </div>

        <div id="bill-content" class="receipt">
            <div class="receipt-header">
                <h3>YAMAHA</h3>
                <p><strong>Receipt</strong></p>
                <p>Registered Address: Konabari, Gazipur</p>
                <p>Registered No: 0000004532566 552</p>
                <p>Outlet: Uttara, Dhaka-1230</p>
            </div>

            <div class="receipt-header">
                <p>Retail Invoice</p>
                <div class="receipt-row">
                    <span class="field-name">Customer Name:</span>
                    <span class="field-value">{{ $sale->customer_name }}</span>
                </div>
                <div class="receipt-row">
                    <span class="field-name">Customer Phone No:</span>
                    <span class="field-value">{{ $sale->phone_no }}</span>
                </div>
                <div class="receipt-row">
                    <span class="field-name">Date:</span>
                    <span class="field-value">{{ $sale->created_at->format('M d, Y') }}</span>
                </div>
                <div class="receipt-row">
                    <span class="field-name">Invoice Number:</span>
                    <span class="field-value">{{ $sale->invoice_number }}</span>
                </div>
            </div>

            @foreach ($sale->items as $item)
                <div class="receipt-row">
                    <span class="field-name">Product:</span>
                    <span class="field-value">{{ $item->product->name }}</span>
                </div>
                <div class="receipt-row">
                    <span class="field-name">Quantity:</span>
                    <span class="field-value">{{ $item->quantity }}</span>
                </div>
                <div class="receipt-row">
                    <span class="field-name">Price:</span>
                    <span class="field-value">৳{{ number_format($item->price, 2) }}</span>
                </div>
                <div class="receipt-row">
                    <span class="field-name">Subtotal:</span>
                    <span class="field-value">৳{{ number_format($item->subtotal, 2) }}</span>
                </div>
            @endforeach

            <div class="receipt-row">
                <span class="field-name">VAT:</span>
                <span class="field-value">৳{{ number_format($sale->vat, 2) }}</span>
            </div>
            <div class="receipt-row">
                <span class="field-name">Tax:</span>
                <span class="field-value">৳{{ number_format($sale->tax, 2) }}</span>
            </div>
            <div class="receipt-row total-row">
                <span class="field-name">Total:</span>
                <span class="field-value">৳{{ number_format($sale->total, 2) }}</span>
            </div>

            <div class="receipt-footer">
                <p>Thank you for your purchase!</p>
                <p><strong>YAMAHA</strong></p>
                <p><strong>Return Policy:</strong> Products can be returned within 7 days of purchase with a valid receipt. Items must be in their original condition. For more details, please contact our support.</p>
            </div>
        </div>
    </div>

    <!-- Styling for the receipt -->
    <style>
        /* Receipt Layout */
        .receipt {
            max-width: 400px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 30px;
            background: #fff;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header h3 {
            margin: 0;
            font-size: 20px;
        }

        .receipt-header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .receipt-body {
            margin-bottom: 20px;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px dashed #ddd;
        }

        .receipt-row.total-row {
            font-weight: bold;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            margin-top: 10px;
            padding: 10px 0;
        }

        .field-name {
            flex: 1;
            text-align: left;
        }

        .field-value {
            flex: 1;
            text-align: right;
        }

        .receipt-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }

        /* Print-Specific Styling */
        @media print {
            body * {
                visibility: hidden;
            }

            #bill-content,
            #bill-content * {
                visibility: visible;
            }

            #bill-content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .btn {
                display: none;
                /* Hide buttons during print */
            }
        }
    </style>
@endsection
