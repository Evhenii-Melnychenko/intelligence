export function initReaderReviewsSlider() {
    const section = document.querySelector('[data-reader-reviews]');

    if (!section) {
        return;
    }

    const track = section.querySelector('[data-reader-reviews-track]');
    const slides = Array.from(section.querySelectorAll('[data-reader-review]'));
    const dots = Array.from(section.querySelectorAll('[data-reader-review-dot]'));

    if (!track || slides.length < 2 || dots.length !== slides.length) {
        return;
    }

    const setActiveDot = (activeIndex) => {
        dots.forEach((dot, index) => {
            dot.setAttribute('aria-current', String(index === activeIndex));
        });
    };

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            const slide = slides[index];
            const targetLeft = slide.getBoundingClientRect().left - track.getBoundingClientRect().left + track.scrollLeft;
            const behavior = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';

            track.scrollTo({ left: targetLeft, behavior });
            setActiveDot(index);
        });
    });

    let scrollFrame = null;

    track.addEventListener('scroll', () => {
        if (scrollFrame !== null) {
            window.cancelAnimationFrame(scrollFrame);
        }

        scrollFrame = window.requestAnimationFrame(() => {
            const trackLeft = track.getBoundingClientRect().left;
            let activeIndex = 0;
            let nearestDistance = Number.POSITIVE_INFINITY;

            slides.forEach((slide, index) => {
                const distance = Math.abs(slide.getBoundingClientRect().left - trackLeft);

                if (distance < nearestDistance) {
                    nearestDistance = distance;
                    activeIndex = index;
                }
            });

            setActiveDot(activeIndex);
            scrollFrame = null;
        });
    }, { passive: true });
}
