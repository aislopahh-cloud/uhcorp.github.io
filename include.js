const includes = document.querySelectorAll('[data-include]');
let loaded = 0;

includes.forEach(el => {
    const file = el.getAttribute('data-include');
    fetch(file)
        .then(r => r.text())
        .then(html => {
            el.outerHTML = html;
            loaded++;
            if (loaded === includes.length) {
                document.dispatchEvent(new Event('includes-loaded'));
            }
        });
});
