// Sidebar JavaScript

changeLanguageClient = function(lang) {
    localStorage.setItem('selectedLang', lang);

    // Update radio button states
    document.getElementById('language_en').checked = (lang === 'en');
    document.getElementById('language_es').checked = (lang === 'es');

    // Update active class on labels
    document.querySelector('label[for="language_en"]').classList.toggle('active', lang === 'en');
    document.querySelector('label[for="language_es"]').classList.toggle('active', lang === 'es');

    // Google Translate functionality
    setTimeout(function() {
        var googleCombo = document.querySelector(".goog-te-combo");
        if (googleCombo) {
            googleCombo.value = lang;
            googleCombo.dispatchEvent(new Event("change"));
        }
    }, 1000);
}

window.addEventListener('DOMContentLoaded', function() {
    let savedLang = localStorage.getItem('selectedLang') || 'en'; // Default to English
    changeLanguageClient(savedLang);
});