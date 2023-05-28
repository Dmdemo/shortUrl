<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

/**
 * Class Urls
 * @package App\Models
 */
class Urls extends Model
{
    use HasFactory;

    /**
     * Время хранения кеша
     *
     * @var float|int
     */
    static $expiresAt = 3600 * 24;

    /**
     * Получение строки для ответа с коротким URL
     *
     * @param string $url
     * @return string
     */
    public static function getShortUrl(string $url): string
    {
        if (!$url) {
            return 'не указан url';
        }

        self::logRequest($url);
        $key = self::getHashKey($url);
        $str = self::getStrFromCache($key);

        if (!$str) {
            $str = RepositoryCommon::getStrFromRepository($key);
        }

        if (!$str) {
            RepositoryCommon::putStrToRepository($key, $url);
            self::putStrToCache($key, $url);
        }
        self::logResponse(Config::get('app.url') . $key);

        return Config::get('app.url') . $key;
    }

    /**
     * Получаем полный урл по ключу
     *
     * @param string $key
     * @return string
     */
    public static function getUrl(string $key): string
    {
        $url = '';
        $str = Urls::where('short', $key)->first();
        if ($str) {
            $url = $str->url;
        }

        return $url;
    }

    /**
     * @param string $key
     * @return mixed
     */
    private static function getStrFromCache(string $key)
    {
        return Cache::get($key);
    }

    /**
     * @param string $key
     * @param string $value
     */
    private static function putStrToCache(string $key, string $value): void
    {
        Cache::put($key, $value, self::$expiresAt);
    }

    /**
     * @param string $url
     * @return string
     */
    private static function getHashKey(string $url): string
    {
        return md5($url);
    }

    /**
     * @param string $url
     */
    private static function logRequest(string $url): void
    {
        Log::channel('requestlog')->info('добавление урл: ' . $url . ' время ' . now());
    }

    /**
     * @param string $url
     */
    private static function logResponse(string $url): void
    {
        Log::channel('requestlog')->info('вернули короткий урл: ' . $url . ' время ' . now());
    }
}
