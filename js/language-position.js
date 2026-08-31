(function () {
    'use strict';

    var storageKey = 'pirita-language-position';

    function currentSection(y) {
        var elements = document.querySelectorAll('[id]');
        var selected = null;

        for (var index = 0; index < elements.length; index += 1) {
            var element = elements[index];
            var top = element.getBoundingClientRect().top + y;

            if (top <= y + 1 && (!selected || top > selected.top)) {
                selected = {
                    id: element.id,
                    top: top
                };
            }
        }

        return selected;
    }

    function savePosition(link) {
        var y = window.pageYOffset || 0;
        var section = currentSection(y);

        try {
            window.sessionStorage.setItem(storageKey, JSON.stringify({
                x: window.pageXOffset || 0,
                y: y,
                sectionId: section ? section.id : '',
                sectionOffset: section ? y - section.top : 0,
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
        var targetY;
        var section;

        if (!saved) {
            document.documentElement.classList.remove('language-transition-cover');
            return;
        }

        targetY = saved.y || 0;
        section = saved.sectionId ? document.getElementById(saved.sectionId) : null;

        if (section) {
            targetY = section.getBoundingClientRect().top + window.pageYOffset + (saved.sectionOffset || 0);
        }

        window.scrollTo(saved.x || 0, targetY);
        window.requestAnimationFrame(function () {
            window.requestAnimationFrame(function () {
                window.scrollTo(saved.x || 0, targetY);
                window.sessionStorage.removeItem(storageKey);
                document.documentElement.classList.add('language-transition-reveal');
                window.setTimeout(function () {
                    document.documentElement.classList.remove('language-transition-cover', 'language-transition-reveal');
                }, 140);
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
        document.documentElement.classList.add('language-transition-cover');

        window.requestAnimationFrame(function () {
            window.location.href = link.href;
        });
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', restorePosition, { once: true });
    } else {
        restorePosition();
    }
}());
