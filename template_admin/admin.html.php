<!-- admin.html.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="../style.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 text-white min-h-screen">
    
    <!-- Main Content -->
    <h1 class="text-3xl font-semibold text-gray-900">Dashboard</h1>
    <p class="text-gray-600">Manage your platform settings and users from this area.</p>
    <div class="container mx-auto bg-white text-gray-900 rounded-xl shadow-xl p-10 max-w-lg w-full transform hover:scale-105 transition-transform duration-500 ease-in-out mt-10">
        <div class="text-center mb-6">
            <!-- Add Icon -->
            <div class="flex justify-center mb-4">
                <div class="bg-gradient-to-r from-green-400 to-blue-500 p-3 rounded-full shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h2M12 6v6M8 18v-4a4 4 0 00-8 0v4h10z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h3l3 9h-7l-3-9h3zm0 0L9 3h3l3 9z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Admin Panel</h2>
            <p class="text-xl text-gray-600 mb-2">Welcome to the Admin Panel</p>
            <p class="text-lg text-gray-500">Manage Users, Devices, Services, and Packages Here!</p>
        </div>

        <!-- Buttons for Actions -->
        <div class="flex justify-around mt-8 space-x-4">
            <a href="../admin/user.php" class="bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold py-2 px-4 rounded-full shadow-lg hover:from-green-500 hover:to-blue-600 transition duration-300 text-center">Manage Users</a>
            <a href="../" class="bg-gradient-to-r from-orange-400 to-red-500 text-white font-bold py-2 px-4 rounded-full shadow-lg hover:from-orange-500 hover:to-red-600 transition duration-300 text-center">Manage Devices</a>
            <a href="#" class="bg-gradient-to-r from-purple-400 to-pink-500 text-white font-bold py-2 px-4 rounded-full shadow-lg hover:from-purple-500 hover:to-pink-600 transition duration-300 text-center">Manage Services</a>
            <a href="#" class="bg-gradient-to-r from-teal-400 to-cyan-500 text-white font-bold py-2 px-4 rounded-full shadow-lg hover:from-teal-500 hover:to-cyan-600 transition duration-300 text-center">Manage Packages</a>
        </div>
    </div>

</body>

</html>
