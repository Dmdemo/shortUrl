Как установить локально на windows? 

(должен быть установлен docker)

1. Скачиваем репозиторий себе локально
2. Из папки куда скачали запускаем 

    docker-compose up

3. Ждем завершения установки, после чего в браузере должен быть доступен урл вида
http://localhost:8876/dded 
сообщающий нам о том, что такой ссылки нет.

4. Чтоб добавить новый url и получить сокращенную ссылку нужно послать 

    post запрос на http://localhost:8876/api/shorturl


    где в теле передать(form-data) 

    (key) "url" => (value) "https://yandex.ru" 


5. В ответе придет ссылка (например http://localhost:8876/8e3b6be2adafad26170bbeed3fcda973 )
При переходе по этой ссылке будет переход на yandex.ru

---
ps: файлы кот были задействованы в laravel:

    app/Models/UrlRepositoryInterface.php

    app/Models/RepositoryCommon.php

    app/Models/Urls.php

    app/Http/Controllers/Api/UrlController.php

    routes/api.php

    routes/web.php

