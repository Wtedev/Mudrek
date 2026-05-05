import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/** شريط الشركاء: تمرير لا نهائي فقط عند ظهور القسم في نافذة العرض */
function initPartnersMarqueeVisibility() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    document.querySelectorAll('.medrek-partners-viewport').forEach((viewport) => {
        const track = viewport.querySelector('.medrek-partners-track');
        if (!track) {
            return;
        }

        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    track.classList.remove('medrek-partners-track--paused');
                } else {
                    track.classList.add('medrek-partners-track--paused');
                }
            },
            { root: null, rootMargin: '0px', threshold: 0 },
        );

        observer.observe(viewport);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPartnersMarqueeVisibility);
} else {
    initPartnersMarqueeVisibility();
}
