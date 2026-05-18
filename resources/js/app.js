document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('[data-menu-button]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');

    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', () => {
            const expanded = menuButton.getAttribute('aria-expanded') === 'true';
            menuButton.setAttribute('aria-expanded', String(!expanded));
            mobileMenu.classList.toggle('hidden');
            menuButton.innerHTML = expanded ? '<span class="text-lg">+</span>' : '<span class="text-lg">x</span>';
        });
    }

    const revealElements = document.querySelectorAll('[data-reveal]');

    if (!('IntersectionObserver' in window)) {
        revealElements.forEach((item) => item.classList.add('in-view'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.2,
        }
    );

    revealElements.forEach((item, index) => {
        item.classList.add('reveal');
        item.style.transitionDelay = `${Math.min(index * 50, 250)}ms`;
        observer.observe(item);
    });

    const parallaxItems = document.querySelectorAll('[data-parallax]');
    if (parallaxItems.length > 0) {
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            parallaxItems.forEach((item) => {
                const factor = Number(item.getAttribute('data-parallax')) || 18;
                item.style.transform = `translateY(${scrollY / factor}px)`;
            });
        });
    }

    const heroStage = document.querySelector('.hero-stage');
    if (heroStage) {
        window.addEventListener('mousemove', (event) => {
            const rect = heroStage.getBoundingClientRect();

            if (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom) {
                heroStage.style.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg)';
                return;
            }

            const x = (event.clientX - rect.left) / rect.width;
            const y = (event.clientY - rect.top) / rect.height;
            const rotateY = (x - 0.5) * 9;
            const rotateX = (0.5 - y) * 7;

            heroStage.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        heroStage.addEventListener('mouseleave', () => {
            heroStage.style.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg)';
        });
    }

    const statValues = document.querySelectorAll('[data-stat-value]');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    statValues.forEach((node, index) => {
        const text = (node.textContent || '').trim();
        const parsed = text.match(/^(\d+)(\+?)$/);

        if (!parsed) {
            return;
        }

        const target = Number(parsed[1]);
        const suffix = parsed[2] || '';

        if (reduceMotion) {
            node.textContent = `${target}${suffix}`;
            return;
        }

        node.textContent = `0${suffix}`;

        setTimeout(() => {
            const start = performance.now();
            const duration = 2200;

            const tick = (now) => {
                const progress = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 2);
                const value = Math.round(target * eased);

                node.textContent = `${value}${suffix}`;

                if (progress < 1) {
                    requestAnimationFrame(tick);
                }
            };

            requestAnimationFrame(tick);
        }, index * 120 + 120);
    });

});
