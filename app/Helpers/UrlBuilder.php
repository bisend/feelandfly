<?php

namespace App\Helpers;

class UrlBuilder
{
    /**
     * Constants
     */

    /**
     * Url root sign
     *
     * @var string
     */
    const URL_ROOT = '/';

    /**
     * Home page
     *
     * @var string
     */
    const HOME_PAGE = 'home';

    /**
     * Category page
     *
     * @var string
     */
    const CATEGORY_PAGE = 'category';

    /**
     * Product page
     *
     * @var string
     */
    const PRODUCT_PAGE = 'product';

    /**
     * Contacts page
     *
     * @var string
     */
    const CONTACTS_PAGE = 'contacts';

    /**
     * About page
     *
     * @var string
     */
    const ABOUT_PAGE = 'about';

    /**
     * Search page
     *
     * @var string
     */
    const SEARCH_PAGE = 'search';

    /**
     * confirm page
     * @var string
     */
    const CONFIRMATION_PAGE = 'confirm';

    /**
     * new email confirm page
     * @var string
     */
    const NEW_EMAIL_CONFIRMATION_PAGE = 'confirm-new-email';

    /**
     * Search async method name
     *
     * @var string
     */
    const SEARCH_ASYNC_METHOD = 'async';

    /**
     * Errors page
     *
     * @var string
     */
    const ERROR_PAGE = 'errors';

    /**
     * Url parts separator
     *
     * @var string
     */
    const URL_PARTS_SEPARATOR = '/';

    /**
     * Default url query series param
     *
     * @var string
     */
    const SERIES_PARAM = '_SERIES_';

    /**
     * Url query series separator(?param1=arg1+arg2&param2=...)
     *
     * @var string
     */
    const SERIES_SEPARATOR = '+';

    /**
     * Undefined url(null)
     *
     * @var string
     */
    const UNDEFINED_URL = '#header';

    /**
     * Undefined url part
     *
     * @var string
     */
    const UNDEFINED_URL_PART = '';

    /**
     * Undefined error url(null)
     *
     * @var string
     */
    const UNDEFINED_ERROR_URL = '404';

    /**
     * Url param values pair separator
     *
     * @var string
     */
    const PARAM_VALUES_PAIR_SEPARATOR = '=';

    /**
     * Url params separator
     *
     * @var string
     */
    const PARAMS_SEPARATOR = ';';

    /**
     * Url param values separator
     *
     * @var string
     */
    const PARAM_VALUES_SEPARATOR = ',';


    /*
     * Personal info page
     * @var string
     */
    const PERSONAL_INFO_PAGE = 'profile/personal-info';
    
    /*
     * Change password page
     * @var string
     */
    const CHANGE_PASSWORD_PAGE = 'profile/change-password';
    
    /*
     * My orders page
     * @var string
     */
    const MY_ORDERS_PAGE = 'profile/my-orders';

    /*
     * Wishlist page
     * @var string
     */
    const WISHLIST_PAGE = 'profile/wish-list';

    /*
     * Compare page
     * @var string
     */
    const COMPARE_PAGE = 'compare';

    /*
     * Payment Delivery page
     * @var string
     */
    const PAYMENT_DELIVERY_PAGE = 'payment-delivery';

    /*
    * Order page
    * @var string
    */
    const ORDER = 'order';



    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build home page url
     *
     * @param string $language
     *
     * @return string
     */
    public static function home($language = Languages::DEFAULT_LANGUAGE)
    {
        return self::localize(url(self::URL_ROOT), $language);
    }
    
    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build current page url
     *
     * @param string $language
     *
     * @return string
     */
    public static function current($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::clearLanguage(url()->current());

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build category page url
     *
     * @param null|string $slug
     * @param string $language
     *
     * @return null|string
     */
    public static function category($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$slug)
        {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CATEGORY_PAGE,
            $slug
        ]);

