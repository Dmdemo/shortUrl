<?php

namespace App\Models;

use Psy\Util\Str;

/**
 * Interface UrlRepositoryInterface
 * @package App\Models
 */
interface UrlRepositoryInterface
{
    public static function getStrFromRepository(string $key): string;

    public static function putStrToRepository(string $key, string $value): void;

}
