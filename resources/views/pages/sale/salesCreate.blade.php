@extends('master')
@section('content')

<div class="container">
    <h2>Add Sale</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Enter customer name" required>
        </div>

        <div id="product-container">
            <div class="product-group">
                <div class="form-group">
                    <label for="product_id">Select Product</label>
                    <select name="products[0][product_id]" class="form-control product-select" data-index="0" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->quantity }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="products[0][quantity]" class="form-control quantity" min="1" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="products[0][price]" class="form-control price" step="0.01" required readonly>
                </div>
                <hr>
            </div>
        </div>

        <button type="button" id="add-product" class="btn btn-secondary">Add Another Product</button>
<br>
<br>


        <button type="submit" class="btn btn-primary">Add Sale</button>
    </form>
</div>

<script>
    let productIndex = 1;

    // Add another product input group
    document.getElementById('add-product').addEventListener('click', function () {
        const productContainer = document.getElementById('product-container');
        const newProductGroup = document.querySelector('.product-group').cloneNode(true);

        // Update input names and reset values
        newProductGroup.querySelectorAll('select, input').forEach(input => {
            input.name = input.name.replace(/\[0\]/, `[${productIndex}]`);
            input.value = ''; // Clear the value for new inputs
            if (input.classList.contains('price')) input.readOnly = true; // Make price readonly
        });

        // Update data-index for the product select dropdown
        newProductGroup.querySelector('.product-select').setAttribute('data-index', productIndex);

        productContainer.appendChild(newProductGroup);
        productIndex++;
    });

    // Fetch product price dynamically
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('product-select')) {
            const productId = e.target.value;
            const index = e.target.getAttribute('data-index');
            const priceField = document.querySelector(`input[name="products[${index}][price]"]`);

            if (productId) {
                fetch(`/product-price/${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        priceField.value = data.price; // Set the price field value
                    })
                    .catch(error => console.error('Error fetching product price:', error));
            } else {
                priceField.value = ''; // Clear price if no product is selected
            }
        }
    });
</script>

@endsection
