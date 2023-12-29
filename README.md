<h1 align="center">Cara Installasi</h1>
<ul>
    <li>git clone https://github.com/gugunefendi/nawatech.git</li>
    <li>cd nawatech</li>
    <li>composer install</li>
    <li>Tambahkan ORDER = "public/orders.json" WORKSHOP = "public/workshops.json" di dalam .ENV</li>
    <li>Copy file orders.json dan workshops.json yang ada di dalam folder storage/data kedalam folder storage/public</li>
    <li>php artisan storage:link</li>
    <li>php artisan serve</li>
    <li>buka postman dan masukkan url http://localhost:8000/api/booking</li>
</ul>
