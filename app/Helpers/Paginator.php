<?php

namespace App\Helpers;

/**
 * Class Paginator
 * @package App\Helpers
 */
class Paginator
{
    /**
     * @var int
     */
    private static $maxElements = 7;

    /**
     * @param int $page
     * @param null $itemsPerPage
     * @param null $totalItemsCount
     * @return array
     */
    public static function createPagination($page = 1, $itemsPerPage = null, $totalItemsCount = null)
    {
        $pages = [];

        if (!$page || !$itemsPerPage || !$totalItemsCount) {
            return $pages;
        }

        $lastPage = ceil($totalItemsCount / $itemsPerPage);

        if (self::$maxElements >= $lastPage) {
            $pages = range(1, $lastPage);
        } else {
            $minMiddle = ceil(self::$maxElements / 2);
            $maxMiddle = ceil($lastPage - self::$maxElements / 2);

            if ($page > $minMiddle) {
                array_push($pages, 1);
                array_push($pages, '...');
            }

            if ($page > $minMiddle && $page < $maxMiddle) {
                $pagesPerBothSides = floor(self::$maxElements / 4);
                $min = $page - $pagesPerBothSides;
                $max = $page + $pagesPerBothSides;
                for ($i = $min; $i <= $max; $i++) {
                    array_push($pages, $i);
                }
            } else if ($page <= $minMiddle) {
                $pagesPerLeftSide = self::$maxElements - 2;
                for ($i = 1; $i <= $pagesPerLeftSide; $i++) {
                    array_push($pages, $i);
                }
            } else if ($page >= $maxMiddle) {
                $pagesPerRightSide = self::$maxElements - 3;
                $min = $lastPage - $pagesPerRightSide;
                for ($i = $min; $i <= $lastPage; $i++) {
                    array_push($pages, $i);
                }
            }

            if ($page < $maxMiddle) {
                array_push($pages, '...');
                array_push($pages, $lastPage);
            }
        }

        if ($page == 1) {
            array_unshift($pages, false);
        } else {
            array_unshift($pages, true);
        }

        if ($page == $lastPage) {
            array_push($pages, false);
        } else {
            array_push($pages, true);
        }

        return $pages;
    }
}