        return self::localize($url, $language);
    }

    /**
     * confirmation email url
     * @param null $confirmationToken
     * @param string $language
     * @return string
     */
    public static function confirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$confirmationToken)
        {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CONFIRMATION_PAGE,
            $confirmationToken
        ]);

        return self::localize($url, $language);
    }

    /**
     * confirmation new email url
     * @param null $confirmationToken
     * @param string $language
     * @return string
     */
    public static function newEmailConfirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$confirmationToken)
        {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::NEW_EMAIL_CONFIRMATION_PAGE,
            $confirmationToken
        ]);

        return self::localize($url, $language);
    }

    /**
     * Build category page url
     *
     * @param null|string $slug
     * @param int $page
     * @param string $language
     *
     * @return null|string
     */
    public static function categoryPerPage($slug = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$slug) {
            return self::UNDEFINED_URL;
        }

        if ($page < 1)
        {
            $page = 1;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CATEGORY_PAGE,
            $slug
        ]);
        
        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    /**
     * Build orders per page page url
     *
     * 
     * @param int $page
     * @param string $language
     *
     * @return null|string
     */
    public static function ordersPerPage($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if ($page < 1)
        {
            $page = 1;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::MY_ORDERS_PAGE
        ]);

        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    /**
     * Build wish_list_per_page page url
     *
     *
     * @param int $page
     * @param string $language
     *
     * @return null|string
     */
    public static function wishListPerPage($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if ($page < 1)
        {
            $page = 1;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::WISHLIST_PAGE
        ]);

        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build product page url
     *
     * @param null|string $slug
     * @param string $language
     *
     * @return null|string
     */
    public static function product($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$slug) {
            return self::UNDEFINED_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::PRODUCT_PAGE,
            $slug
        ]);

        return self::localize($url, $language);
    }
    
    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build order page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function order($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::ORDER
        ]);

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build personal-info page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function personalInfo($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::PERSONAL_INFO_PAGE
        ]);

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build change-password page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function changePassword($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::CHANGE_PASSWORD_PAGE
        ]);

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build my-orders page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function myOrders($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::MY_ORDERS_PAGE
        ]);

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build wish-list page url
     *
     * @param string $language
     *
     * @return null|string
     */
    public static function wishlist($language = Languages::DEFAULT_LANGUAGE)
    {
        $url = self::concatParts([
            url(self::URL_ROOT),
            self::WISHLIST_PAGE
        ]);

        return self::localize($url, $language);
    }
    
    
    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build search page url
     *
     * @param null|string $series
     * @param string $language
     *
     * @return null|string
     */
    public static function search($series = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$series) {
            $series = self::SERIES_PARAM;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::SEARCH_PAGE,
            $series
        ]);

        return self::localize($url, $language);
    }

    /**
     * Build search(per page) page url
     *
     * @param null|string $series
     * @param int $page
     * @param string $language
     *
     * @return null|string
     */
    public static function searchPerPage($series = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$series) {
            $series = self::SERIES_PARAM;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::SEARCH_PAGE,
            $series
        ]);

        if ($page > 1) {
            $url = self::concatParts([$url, $page]);
        }

        return self::localize($url, $language);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Clear language param in the given url
     *
     * @param null|string $url
     *
     * @return string
     */
    public static function clearLanguage($url = null)
    {
        if (!$url) {
            return self::UNDEFINED_URL;
        }

        $url = preg_replace(Languages::SUPPORTED_LANGUAGES_REGULAR, self::UNDEFINED_URL_PART, $url);

        return trim($url, self::URL_ROOT);
    }


    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Localize given url with a given language
     *
     * @param null|string $url
     * @param string $language
     *
     * @return string
     */
    public static function localize($url = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$url) {
            return self::UNDEFINED_URL;
        }
        if (!$language) {
            $language = Languages::DEFAULT_LANGUAGE;
        }

        if ($language == Languages::DEFAULT_LANGUAGE) {
            return $url;
        }

        return self::concatParts([$url, $language]);
    }

    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Concat url parts
     *
     * @param null|array $parts
     * @param string $separator
     *
     * @return string
     */
    public static function concatParts($parts = null, $separator = self::URL_PARTS_SEPARATOR)
    {
        if (!$parts || !$separator) {
            return self::UNDEFINED_URL_PART;
        }

        $result = '';

        foreach ($parts as $part) {
            if (preg_match('/^http:|https:/i', $part)) {
                $result .= trim($part, $separator);
            } else {
                $result .= $separator . trim($part, $separator);
            }
        }

        return $result;
    }


    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Build error page url
     *
     * @param null $code
     * @param string $language
     *
     * @return null|string
     */
    public static function error($code = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        if (!$code) {
            $code = self::UNDEFINED_ERROR_URL;
        }

        $url = self::concatParts([
            url(self::URL_ROOT),
            self::ERROR_PAGE,
            $code
        ]);

        return self::localize($url, $language);
    }
}
