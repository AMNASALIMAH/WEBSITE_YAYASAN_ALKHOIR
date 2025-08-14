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

    <!-- Styles / Scripts -->
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/46.0.0/ckeditor5.css">



    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="flex h-screen">
        @include('admin.sidebar')
        {{-- Main content area --}}
        <div class="flex-1 flex flex-col">
            {{-- Navbar --}}
            @include('admin.navigation')
        {{-- Halaman konten dinamis --}}
        <main class="flex-1 overflow-y-auto p-6 bg-gradient-to-br from-gray-50 to-white" id="main-content">
                @yield('content')
            </main>
        </div>
    </div>

@stack('scripts')

<script>
// UI helpers available for dynamically injected fragments
function initializeMainContentUI() {
    const container = document.getElementById('main-content');
    if (!container) return;

    // Subtle reveal animation
    container.querySelectorAll('[data-animate]')?.forEach((el) => {
        el.classList.add('opacity-0', 'translate-y-2', 'transition', 'duration-300');
        requestAnimationFrame(() => {
            el.classList.remove('opacity-0', 'translate-y-2');
        });
    });
}

// Ensure <script> tags inside dynamically injected HTML execute
function runScriptsFrom(container) {
    if (!container) return;
    const scripts = container.querySelectorAll('script');
    scripts.forEach((oldScript) => {
        const newScript = document.createElement('script');
        // Copy attributes (e.g., src, type)
        [...oldScript.attributes].forEach((attr) => newScript.setAttribute(attr.name, attr.value));
        // Inline script content
        newScript.text = oldScript.text || oldScript.textContent || '';
        // Replace to trigger execution
        oldScript.parentNode.replaceChild(newScript, oldScript);
    });
}

function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function filterTable(inputId, tbodyId) {
    const query = (document.getElementById(inputId)?.value || '').toLowerCase();
    const tbody = document.getElementById(tbodyId);
    if (!tbody) return;
    [...tbody.querySelectorAll('tr')].forEach((row) => {
        const text = row.textContent?.toLowerCase() || '';
        row.classList.toggle('hidden', !text.includes(query));
    });
}

function showToast(message, theme = 'success') {
    let root = document.getElementById('toast-root');
    if (!root) {
        root = document.createElement('div');
        root.id = 'toast-root';
        root.className = 'fixed bottom-4 right-4 z-50 space-y-2 pointer-events-none';
        document.body.appendChild(root);
    }
    const color = theme === 'error' ? 'bg-red-600' : theme === 'warning' ? 'bg-yellow-600' : 'bg-emerald-600';
    const toast = document.createElement('div');
    toast.className = `${color} text-white px-4 py-3 rounded-lg shadow-lg pointer-events-auto transition transform duration-300 translate-y-2 opacity-0`;
    toast.innerHTML = `<div class="flex items-center gap-2"><span class="text-sm">${message}</span><button class="ml-2/ pointer-events-auto" onclick="this.parentElement.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button></div>`;
    root.appendChild(toast);
    requestAnimationFrame(() => {
        toast.classList.remove('translate-y-2', 'opacity-0');
    });
    setTimeout(() => {
        toast.classList.add('translate-y-2', 'opacity-0');
        setTimeout(() => toast.remove(), 200);
    }, 3000);
}

function loadContent(type) {
    const mainContent = document.getElementById('main-content');
    
    // Show loading state
    mainContent.innerHTML = `
        <div class="flex items-center justify-center h-64">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            <span class="ml-3 text-gray-600">Loading...</span>
        </div>
    `;
    
    // Load content based on type
    switch(type) {
        case 'news':
            fetch('/admin/news/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    // Update browser history without page refresh
                    history.pushState({content: 'news'}, 'News', '/admin/news');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'galery':
            fetch('/admin/galery/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    // Update browser history without page refresh
                    history.pushState({content: 'galery'}, 'Galery', '/admin/galery');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'mgmt-profile':
            fetch('/admin/management/profile/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-profile'}, 'Profil Yayasan', '/admin/management/profile');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'mgmt-teachers':
            fetch('/admin/management/teachers/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    // Execute any inline scripts from the loaded fragment
                    runScriptsFrom(mainContent);
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-teachers'}, 'Data Guru', '/admin/management/teachers');
                    // Initialize page-specific logic when loaded via AJAX
                    if (typeof window.loadTeachers === 'function') {
                        window.loadTeachers();
                    }
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'mgmt-students':
            fetch('/admin/management/students/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-students'}, 'Data Santri', '/admin/management/students');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'mgmt-finance':
            fetch('/admin/management/finance/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-finance'}, 'Data Keuangan', '/admin/management/finance');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'mgmt-account':
            fetch('/admin/management/account/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-account'}, 'Akun Profil', '/admin/management/account');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'mgmt-messages':
            fetch('/admin/management/messages/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-messages'}, 'Pesan Masuk', '/admin/management/messages');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'mgmt-applications':
            fetch('/admin/management/applications/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-applications'}, 'Formulir Masuk', '/admin/management/applications');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'mgmt-admin-accounts':
            fetch('/admin/management/admin-accounts/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-admin-accounts'}, 'Data Akun Pengurus', '/admin/management/admin-accounts');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class=\"bg-red-50 border border-red-200 rounded-lg p-4\">
                            <p class=\"text-red-700\">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        case 'mgmt-programs':
            fetch('/admin/management/programs/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-programs'}, 'Data Program', '/admin/management/programs');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class=\"bg-red-50 border border-red-200 rounded-lg p-4\">
                            <p class=\"text-red-700\">Error loading content. Please try again.</p>
                        </div>
                    `;
                });
            break;
        default:
            mainContent.innerHTML = '<p>Content not found</p>';
    }
}

// Handle browser back/forward buttons
window.addEventListener('popstate', function(event) {
    if (event.state && event.state.content) {
        loadContent(event.state.content);
    }
});

// Load initial content if provided by server (pretty URLs)
document.addEventListener('DOMContentLoaded', function() {
    // Blade will render this block only when $initialContent is set
    @isset($initialContent)
        loadContent('{{ $initialContent }}');
    @endisset
});
</script>
</body>

</html>
