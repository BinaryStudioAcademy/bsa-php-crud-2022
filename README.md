# Binary Studio Academy 2022
## Домашнее задание ([ua](README_UA.md))

### 1. Установка:
```bash
git clone https://github.com/BinaryStudioAcademy/bsa-php-crud-2022.git
cd bsa-php-crud-2022
cp .env.example .env
composer install
docker-compose up -d
```
При развертывании без docker:
 - переменная DB_HOST=127.0.0.1 (в .env)
 - php >= 7.4
 - создайте БД MySQL (MariaDB) в соответствии с конфинурацией .env

### 2. Запустите миграции и заполните БД начальными данными:
```bash
php artisan migrate --seed
```
### 3. Добавьте следующие models и relations:
    - Order `[id, date, orderItems, buyer]`
    - OrderItem `[id, order, product, quantity, price, discount (%), sum (price x discount x quantity)]`
    - Buyer `[id, name, surname, country, city, addressLine, phone, orders]`
    
    relations:
    - Order -> OrderItem(many), 
    - Buyer -> Orders(many)
    
    *все цены должны быть сохранены в копейках - 5 грн => 500 в базе данных*

### 4. Создайте factories для моделей **Order, OrderDetail, Buyer**, используя Faker

### 5. Создайте seeders для создания Order c OrderItems и Buyer, используя factories и уже существующие в БД Products

### 6. Добавьте CRUD endpoints (API routes and controller actions) для модели Order

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

### 7. Для поиска Order по ID и возврата коллекции Order создайте resource presenters (см. Laravel: Eloquent API Resource) и их коллекции: 
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

### Прием решений

Необходимо склонировать этот репозиторий и разместить свое решение на Bitbucket.

__Форкать репозиторий категорически запрещено!__

Выполненное задание будет оценивается по следующим критериям:

1) Выполнены пункты 3-6: 2 балла

2) Все эндпоинты работают в соответствии с ожидаемой логикой и п. 6 и 7: 5 баллов 

3) Использование strict_types и type hinting для аргументов и возвращаемых значений: 1 балл

4) Валидация данных: 1 балл

4) Код написан чисто и аккуратно в соответствии со стандартом [PSR-2](https://www.php-fig.org/psr/psr-2/) и [PSR-12](https://www.php-fig.org/psr/psr-12/), без закоментированых отладочных блоков и функций в коде: 1 балл
