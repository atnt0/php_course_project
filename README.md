## **Курсовой проект по MVC**

### C использованием MVC-фреймворка Laravel 8.x на PHP.

#### Техническое Задание.

Создать интернет-магазин продукции







==============================================================

##### **План базы данных:**

===================== 
Авторизация:

**users**: id, name, block, email, email_verified_at, password, remember_token, created_at, updated_at, blocked_at

**user_role**: id, user_id, role_id, created_at, updated_at

**user_roles**: id, title, created_at, updated_at

**password_resets**: email, token, created_at
=====================


===================== 
Основные таблицы

// продукты/товары
**products**: id, article_number, price, tax, quantity, status_id, category_id, user_own_id, uuid, title, description, created_at, updated_at

// один ко многим - статус продукта - 
**product_statuses**: id, title, created_at, updated_at



// один продукт к одной категории - категории
**product_categories**: id, parent_category_id, title, description, created_at, updated_at



// тэги
**product_tags**: id, title, created_at, updated_at
// многие ко многим - тэги
**product_tag**: id, product_id, tag_id


// заказы/подтвержденные корзины
**orders**: id, user_id(can be null), status_id, comment, address, email, phone, created_at, updated_at

// один ко многим - статус заказа
**order_statuses**: id, title, created_at, updated_at

// многие ко многим - продукты/товары
**order_product**: id, product_id, order_id, quantity

=====================







===================== 
Идей на будущее

// многие ко многим - варианты количества 
**product_quantities**: id, product_id, title

**product_quantity**: id, product_id, product_quantity_id

// многие к одному - жалобы
~~_**product_complaints**: id, user_id, instruction_id, instruction_сomplaint_status_id, description, created_at, updated_at~~_~~
// состояние одобрение жалоб администрацией
~~_**product_complaint_statuses**: id, title, created_at, updated_at_~~

// Product Attributes

=====================
