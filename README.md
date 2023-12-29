<h5 align="center">Technical Test at Nawatech</h5>
<ul>
    <li>1. git clone https://github.com/gugunefendi/nawatech.git</li>
    <li>2. cd nawatech</li>
    <li>3. composer install</li>
    <li>4. Tambahkan ORDER = "public/orders.json" WORKSHOP = "public/workshops.json" di dalam .ENV</li>
    <li>5. Copy file orders.json dan workshops.json yang ada di dalam folder storage/data kedalam folder storage/public</li>
    <li>6. php artisan storage:link</li>
    <li>7. php artisan serve</li>
    <li>8. buka postman dan masukkan url http://localhost:8000/api/booking</li>
</ul>
