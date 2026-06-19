function getCookie(name) {
    return document.cookie
        .split('; ')
        .find(row => row.startsWith(name + '='))
        ?.split('=')[1];
}

function applyTheme() {
    const root = document.documentElement;
    const preference = getCookie('appearance') || 'system';

    root.classList.remove('dark');

    if (preference === 'dark') {
        root.classList.add('dark');
        return;
    }

    if (preference === 'light') {
        return;
    }

    // system
    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        root.classList.add('dark');
    }
}

applyTheme();

// live system change
window.matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', applyTheme);

function toggleThemeMenu() {
    document.getElementById('themeMenu').classList.toggle('hidden');
}

function setTheme(value) {
    document.cookie = `appearance=${value}; path=/; max-age=31536000`;

    applyTheme();

    document.getElementById('themeMenu').classList.add('hidden');
}
