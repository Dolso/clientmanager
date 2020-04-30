Client and manager
=====================
***Версия Laravel - 7.8.1***

### Используемые модули 

Помимо модулей, который laravel устанавливает изначально, были подключены:

* ["laravelcollective/html"](https://github.com/LaravelCollective/docs/blob/master/html.md) - используется для создания форм
* ["laravel/ui"](https://laravel.com/docs/7.x/authentication) - используется для аутентификации и авторизации

### Установка

Для установки вы можете использовать **git**: `git clone https://github.com/Dolso/clientmanager`. Для того
чтобы имя дериктории не повторяла данныю, вы можете написать свой вариант названия после url в команде выше.

Чтобы установить остальные пакеты проекта вам может потребоваться **nodejs** и **composer**.
В папке с проектом вам потребуется написать `composer install` и `npm install`

Для подключения к вашей СУБД вам нужно для начала нужно переименовать файл **.env.example** в **.env** 
 и в нем прописать данные БД. После подключение БД проведите миграцию `php artisan migrate`.  

Также для работы почты вам следует в файл **.env** записать данные вашего почтового ящика.

MAIL_MAILER=smtp  
MAIL_HOST=smtp.yandex.ru  
MAIL_PORT=587  
MAIL_USERNAME=name24@yandex.ru  
MAIL_PASSWORD=********  
MAIL_ENCRYPTION=tls  
MAIL_FROM_ADDRESS=name4@yandex.ru    
MAIL_FROM_NAME=name  

Для получения пароля вам нужно будет (в моем случае яндекса) вам нужно будет зайти в ваш почтовой ящик,  
нажать на шестеренку и в выпавшем меню выберите "безопасность" и потом нажмите на "пароли приложений".  
И там вы создадите специальный пароль для работы с отправкой email на Laravel.
 
Перед запуском вам нужно прописать команду `php artisan key:generate` для генерации ключа шифрования.

#### Контакты

Почта: omnogom24@yandex.ru
Telegram: https://t.me/Dolso  