<?php

use App\Helpers\Languages;
use App\Helpers\UrlBuilder;


// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_home
 */
if (!function_exists('url_home')) {

    /**
     * Get the home page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_home($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::home($language);
    }
}
// ---------------------------------------------------------------------------------------------------------------------

if (!function_exists('url_confirmation'))
{
    function url_confirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::confirmation($confirmationToken, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------

if (!function_exists('url_new_email_confirmation'))
{
    function url_new_email_confirmation($confirmationToken = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::newEmailConfirmation($confirmationToken, $language);
    }
}



// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_current
 */
if (!function_exists('url_current')) {

    /**
     * Get the current page url
     *
     * @param string $language
     * @return string
     */
    function url_current($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::current($language);
    }
}



// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_category
 */
if (!function_exists('url_category')) {

    /**
     * Get the category page url
     *
     * @param null|string $slug
     * @param string $language
     *
     * @return string
     */
    function url_category($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::category($slug, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_category_per_page
 */
if (!function_exists('url_category_per_page')) {

    /**
     * Get the category(per page) page url
     *
     * @param null|string $slug
     * @param int $page
     * @param string $language
     *
     * @return string
     */
    function url_category_per_page($slug = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::categoryPerPage($slug, $page, $language);
    }
}


// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_product
 */
if (!function_exists('url_product')) {

    /**
     * Get the product page url
     *
     * @param null|string $slug
     * @param string $language
     *
     * @return string
     */
    function url_product($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::product($slug, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------

/**
 * url order
 */
if (!function_exists('url_order')) {

    /**
     * Get the order page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_order($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::order($language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------

/**
 * url personal_info
 */
if (!function_exists('url_personal_info')) {

    /**
     * Get the personal-info page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_personal_info($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::personalInfo($language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------

/**
 * url change_password
 */
if (!function_exists('url_change_password')) {

    /**
     * Get the change-password page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_change_password($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::changePassword($language);
    }
}

/**
 * url my_orders
 */
if (!function_exists('url_my_orders')) {

    /**
     * Get the my-orders page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_my_orders($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::myOrders($language);
    }
}

/**
 * url my_orders per page
 */
if (!function_exists('url_my_orders_per_page')) {

    /**
     * Get the my-orders per page page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_my_orders_per_page($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::ordersPerPage($page, $language);
    }
}

/**
 * url wishListPerPage
 */
if (!function_exists('url_wish_list_per_page')) {

    /**
     * Get the wishListPerPage page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_wish_list_per_page($page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::wishListPerPage($page, $language);
    }
}

/**
 * url wish_list
 */
if (!function_exists('url_wish_list')) {

    /**
     * Get the wish-list page url
     *
     * @param string $language
     *
     * @return string
     */
    function url_wish_list($language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::wishlist($language);
    }
}


// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_search
 */
if (!function_exists('url_search')) {

    /**
     * Get the search page url
     *
     * @param null|string $series
     * @param string $language
     *
     * @return null|string
     */
    function url_search($series = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::search($series, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------
/**
 * url_search_per_page
 */
if (!function_exists('url_search_per_page')) {

    /**
     * Get the search(per page) page url
     *
     * @param null|string $series
     * @param int $page
     * @param string $language
     *
     * @return string
     */
    function url_search_per_page($series = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE)
    {
        return UrlBuilder::searchPerPage($series, $page, $language);
    }
}

// ---------------------------------------------------------------------------------------------------------------------
/*
 * setting formatted price
 */
if (!function_exists('set_format_price')) {

    function set_format_price($price, $product_count = 1)
    {
        return sprintf('%0.2f', round($price, 2, PHP_ROUND_HALF_UP) * $product_count);
    }
}