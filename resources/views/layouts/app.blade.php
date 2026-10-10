<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog Buku')</title>
</head>
<body>
 

    <main>
      @if (session('success'))
    <div class="alert success">
        {{ session('success') }}
    </div>
@endif
  
        @yield('content')
    </main>
</body>
</html>
