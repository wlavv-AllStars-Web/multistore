<?php
/**
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
 */

namespace Hybridauth\HttpClient;

if (!defined('_PS_VERSION_')) { exit; }
use Hybridauth\Data;
use Tools;
/**
 * HttpClient\Util home to a number of utility functions.
 */
class Util
{
    /**
    * Redirect handler.
    *
    * @var callable|null
    */
    protected static $redirectHandler;

    /**
    * Exit handler.
    *
    * @var callable|null
    */
    protected static $exitHandler;

   /**
    * Redirect to a given URL.
    *
    * In case your application need to perform certain required actions before Hybridauth redirect users
    * to IDPs websites, the default behaviour can be altered in one of two ways:
    *   If callable $redirectHandler is defined, it will be called instead.
    *   If callable $exitHandler is defined, it will be called instead of exit().
    *
    * @param string $url
    */
    public static function redirect($url)
    {
        if (static::$redirectHandler) {
            return call_user_func(static::$redirectHandler, $url);
        }
        Tools::redirect($url);
        if (static::$exitHandler) {
            return call_user_func(static::$exitHandler);
        }

        exit(1);
    }

    /**
    * Redirect handler to which the regular redirect() will yield the action of redirecting users.
    *
    * @param callable $callback
    */
    public static function setRedirectHandler($callback)
    {
        self::$redirectHandler = $callback;
    }

    /**
    * Exit handler will be called instead of regular exit() when calling Util::redirect() method.
    *
    * @param callable $callback
    */
    public static function setExitHandler($callback)
    {
        self::$exitHandler = $callback;
    }

    /**
    * Returns the Current URL.
    *
    * @param bool $requestUri TRUE to use $_SERVER['REQUEST_URI'], FALSE for $_SERVER['PHP_SELF']
    *
    * @return string
    */
    public static function getCurrentUrl($requestUri = false)
    {
        $collection = new Data\Collection($_SERVER);

        $protocol = 'http://';

        if (
            (
                $collection->get('HTTPS') && $collection->get('HTTPS') !== 'off'
            ) ||
                $collection->get('HTTP_X_FORWARDED_PROTO') === 'https'
        ) {
            $protocol = 'https://';
        }

        return $protocol.
               $collection->get('HTTP_HOST').
               $collection->get($requestUri ? 'REQUEST_URI' : 'PHP_SELF');
    }
}
