// Sélection du footer
const footer = document.getElementById('footer');

// Gestionnaire d'événement de défilement
window.addEventListener('scroll', () => {
    // Vérifier la position de défilement verticale
    if (window.scrollY > 0) {
        // Faire disparaître le footer
        footer.style.display = 'none';
    } else {
        // Afficher le footer
        footer.style.display = 'block';
    }
});

document.addEventListener('DOMContentLoaded', (event) => {
    const themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-theme');
    });
});
