@extends('layouts.main')

@section('configurations')
    <div class="navbar-conf">
        <div>
            @if($page > 1)
                <a href="?page={{ $page - 1 }}{{ $search ? '&search=' . $search : '' }}"><button> &lt; </button></a>
            @else
                <button disabled> < </button>
            @endif

            <span>{{ $page }} of {{ $totalPages }}</span>

            @if($page < $totalPages)
                    <a href="?page={{ $page + 1 }}{{ $search ? '&search=' . $search : '' }}"><button> &gt; </button></a>
            @else
                <button disabled> > </button>
            @endif
        </div>

        <input
            type="search"
            id="search"
            name="search"
            class="search"
            value="{{ $search }}"
            placeholder="Search products..."
            onblur="updateSearch(this.value)"
        >

        <a href="/create">Add Product</a>
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
                <td>
                    <div class="table-image">
                        <img
                            src="/uploads/{{ $product['image_path'] ?? 'default.jpg' }}"
                            alt="Product Image"
                            class="table-image-img"
                        >
                    </div>
                    <a href={{"/". $product['id'] . "/change"}}>{{ $product['name'] }}
                </td>
                <td class="col-description">{{ $product['description'] }}</td>
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