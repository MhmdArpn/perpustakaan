const API_BASE = '/perpustakaan-main/BE';
const sidebarLinks = document.querySelectorAll('.sidebar li a');
const sidebarItems = document.querySelectorAll('.sidebar li');
const currentPath = window.location.pathname.split('/').pop();

sidebarItems.forEach(item => item.classList.remove('active'));

sidebarLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (!href) return;

    const resolvedHref = new URL(link.href, window.location.href).pathname;
    const linkPage = resolvedHref.split('/').pop();

    if (linkPage === currentPath) {
        link.closest('li')?.classList.add('active');
    }
});

const rows = document.querySelectorAll('tbody tr');
rows.forEach(row => {
    row.addEventListener('mouseenter', () => {
        row.style.background = '#F8FAFC';
    });
    row.addEventListener('mouseleave', () => {
        row.style.background = 'transparent';
    });
});

document.querySelectorAll('.role-switch button, .role-switch a').forEach(item => {
    item.addEventListener('click', function () {
        const parent = this.closest('.role-switch');
        if (!parent) return;

        parent.querySelectorAll('.active').forEach(el => el.classList.remove('active'));
        this.classList.add('active');
    });
});

const toggle = document.getElementById('togglePassword');
const password = document.getElementById('password');

if (toggle && password) {
    toggle.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        toggle.classList.toggle('fa-eye');
        toggle.classList.toggle('fa-eye-slash');
    });
}

const searchInput = document.querySelector('.search-panel input');
const categoryFilter = document.querySelector('#filterCategory');
const statusFilter = document.querySelector('#filterStatus');
const sortFilter = document.querySelector('#filterSort');
const bookCards = document.querySelectorAll('.books .book-card');
const resultCount = document.querySelector('.result-count');
const resetButton = document.querySelector('.modern-filter .btn-outline.secondary');
const searchButton = document.querySelector('.search-panel .btn-primary');

function applyBookFilters() {
    if (!searchInput && !categoryFilter && !statusFilter && !sortFilter) return;

    const query = (searchInput?.value || '').toLowerCase().trim();
    const category = (categoryFilter?.value || 'all').toLowerCase();
    const status = (statusFilter?.value || 'all').toLowerCase();
    const sort = (sortFilter?.value || 'default');

    const filtered = Array.from(bookCards).filter(card => {
        const title = card.getAttribute('data-title') || '';
        const author = card.getAttribute('data-author') || '';
        const cardCategory = (card.getAttribute('data-category') || '').toLowerCase();
        const cardStatus = (card.getAttribute('data-status') || '').toLowerCase();

        const matchesQuery = !query || title.includes(query) || author.includes(query) || cardCategory.includes(query);
        const matchesCategory = category === 'all' || cardCategory === category;
        const matchesStatus = status === 'all' || cardStatus === status;

        return matchesQuery && matchesCategory && matchesStatus;
    });

    bookCards.forEach(card => card.classList.add('is-hidden'));
    filtered.forEach(card => card.classList.remove('is-hidden'));

    const resultsContainer = document.querySelector('.books');
    const emptyState = document.querySelector('.empty-state');

    if (emptyState) emptyState.remove();

    if (filtered.length === 0) {
        const state = document.createElement('div');
        state.className = 'empty-state';
        state.textContent = 'Tidak ada buku yang cocok dengan filter saat ini.';
        resultsContainer?.appendChild(state);
    }

    if (resultCount) {
        resultCount.textContent = `${filtered.length} buku tampil`;
    }

    if (sort !== 'default') {
        const sorted = [...filtered].sort((a, b) => {
            const titleA = (a.getAttribute('data-title') || '').toLowerCase();
            const titleB = (b.getAttribute('data-title') || '').toLowerCase();
            return sort === 'az' ? titleA.localeCompare(titleB) : titleB.localeCompare(titleA);
        });

        if (resultsContainer) {
            sorted.forEach(card => resultsContainer.appendChild(card));
        }
    }
}

[searchInput, categoryFilter, statusFilter, sortFilter].forEach(el => {
    el?.addEventListener('input', applyBookFilters);
    el?.addEventListener('change', applyBookFilters);
});

if (searchInput) {
    searchInput.addEventListener('keydown', event => {
        if (event.key === 'Enter') {
            event.preventDefault();
            applyBookFilters();
        }
    });
}

if (searchButton) {
    searchButton.addEventListener('click', applyBookFilters);
}

if (resetButton) {
    resetButton.addEventListener('click', () => {
        if (searchInput) searchInput.value = '';
        if (categoryFilter) categoryFilter.value = 'all';
        if (statusFilter) statusFilter.value = 'all';
        if (sortFilter) sortFilter.value = 'default';
        bookCards.forEach(card => card.classList.remove('is-hidden'));
        const emptyState = document.querySelector('.empty-state');
        if (emptyState) emptyState.remove();
        if (resultCount) resultCount.textContent = '24 buku tersedia';
    });
}

/* Dark mode toggle: persist choice in localStorage and apply `.dark` class */
function setDarkMode(enabled) {
    try { localStorage.setItem('darkMode', enabled ? '1' : '0'); } catch (e) {}
    document.documentElement.classList.toggle('dark', !!enabled);
}

document.addEventListener('DOMContentLoaded', () => {
    const saved = localStorage.getItem('darkMode');
    const prefers = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const useDark = saved === null ? prefers : saved === '1';
    setDarkMode(useDark);

    const switchInput = document.querySelector('.switch input');
    if (switchInput) {
        switchInput.checked = !!useDark;
        switchInput.addEventListener('change', () => setDarkMode(switchInput.checked));
    }
});

