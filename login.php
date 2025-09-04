<?php
session_start();
include "database.php";

if (isset($_POST['login'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sqlEmail = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $resEmail = mysqli_query($conn, $sqlEmail);

    if (mysqli_num_rows($resEmail) > 0) {
        $_SESSION['email'] = $email;
        echo "
        <script>
            alert('Login successful'); 
            window.location.href='admin.php'; 
        </script>";
        exit();
    } else {
        echo "
        <script>
            alert('Login failed'); 
            window.location.href='login.php'; 
        </scrip>";
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Feedback Page — HRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-black font-sans text-white">

    <!-- Header -->
    <header class="w-full bg-white/10 backdrop-blur-lg shadow-lg border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="index.php" class="flex items-center space-x-3">
                <svg role="img" aria-label="HRM logo" viewBox="0 0 64 64" width="44" height="44" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="g1" x1="0" x2="1" y1="0" y2="1">
                            <stop offset="0" stop-color="#6366f1" />
                            <stop offset="1" stop-color="#9333ea" />
                        </linearGradient>
                        <clipPath id="r">
                            <rect x="0" y="0" width="64" height="64" rx="12" ry="12" />
                        </clipPath>
                    </defs>
                    <rect width="64" height="64" rx="12" fill="url(#g1)" />
                    <path d="M8 40 L56 8 V56 L8 40 Z" fill="#0b1220" opacity="0.12" clip-path="url(#r)" />
                    <g transform="translate(6,8)" fill="#ffffff">
                        <path d="M2 2 H10 V26 H16 V32 H10 V44 H2 V32 H-4 V26 H2z" transform="translate(0,0) scale(0.9)" />
                        <path d="M22 2 H34 C38 2 42 6 42 10 C42 14 38 18 34 18 H28 V26 H22z M28 10 H34 C36 10 38 8 38 6 C38 4 36 2 34 2 H28z"
                            transform="translate(0,0) scale(0.86)" />
                        <path d="M46 44 V2 L54 22 L62 2 V44 H54 V18 L46 30 V44z" transform="translate(-2,0) scale(0.78)" />
                    </g>
                </svg>
                <h1 class="text-2xl font-extrabold tracking-tight">HRM</h1>
            </a>

            <!-- Admin Login -->
            <a href="login.php"
                class="px-6 py-2 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-lg hover:scale-[1.05] transition shadow-lg">
                Admin
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4 pt-12 pb-8">
        <div class="w-full max-w-md p-6 sm:p-10 bg-white/10 backdrop-blur-xl rounded-2xl sm:rounded-3xl shadow-2xl border border-gray-200/20">

            <!-- Title -->
            <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-white mb-6 sm:mb-8 tracking-wide drop-shadow-lg">
                Admin Login
            </h2>

            <!-- Form -->
            <form method="POST" class="space-y-5 sm:space-y-6">
                <!-- Email -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-200">Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required
                        class="w-full px-4 py-3 min-h-[48px] text-white bg-white/10 border border-gray-300/30 rounded-xl placeholder-gray-300 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" />
                </div>

                <!-- Password -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-200">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required
                        class="w-full px-4 py-3 min-h-[48px] text-white bg-white/10 border border-gray-300/30 rounded-xl placeholder-gray-300 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" />
                </div>

                <!-- Button -->
                <button type="submit" name="login"
                    class="w-full py-3 min-h-[48px] mt-5 font-bold text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-xl shadow-lg hover:shadow-2xl hover:scale-[1.02] active:scale-95 transition duration-300">
                    Login
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full bg-white/10 backdrop-blur-lg border-t border-white/20 shadow-inner mt-6">
        <div class="max-w-7xl mx-auto px-6 py-4 text-center text-sm text-gray-200">
            ©2025 HRM Pvt Ltd. All rights reserved.
        </div>
    </footer>

</body>

</html>