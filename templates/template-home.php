<?php
/*
Template Name: Home (Demo)
Description: صفحه نمونه با اسلایدر Swiper برای تست سریع.
*/
get_header();
?>

<main class="container mx-auto px-4 py-12">
    <section class="mb-12">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide bg-gray-100 p-12 rounded">Slide 1 — محتوا</div>
                <div class="swiper-slide bg-gray-200 p-12 rounded">Slide 2 — محتوا</div>
                <div class="swiper-slide bg-gray-300 p-12 rounded">Slide 3 — محتوا</div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-semibold mb-4">عناوین نمونه</h2>
        <p>این یک صفحه نمونه برای تست قالب است. از Barba.js برای جاگذاری صفحات و GSAP برای تحقق انتقال‌ها استفاده کنید.</p>
    </section>
</main>

<?php get_footer(); ?>
