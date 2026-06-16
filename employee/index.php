<?php
include '../components/config.php';
include('../components/sidebar.php');
$result = mysqli_query($conn, "SELECT * FROM employee");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        table {
            border-collapse: collapse;
        }
        
        th {
            background-color: #f8fafc;
            font-weight: 600;
            color: #374151;
        }
        
        tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    <div class="max-w-7xl mx-auto p-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900">Employee Management</h1>
                <p class="text-gray-500 mt-1">Manage all employees in your organization</p>
            </div>
            
            <a href="create.php" 
               class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                <i class="fa-solid fa-plus"></i>
                Add New Employee
            </a>
        </div>

        <!-- Stats Cards (Optional but nice) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-3xl p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center">
                        <i class="fa-solid fa-users text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-3xl font-semibold text-gray-900"><?= mysqli_num_rows($result) ?></p>
                        <p class="text-gray-500 text-sm">Total Employees</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="table-container">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-6 py-5 text-left">ID</th>
                            <th class="px-6 py-5 text-left">First Name</th>
                            <th class="px-6 py-5 text-left">Last Name</th>
                            <th class="px-6 py-5 text-left">Email</th>
                            <th class="px-6 py-5 text-left">Role</th>
                            <th class="px-6 py-5 text-left">Job Title</th>
                            <th class="px-6 py-5 text-right">Salary</th>
                            <th class="px-6 py-5 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-5 font-medium text-gray-700"><?= $row['id'] ?></td>
                            <td class="px-6 py-5"><?= $row['name'] ?></td>
                            <td class="px-6 py-5"><?= $row['last_name'] ?></td>
                            <td class="px-6 py-5 text-gray-600"><?= $row['email'] ?></td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                    <?= $row['role'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-5"><?= $row['job_title'] ?></td>
                            <td class="px-6 py-5 text-right font-semibold text-emerald-600">
                                $<?= $row['salary'] ?>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="edit.php?id=<?= $row['id'] ?>" 
                                       class="text-blue-600 hover:text-blue-700 transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-lg"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $row['id'] ?>" 
                                       onclick="return confirm('Are you sure you want to delete this record?')"
                                       class="text-red-500 hover:text-red-700 transition-colors">
                                        <i class="fa-solid fa-trash text-lg"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <?php if(mysqli_num_rows($result) == 0): ?>
            <div class="text-center py-16 text-gray-400">
                <i class="fa-solid fa-users text-5xl mb-4"></i>
                <p>No employees found</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <div class="text-center text-gray-400 text-xs mt-6">
            Total Records: <span class="font-medium text-gray-600"><?= mysqli_num_rows($result) ?></span>
        </div>
    </div>

</body>
</html>