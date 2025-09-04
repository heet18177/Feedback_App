<?php
session_start();
include "database.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM allfeedback ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HRM Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans flex">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed md:relative top-0 left-0 w-64 bg-gradient-to-b from-indigo-900 via-purple-900 to-black text-white min-h-screen flex flex-col shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50">

        <!-- HRM Logo + Title -->
        <div class="p-6 flex items-center space-x-3 border-b border-white/20">
            <svg role="img" aria-label="HRM logo" viewBox="0 0 64 64" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="g1" x1="0" x2="1" y1="0" y2="1">
                        <stop offset="0" stop-color="#6366f1" />
                        <stop offset="1" stop-color="#9333ea" />
                    </linearGradient>
                </defs>
                <rect width="64" height="64" rx="12" fill="url(#g1)" />
                <g transform="translate(6,8)" fill="#fff">
                    <path d="M2 2 H10 V26 H16 V32 H10 V44 H2 V32 H-4 V26 H2z" />
                    <path
                        d="M22 2 H34 C38 2 42 6 42 10 C42 14 38 18 34 18 H28 V26 H22z M28 10 H34 C36 10 38 8 38 6 C38 4 36 2 34 2 H28z" />
                    <path d="M46 44 V2 L54 22 L62 2 V44 H54 V18 L46 30 V44z" />
                </g>
            </svg>
            <h1 class="text-2xl font-extrabold tracking-tight">HRM</h1>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 p-6 space-y-2">
            <a href="add_admin.php"
                class="block px-4 py-3 rounded-lg hover:bg-white/10 transition font-medium">➕ Add Admin</a>
            <a href="view_admins.php"
                class="block px-4 py-3 rounded-lg hover:bg-white/10 transition font-medium">👥 View Admins</a>
            <a href="feedback.php"
                class="block px-4 py-3 rounded-lg hover:bg-white/10 transition font-medium">📝 All Feedback</a>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-white/20">
            <a href="logout.php"
                class="w-full block text-center px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 rounded-lg font-bold hover:scale-[1.03] transition">
                Logout
            </a>
        </div>
    </aside>

    <!-- Overlay for mobile -->
    <div id="overlay" onclick="toggleSidebar()"
        class="fixed inset-0 bg-black/50 hidden md:hidden z-40"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen">

        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex items-center justify-between sticky top-0 z-30">
            <h1 class="text-2xl font-extrabold text-gray-800">Dashboard</h1>

            <!-- Mobile Menu Button -->
            <button onclick="toggleSidebar()" class="md:hidden px-4 py-2 bg-indigo-600 text-white rounded-lg">☰</button>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Welcome,
                <?php echo htmlspecialchars($_SESSION['email']); ?> 👋</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Add Admin</h2>
                    <p class="text-gray-600">Create new admin accounts securely.</p>
                    <a href="add_admin.php"
                        class="mt-4 inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Add</a>
                </div>

                <!-- Card 2 -->
                <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Admins</h2>
                    <p class="text-gray-600">Manage admin accounts and permissions.</p>
                    <a href="view_admins.php"
                        class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">View</a>
                </div>

                <!-- Card 3 -->
                <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Feedback</h2>
                    <p class="text-gray-600">Review all user feedback submissions.</p>
                    <a href="feedback.php"
                        class="mt-4 inline-block px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700">See Feedback</a>
                </div>
            </div>
        </main>
    </div>

    <!-- JS for Sidebar -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }
    </script>
</body>

</html>