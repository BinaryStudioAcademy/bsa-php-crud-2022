# Binary Studio Academy 2022
## Домашнє завдання ([ua](README_UA.md))

###1. Інсталяція
```bash
git clone https://github.com/BinaryStudioAcademy/bsa-php-crud-2022.git
cd bsa-php-crud-2022
cp .env.example .env
composer install
docker-compose up -d
```
При розгортанні без docker:
 - змінна DB_HOST=127.0.0.1 (в .env)
 - php >= 7.4
 - створіть БД MySQL (MariaDB) відповідно до конфінурації .env

###2. Запустіть міграції і заповніть БД початковими даними:
```bash
php artisan migrate --seed
```
###3. Додайте наступні models и relations:
    - Product `[id, date, orderItems, buyer]`
    - OrderItem `[id, order, product, quantity, price, discount (%), sum (price x discount x quantity)]`
    - Buyer `[id, name, surname, country, city, addressLine, phone, orders]`
    
    relations:
    - Order -> OrderItem(many), 
    - Buyer -> Orders(many)
    
    *все цены должны быть сохранены в копейках - 5 грн => 500 в базе данных*

###4. Створіть factories для моделей **Order, OrderDetail, Buyer**, за допомогою Faker

###5. Створіть seeders для створення Order c OrderItems и Buyer, використовуючи factories та вже існуючі в БД Products

###6. Додайте CRUD endpoints (API routes and controller actions) для моделі Order

- create order:
```
POST: {
    buyerId: id,
    orderItems: [{
        productId: id.
        productQty: quantity,
        productDiscount: %,
    }, { 
        ...
    }]
}
```
- update order:
```
PUT: {
    orderId: id,
    orderItems: [{
        productId: id.
        productQty: quantity,
        productDiscount: %,
    }, { 
        ...
    }]
}
```

###7. Для пошуку Order по ID і повернення колекції Order створіть resource presenters (см. Laravel: Eloquent API Resource) і їх колекції: 
```
{ 
    data: {
        orderId: id,
        orderDate: date,
        orderSum: sum, 
        orderItems: [{
            productName: name,
            productQty: quantity,
            productPrice: price,
            productDiscount: %,
            productSum
        }, { 
            ... 
        }], 
        buyer: {
            buyerFullName: name+surname, 
            buyerAddress: country+city+addressLine,
            buyerPhone: phone
        }
    }
}
```

### Приймання рішення

Необхідно зробити клон цього репозиторія й розмістити своє рішення на Bitbucket.

__Форкати репозиторій категорично заборонено!__

Виконане завдання оцінюватиметься за наступними критеріями::

1) Виконані пункти 3-6: 2 бали

2) Усі єндпоінти працюють згідно очікуваной логіки и п. 6 и 7: 5 балів

3) Використання strict_types и type hinting для аргументів і значень що повертаються: 1 бал

4) Валідація даних: 1 бал

4) Код написано чисто і охайно відповідно до стандарту [PSR-2](https://www.php-fig.org/psr/psr-2/) та [PSR-12](https://www.php-fig.org/psr/psr-12/), без закоментованих блоків коду та функцій відлагодження тощо: 1 бал
