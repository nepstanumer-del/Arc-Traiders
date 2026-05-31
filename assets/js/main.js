 document.addEventListener('DOMContentLoaded', function () {
        const burgerBtn = document.querySelector('.arc-burger-btn');
        const navList = document.querySelector('.arc-nav-list');
        const body = document.body;

        if (burgerBtn && navList) {
            burgerBtn.addEventListener('click', function () {
                // Переключаем классы для анимаций
                burgerBtn.classList.toggle('is-active');
                navList.classList.toggle('is-open');
                body.classList.toggle('no-scroll');
                const isExpanded = burgerBtn.getAttribute('aria-expanded') === 'true';
                burgerBtn.setAttribute('aria-expanded', !isExpanded);
            });
        }
    });