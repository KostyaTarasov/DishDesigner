# Конструктор блюд в виде консольного приложения

## Входные и выходные данные приложения:

- Вход: коды ингредиентов, которые должны входить в полученное блюдо. Один ингредиент может быть указан несколько раз. Пример: строка «dcciii» означает блюдо, состоящее из одного теста, двух видов сыра и трёх видов начинки.
- Вывод: JSON-массив содержащий все комбинации ингредиентов, соответствующих заданному шаблону. При этом один ингредиент не может встречаться в блюде дважды.

## Таблицы:
- В таблице ingredient_type содержатся id, типы возможных ингредиентов, каждому типу соответствует уникальный 1-буквенный код
- В таблице ingredient хранятся id, type_id, конкретные ингредиенты с ценой

## Основные технологии:

1. Composer
2. JSON
3. Autoloading
4. Exceptions

## Версии

- PHP: 8.0.13.
- MySQL: 5.7.36
- PhpMyAdmin: 5.1.1
- Apache: 2.4.51
- WampServer: 3.2.6

## Установка и запуск

1. Клонируйте репозиторий:

   ```
   git clone https://github.com/KostyaTarasov/DishDesigner.git
   ```

2. Установите пакеты:

   ```
   composer install
   ```

3. Настройте окружение и базу данных. Подключение к БД в файле src/settings.php
 - 'host' => 'localhost:3306',
 - 'dbname' => 'dish-designer',
 - 'user' => 'root',
 - 'password' => '',

4. Команда для кода "dcii" в терминале:

   ```
   php bin/cli.php DishDesigner dcii
   ```