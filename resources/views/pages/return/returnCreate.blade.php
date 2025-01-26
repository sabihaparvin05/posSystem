@extends('master')
@section('content')

    <div class="container">
        <h2>Create Return</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($errors->has('return_policy'))
            <div class="alert alert-danger">
                {{ $errors->first('return_policy') }}
            </div>
        @endif

        @if ($errors->has('quantity_exceeded'))
            <div class="alert alert-danger">
                {{ $errors->first('quantity_exceeded') }}
            </div>
        @endif

        <form action="{{ route('return.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="sale_id">Sale</label>
                <select id="sale_id" name="sale_id" class="form-control" required>
                    <option value="">Select Sale</option>
                    @foreach ($sales as $sale)
                        <option value="{{ $sale->id }}">
                            Invoice: {{ $sale->invoice_number }} | Customer: {{ $sale->customer_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="sales_item_id">Product</label>
                <select id="sales_item_id" name="sales_item_id" class="form-control" required onchange="updateAmount()">
                    <option value="">Select Product</option>
                    @foreach ($sales as $sale)
                        @foreach ($sale->items as $item)
                            <option value="{{ $item->id }}" data-price="{{ $item->price }}" data-quantity="{{ $item->quantity }}">
                                {{ $item->product->name }} (x{{ $item->quantity }})
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Return Quantity</label>
                <input type="number" id="quantity" name="quantity" class="form-control" min="1" required oninput="updateAmount()">
                <small id="quantity-error" class="text-danger" style="display: none;">Return quantity exceeds the available quantity!</small>
            </div>

            <div class="form-group">
                <label for="amount_refunded">Amount Refunded</label>
                <input type="number" id="amount_refunded" name="amount_refunded" class="form-control" step="0.01" readonly required>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Return</label>
                <textarea id="reason" name="reason" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Return</button>
        </form>
    </div>

    <script>
        function updateAmount() {
            const productSelect = document.getElementById('sales_item_id');
            const quantityInput = document.getElementById('quantity');
            const amountInput = document.getElementById('amount_refunded');
            const quantityError = document.getElementById('quantity-error');

            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const maxQuantity = selectedOption.getAttribute('data-quantity');

            const quantity = quantityInput.value;

            if (quantity && maxQuantity && parseInt(quantity) > parseInt(maxQuantity)) {
                quantityError.style.display = 'block';
                amountInput.value = '';
                return;
            } else {
                quantityError.style.display = 'none';
            }

            if (price && quantity) {
                const subtotal = parseFloat(price) * parseInt(quantity);
                const vat = (subtotal * 10) / 100; // 10% VAT
                const tax = (subtotal * 5) / 100;  // 5% Tax
                const total = subtotal + vat + tax;

                amountInput.value = total.toFixed(2);
            } else {
                amountInput.value = '';
            }
        }
    </script>

@endsection
