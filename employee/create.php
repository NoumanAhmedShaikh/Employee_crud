<?php
include '../components/config.php';

if(isset($_POST['submit'])) {
    $name      = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email     = $_POST['email'];
    $role      = $_POST['role'];
    $job_title = $_POST['job_title'];
    $salary    = $_POST['salary'];

    $query = "INSERT INTO employee (name, last_name, email, role, job_title, salary) 
              VALUES ('$name', '$last_name', '$email', '$role', '$job_title', '$salary')";

    if(mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="max-w-lg w-full mx-auto p-6">
        
        <!-- Back Button -->
        <a href="index.php" 
           class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 mb-6 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Employees</span>
        </a>

        <div class="bg-white rounded-3xl shadow-sm p-8">
            <h2 class="text-3xl font-semibold text-gray-900 mb-2">Add New Employee</h2>
            <p class="text-gray-500 mb-8">Fill in the details to create a new employee record</p>

            <form method="POST" class="space-y-6">
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" name="name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-blue-500 transition-colors"
                               placeholder="John">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" name="last_name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-blue-500 transition-colors"
                               placeholder="Smith">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-blue-500 transition-colors"
                           placeholder="john.smith@company.com">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select name="role" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-blue-500 transition-colors bg-white">
                            <option value="">Select Role</option>
                            <option value="Coder">Coder</option>
                            <option value="Editor">Editor</option>
                            <option value="Admin">Admin</option>
                            <option value="Team Lead">Team Lead</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                        <input type="text" name="job_title" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-blue-500 transition-colors"
                               placeholder="Software Engineer">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Salary ($)</label>
                    <input type="number" name="salary" required step="0.01"
                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-blue-500 transition-colors"
                           placeholder="75000">
                </div>

                <div class="flex gap-4 pt-6">
                    <button type="submit" name="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-4 rounded-2xl transition-all duration-200 shadow-sm hover:shadow-md">
                        Save Employee
                    </button>
                    <a href="index.php"
                       class="flex-1 text-center border border-gray-300 hover:bg-gray-50 font-medium py-4 rounded-2xl transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>