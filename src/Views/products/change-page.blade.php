@extends('layouts.main', ['title' => 'Change Product'])

@section('configurations')
    <div class="navbar-conf">
        <button onclick="save({{ $product['id'] ?? null }})">
            {{
                $product ? 'Save Changes' : 'Create Product'
            }}
        </button>
        @if($product)
            <button onclick="deleteProduct({{ $product['id'] }})">Delete Product</button>
        @endif
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="form-group">
            <label for="name" class="required">Name</label>
            <input type="text" id="name" value="{{ $product['name'] ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="price" class="required">Price</label>
            <input type="number" id="price" step="0.01" value="{{ $product['price'] ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="availability_date">Availability date</label>
            <input type="date" id="availability_date" value="{{ $product['availability_date'] ?? null }}">
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            @if(!empty($product['image_path']))
                <div class="image-preview">
                    <img src="/products/{{ $product['image_path'] }}" alt="Product Image" style="max-width:150px; display:block; margin-bottom:10px;">
                </div>
                <input type="hidden" id="existing_image" value="{{ $product['image_path'] }}">
            @endif

            <input type="file" id="image" accept="image/*">
        </div>

        <div class="form-group checkbox-group">
            <label for="in_stock">In Stock</label>
            <input type="checkbox"
                   id="in_stock"
                    {{ !empty($product['in_stock']) ? 'checked' : '' }}>
        </div>

        <div class="form-group full-width">
            <label for="description">Description</label>
            <textarea id="description">{{ $product['description'] ?? '' }}</textarea>
        </div>
    </div>
@endsection

<script src="/products.js"></script>