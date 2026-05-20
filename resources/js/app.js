function initHeroReel() {
    const reel = document.querySelector('[data-hero-reel]');

    if (!reel) {
        return () => {};
    }

    const slides = Array.from(reel.querySelectorAll('[data-hero-slide]'));
    const dots = Array.from(reel.querySelectorAll('[data-hero-dot]'));

    if (slides.length === 0) {
        return () => {};
    }

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let activeIndex = Math.max(
        slides.findIndex((slide) => slide.classList.contains('is-active')),
        0
    );
    let timerId = 0;

    const setActive = (index) => {
        activeIndex = (index + slides.length) % slides.length;

        slides.forEach((slide, slideIndex) => {
            slide.classList.toggle('is-active', slideIndex === activeIndex);
        });

        dots.forEach((dot, dotIndex) => {
            dot.classList.toggle('is-active', dotIndex === activeIndex);
        });
    };

    const stopAutoPlay = () => {
        if (timerId) {
            window.clearInterval(timerId);
            timerId = 0;
        }
    };

    const startAutoPlay = () => {
        if (reduceMotion || slides.length <= 1) {
            return;
        }

        stopAutoPlay();
        timerId = window.setInterval(() => {
            setActive(activeIndex + 1);
        }, 5400);
    };

    const onVisibilityChange = () => {
        if (document.hidden) {
            stopAutoPlay();
        } else {
            startAutoPlay();
        }
    };

    const dotHandlers = dots.map((dot, index) => {
        const handler = () => {
            setActive(index);
            startAutoPlay();
        };

        dot.addEventListener('click', handler);
        return { dot, handler };
    });

    reel.addEventListener('mouseenter', stopAutoPlay);
    reel.addEventListener('mouseleave', startAutoPlay);
    document.addEventListener('visibilitychange', onVisibilityChange);

    setActive(activeIndex);
    startAutoPlay();

    return () => {
        stopAutoPlay();
        reel.removeEventListener('mouseenter', stopAutoPlay);
        reel.removeEventListener('mouseleave', startAutoPlay);
        document.removeEventListener('visibilitychange', onVisibilityChange);

        dotHandlers.forEach(({ dot, handler }) => {
            dot.removeEventListener('click', handler);
        });
    };
}

function initHeroSpotlight() {
    const reel = document.querySelector('[data-hero-reel]');

    if (!reel) {
        return () => {};
    }

    if (window.matchMedia('(max-width: 768px)').matches) {
        return () => {};
    }

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduceMotion) {
        return () => {};
    }

    const clamp = (value, min, max) => Math.min(max, Math.max(min, value));

    let frameId = 0;
    let targetX = 50;
    let targetY = 50;
    let currentX = 50;
    let currentY = 50;

    const update = () => {
        currentX += (targetX - currentX) * 0.14;
        currentY += (targetY - currentY) * 0.14;

        reel.style.setProperty('--spot-x', `${currentX}%`);
        reel.style.setProperty('--spot-y', `${currentY}%`);

        frameId = window.requestAnimationFrame(update);
    };

    const onMove = (event) => {
        const bounds = reel.getBoundingClientRect();
        targetX = clamp(((event.clientX - bounds.left) / bounds.width) * 100, 5, 95);
        targetY = clamp(((event.clientY - bounds.top) / bounds.height) * 100, 8, 92);
        reel.classList.add('is-pointer-active');
    };

    const onLeave = () => {
        targetX = 50;
        targetY = 50;
        reel.classList.remove('is-pointer-active');
    };

    reel.addEventListener('pointermove', onMove);
    reel.addEventListener('pointerleave', onLeave);
    frameId = window.requestAnimationFrame(update);

    return () => {
        window.cancelAnimationFrame(frameId);
        reel.removeEventListener('pointermove', onMove);
        reel.removeEventListener('pointerleave', onLeave);
        reel.classList.remove('is-pointer-active');
        reel.style.removeProperty('--spot-x');
        reel.style.removeProperty('--spot-y');
    };
}

function initPageTransitions() {
    const body = document.body;

    if (!body.classList.contains('page-transition-body')) {
        return () => {};
    }

    body.classList.add('is-page-ready');

    if ('startViewTransition' in document) {
        return () => {};
    }

    const isInternalLink = (link) => {
        if (!link.href || link.target === '_blank' || link.hasAttribute('download')) {
            return false;
        }

        if (link.getAttribute('href')?.startsWith('#')) {
            return false;
        }

        try {
            const url = new URL(link.href, window.location.href);
            return url.origin === window.location.origin && url.href !== window.location.href;
        } catch {
            return false;
        }
    };

    const clickHandler = (event) => {
        if (
            event.defaultPrevented ||
            event.button !== 0 ||
            event.metaKey ||
            event.ctrlKey ||
            event.shiftKey ||
            event.altKey
        ) {
            return;
        }

        if (!(event.target instanceof Element)) {
            return;
        }

        const link = event.target.closest('a[href]');
        if (!link || !isInternalLink(link)) {
            return;
        }

        event.preventDefault();
        body.classList.add('is-transitioning');

        window.setTimeout(() => {
            window.location.href = link.href;
        }, 170);
    };

    document.addEventListener('click', clickHandler);

    return () => {
        document.removeEventListener('click', clickHandler);
    };
}

