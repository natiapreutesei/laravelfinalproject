import './bootstrap';
import 'preline';

document.addEventListener('livewire:navigated', () => {
    try {
        const result = window.HSStaticMethods.autoInit();
        if (result instanceof Promise) {
            result
                .catch(error => console.error('Error during autoInit:', error));
        } else {
        }
    } catch (error) {
        console.error('Error during autoInit:', error);
    }
});

/*// IMPORT SWIPER
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, Keyboard } from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';
import 'swiper/css/keyboard';

document.addEventListener("DOMContentLoaded", function () {
    const progressCircle = document.querySelector(".autoplay-progress circle");
    const progressContent = document.querySelector(".autoplay-progress span");

    // Init Swiper:
    const swiperElement = document.querySelector('#swiper1');
    if (swiperElement) {
        var swiper = new Swiper(swiperElement, {
            loop: true,
            centeredSlides: true,
            modules: [Navigation, Pagination, Autoplay, Keyboard],
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            autoplay: {
                delay: 10000,
                disableOnInteraction: false
            },
            on: {
                autoplayTimeLeft(s, time, progress) {
                    if (progressCircle) {
                        progressCircle.style.setProperty("--progress", 1 - progress);
                    }
                    if (progressContent) {
                        progressContent.textContent = `${Math.ceil(time / 1000)}s`;
                    }
                }
            },
            keyboard: {
                enabled: true,
                onlyInViewport: false,
            },
        });
    } else {
        console.error("Swiper element not found");
    }

    // Initialize carousel
    var carousel = new bootstrap.Carousel(document.getElementById('carouselExample'), {
        interval: 5000 // Set the desired interval (in milliseconds)
    });

    // Slider
    const range = document.getElementById('range');
    const handle1 = document.getElementById('handle1');
    const handle2 = document.getElementById('handle2');

    const min = 0;
    const max = 100;

    handle1.style.left = `${min}%`;
    handle2.style.left = `${max}%`;

    handle1.addEventListener('mousedown', (e) => {
        let startX = e.clientX;

        const handleMouseMove = (e) => {
            const offsetX = e.clientX - startX;
            const newPosition = Math.min(max, Math.max(min, handle1.offsetLeft + offsetX));
            handle1.style.left = `${newPosition}px`;
            range.style.left = `${newPosition}px`;
            startX = e.clientX;
        };

        const handleMouseUp = () => {
            document.removeEventListener('mousemove', handleMouseMove);
            document.removeEventListener('mouseup', handleMouseUp);
        };

        document.addEventListener('mousemove', handleMouseMove);
        document.addEventListener('mouseup', handleMouseUp);
    });

    handle2.addEventListener('mousedown', (e) => {
        let startX = e.clientX;

        const handleMouseMove = (e) => {
            const offsetX = e.clientX - startX;
            const newPosition = Math.min(max, Math.max(min, handle2.offsetLeft + offsetX));
            handle2.style.left = `${newPosition}px`;
            range.style.right = `${100 - newPosition}%`;
            startX = e.clientX;
        };

        const handleMouseUp = () => {
            document.removeEventListener('mousemove', handleMouseMove);
            document.removeEventListener('mouseup', handleMouseUp);
        };

        document.addEventListener('mousemove', handleMouseMove);
        document.addEventListener('mouseup', handleMouseUp);
    });
});*/
