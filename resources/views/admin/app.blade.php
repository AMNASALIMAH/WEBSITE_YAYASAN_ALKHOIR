{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/icons/logo.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>YAYASAN AL-KHOIR - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles / Scripts -->
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/46.0.0/ckeditor5.css">

    <!-- Custom CSS to prevent sidebar duplication -->
    <style>
        /* Reset any potential conflicting styles */
        * {
            box-sizing: border-box;
        }
        
        .admin-layout {
            display: flex;
            height: 100vh;
            overflow: hidden;
            position: relative;
            width: 100%;
        }
        
        .sidebar-container {
            flex-shrink: 0;
            position: relative;
            z-index: 10;
            width: 16rem; /* 256px - matches w-64 */
            max-width: 16rem;
            min-width: 16rem;
            overflow: hidden;
        }
        
        .main-content-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            position: relative;
            overflow: hidden;
        }
        
        #admin-sidebar {
            position: sticky;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100%;
            max-width: 100%;
            overflow-y: auto;
        }
        
        /* Ensure no duplicate sidebars */
        .sidebar-container:not(:first-child) {
            display: none !important;
        }
        
        #admin-sidebar:not(:first-of-type) {
            display: none !important;
        }
        
        /* Additional safety measures */
        #sidebar-wrapper {
            position: relative;
            z-index: 20;
        }
        
        #main-wrapper {
            position: relative;
            z-index: 1;
        }
        
        /* Prevent any potential CSS conflicts */
        body > .sidebar-container:not(:first-child) {
            display: none !important;
        }
        
        body > #admin-sidebar:not(:first-of-type) {
            display: none !important;
        }

        /* Animation classes for modals and UI elements */
        .animate-in {
            animation: slideIn 0.3s ease-out;
        }

        .slide-in-from-top-2 {
            animation: slideInFromTop 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Smooth transitions for interactive elements */
        .transition-all {
            transition: all 0.2s ease-in-out;
        }

        .transform {
            transition: transform 0.2s ease-in-out;
        }

        .hover\:scale-105:hover {
            transform: scale(1.05);
        }

        /* Loading spinner animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Toast animations */
        .toast-enter {
            animation: toastSlideIn 0.3s ease-out;
        }

        .toast-exit {
            animation: toastSlideOut 0.3s ease-in;
        }

        @keyframes toastSlideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes toastSlideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        /* Table row hover effects */
        .hover\:bg-gray-50:hover {
            background-color: #f9fafb;
            transition: background-color 0.15s ease-in-out;
        }

        /* Button hover effects */
        .hover\:bg-blue-700:hover {
            background-color: #1d4ed8;
            transition: background-color 0.2s ease-in-out;
        }

        .hover\:bg-red-700:hover {
            background-color: #b91c1c;
            transition: background-color 0.2s ease-in-out;
        }

        /* Focus states for accessibility */
        .focus\:ring-2:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
            transition: box-shadow 0.2s ease-in-out;
        }

        .focus\:ring-blue-500:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }

        /* Responsive design improvements */
        @media (max-width: 640px) {
            .admin-layout {
                flex-direction: column;
            }
            
            .sidebar-container {
                width: 100%;
                max-width: 100%;
                min-width: 100%;
            }
            
            .main-content-container {
                min-height: calc(100vh - 4rem);
            }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <!-- Main container with proper overflow handling -->
    <div class="admin-layout">
        <!-- Sidebar container - ensure single instance -->
        <div class="sidebar-container" id="sidebar-wrapper">
            @include('admin.sidebar')
        </div>
        
        <!-- Main content area -->
        <div class="main-content-container" id="main-wrapper">
            <!-- Navbar (hidden) -->
            <div style="display: none;">
                @include('admin.navigation')
            </div>
            
            <!-- Main content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gradient-to-br from-gray-50 to-white" id="main-content">
                @yield('content')
            </main>
        </div>
    </div>

@stack('scripts')

<script src="{{ asset('js/main_app.js') }}" defer></script>

<script src="{{ asset('js/admin_account.js') }}" defer></script>

<script src="{{ asset('js/santri_account.js') }}" defer></script>



<script>
// Prevent sidebar duplication
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, checking for sidebar duplication...');
    
    // Initial cleanup
    cleanupDuplicateSidebars();
    
    // Load initial content if provided by server (pretty URLs)
    @isset($initialContent)
        loadContent('{{ $initialContent }}');
    @endisset
    
    // Set up observer to watch for DOM changes
    setupSidebarObserver();
});

// Function to clean up duplicate sidebars
function cleanupDuplicateSidebars() {
    // Remove duplicate sidebar containers
    const sidebarContainers = document.querySelectorAll('.sidebar-container');
    if (sidebarContainers.length > 1) {
        console.log('Duplicate sidebar containers detected, removing extras...');
        for (let i = 1; i < sidebarContainers.length; i++) {
            sidebarContainers[i].remove();
        }
    }
    
    // Remove duplicate sidebars
    const sidebars = document.querySelectorAll('#admin-sidebar');
    if (sidebars.length > 1) {
        console.log('Duplicate sidebars detected, removing extras...');
        for (let i = 1; i < sidebars.length; i++) {
            sidebars[i].remove();
        }
    }
    
    // Ensure only one sidebar wrapper exists
    const sidebarWrappers = document.querySelectorAll('#sidebar-wrapper');
    if (sidebarWrappers.length > 1) {
        console.log('Duplicate sidebar wrappers detected, removing extras...');
        for (let i = 1; i < sidebarWrappers.length; i++) {
            sidebarWrappers[i].remove();
        }
    }
}

// Set up observer to watch for DOM changes
function setupSidebarObserver() {
    const observer = new MutationObserver(function(mutations) {
        let shouldCleanup = false;
        
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === Node.ELEMENT_NODE) {
                        if (node.id === 'admin-sidebar' || 
                            node.classList.contains('sidebar-container') ||
                            node.querySelector('#admin-sidebar') ||
                            node.querySelector('.sidebar-container')) {
                            shouldCleanup = true;
                        }
                    }
                });
            }
        });
        
        if (shouldCleanup) {
            console.log('DOM changes detected, cleaning up duplicates...');
            setTimeout(cleanupDuplicateSidebars, 50);
        }
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
}

// Additional check to prevent sidebar duplication during AJAX content loading
function preventSidebarDuplication() {
    cleanupDuplicateSidebars();
}

// Override the loadContent function to prevent sidebar duplication (apply once only)
if (!window.__loadContentWrapperApplied) {
    window.__loadContentWrapperApplied = true;
    var __originalLoadContent = window.loadContent;
    if (typeof __originalLoadContent === 'function') {
        window.loadContent = function(type) {
            console.log('Loading content:', type);
            const result = __originalLoadContent.call(this, type);
            // Check for sidebar duplication after content loads
            setTimeout(cleanupDuplicateSidebars, 100);
            return result;
        };
    }
}
</script>


</body>

</html>