function initContactForm() {
    const form = document.querySelector('[data-contact-form]');

    if (!form) {
        return () => {};
    }

    const submitButton = form.querySelector('[data-contact-submit]');
    const successCard = document.querySelector('[data-contact-success]');
    const successMessage = document.querySelector('[data-contact-success-message]');
    const resetButton = document.querySelector('[data-contact-reset]');
    const defaultLabel = submitButton?.getAttribute('data-default-label') || 'Send Inquiry';

    const fieldErrors = Array.from(form.querySelectorAll('[data-field-error]'));
    const fields = Array.from(form.querySelectorAll('[data-contact-input]'));

    const clearErrors = () => {
        fieldErrors.forEach((node) => {
            node.textContent = '';
        });

        fields.forEach((field) => {
            field.classList.remove('contact-input-error');
            field.removeAttribute('aria-invalid');
        });
    };

    const setFieldError = (fieldName, message) => {
        const input = form.querySelector(`[name="${fieldName}"]`);
        const errorNode = fieldErrors.find((node) => node.getAttribute('data-field-error') === fieldName);

        if (input) {
            input.classList.add('contact-input-error');
            input.setAttribute('aria-invalid', 'true');
        }

        if (errorNode) {
            errorNode.textContent = message;
        }
    };

    const onSubmit = async (event) => {
        event.preventDefault();
        clearErrors();

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = 'Sending...';
        }

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (response.ok) {
                const payload = await response.json();
                const message = payload.message || 'Thanks for reaching out. Our team will contact you shortly.';

                if (successMessage) {
                    successMessage.textContent = message;
                }

                form.reset();
                form.classList.add('contact-form-hidden');

                if (successCard) {
                    successCard.classList.remove('hidden');
                    window.requestAnimationFrame(() => {
                        successCard.classList.add('is-visible');
                    });
                }

                return;
            }

            if (response.status === 422) {
                const payload = await response.json();
                const errors = payload.errors || {};

                Object.entries(errors).forEach(([field, messages]) => {
                    const message = Array.isArray(messages) ? messages[0] : messages;
                    if (typeof message === 'string') {
                        setFieldError(field, message);
                    }
                });

                return;
            }

            window.location.reload();
        } catch {
            window.location.reload();
        } finally {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = defaultLabel;
            }
        }
    };

    const onReset = () => {
        clearErrors();
        form.classList.remove('contact-form-hidden');

        if (successCard) {
            successCard.classList.remove('is-visible');
            window.setTimeout(() => {
                successCard.classList.add('hidden');
            }, 220);
        }

        const firstField = form.querySelector('[name="name"]');
        if (firstField instanceof HTMLElement) {
            firstField.focus();
        }
    };

    form.addEventListener('submit', onSubmit);
    resetButton?.addEventListener('click', onReset);

    return () => {
        form.removeEventListener('submit', onSubmit);
        resetButton?.removeEventListener('click', onReset);
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const cleanupPageTransitions = initPageTransitions();
    const loader = document.querySelector('[data-site-loader]');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (loader) {
        document.body.classList.add('is-loading');

        const revealLoader = window.setTimeout(() => {
            loader.classList.add('is-exiting');
            document.body.classList.remove('is-loading');

            window.setTimeout(() => {
                loader.classList.add('is-hidden');
            }, 760);
        }, prefersReducedMotion ? 350 : 1650);

        window.addEventListener('pagehide', () => {
            window.clearTimeout(revealLoader);
        });
    }

    const cleanupHeroReel = initHeroReel();
    const cleanupHeroSpotlight = initHeroSpotlight();
    const cleanupContactForm = initContactForm();

    window.addEventListener('pagehide', () => {
        cleanupPageTransitions();
        cleanupHeroReel();
        cleanupHeroSpotlight();
        cleanupContactForm();
    });

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

    const statValues = document.querySelectorAll('[data-stat-value]');
    const reduceMotion = prefersReducedMotion;

    if (statValues.length > 0) {
        const statItems = [];

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
            statItems.push({ node, index, target, suffix });
        });

        if (statItems.length > 0) {
            let started = false;
            let hasScrolled = window.scrollY > 8;
            let sectionInView = false;

            const startStats = () => {
                if (started || !hasScrolled || !sectionInView) {
                    return;
                }

                started = true;
                window.removeEventListener('scroll', onFirstScroll);

                statItems.forEach(({ node, index, target, suffix }) => {
                    window.setTimeout(() => {
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
            };

            const onFirstScroll = () => {
                hasScrolled = true;
                startStats();
            };

            window.addEventListener('scroll', onFirstScroll, { passive: true });

            const statSection = statValues[0].closest('section');
            if (statSection && 'IntersectionObserver' in window) {
                const statObserver = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                sectionInView = true;
                                startStats();
                                if (started) {
                                    statObserver.disconnect();
                                }
                            }
                        });
                    },
                    { threshold: 0.35 }
                );

                statObserver.observe(statSection);
            } else {
                sectionInView = true;
                startStats();
            }
        }
    }

});
