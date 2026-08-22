(function () {
    'use strict';

    var root = document.documentElement;
    var button = document.querySelector('.theme-toggle');
    if (!button) return;

    var labels = {
        ru: { dark: 'Включить тёмную тему', light: 'Включить светлую тему' },
        et: { dark: 'Lülita tume teema sisse', light: 'Lülita hele teema sisse' },
        en: { dark: 'Switch to dark theme', light: 'Switch to light theme' }
    };

    function currentTheme() {
        return root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
    }

    function updateButton() {
        var language = (root.getAttribute('lang') || 'en').toLowerCase();
        var copy = labels[language] || labels.en;
        var nextTheme = currentTheme() === 'dark' ? 'light' : 'dark';
        button.setAttribute('aria-label', copy[nextTheme]);
        button.setAttribute('title', copy[nextTheme]);
        button.setAttribute('aria-pressed', currentTheme() === 'dark' ? 'true' : 'false');
    }

    button.addEventListener('click', function () {
        var theme = currentTheme() === 'dark' ? 'light' : 'dark';
        root.setAttribute('data-theme', theme);
        try { localStorage.setItem('site-theme', theme); } catch (e) {}
        updateButton();
    });

    updateButton();
}());
