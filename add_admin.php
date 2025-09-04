<?php
session_start();
include "database.php";

// Only allow if logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Edit Admin
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM admin WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result);
}

// Update Admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE admin SET email='$email', password='$password' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Admin updated successfully'); window.location.href='view_admins.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to update admin');</script>";
    }
}

// Add Admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_GET['id'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO admin (email, password) VALUES ('$email', '$password')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('New admin added successfully'); window.location.href='view_admins.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to add admin');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Admin — HRM</title>
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
            <a href="add_admin.php" class="block px-4 py-3 rounded-lg bg-white/10 transition font-bold">➕ Add Admin</a>
            <a href="view_admins.php" class="block px-4 py-3 rounded-lg hover:bg-white/10 font-medium">👥 View Admins</a>
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

    <!-- Overlay for Mobile -->
    <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 hidden md:hidden z-40"></div>

    <!-- Main -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex items-center justify-between sticky top-0 z-30">
            <h1 class="text-2xl font-xtrabold text-gray-800">Add Admins</h1>
            <button onclick="toggleSidebar()" class="md:hidden px-4 py-2 bg-indigo-600 text-white rounded-lg">☰</button>
        </header>

        <!-- Centered Form -->
        <main class="flex flex-1 items-center justify-center p-6">
            <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">
                    <p class="sm:hidden block">
                        <?php echo isset($_GET['id']) ? 'Update Admin' : 'Add Admin'; ?>
                    </p>
                    <p class="hidden sm:block"><?php echo isset($_GET['id']) ? '✏️ Update Admin' : '➕ Add Admin'; ?></p>
                </h1>

                <form method="POST" class="space-y-6">
                    <!-- Email -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" placeholder="Enter email address" required
                            value="<?php echo isset($admin['email']) ? $admin['email'] : ''; ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 
                     focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none shadow-sm" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Password</label>
                        <input type="password" name="password" placeholder="Enter password" required
                            value="<?php echo isset($admin['password']) ? $admin['password'] : ''; ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 
                     focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none shadow-sm" />
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-3 font-bold text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 
                   rounded-xl shadow-lg hover:scale-[1.02] active:scale-95 transition text-lg">
                        <?php echo isset($_GET['id']) ? 'Update Admin' : 'Add Admin'; ?>
                    </button>
                </form>
            </div>
        </main>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("-translate-x-full");
            document.getElementById("overlay").classList.toggle("hidden");
        }
    </script>
</body>

</html>