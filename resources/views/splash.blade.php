<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HUEMENT LABS</title>
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
            background-color: #000;
        }

        .splash-img {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            display: block;
        }
    </style>
</head>

<body>
    <img src="{{ asset('splash.png') }}" alt="Huement Labs Splash" class="splash-img">
</body>

</html>
