
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

// News Modal Functions - Available globally
let currentNewsId = null;

function openNewsModal(newsId = null) {
    currentNewsId = newsId;
    const modal = document.getElementById('modal-news');
    const title = document.getElementById('modal-title');
    const form = document.getElementById('news-form');
    const methodField = document.getElementById('method-field');
    const saveText = document.getElementById('save-text');
    
    if (newsId) {
        // Edit mode
        title.textContent = 'Edit Berita';
        saveText.textContent = 'Update Berita';
        saveText.style.color = 'black';
        methodField.value = 'PUT';
        loadNewsData(newsId);
    } else {
        // Create mode
        title.textContent = 'Tambah Berita Baru';
        saveText.textContent = 'Simpan Berita';
        methodField.value = 'POST';
        form.reset();
        document.getElementById('current-image').classList.add('hidden');
    }
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeNewsModal() {
    const modal = document.getElementById('modal-news');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    currentNewsId = null;
}

function loadNewsData(newsId) {
    const form = document.getElementById('news-form');
    const currentImageWrapper = document.getElementById('current-image');
    const previewImage = document.getElementById('preview-image');
    
    // Clear previous file input and errors
    form.reset();
    clearErrors();
    
    fetch(`/admin/news/${newsId}`)
        .then(response => response.json())
        .then(result => {
            if (!result.success) return;
            const data = result.data;
            document.getElementById('news-id').value = data.id;
            document.getElementById('judul').value = data.judul ?? '';
            document.getElementById('tanggal_terbit').value = data.tanggal_terbit ?? '';
            document.getElementById('kategori').value = data.kategori ?? 'Umum';
            document.getElementById('status').value = data.status ?? 'draft';
            document.getElementById('penulis').value = data.penulis ?? '';
            document.getElementById('tags').value = data.tags ?? '';
            document.getElementById('ringkasan').value = data.ringkasan ?? '';
            document.getElementById('konten').value = data.konten ?? '';
            
            if (data.gambar_url) {
                previewImage.src = data.gambar_url;
                currentImageWrapper.classList.remove('hidden');
            } else {
                currentImageWrapper.classList.add('hidden');
                previewImage.src = '';
            }
        })
        .catch(err => {
            console.error('Failed to load news data', err);
        });
}

function saveNews() {
    const form = document.getElementById('news-form');
    const formData = new FormData(form);
    const saveBtn = document.getElementById('save-btn');
    const saveText = document.getElementById('save-text');
    const saveLoading = document.getElementById('save-loading');
    
    // Show loading state
    saveBtn.disabled = true;
    saveText.classList.add('hidden');
    saveLoading.classList.remove('hidden');
    
    // Clear previous errors
    clearErrors();
    
    const url = currentNewsId ? `/admin/news/${currentNewsId}` : '/admin/news';
    const method = currentNewsId ? 'PUT' : 'POST';
    
    // Add CSRF token to form data for PUT requests
    if (method === 'PUT') {
        formData.append('_method', 'PUT');
    }
    
    fetch(url, {
        method: 'POST', // Always use POST for Laravel form handling
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            closeNewsModal();
            // Reload the page to show updated data
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showErrors(data.errors);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat menyimpan berita', 'error');
    })
    .finally(() => {
        // Reset button state
        saveBtn.disabled = false;
        saveText.classList.remove('hidden');
        saveLoading.classList.add('hidden');
    });
}

function editNews(newsId) {
    openNewsModal(newsId);
}

function deleteNews(newsId) {
    if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
        fetch(`/admin/news/${newsId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => window.location.reload(), 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan saat menghapus berita', 'error');
        });
    }
}

function restoreNews(newsId) {
    if (confirm('Apakah Anda yakin ingin memulihkan berita ini?')) {
        fetch(`/admin/news/${newsId}/restore`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => window.location.reload(), 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan saat memulihkan berita', 'error');
        });
    }
}

function forceDeleteNews(newsId) {
    if (confirm('PERHATIAN: Tindakan ini akan menghapus berita secara permanen dan tidak dapat dibatalkan. Apakah Anda yakin?')) {
        fetch(`/admin/news/${newsId}/force-delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => window.location.reload(), 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan saat menghapus berita', 'error');
        });
    }
}

function clearErrors() {
    const errorElements = document.querySelectorAll('[id$="-error"]');
    errorElements.forEach(element => {
        element.classList.add('hidden');
        element.textContent = '';
    });
}

