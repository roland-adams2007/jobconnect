<!DOCTYPE html>
<html lang="en">

<head>
<base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href= "<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png') ?>">
    
    <style>
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out forwards;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="text-center space-y-6 fade-in">
        <!-- Error Heading -->
        <h1 class="text-8xl font-extrabold text-indigo-600">404</h1>
        <p class="text-xl text-gray-600">Oops! The page you're looking for can't be found.</p>

        <!-- Font Awesome Plug Icon -->
        <div class="my-6">
            <i class="fas fa-plug fa-7x text-indigo-600"></i>
        </div>

        <!-- Home Button -->
        <a href="<?php print url('home') ?>" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-indigo-700 hover:shadow-lg transition-transform transform hover:scale-105">
            Go to Home
        </a>
    </div>

</body>

</html>
