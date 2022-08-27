<!doctype html>
<html>
<head>
    <!-- <link rel="stylesheet" href="public/assets/css/style"> -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css" />
    <script src="http://localhost/assets/script.js"></script>
    <title>Neoness with codeigniter</title>
</head>
<body>
<?php 
    $uri = service('uri');
?>
<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-l px-4 md:px-6 py-2.5">
        <a href="https://flowbite.com" class="flex items-center">
            <img src="https://upload.wikimedia.org/wikipedia/fr/7/70/Logo_NEONESS.svg" class="mr-3 h-6 sm:h-9" alt="Neoness Logo">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Neoness</span>
        </a>
        <div class="flex items-center">
            <a href="home" class="text-black-900 font-bold">Admin</a>
        </div>
    </div>
</nav>
<nav class="bg-gray-50 dark:bg-gray-700">
    <div class="py-3 px-4 mx-auto max-w-screen-xl md:px-6">   
        <div class="flex items-center">
        <?php if (session()->get('isLoggedIn')):?>
            <ul class="flex flex-row mt-0 mr-6 space-x-8 text-sm font-medium">
                <li <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>>
                    <a href="/dashboard" 
                    class="text-gray-900 dark:text-white hover:underline">
                    Dashbord
                    </a>
                </li>
                 <li <?= ($uri->getSegment(1) == 'profile' ? 'active' : null) ?>>
                    <a href="/profile" 
                    class="text-gray-900 dark:text-white hover:underline">
                    Profile
                    </a>
                </li>  
                <li>
                    <a href="/logout" 
                    class="text-gray-900 dark:text-white hover:underline" aria-current="page">
                    Logout
                    </a>
                </li>
                <?php else: ?>
                <li <?= ($uri->getSegment(1) == 'register' ? 'active' : null) ?>>
                    <a href="/register" 
                    class="text-gray-900 dark:text-white hover:underline">
                    Register
                    </a>
                </li>
                <li <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>>
                    <a href="/" 
                    class="text-gray-900 dark:text-white hover:underline ">
                    Login
                    </a>
                </li>
            </ul>           
            <?php endif ?>
        </div>
    </div>
</nav>


