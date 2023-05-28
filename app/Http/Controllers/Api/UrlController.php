<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Urls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class UrlController extends Controller
{

    /**
     * Редирект на сохраненный адрес
     *
     * @param string $key
     * @return \Illuminate\Http\RedirectResponse|string
     */
     public function index(string $key)
    {
        $url = null;
        if ($key) {
            $url = Urls::getUrl($key);
        }

        if ($url){
            $result = Redirect::to($url, 301);
        } else {
            $result = 'Мы не знаем такого адреса';
        }

       return $result;
    }

    /**
     * Возврат короткого урл
     *
     * @param Request $request
     * @return string
     */
    public function shortUrl(Request $request): string
    {
        $shortUrl = 'неизвестный url';
        $url = $request->input('url');
        if (filter_var($url, FILTER_VALIDATE_URL))
        {
            $shortUrl = Urls::getShortUrl($url);
        }

        return $shortUrl;
    }
}
