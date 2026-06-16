<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Crud Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }
        
        .sidebar {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-link {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-link:hover {
            transform: translateX(8px);
        }
        
        .active {
            background-color: #f3f4f6;
            border-left: 4px solid #3b82f6;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">
    
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar w-64 bg-white border-r border-gray-200 h-screen fixed flex flex-col shadow-xl">
        
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                    G
                </div>
                <div>
                    <h1 class="font-semibold text-xl tracking-tight text-gray-900">GroqUI</h1>
                    <p class="text-xs text-gray-500 -mt-1">Admin Panel</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 p-4 overflow-y-auto">
            <ul class="space-y-1">
                <li>
                    <a href="#" class="nav-link active flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-2xl">
                        <i class="fa-solid fa-house w-5"></i>
                        <span class="font-medium">Employee Table</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-2xl">
                        <i class="fa-solid fa-chart-bar w-5"></i>
                        <span class="font-medium">Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-2xl">
                        <i class="fa-solid fa-users w-5"></i>
                        <span class="font-medium">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-2xl">
                        <i class="fa-solid fa-folder w-5"></i>
                        <span class="font-medium">Projects</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Footer -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-2xl">
                <div class="w-9 h-9 bg-gradient-to-br from-purple-400 to-pink-400 rounded-2xl flex items-center justify-center text-white font-medium text-sm">
                    JS
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate"></p>
                    <p class="text-xs text-gray-500 truncate">john@example.com</p>
                </div>
                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                   <a href="../form/logout.php"> <i class="fa-solid fa-right-from-bracket"></i> </a>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Main Content (for demo) -->
    <div class="ml-64 p-8">
        <?php
            // include "index.php";
        ?>
    </div>

    <script>
        // Tailwind script already loaded via CDN
        
        function toggleSettings(btn) {
            const menu = document.getElementById('settings-menu');
            const icon = btn.querySelector('i:last-child');
            
            menu.classList.toggle('hidden');
            icon.style.transform = menu.classList.contains('hidden') ? '' : 'rotate(180deg)';
        }
        
        // Keyboard shortcut: Ctrl/Cmd + B to collapse sidebar
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                e.preventDefault();
                const sidebar = document.getElementById('sidebar');
                sidebar.style.transform = sidebar.style.transform === 'translateX(-100%)' 
                    ? 'translateX(0)' 
                    : 'translateX(-100%)';
            }
        });
    </script>
</body>
</html>


<?php
    session_destroy();
?>