document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.carousel');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    let index = 0;

    nextButton.addEventListener('click', () => {
        if (index < carousel.children.length - 1) {
            index++;
        } else {
            index = 0;
        }
        updateCarousel();
    });

    prevButton.addEventListener('click', () => {
        if (index > 0) {
            index--;
        } else {
            index = carousel.children.length - 1;
        }
        updateCarousel();
    });

    function updateCarousel() {
        carousel.style.transform = `translateX(-${index * 100}%)`;
    }
});
