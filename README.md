# TheyCallMeGordon — قالب پایه وردپرس

این یک قالب پایه است که از CDNهای زیر استفاده می‌کند: Tailwind (Play CDN)، Swiper، GSAP و Barba.js. قالب با Elementor و WooCommerce سازگار است (پشتیبانی پایه ثبت شده).

نصب و استفاده
- پوشه `theyCallmeGordon` را در مسیر `wp-content/themes/` قرار دهید.
- از پنل وردپرس قالب را فعال کنید.

پشتیبانی CDN
- Tailwind: `https://cdn.tailwindcss.com` (Play CDN — مناسب برای توسعه سریع)
- Swiper: `https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js`
- GSAP: `https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js`
- Barba: `https://unpkg.com/@barba/core/dist/barba.umd.js`

نکات توسعه
- این قالب از Tailwind via CDN استفاده می‌کند تا نیاز به تنظیمات build اولیه نداشته باشید. اگر می‌خواهید از Tailwind با `npm` و مشتق‌سازی (purge) استفاده کنید، می‌توانم فایل‌های `package.json` و `tailwind.config.js` را اضافه کنم.
- فایل راه‌انداز JS در `assets/js/app.js` قرار دارد؛ در آن Swiper و Barba با انیمیشن‌های ساده GSAP مقداردهی اولیه می‌شوند.

موارد بعدی (دلخواه)
- افزودن الگوهای اختصاصی Elementor (widget/sections) یا template kit
- استایل‌های پایه Tailwind یا فایل‌های SASS/پیکربندی build
# theyCallmeGordon