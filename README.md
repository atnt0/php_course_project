## **Курсовой проект по MVC**

### C использованием MVC-фреймворка Laravel 8.x на PHP.

#### Техническое Задание.

Создать интернет-магазин продукции







==============================================================

##### **План базы данных:**

**products**: id, articul_code, price, tax, quantity, user_own_id, category_id, tag_id, title, description, created_at, updated_at


**product_categories**: id, category_parent_id, title, description, created_at, updated_at

**product_category**: id, product_id, category_id


**product_tags**: id, title, created_at, updated_at

**product_tag**: id, product_id, tag_id


**orders**: id, user_id(can be null), status, created_at, updated_at

**order_product**: id, product_id, order_id, quantity

~~_**product_complaints**: id, user_id, instruction_id, instruction_сomplaint_status_id, description, created_at, updated_at~~_~~

~~_**product_complaint_statuses**: id, title, created_at, updated_at_~~

===================== 
Авторизация:

**users**: id, name, block, email, email_verified_at, password, remember_token, created_at, updated_at, blocked_at

**user_role**: id, user_id, role_id, created_at, updated_at

**user_roles**: id, title, created_at, updated_at

**password_resets**: email, token, created_at
=====================


