<?php
session_start();
include "database.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM admin ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Admins — HRM</title>
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
            <a href="view_admins.php" class="block px-4 py-3 rounded-lg bg-white/10 font-bold">👥 View Admins</a>
            <a href="feedback.php" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition font-medium">📝 All Feedback</a>
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

    <!-- Main -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex items-center justify-between sticky top-0 z-30">
            <h1 class="text-2xl font-extrabold text-gray-800">View Admins</h1>
            <button onclick="toggleSidebar()" class="md:hidden px-4 py-2 bg-indigo-600 text-white rounded-lg">☰</button>
        </header>

        <!-- Main Content -->
        <main class="flex-1 sm:p-6 p-4">

            <!-- Desktop Table -->
            <div class="hidden md:block bg-white rounded-2xl shadow-lg p-6 overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-600 text-white text-left">
                            <th class="p-3">ID</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Password</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-700"><?php echo htmlspecialchars($row['id']); ?></td>
                                <td class="p-3 text-gray-800"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="p-3 text-gray-800"><?php echo htmlspecialchars($row['password']); ?></td>
                                <td class="p-3 space-x-2">
                                    <a href="add_admin.php?id=<?php echo $row['id']; ?>"
                                        class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">✏️ Edit</a>
                                    <a href="delete_admin.php?id=<?php echo $row['id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this admin?');"
                                        class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">🗑️ Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card Layout -->
            <div class="grid grid-cols-1 gap-4 md:hidden">
                <?php
                mysqli_data_seek($result, 0); // reset pointer for second loop
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200">
                        <p class="text-sm text-gray-500">ID: <?php echo htmlspecialchars($row['id']); ?></p>
                        <h2 class="text-lg font-bold text-gray-800"><?php echo htmlspecialchars($row['email']); ?></h2>
                        <h2 class="text-md font-semibold text-gray-800"><?php echo htmlspecialchars($row['password']); ?></h2>
                        <div class="mt-3 flex space-x-2">
                            <a href="add_admin.php?id=<?php echo $row['id']; ?>"
                                class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">✏️ Edit</a>
                            <a href="delete_admin.php?id=<?php echo $row['id']; ?>"
                                onclick="return confirm('Are you sure you want to delete this admin?');"
                                class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">🗑️ Delete</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>
    </div>

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