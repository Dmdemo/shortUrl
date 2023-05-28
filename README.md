Как установить локально на windows? 
(должен быть установлен docker)

1. Скачиваем репозиторий себе локально
2. Из папки куда скачали запускаем 
docker-compose up
и ждем завершения установки, после чего в браузере должен быть доступен урл вида
http://localhost:8876/dded 
сообщающий нам о том что такой ссылки нет.

Чтоб добавить получить сокращенную ссылку нужно послать post запрос на http://localhost:8876/api/shorturl
где в теле передать(form-data) 
(key) "url" => (value) "https://yandex.ru" 

После чего в ответе придет ссылка, по например http://localhost:8876/8e3b6be2adafad26170bbeed3fcda973
после чего по этой ссылке можно перейти и попасть на yandex.ru

---
ps: файлы кот были задействованы в laravel:

app/Models/UrlRepositoryInterface.php
app/Models/RepositoryCommon.php
app/Models/Urls.php

app/Http/Controllers/Api/UrlController.php
routes/api.php
routes/web.php

