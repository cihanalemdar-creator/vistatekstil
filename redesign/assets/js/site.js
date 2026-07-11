(() => {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const header = document.querySelector('[data-site-header]');
    const footer = document.querySelector('[data-site-footer]');
    const backToTop = document.querySelector('[data-back-to-top]');
    const mobileNav = document.querySelector('[data-mobile-nav]');

    const initStickyHeader = () => {
        if (!header) return;
        let scheduled = false;
        const update = () => {
            header.classList.toggle('is-scrolled', window.scrollY > 24);
            scheduled = false;
        };
        window.addEventListener('scroll', () => {
            if (scheduled) return;
            scheduled = true;
            window.requestAnimationFrame(update);
        }, { passive: true });
        update();
    };

    const initBackToTop = () => {
        if (!backToTop) return;
        let footerVisible = false;
        const avoidanceZones = new Set();
        const collisionTargets = Array.from(document.querySelectorAll('[data-fixed-control-collision]'));
        const wouldCollide = () => {
            const stack = backToTop.closest('[data-fixed-controls]');
            const stackStyle = stack ? getComputedStyle(stack) : null;
            const buttonStyle = getComputedStyle(backToTop);
            const size = parseFloat(buttonStyle.width) || 48;
            const right = parseFloat(stackStyle?.right) || 14;
            const bottom = parseFloat(stackStyle?.bottom) || 18;
            const controlRect = {
                left: window.innerWidth - right - size,
                right: window.innerWidth - right,
                top: window.innerHeight - bottom - size,
                bottom: window.innerHeight - bottom,
            };
            return collisionTargets.some((element) => {
                const rect = element.getBoundingClientRect();
                return rect.right > controlRect.left && rect.left < controlRect.right
                    && rect.bottom > controlRect.top && rect.top < controlRect.bottom;
            });
        };
        const update = () => {
            backToTop.hidden = window.scrollY < 700 || footerVisible || avoidanceZones.size > 0 || wouldCollide();
        };
        window.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update, { passive: true });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: reducedMotion.matches ? 'auto' : 'smooth' });
        });
        if (footer && 'IntersectionObserver' in window) {
            new IntersectionObserver((entries) => {
                footerVisible = entries.some((entry) => entry.isIntersecting);
                update();
            }, { rootMargin: '0px 0px -8% 0px', threshold: 0.02 }).observe(footer);
        }
        if ('IntersectionObserver' in window) {
            const avoidanceObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) avoidanceZones.add(entry.target);
                    else avoidanceZones.delete(entry.target);
                });
                update();
            }, { rootMargin: `0px 0px ${parseInt(getComputedStyle(backToTop).height, 10) + 28}px 0px`, threshold: 0.01 });
            document.querySelectorAll('[data-fixed-control-avoid]').forEach((element) => avoidanceObserver.observe(element));
        }
        update();
    };

    const initMobileMenu = () => {
        if (!mobileNav) return;
        const summary = mobileNav.querySelector('summary');
        const panel = mobileNav.querySelector('[data-mobile-menu-panel]');
        const main = document.querySelector('main');
        const pageFooter = document.querySelector('footer');
        const fixedControls = document.querySelector('[data-fixed-controls]');
        let closeReturnsFocus = true;

        const focusables = () => Array.from(mobileNav.querySelectorAll('summary, a[href], button:not([disabled])'))
            .filter((element) => element.offsetWidth || element.offsetHeight);

        const setBackgroundInert = (value) => {
            [main, pageFooter, fixedControls].forEach((element) => {
                if (!element) return;
                element.inert = value;
                if (value) element.setAttribute('aria-hidden', 'true');
                else element.removeAttribute('aria-hidden');
            });
        };

        const closeMenu = (returnFocus = true) => {
            closeReturnsFocus = returnFocus;
            mobileNav.open = false;
        };

        mobileNav.addEventListener('toggle', () => {
            const open = mobileNav.open;
            summary.setAttribute('aria-expanded', String(open));
            document.body.classList.toggle('mobile-menu-open', open);
            setBackgroundInert(open);
            if (open) {
                closeReturnsFocus = true;
                window.requestAnimationFrame(() => panel.querySelector('a[href]')?.focus());
            } else if (closeReturnsFocus) {
                summary.focus();
            }
        });

        mobileNav.addEventListener('keydown', (event) => {
            if (!mobileNav.open) return;
            if (event.key === 'Escape') {
                event.preventDefault();
                closeMenu(true);
                return;
            }
            if (event.key !== 'Tab') return;
            const items = focusables();
            if (!items.length) return;
            const first = items[0];
            const last = items[items.length - 1];
            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
        });

        panel.addEventListener('click', (event) => {
            if (event.target.closest('a[href]')) closeMenu(false);
        });

        window.matchMedia('(min-width: 1181px)').addEventListener('change', (event) => {
            if (event.matches && mobileNav.open) closeMenu(false);
        });

        summary.setAttribute('aria-expanded', 'false');
    };

    const initReveal = () => {
        const elements = Array.from(document.querySelectorAll('[data-reveal]'));
        if (!elements.length || reducedMotion.matches || !('IntersectionObserver' in window)) {
            elements.forEach((element) => element.classList.add('is-revealed'));
            return;
        }
        document.documentElement.classList.add('reveal-enabled');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-revealed');
                observer.unobserve(entry.target);
            });
        }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
        elements.forEach((element) => {
            if (element.getBoundingClientRect().top < window.innerHeight * 0.94) {
                element.classList.add('is-revealed');
            } else {
                observer.observe(element);
            }
        });
    };

    const initLightbox = () => {
        const dialog = document.querySelector('[data-lightbox]');
        const gallery = document.querySelector('[data-lightbox-gallery]');
        if (!dialog || !gallery || typeof dialog.showModal !== 'function') return;

        const items = Array.from(gallery.querySelectorAll('[data-lightbox-item]'));
        const image = dialog.querySelector('[data-lightbox-image]');
        const title = dialog.querySelector('[data-lightbox-title]');
        const description = dialog.querySelector('[data-lightbox-description]');
        const count = dialog.querySelector('[data-lightbox-count]');
        const close = dialog.querySelector('[data-lightbox-close]');
        const previous = dialog.querySelector('[data-lightbox-previous]');
        const next = dialog.querySelector('[data-lightbox-next]');
        let currentIndex = 0;
        let returnFocus = null;

        const render = () => {
            const item = items[currentIndex];
            image.src = item.dataset.lightboxSrc;
            image.alt = item.dataset.lightboxDescription || '';
            title.textContent = item.dataset.lightboxTitle || '';
            description.textContent = item.dataset.lightboxDescription || '';
            count.textContent = `${currentIndex + 1} / ${items.length}`;
        };

        const show = (index, trigger) => {
            currentIndex = index;
            returnFocus = trigger;
            render();
            dialog.showModal();
            close.focus();
        };

        const move = (direction) => {
            currentIndex = (currentIndex + direction + items.length) % items.length;
            render();
        };

        items.forEach((item, index) => item.addEventListener('click', (event) => {
            event.preventDefault();
            show(index, item);
        }));
        close.addEventListener('click', () => dialog.close());
        previous.addEventListener('click', () => move(-1));
        next.addEventListener('click', () => move(1));
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) dialog.close();
        });
        dialog.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') move(-1);
            if (event.key === 'ArrowRight') move(1);
            if (event.key !== 'Tab') return;
            const controls = [close, previous, next].filter((control) => !control.disabled);
            if (event.shiftKey && document.activeElement === controls[0]) {
                event.preventDefault();
                controls[controls.length - 1].focus();
            } else if (!event.shiftKey && document.activeElement === controls[controls.length - 1]) {
                event.preventDefault();
                controls[0].focus();
            }
        });
        dialog.addEventListener('close', () => {
            image.removeAttribute('src');
            returnFocus?.focus();
        });
    };

    const initFormDetails = () => {
        const form = document.querySelector('[data-quote-form]');
        if (!form) return;
        form.addEventListener('invalid', (event) => {
            const details = event.target.closest('details');
            if (details) details.open = true;
        }, true);
    };

    initStickyHeader();
    initBackToTop();
    initMobileMenu();
    initReveal();
    initLightbox();
    initFormDetails();
})();
