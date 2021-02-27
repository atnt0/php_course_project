## **Курсовой проект по MVC**

### C использованием MVC-фреймворка Laravel 8.x на PHP.

#### Техническое Задание.

#### Статус - В процессе разработки

Создать интернет-магазин продукции







==============================================================

##### **План контроллеров:**

===================== 

~~ProductsController - контроллер для товаров~~
ProductCategoriesController - контроллер для категорий товаров
ProductTagsController - контроллер для тегов продуктов
ProductPhotosController - контроллер для фотографий продукта
OrdersController - контроллер для заказов
UsersController - контроллер для управления пользователями

==============================================================



==============================================================

##### **План Базы Данных:**

=====================

Авторизация:

**users**: id, name, block, email, email_verified_at, password, remember_token, created_at, updated_at, blocked_at

**user_roles**: id, title, created_at, updated_at

**role_user**: id, user_id, role_id, created_at, updated_at

**password_resets**: email, token, created_at

=====================


===================== 

Основные таблицы:

// продукты/товары

**products**: id, article_number, price, tax, quantity, category_id, user_own_id, uuid, title, title_ua, title_ru, description, description_ua, description_ru, created_at, updated_at


// многие к одному продукту - фотографии
**product_photos**: id, product_id, index, file_name, desctiprion, desctiprion_ua, desctiprion_ru, created_at, updated_at


// статусы продукта

**product_statuses**: id, name, title, title_ua, title_ru

// многие ко многим - статус продукта

**status_product**: id, product_id, status_id, created_at, updated_at



// один ко многим продуктам - категории
**product_categories**: id, parent_id, title_ua, title_ru, description, description_ua, description_ru, created_at, updated_at



// тэги

**product_tags**: id, title, title_ua, title_ru, created_at, updated_at


// многие ко многим - тэги

**product_tag**: id, product_id, tag_id, created_at, updated_at



// заказы/подтвержденные корзины

**orders**: id, user_own_id(can be null), status_id, comment, email, phone, address_city, address_zip, address_street, address_house, address_floor, address_apart, address_np_number, guest_ip, guest_useragent, created_at, updated_at


// многие ко многим - продукты/товары

**product_order**: id, order_id, product_id, quantity


// статусы заказа

**order_statuses**: id, name, title, title, title_ua, title_ru

// многие ко многим - статус заказа

**status_order**: id, order_id, status_id, created_at, updated_at


=====================



Идей на будущее:

// в корзину/предзаказ/сообщить о наличии 
(по сути статусы продукта => подписка на оповещение по почте)

// купоны на продукцию или наборы

// варианты количества/цвет/форма/набор/бандл

// атрибуты продукта/товара

// голосовалки/звездочки/рейтинг

// жалобы

// бренд продукта

// задать вопрос по товару

// под-описание

// варианты количества/объема/длинна

// промокоды

// акции

=====================


==============================================================

