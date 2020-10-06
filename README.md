Инструкция по установке:

    Скопировать файл ".env.example" в корне проекта и сохранить копию с именем ".env" в той же папке.
    Вписать настройки своей MySQL базы в файле .env (Имя базы, логин и пароль соответственно): DB_DATABASE= DB_USERNAME= DB_PASSWORD= Далее вводить команды в терминал из корня проекта по очереди:
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    php artisan serve
    Зайти на появившийся адрес (стандартно http://127.0.0.1:8000)

