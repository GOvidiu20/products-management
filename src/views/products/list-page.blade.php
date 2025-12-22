@extends('layouts.main')

@section('configurations')
    <div class="navbar-conf">
        <div>
            @if($page > 1)
                <a href="?page={{ $page - 1 }}"><button>Previous</button></a>
            @else
                <button disabled>Previous</button>
            @endif

            <span>Page {{ $page }} of {{ $totalPages }}</span>

            @if($page < $totalPages)
                <a href="?page={{ $page + 1 }}"><button>Next</button></a>
            @else
                <button disabled>Next</button>
            @endif
        </div>

        <input
                type="search"
                id="search"
                name="search"
                value="{{ $search }}"
                placeholder="Search products..."
                oninput="updateSearch(this.value)"
        >

        <a href="/change">Add Product</a>
    </div>
@endsection

@section('content')
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Availability</th>
            <th>In Stock</th>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['description'] }}</td>
                <td>{{ $product['price'] }}</td>
                <td>{{ $product['availability_date'] }}</td>
                <td>{{ $product['in_stock'] ? 'Yes' : 'No' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

<script>
    function updateSearch(value) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('search', value);
        urlParams.set('page', 1);
        window.location.search = urlParams.toString();
    }
</script>