function showErrors(errors) {
    Object.keys(errors).forEach(field => {
        const errorElement = document.getElementById(`${field}-error`);
        if (errorElement) {
            errorElement.textContent = errors[field][0];
            errorElement.classList.remove('hidden');
        }
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
    
    // Prevent multiple simultaneous loading operations
    if (window.isLoadingContent) {
        console.log('Content loading already in progress, skipping...');
        return;
    }
    
    // Check if we're already on the requested content
    if (isAlreadyOnContent(type)) {
        console.log(`Already on content type: ${type}, skipping...`);
        return;
    }
    
    window.isLoadingContent = true;
    
    // Add timeout to reset loading flag in case something goes wrong
    setTimeout(() => {
        if (window.isLoadingContent) {
            console.log('Content loading timeout, resetting flag...');
            window.isLoadingContent = false;
        }
    }, 10000); // 10 second timeout
    
    // Clean up existing content before loading new content
    cleanupMainContent();
    
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
                    // Execute any inline scripts from the loaded fragment
                    runScriptsFrom(mainContent);
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
            fetch('/admin/management/data-santri/content')
            .then(response => response.text())
            .then(html => {
                mainContent.innerHTML = html;
                initializeMainContentUI();
                history.pushState(
                    {content: 'mgmt-students'},
                    'Data Santri',
                    '/admin/management/data-santri/content'
                );
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
        case 'mgmt-finance-pemasukan':
            fetch('/admin/management/finance/pemasukan')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-finance-pemasukan'}, 'Pemasukan', '/admin/management/finance/pemasukan');
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
        case 'mgmt-finance-pengeluaran':
            fetch('/admin/management/finance/pengeluaran')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-finance-pengeluaran'}, 'Pengeluaran', '/admin/management/finance/pengeluaran');
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
            fetch('/admin/management/admin-accounts/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-account'}, 'Akun Profil', '/admin/management/admin-accounts');
                    window.isLoadingContent = false;
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                    window.isLoadingContent = false;
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
                    history.pushState(
                        {content: 'mgmt-admin-accounts'},
                        'Data Akun Pengurus',
                        '/admin/management/admin-accounts'
                    );
                    window.isLoadingContent = false;
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    mainContent.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700">Error loading content. Please try again.</p>
                        </div>
                    `;
                    window.isLoadingContent = false;
                });
            break;
        
        case 'mgmt-programs':
            fetch('/admin/management/programs/content')
                .then(response => response.text())
                .then(html => {
                    mainContent.innerHTML = html;
                    initializeMainContentUI();
                    history.pushState({content: 'mgmt-programs'}, 'Data Program', '/admin/management/programs/content');
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

// Function to check if we're already on the requested content
function isAlreadyOnContent(type) {
    const mainContent = document.getElementById('main-content');
    if (!mainContent) return false;
    
    // Check for specific content types
    if (type === 'mgmt-admin-accounts' || type === 'mgmt-account') {
        return mainContent.querySelector('#admin-accounts-content') !== null;
    }
    
    // General check for other content types
    const existingContent = mainContent.querySelector('[data-content]');
    return existingContent && existingContent.getAttribute('data-content') === type;
}

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

// Function to clean up main content before loading new content
function cleanupMainContent() {
    const mainContent = document.getElementById('main-content');
    if (mainContent) {
        // Remove any existing content
        mainContent.innerHTML = '';
        
        // Clean up any existing event listeners or references
        if (window.adminAccountsManager) {
            window.adminAccountsManager.cleanup();
            window.adminAccountsManager = null;
        }
    }
}

// Handle browser back/forward buttons
window.addEventListener('popstate', function(event) {
    if (event.state && event.state.content) {
        // Check if we're already on the same content type
        if (isAlreadyOnContent(event.state.content)) {
            console.log('Already on the same content type, skipping...');
            return;
        }
        loadContent(event.state.content);
    }
});

// Load initial content if provided by server (pretty URLs)
document.addEventListener('DOMContentLoaded', function() {
    // Check if content is already loaded
    if (document.querySelector('[data-content]')) {
        console.log('Content already loaded, skipping initial content loading...');
        return;
    }
    
    // Initial content loading is handled in the Blade template
    // The initialContent variable is set by the server and will be handled by the template
});
