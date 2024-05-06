# inline-test-task

## Установка

1. Клонируйте репозиторий: git clone https://github.com/TouristPlay/inline-tester

2. Перейдите в директорию проекта: cd inline-tester

3. Установите значения для переменных среды, создав файл .env

4. Запустить команду docker-compose up -d

5. Подключиться к контейнеру docker exec -it inline_test_app bash

6. Генерируйте ключ приложения: php artisan key:generate

7. Запустите миграции базы данных: php artisan migrate --seed

8. Выполните загрузку и установку данных о постах и комментариях: php artisan app:filling-database

Получить доступ к приложению можно по адресу http://localhost:8000
