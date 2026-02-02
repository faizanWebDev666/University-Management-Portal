<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>University Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<x-faviccon />
  <!-- Bootstrap -->
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ URL::asset('frontend/css/indexstyle.css') }}">
  
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">

        <x-logocomponent />

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>

                <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                        data-bs-target="#loginModal">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact-Us</a></li>
            </ul>
        </div>
    </div>
</nav>