<?php
session_start();
include "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $msg = $_POST["message"];
    $rating = $_POST['rating'];
    $date = $_POST['date']; // new date input


    $sql = "INSERT INTO allfeedback (fullname, email, msg, rating, date) VALUES ('$name', '$email', '$msg', '$rating', '$date')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "
        <script>
            alert('Feedback submitted successfully'); 
            window.location.href='index.php'; 
        </script>";
        exit();
    } else {
        echo "
        <script>
            alert('Failed to submit feedback'); 
            window.location.href='index.php'; 
        </script>";
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

    <style>
        /* ScrollBar Hidden Karne Ke Liye */
        ::-webkit-scrollbar {
            display: none;
        }

        body {
            scrollbar-width: none;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-black font-sans text-white">

    <!-- Header -->
    <header class="w-full bg-white/10 backdrop-blur-lg shadow-lg border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
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
            </div>

            <!-- Admin Login -->
            <a href="login.php"
                class="px-6 py-2 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-lg hover:scale-[1.05] transition shadow-lg">
                Admin
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4 pt-12 pb-8">
        <div
            class="w-full max-w-3xl p-6 sm:p-10 bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 hover:shadow-3xl transition">

            <!-- Title -->
            <h2 class="text-3xl sm:text-4xl font-extrabold sm:hidden block text-center mb-8 drop-shadow-lg">
                Feedback
            </h2>

            <h2 class="text-3xl sm:text-4xl font-extrabold hidden sm:block text-center mb-8 drop-shadow-lg">
                Share Your Feedback
            </h2>

            <form method="POST" class="space-y-6 sm:space-y-8">
                <!-- Name -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-200">Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" required
                        class="w-full px-4 py-3 min-h-[48px] rounded-xl text-white bg-white/10 border border-white/20 placeholder-gray-300 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" />
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-200">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required
                        class="w-full px-4 py-3 min-h-[48px] rounded-xl text-white bg-white/10 border border-white/20 placeholder-gray-300 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" />
                </div>

                <!-- Message -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-200">Message</label>
                    <textarea name="message" rows="5" placeholder="Write your message..."
                        class="w-full px-4 py-3 min-h-[48px] rounded-xl text-white bg-white/10 border border-white/20 placeholder-gray-300 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"></textarea>
                </div>

                <!-- Date -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-200">Date</label>
                    <input type="date" name="date" required
                        class="w-full px-4 py-3 min-h-[48px] rounded-xl text-white bg-white/10 border border-white/20 placeholder-gray-300 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" />
                </div>

                <!-- Rating -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-200">Rate Us (1–5)</label>
                    <select name="rating" required
                        class="w-full px-4 py-3 min-h-[48px] rounded-xl text-white bg-white/10 border border-white/20 placeholder-gray-300 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        <option value="" class="text-gray-700">Select a rating</option>
                        <option value="1" class="text-gray-900">1 - Poor</option>
                        <option value="2" class="text-gray-900">2 - Fair</option>
                        <option value="3" class="text-gray-900">3 - Good</option>
                        <option value="4" class="text-gray-900">4 - Very Good</option>
                        <option value="5" class="text-gray-900">5 - Excellent</option>
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit" name="send"
                    class="w-full py-4 font-bold text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-xl shadow-lg hover:shadow-2xl hover:scale-[1.02] active:scale-95 transition text-lg">
                    Submit Feedback
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