<?php session_start();
include "database.php";
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
} // Fetch feedback data
$sql = "SELECT * FROM allfeedback ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin — Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans flex">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed md:relative top-0 left-0 w-64 bg-gradient-to-b from-indigo-900 via-purple-900 to-black text-white min-h-screen flex flex-col shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50">

        <!-- Logo -->
        <a href="admin.php" class="p-6 flex items-center space-x-3 border-b border-white/20">
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
        </a>

        <!-- Nav -->
        <nav class="flex-1 p-6 space-y-2">
            <a href="add_admin.php" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition font-medium">➕ Add Admin</a>
            <a href="view_admins.php" class="block px-4 py-3 rounded-lg hover:bg-white/10 font-medium">👥 View Admins</a>
            <a href="feedback.php" class="block px-4 py-3 rounded-lg bg-white/10 transition font-bold">📝 All Feedback</a>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-white/20">
            <a href="logout.php"
                class="w-full block text-center px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 rounded-lg font-bold hover:scale-[1.03] transition">
                Logout
            </a>
        </div>
    </aside>

    <!-- Overlay -->
    <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 hidden md:hidden z-40"></div>


    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex items-center justify-between sticky top-0 z-30">
            <h1 class="text-2xl font-extrabold text-gray-800">User Feedback</h1>
            <button id="menu-toggle" class="md:hidden px-4 py-2 bg-indigo-600 text-white rounded-lg">☰</button>
        </header>

        <!-- Table (desktop) -->
        <div class="hidden mt-5 m-5 md:block bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="px-4 py-3 border-b">ID</th>
                            <th class="px-4 py-3 border-b">Full Name</th>
                            <th class="px-4 py-3 border-b">Email</th>
                            <th class="px-4 py-3 border-b">Message</th>
                            <th class="px-4 py-3 border-b">Rating</th>
                            <th class="px-4 py-3 border-b">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr class='hover:bg-gray-50 transition'>";
                                echo "<td class='px-4 py-3 border-b'>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td class='px-4 py-3 border-b font-medium'>" . htmlspecialchars($row['fullname']) . "</td>";
                                echo "<td class='px-4 py-3 border-b'>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td class='px-4 py-3 border-b text-gray-600'>" . htmlspecialchars($row['msg']) . "</td>";
                                echo "<td class='px-4 py-3 border-b font-bold text-indigo-600'>" . htmlspecialchars($row['rating']) . "</td>";
                                echo "<td class='px-4 py-3 border-b text-sm text-gray-500'>" . htmlspecialchars($row['date']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='px-4 py-6 text-center text-gray-500'>No feedback found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Cards (mobile) -->
        <div class="grid grid-cols-1 gap-4 mt-5 m-4 md:hidden">
            <?php
            mysqli_data_seek($result, 0); // reset pointer for reuse
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
          <div class='bg-white rounded-xl shadow p-4 border border-gray-200'>
            <p class='text-sm text-gray-500'>ID : " . htmlspecialchars($row['id']) . " — " . htmlspecialchars($row['date']) . "</p>
            <h2 class='text-lg font-bold text-gray-800'>" . htmlspecialchars($row['fullname']) . "</h2>
            <p class='text-sm text-gray-600 mb-2'>" . htmlspecialchars($row['email']) . "</p>
            <p class='text-gray-700 mb-3'>" . htmlspecialchars($row['msg']) . "</p>
            <span class='px-3 py-1 text-sm font-bold bg-indigo-100 text-indigo-700 rounded-lg'>⭐ " . htmlspecialchars($row['rating']) . "</span>
          </div>";
                }
            } else {
                echo "<p class='text-center text-gray-500'>No feedback found</p>";
            }
            ?>
        </div>
        </main>

        <!-- JS for Sidebar Toggle -->
        <script>
            const toggleBtn = document.getElementById("menu-toggle");
            const sidebar = document.getElementById("sidebar");
            toggleBtn.addEventListener("click", () => {
                sidebar.classList.toggle("-translate-x-full");
            });
        </script>
</body>

</html>