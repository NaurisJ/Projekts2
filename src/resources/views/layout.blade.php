<!doctype html>
<html lang="lv">
<head>
<meta charset="utf-8">
<title>Project 2 - {{ $title }}</title>
<meta name="description" content="Web Technologies Project 2">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-
QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
crossorigin="anonymous">
</head>
<body>
<nav class="navbar bg-primary mb-3" data-bs-theme="dark">
<header class="container">
<nav class="navbar navbar-expand-md bg-primary mb-3" data-bs-theme="dark">
<div class="container">
<span class="navbar-brand mb-0 h1">Car Tracking</span>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
@if(Auth::check())
<li class="nav-item">
<a class="nav-link" href="/">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/manufacturers">Manufacturers</a>
</li>
</li>
<li class="nav-item">
 <a class="nav-link" href="/cars">Cars</a>
</li>
</li>
<li class="nav-item">
 <a class="nav-link" href="/types">Types</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/logout">Log Out</a>
@else
<li>
    <a class="nav-link" href="/">Home</a>
</li>
<li>
    <a class="nav-item" href="/login">Authenticate</a>
</li>
@endif
</ul>
</div>
</div>
</nav>
</header>
</nav>
<main class="container">
N. Jāvalds, VeA, 2025-01
<div class="row">
<div class="col">
@yield('content')
</div>
</div>
</main>
<footer class="text-bg-dark mt-3">
<div class="container">
<div class="row py-5">
<div class="col">
N. Jāvalds, 2025
</div>
</div>
</div>
</footer>
<script src="/js/admin.js"></script>
</body>
</html>
