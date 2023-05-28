<?php

namespace App\Models;

/**
 * Реализация варианта репозитория с хранением в БД
 *
 * Class RepositoryCommon
 * @package App\Models
 */
class RepositoryCommon implements UrlRepositoryInterface
{
    /**
     * @param string $key
     * @return string
     */
    public static function getStrFromRepository(string $key): string
    {
        $str = Urls::where('short', $key)->first();

        return $str ?: '';
    }

    /**
     * @param string $key
     * @param string $value
     */
    public static function putStrToRepository(string $key, string $value): void
    {
        $newStr = new Urls();
        $newStr->url = $value;
        $newStr->short = $key;
        $newStr->save();
    }

}
