<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HUEMENT LABS</title>
    <meta name="title" content="HUEMENT LABS">
    <meta name="description" content="Huement WebDev TestBed Laboratory">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#000000">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="HUEMENT LABS">
    <meta property="og:description" content="Huement WebDev TestBed Laboratory">
    <meta property="og:image" content="{{ asset('splash.png') }}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="HUEMENT LABS">
    <meta property="twitter:description" content="Huement WebDev TestBed Laboratory">
    <meta property="twitter:image" content="{{ asset('splash.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: #000304;
        }

        .splash-img {
            width: 100vw;
            height: 100vh;
            object-fit: contain;
            display: block;
        }
    </style>
</head>

<body>
    <img src="{{ asset('splash-2.png') }}" alt="Huement Labs Splash" class="splash-img">
</body>

</html>
