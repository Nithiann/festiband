<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FestiBand - Welcome</title>
    <link rel="shortcut icon" href="{{ asset('storage/logo.webp') }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .video-background {
            position: fixed;
            top: -20%;
            left: 0;
            width: 120%;
            height: 120%;
            z-index: -1;
            pointer-events: none;
            opacity: 0;
            transition: opacity 1s ease-in;
        }

        .video-background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            /* Adjust opacity as needed */
            z-index: 1;
            /* Ensure it's above the video */
        }

        .video-background video {
            width: 120%;
            height: 120%;
            object-fit: cover;
            filter: blur(5px);
            /* Adjust blur amount as needed */
            z-index: 0;
            /* Behind the overlay */
        }

        .fade-in {
            opacity: 1 !important;
        }

        .content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: white;
            text-align: center;
            opacity: 0;
            transform: translateY(100vh); /* Start from bottom of the viewport */
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .logo-container {
            position: absolute;
            top: 20px; /* Adjust as needed */
            left: 50%;
            transform: translateX(-50%);
        }

        .btn-outline {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #8002bb; /* Purple border */
            color: #ffffff; /* Purple text */
            background-color: transparent;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            overflow: hidden;
            transition: background-color 0.4s ease-in-out, color 0.4s ease-in-out;
        }

        .btn-outline::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            transition: width 0.4s ease-in-out, height 0.4s ease-in-out, top 0.4s ease-in-out, left 0.4s ease-in-out;
            transform: translate(-50%, -50%);
            z-index: 0;
        }

        .btn-outline:hover::before {
            width: 0;
            height: 0;
        }

        .btn-outline:hover {
            background-color: #8002bb; /* Purple background */
            color: white; /* White text */
        }

        .btn-outline span {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body class="bg-black">
    <div class="video-background" id="video-background">
        <video autoplay muted loop id="background-video" object-fit="cover">
            <source src="{{ asset('storage/background.mp4') }}" type="video/mp4" preload="auto">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="logo-container">
        <img src="{{ asset('storage/logo.webp') }}" alt="Logo" class="mb-4 w-24 h-24 object-contain">
    </div>
    <div class="content" id="content">
        <h1 class="text-4xl font-bold">Welcome to FestiBand<small class="text-xl">©</small></h1>
        <p class="mt-4 max-w-md text-lg">Your ultimate social media hub for festival lovers! Share moments, connect with
            fellow festival-goers, and stay updated on the latest events. Keep the festival spirit alive all year round!
        </p>
        <div class='flex justify-between mt-4'>
            <div class="p-4">
                <a class="btn-outline" href="{{ route('login') }}"><span>Login</span></a>
            </div>
            <div class="p-4">
                <a class="btn-outline" href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trigger the animation after the DOM content is fully loaded
            var content = document.getElementById('content');
            content.style.opacity = 1;
            content.style.transform = 'translateY(0)'; // Move to the center

            var video = document.getElementById('background-video');
            video.addEventListener('loadeddata', function() {
                document.getElementById('video-background').classList.add('fade-in');
            }, false);

            video.addEventListener('error', function(err) {
                console.error("Error loading video: ", err);
            });
        });
    </script>
</body>

</html>
