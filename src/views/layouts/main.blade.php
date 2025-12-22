<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Products Management' }}</title>
    <link rel="stylesheet" href="/style.css">

</head>
<body>
<header class="navbar">
    <h1>Products Management</h1>
    <div>
        @yield('configurations')
    </div>
</header>

<main>
    @yield('content')
</main>
</body>
</html>
