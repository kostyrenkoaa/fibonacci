# fibonacci

## Для установки выполните следующие действия
- Склонируйте директорию
- Запустите сборку `docker-compose build`
- Поднимите контейнеры `docker-compose up -d`
- Зайдите в контейнер приложения `docker exec -it fibonacci_laravel.test bash` и установить зависимости `composer install`
- При необходимости сменить адрес запросов `services/Service.php` в константе `URL` //todo вынести в конфиг и в гитигнор