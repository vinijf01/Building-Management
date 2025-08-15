import './bootstrap';

import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/swiper-bundle.css';


window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const swiper = new Swiper('.mySwiper', {
        modules: [Navigation, Pagination],
        slidesPerView: 1,
        spaceBetween: 20,
        loop: false, // penting: jangan loop kalau mau hide tombol di ujung
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'swiper-pagination-bullet custom-bullet',
            bulletActiveClass: 'swiper-pagination-bullet-active custom-bullet-active',
        },

        breakpoints: {
            640: { slidesPerView: 2 },  // sm
            1024: { slidesPerView: 3 }, // lg
            1280: { slidesPerView: 4 }, // xl
        }
    });

    // Event untuk sembunyikan tombol
    swiper.on('slideChange', () => {
        if (swiper.isBeginning) {
            document.querySelector('.swiper-button-prev').style.display = 'none';
        } else {
            document.querySelector('.swiper-button-prev').style.display = '';
        }

        if (swiper.isEnd) {
            document.querySelector('.swiper-button-next').style.display = 'none';
        } else {
            document.querySelector('.swiper-button-next').style.display = '';
        }
    });

    if (swiper.isBeginning) {
        document.querySelector('.swiper-button-prev').style.display = 'none';
    }
});
