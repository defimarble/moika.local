(function () {
    'use strict';

    var storageKey = 'pirita-language-position';

    function savePosition(link) {
        try {
            window.sessionStorage.setItem(storageKey, JSON.stringify({
                x: window.pageXOffset || 0,
                y: window.pageYOffset || 0,
                savedAt: Date.now()
            }));
        } catch (error) {
            return;
        }

        if (window.location.hash) {
            link.href = link.href.split('#')[0] + window.location.hash;
        }
    }

    function readPosition() {
        var saved;

        try {
            saved = JSON.parse(window.sessionStorage.getItem(storageKey) || 'null');
        } catch (error) {
            return null;
        }

        if (!saved || Date.now() - saved.savedAt > 15000) {
            return null;
        }

        return saved;
    }

    function restorePosition() {
        var saved = readPosition();

        if (!saved) {
            document.documentElement.classList.remove('language-position-restoring');
            return;
        }

        window.scrollTo(saved.x || 0, saved.y || 0);
        window.requestAnimationFrame(function () {
            window.requestAnimationFrame(function () {
                window.scrollTo(saved.x || 0, saved.y || 0);
                document.documentElement.classList.remove('language-position-restoring');
                window.sessionStorage.removeItem(storageKey);
                window.setTimeout(function () {
                    document.documentElement.classList.remove('language-transition-ready');
                }, 200);
            });
        });
    }

    document.addEventListener('click', function (event) {
        var link = event.target.closest ? event.target.closest('a[data-language-switch]') : null;

        if (!link || event.defaultPrevented || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) {
            return;
        }

        event.preventDefault();

        if (link.classList.contains('active')) {
            return;
        }

        savePosition(link);
        document.documentElement.classList.add('language-transition-ready', 'language-switch-leaving');

        window.setTimeout(function () {
            window.location.href = link.href;
        }, 160);
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', restorePosition, { once: true });
    } else {
        restorePosition();
    }
}());
