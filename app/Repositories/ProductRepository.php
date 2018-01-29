<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 15:33
 */

namespace App\Repositories;

use App\DatabaseModels\MainSlider;
use App\DatabaseModels\Product;
use App\DatabaseModels\Property;
use DB;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository
{
    /**
     * word separator for search
     * @var string
     */
    protected $wordsSeparator = '+';

    /**
     * like separator for search query
     * @var string
     */
    protected $likeSeparator = '%';

    public function getProductBySlug($slug, $language, $userTypeId)
    {
        return Product::with([
            'images',
            'color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'sizes' => function ($query) use ($language) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($language, $userTypeId) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($userTypeId);
            },
            'product_sizes.stocks' => function ($query) use ($userTypeId) {
                $query->whereUserTypeId($userTypeId);
            },
            'promotions' => function ($query) {
                $query->orderByRaw('promotions.priority desc');
            },
            'meta_tag' => function ($query) use ($language) {
                $query->select([
                    'meta_tags.id',
                    "meta_tags.title_$language as title",
                    "meta_tags.description_$language as description",
                    "meta_tags.keywords_$language as keywords",
                    "meta_tags.h1_$language as h1"
                ]);
            }
        ])
            ->whereSlug($slug)
            ->whereIsVisible(true)
            ->first([
                'id',
                "name_$language as name",
                'slug',
                'color_id',
                'group_id',
                'category_id',
                'meta_tag_id',
                'breadcrumb_category_id',
                "description_$language as description",
                'priority',
                'vendor_code',
                'rating',
                'number_of_views'
            ]);
    }

    /**
     * return product properties
     * @param $productId
     * @param $language
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProductProperties($productId, $language = Languages::DEFAULT_LANGUAGE)
    {
        return Property::select([
            'property_names.id as property_name_id',
            'property_names.slug as property_name_slug',
            'property_values.id as property_value_id',
            'property_values.slug as property_value_slug',
            "property_names.name_$language as name",
            "property_values.name_$language as value"
        ])
            ->join('products', 'properties.product_id', '=', 'products.id')
            ->join('property_names', 'properties.property_name_id', '=', 'property_names.id')
            ->join('property_values', 'properties.property_value_id', '=', 'property_values.id')
            ->orderBy('name')
            ->where('properties.product_id', '=', $productId)
            ->get();
    }

    /**
     * return all products for category (with pagination)
     * @param $currentCategory
     * @param $categoryProductsLimit
     * @param $categoryProductsOffset
     * @param $language
     * @param $userTypeId
     * @param $sort
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllProductsForCategory(
        $currentCategory,
        $categoryProductsLimit,
        $categoryProductsOffset,
        $language,
        $userTypeId,
        $sort
    )
    {
        $orderByRaw = 'name';

        if ($sort == 'popularity')
        {
            $orderByRaw = 'rating desc, name';
        }
        elseif ($sort == 'new')
        {
            $orderByRaw = 'created_at desc, name';
        }
        elseif ($sort == 'price-asc')
        {
            $orderByRaw = 'price asc, name';
        }
        elseif ($sort == 'price-desc')
        {
            $orderByRaw = 'price desc, name';
        }
        
        return Product::with([
            'images',
            'color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($language) {
                $query->select([
                    'id',
                    "name_$language as name",
                    'slug',
                    'html_code'
                ]);
            },
            'sizes' => function ($query) use ($language) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($language, $userTypeId) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($userTypeId);
            },
            'product_sizes.stocks' => function ($query) use ($userTypeId) {
                $query->whereUserTypeId($userTypeId);
            },
            'promotions' => function ($query) {
                $query->orderByRaw('promotions.priority desc');
            },
            'properties' => function ($query) use ($language) {
                $query->select([
                    'properties.id',
                    'properties.product_id',
                    'properties.property_name_id',
                    'properties.property_value_id',
                    'properties.priority',
                    'property_names.id',
                    'property_values.id',
                    'property_names.slug',
                    "property_names.name_$language as property_name",
                    "property_values.name_$language as property_value",
                ]);
                $query->join('property_names', function ($join) {
                    $join->on('properties.property_name_id', '=', 'property_names.id');
                });
                $query->join('property_values', function ($join) {
                    $join->on('properties.property_value_id', '=', 'property_values.id');
                });
            }
        ])->join('product_prices', function ($join) use ($userTypeId) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $userTypeId);
        })
            ->join('product_category', function ($query) use ($currentCategory) {
                $query->on('products.id', '=', 'product_category.product_id')
                    ->where('product_category.category_id', '=', "$currentCategory->id");
            })
            ->whereIsVisible(true)
            ->orderByRaw($orderByRaw)
            ->offset($categoryProductsOffset)
            ->limit($categoryProductsLimit)
            ->get([
                'products.id',
                "name_$language as name",
                'slug',
                'color_id',
                'group_id',
                'products.category_id',
                'breadcrumb_category_id',
                "description_$language as description",
                'products.priority',
                'vendor_code',
                'rating',
                'number_of_views',
                'products.created_at'
            ]);
    }

    /**
     * return count of all products related to current Category
     * @param $currentCategory
     * @return int
     */
    public function getCountProductsCategory($currentCategory)
    {
        return Product::join('product_category', function ($query) use ($currentCategory) {
            $query->on('products.id', '=', 'product_category.product_id')
                ->where('product_category.category_id', '=', "$currentCategory->id");
            })
            ->whereIsVisible(true)
            ->count();
    }

    /**
     * return similar products for single product page
     * @param $productId
     * @param $categoryId
     * @param $language
     * @param $userTypeId
     * @return \Illuminate\Support\Collection
     */
    public function getSimilarProducts($productId, $categoryId, $language, $userTypeId)
    {
        return Product::with([
            'images',
            'color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($language) {
                $query->select([
                    'id',
                    "name_$language as name",
                    'slug',
                    'html_code'
                ]);
            },
            'sizes' => function ($query) use ($language) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($language, $userTypeId) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($userTypeId);
            },
            'product_sizes.stocks' => function ($query) use ($userTypeId) {
                $query->whereUserTypeId($userTypeId);
            },
            'promotions' => function ($query) {
                $query->orderByRaw('promotions.priority desc');
            },
            'properties' => function ($query) use ($language) {
                $query->select([
                    'properties.id',
                    'properties.product_id',
                    'properties.property_name_id',
                    'properties.property_value_id',
                    'properties.priority',
                    'property_names.id',
                    'property_values.id',
                    'property_names.slug',
                    "property_names.name_$language as property_name",
                    "property_values.name_$language as property_value",
                ]);
                $query->join('property_names', function ($join) {
                    $join->on('properties.property_name_id', '=', 'property_names.id');
                });
                $query->join('property_values', function ($join) {
                    $join->on('properties.property_value_id', '=', 'property_values.id');
                });
            }
        ])
            ->whereCategoryId($categoryId)
            ->whereIsVisible(true)
            ->whereNotIn('id', [$productId])
            ->limit(8)
            ->get([
                'products.id',
                "name_$language as name",
                'slug',
                'color_id',
                'group_id',
                'category_id',
                'breadcrumb_category_id',
                "description_$language as description",
                'products.priority',
                'vendor_code',
                'rating',
                'number_of_views',
                'products.created_at'
            ]);
    }

    /**
     * get products for Cart
     * @param $productIds
     * @param $language
     * @param $userTypeId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCartProducts($productIds, $language, $userTypeId)
    {
        return Product::with([
            'images',
            'color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'sizes' => function ($query) use ($language) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($language, $userTypeId) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($userTypeId);
            },
            'promotions' => function ($query) {
                $query->orderByRaw('promotions.priority desc');
            },
        ])
            ->whereIn('id', $productIds)
            ->whereIsVisible(true)
            ->get([
                'id',
                "name_$language as name",
                'slug',
                'color_id',
                'group_id',
                'category_id',
                'breadcrumb_category_id',
                "description_$language as description",
                'priority',
                'vendor_code',
                'rating',
                'number_of_views'
            ]);
    }

    /**
     * return products for wish list
     * @param $productIds
     * @param $language
     * @param $userTypeId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getWishListProducts($productIds, $language, $userTypeId)
    {
        return Product::with([
            'images',
            'color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'sizes' => function ($query) use ($language) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($language, $userTypeId) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($userTypeId);
            },
            'promotions' => function ($query) {
                $query->orderByRaw('promotions.priority desc');
            },
        ])
            ->whereIn('id', $productIds)
            ->whereIsVisible(true)
            ->get([
                'id',
                "name_$language as name",
                'slug',
                'color_id',
                'group_id',
                'category_id',
                'breadcrumb_category_id',
                "description_$language as description",
                'priority',
                'vendor_code',
                'rating',
                'number_of_views'
            ]);
    }

    /**
     * return products for order
     * @param $productIds
     * @param $language
     * @param $userTypeId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getOrdersProducts($productIds, $language, $userTypeId)
    {
        return Product::with([
            'images',
            'color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'sizes' => function ($query) use ($language) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($language, $userTypeId) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($userTypeId);
            },
            'promotions' => function ($query) {
                $query->orderByRaw('promotions.priority desc');
            },
        ])->whereIsVisible(true)
            ->whereIn('id', $productIds)
            ->get([
                'id',
                "name_$language as name",
                'slug',
                'color_id',
                'group_id',
                'category_id',
                'breadcrumb_category_id',
                "description_$language as description",
                'priority',
                'vendor_code',
                'rating',
                'number_of_views'
            ]);
    }

    /**
     * return products for filtered categories
     * @param $currentCategory
     * @param $categoryProductsLimit
     * @param $categoryProductsOffset
     * @param $language
     * @param $userTypeId
     * @param $model
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllProductsForFiltersCategory(
        $currentCategory,
        $categoryProductsLimit,
        $categoryProductsOffset,
        $language,
        $userTypeId,
        $model
    )
    {
        $orderByRaw = 'name';

        if ($model->sort == 'popularity')
        {
            $orderByRaw = 'rating desc, name';
        }
        elseif ($model->sort == 'new')
        {
            $orderByRaw = 'created_at desc, name';
        }
        elseif ($model->sort == 'price-asc')
        {
            $orderByRaw = 'price asc, name';
        }
        elseif ($model->sort == 'price-desc')
        {
            $orderByRaw = 'price desc, name';
        }

        $query = Product::query();

        $query->with([
            'images',
            'color' => function ($query) use ($language) {
                $query->select([
                    'colors.id',
                    "colors.name_$language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($language) {
                $query->select([
                    'id',
                    "name_$language as name",
                    'slug',
                    'html_code'
                ]);
            },
            'sizes' => function ($query) use ($language) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($language, $userTypeId) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($userTypeId);
            },
            'product_sizes.stocks' => function ($query) use ($userTypeId) {
                $query->whereUserTypeId($userTypeId);
            },
            'promotions' => function ($query) {
                $query->orderByRaw('promotions.priority desc');
            },
            'properties' => function ($query) use ($language) {
                $query->select([
                    'properties.id',
                    'properties.product_id',
                    'properties.property_name_id',
                    'properties.property_value_id',
                    'properties.priority',
                    'property_names.id',
                    'property_values.id',
                    'property_names.slug',
                    "property_names.name_$language as property_name",
                    "property_values.name_$language as property_value",
                ]);
                $query->join('property_names', function ($join) {
                    $join->on('properties.property_name_id', '=', 'property_names.id');
                });
                $query->join('property_values', function ($join) {
                    $join->on('properties.property_value_id', '=', 'property_values.id');
                });
            }
        ]);

        if ($model->priceMin && $model->priceMax)
        {
            $query->whereHas('price', function ($q) use ($model) {
                $q->whereUserTypeId($model->userTypeId);
                $q->whereBetween('price', [$model->priceMin, $model->priceMax]);
            });
        }

        foreach ($model->parsedFilters as $name => $values) {
            $query->whereHas('properties', function ($query) use ($name, $values) {
                $query->whereHas('property_names', function ($query) use ($name) {
                    $query->whereIn('slug', [$name]);
                })->whereHas('property_values', function ($query) use ($values) {
                    $query->whereIn('slug', $values);
                });
            });
        }

        $query->join('product_prices', function ($join) use ($userTypeId) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $userTypeId);
        });

        $query->orderByRaw($orderByRaw)
            ->join('product_category', function ($query) use ($currentCategory) {
                $query->on('products.id', '=', 'product_category.product_id')
                    ->where('product_category.category_id', '=', "$currentCategory->id");
            })
            ->whereIsVisible(true)
            ->offset($categoryProductsOffset)
            ->limit($categoryProductsLimit);


        return $query->whereIsVisible(true)->get([
            'products.id',
            "name_$language as name",
            'slug',
            'color_id',
            'group_id',
            'products.category_id',
            'breadcrumb_category_id',
            "description_$language as description",
            'products.priority',
            'vendor_code',
            'rating',
            'number_of_views',
            'products.created_at'
        ]);
    }

    /**
     * return search products
     * @param $model
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllProductsForSearch($model)
    {
        $orderByRaw = 'name';

        if ($model->sort == 'popularity')
        {
            $orderByRaw = 'rating desc, name';
        }
        elseif ($model->sort == 'new')
        {
            $orderByRaw = 'created_at desc, name';
        }
        elseif ($model->sort == 'price-asc')
        {
            $orderByRaw = 'price asc, name';
        }
        elseif ($model->sort == 'price-desc')
        {
            $orderByRaw = 'price desc, name';
        }

        $words = explode($this->wordsSeparator, $model->series);
        $wordsReverse = array_reverse($words);
        $seriesReverse = implode($this->likeSeparator, $wordsReverse);
        $series = implode($this->likeSeparator, $words);

        return Product::with([
            'images',
            'color' => function ($query) use ($model) {
                $query->select([
                    'colors.id',
                    "colors.name_$model->language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($model) {
                $query->select([
                    'id',
                    "name_$model->language as name",
                    'slug',
                    'html_code'
                ]);
            },
            'sizes' => function ($query) use ($model) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$model->language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($model) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($model->userTypeId);
            },
            'product_sizes.stocks' => function ($query) use ($model) {
                $query->whereUserTypeId($model->userTypeId);
            },
            'promotions' => function ($query) {
                $query->orderByRaw('promotions.priority desc');
            },
            'properties' => function ($query) use ($model) {
                $query->select([
                    'properties.id',
                    'properties.product_id',
                    'properties.property_name_id',
                    'properties.property_value_id',
                    'properties.priority',
                    'property_names.id',
                    'property_values.id',
                    'property_names.slug',
                    "property_names.name_$model->language as property_name",
                    "property_values.name_$model->language as property_value",
                ]);
                $query->join('property_names', function ($join) {
                    $join->on('properties.property_name_id', '=', 'property_names.id');
                });
                $query->join('property_values', function ($join) {
                    $join->on('properties.property_value_id', '=', 'property_values.id');
                });
            }
        ])->join('product_prices', function ($join) use ($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })
        ->where(function ($query) use ($series, $seriesReverse) {
            $query->where('is_visible', '=', true);
            $query->where("name_ru", 'like', '%' . $series . '%');
            $query->orWhere("name_ru", 'like', '%' . $seriesReverse . '%');
            $query->where('is_visible', '=', true);
        })
        ->orWhere(function ($query) use ($series, $seriesReverse) {
            $query->where('is_visible', '=', true);
            $query->where("name_uk", 'like', '%' . $series . '%');
            $query->orWhere("name_uk", 'like', '%' . $seriesReverse . '%');
            $query->where('is_visible', '=', true);
        })
        ->orderByRaw($orderByRaw)
        ->offset($model->searchProductsOffset)
        ->limit($model->searchProductsLimit)
        ->get([
            'products.id',
            "name_$model->language as name",
            'slug',
            'color_id',
            'group_id',
            'category_id',
            'breadcrumb_category_id',
            "description_$model->language as description",
            'products.priority',
            'products.is_visible',
            'vendor_code',
            'rating',
            'number_of_views',
            'products.created_at'
        ]);
    }

    /**
     * return count of search products
     * @param $model
     * @return int
     */
    public function getCountSearchProducts($model)
    {
        $words = explode($this->wordsSeparator, $model->series);
        $wordsReverse = array_reverse($words);
        $seriesReverse = implode($this->likeSeparator, $wordsReverse);
        $series = implode($this->likeSeparator, $words);

        return Product::where(function ($query) use ($series, $seriesReverse) {
                    $query->where('is_visible', '=', true);
                    $query->where("name_ru", 'like', '%' . $series . '%');
                    $query->orWhere("name_ru", 'like', '%' . $seriesReverse . '%');
                    $query->where('is_visible', '=', true);
                })->orWhere(function ($query) use ($series, $seriesReverse) {
                    $query->where('is_visible', '=', true);
                    $query->where("name_uk", 'like', '%' . $series . '%');
                    $query->orWhere("name_uk", 'like', '%' . $seriesReverse . '%');
                    $query->where('is_visible', '=', true);
                })->count();
    }

    /**
     * return ajax search products
     * @param $model
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAjaxSearchProducts($model)
    {
        $orderByRaw = 'name';
        
        $words = explode($this->wordsSeparator, $model->series);
        $wordsReverse = array_reverse($words);
        $seriesReverse = implode($this->likeSeparator, $wordsReverse);
        $series = implode($this->likeSeparator, $words);

        return Product::with([
            'images',
            'color' => function ($query) use ($model) {
                $query->select([
                    'colors.id',
                    "colors.name_$model->language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($model) {
                $query->select([
                    'id',
                    "name_$model->language as name",
                    'slug',
                    'html_code'
                ]);
            },
            'sizes' => function ($query) use ($model) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$model->language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($model) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($model->userTypeId);
            }
        ])->join('product_prices', function ($join) use ($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })
            ->where(function ($query) use ($series, $seriesReverse) {
                $query->where('products.is_visible', '=', true);
                $query->where("name_ru", 'like', '%' . $series . '%');
                $query->orWhere("name_ru", 'like', '%' . $seriesReverse . '%');
                $query->where('products.is_visible', '=', true);
            })
            ->orWhere(function ($query) use ($series, $seriesReverse) {
                $query->where('products.is_visible', '=', true);
                $query->where("name_uk", 'like', '%' . $series . '%');
                $query->orWhere("name_uk", 'like', '%' . $seriesReverse . '%');
                $query->where('products.is_visible', '=', true);
            })
            ->orderByRaw($orderByRaw)
            ->limit(5)
            ->get([
                'products.id',
                "name_$model->language as name",
                'slug',
                'color_id',
                'group_id',
                'category_id',
                'breadcrumb_category_id',
                "description_$model->language as description",
                'products.priority',
                'products.is_visible',
                'vendor_code',
                'rating',
                'number_of_views',
                'products.created_at'
            ]);
    }

    /**
     * return count of product filtered categories
     * @param $model
     * @return int
     */
    public function getCountProductsFiltersCategory($model)
    {
        $query = Product::query();

        if ($model->priceMin && $model->priceMax)
        {
            $query->whereHas('price', function ($q) use ($model) {
                $q->whereUserTypeId($model->userTypeId);
                $q->whereBetween('price', [$model->priceMin, $model->priceMax]);
            });
        }

        foreach ($model->parsedFilters as $name => $values) {
            $query->whereHas('properties', function ($query) use ($name, $values) {
                $query->whereHas('property_names', function ($query) use ($name) {
                    $query->whereIn('slug', [$name]);
                })->whereHas('property_values', function ($query) use ($values) {
                    $query->whereIn('slug', $values);
                });
            });
        }

        $query->join('product_category', function ($query) use ($model) {
            $query->on('products.id', '=', 'product_category.product_id')
                ->where('product_category.category_id', '=', "". $model->currentCategory->id . "");
        })->whereIsVisible(true);

        return $query->count();
    }

    /**
     * return min value of price for categories
     * @param $model
     * @return mixed
     */
    public function getPriceMinForCategoryProducts($model)
    {
        return Product::join('product_prices', function ($join) use($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })
            ->join('product_category', function ($query) use ($model) {
                $query->on('products.id', '=', 'product_category.product_id')
                    ->where('product_category.category_id', '=', "". $model->currentCategory->id . "");
            })->whereIsVisible(true)->min('price');
    }

    /**
     * return max value of price for categories
     * @param $model
     * @return mixed
     */
    public function getPriceMaxForCategoryProducts($model)
    {
        return Product::join('product_prices', function ($join) use($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })->join('product_category', function ($query) use ($model) {
            $query->on('products.id', '=', 'product_category.product_id')
                ->where('product_category.category_id', '=', "". $model->currentCategory->id . "");
        })->whereIsVisible(true)->max('price');
    }

    /**
     * return min value of price for filtered categories
     * @param $model
     * @return mixed
     */
    public function getPriceMinForFiltersCategoryProducts($model)
    {
        $query = Product::query();

        $query->join('product_prices', function ($join) use($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })->join('product_category', function ($query) use ($model) {
            $query->on('products.id', '=', 'product_category.product_id')
                ->where('product_category.category_id', '=', "". $model->currentCategory->id . "");
        })->min('price');

        if (count($model->parsedFilters) > 0)
        {
            foreach ($model->parsedFilters as $name => $values) {
                $query->whereHas('properties', function ($query) use ($name, $values) {
                    $query->whereHas('property_names', function ($query) use ($name) {
                        $query->whereIn('slug', [$name]);
                    })->whereHas('property_values', function ($query) use ($values) {
                        $query->whereIn('slug', $values);
                    });
                });
            }
        }

        return $query->whereIsVisible(true)->min('price');
    }

    /**
     * return max value of price for filtered categories
     * @param $model
     * @return mixed
     */
    public function getPriceMaxForFiltersCategoryProducts($model)
    {
        $query = Product::query();

        $query->join('product_prices', function ($join) use($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })->join('product_category', function ($query) use ($model) {
                $query->on('products.id', '=', 'product_category.product_id')
                    ->where('product_category.category_id', '=', "". $model->currentCategory->id . "");
            })->max('price');

        if (count($model->parsedFilters) > 0)
        {
            foreach ($model->parsedFilters as $name => $values) {
                $query->whereHas('properties', function ($query) use ($name, $values) {
                    $query->whereHas('property_names', function ($query) use ($name) {
                        $query->whereIn('slug', [$name]);
                    })->whereHas('property_values', function ($query) use ($values) {
                        $query->whereIn('slug', $values);
                    });
                });
            }
        }

        return $query->whereIsVisible(true)->max('price');
    }

    public function getSalesProducts($model)
    {
        return Product::with([
            'images',
            'color' => function ($query) use ($model) {
                $query->select([
                    'colors.id',
                    "colors.name_$model->language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($model) {
                $query->select([
                    'id',
                    "name_$model->language as name",
                    'slug',
                    'html_code'
                ]);
            },
            'sizes' => function ($query) use ($model) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$model->language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($model) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($model->userTypeId);
            },
            'product_sizes.stocks' => function ($query) use ($model) {
                $query->whereUserTypeId($model->userTypeId);
            },
            'promotions' => function ($query) use ($model) {
                $query->where('products_promotions.promotion_id', '=', 1);
            },
            'properties' => function ($query) use ($model) {
                $query->select([
                    'properties.id',
                    'properties.product_id',
                    'properties.property_name_id',
                    'properties.property_value_id',
                    'properties.priority',
                    'property_names.id',
                    'property_values.id',
                    'property_names.slug',
                    "property_names.name_$model->language as property_name",
                    "property_values.name_$model->language as property_value",
                ]);
                $query->join('property_names', function ($join) {
                    $join->on('properties.property_name_id', '=', 'property_names.id');
                });
                $query->join('property_values', function ($join) {
                    $join->on('properties.property_value_id', '=', 'property_values.id');
                });
            }
        ])->join('product_prices', function ($join) use ($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })
            ->whereHas('promotions', function ($query) use ($model) {
                $query->where('products_promotions.promotion_id', '=', 1);
            })->whereIsVisible(true)
//            ->orderByRaw($orderByRaw)
//            ->offset($categoryProductsOffset)
//            ->limit($categoryProductsLimit)
            ->get([
                'products.id',
                "name_$model->language as name",
                'slug',
                'color_id',
                'group_id',
                'category_id',
                'breadcrumb_category_id',
                "description_$model->language as description",
                'products.priority',
                'vendor_code',
                'rating',
                'number_of_views',
                'products.created_at'
            ]);
    }
    
    public function getTopProducts($model)
    {
        return Product::with([
            'images',
            'color' => function ($query) use ($model) {
                $query->select([
                    'colors.id',
                    "colors.name_$model->language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($model) {
                $query->select([
                    'id',
                    "name_$model->language as name",
                    'slug',
                    'html_code'
                ]);
            },
            'sizes' => function ($query) use ($model) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$model->language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($model) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($model->userTypeId);
            },
            'product_sizes.stocks' => function ($query) use ($model) {
                $query->whereUserTypeId($model->userTypeId);
            },
            'promotions' => function ($query) use ($model) {
                $query->where('products_promotions.promotion_id', '=', 3);
            },
            'properties' => function ($query) use ($model) {
                $query->select([
                    'properties.id',
                    'properties.product_id',
                    'properties.property_name_id',
                    'properties.property_value_id',
                    'properties.priority',
                    'property_names.id',
                    'property_values.id',
                    'property_names.slug',
                    "property_names.name_$model->language as property_name",
                    "property_values.name_$model->language as property_value",
                ]);
                $query->join('property_names', function ($join) {
                    $join->on('properties.property_name_id', '=', 'property_names.id');
                });
                $query->join('property_values', function ($join) {
                    $join->on('properties.property_value_id', '=', 'property_values.id');
                });
            }
        ])->join('product_prices', function ($join) use ($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })
            ->whereHas('promotions', function ($query) use ($model) {
                $query->where('products_promotions.promotion_id', '=', 3);
            })->whereIsVisible(true)
            ->whereNotIn('products.id', $model->salesIds)
//            ->orderByRaw($orderByRaw)
//            ->offset($categoryProductsOffset)
//            ->limit($categoryProductsLimit)
            ->get([
                'products.id',
                "name_$model->language as name",
                'slug',
                'color_id',
                'group_id',
                'category_id',
                'breadcrumb_category_id',
                "description_$model->language as description",
                'products.priority',
                'vendor_code',
                'rating',
                'number_of_views',
                'products.created_at'
            ]);
    }
    
    public function getNewProducts($model)
    {
        return Product::with([
            'images',
            'color' => function ($query) use ($model) {
                $query->select([
                    'colors.id',
                    "colors.name_$model->language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'product_group.products.color' => function ($query) use ($model) {
                $query->select([
                    'id',
                    "name_$model->language as name",
                    'slug',
                    'html_code'
                ]);
            },
            'sizes' => function ($query) use ($model) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$model->language as name",
                    'sizes.slug'
                ]);
            },
            'price' => function ($query) use ($model) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($model->userTypeId);
            },
            'product_sizes.stocks' => function ($query) use ($model) {
                $query->whereUserTypeId($model->userTypeId);
            },
            'promotions' => function ($query) use ($model) {
                $query->where('products_promotions.promotion_id', '=', 2);
            },
            'properties' => function ($query) use ($model) {
                $query->select([
                    'properties.id',
                    'properties.product_id',
                    'properties.property_name_id',
                    'properties.property_value_id',
                    'properties.priority',
                    'property_names.id',
                    'property_values.id',
                    'property_names.slug',
                    "property_names.name_$model->language as property_name",
                    "property_values.name_$model->language as property_value",
                ]);
                $query->join('property_names', function ($join) {
                    $join->on('properties.property_name_id', '=', 'property_names.id');
                });
                $query->join('property_values', function ($join) {
                    $join->on('properties.property_value_id', '=', 'property_values.id');
                });
            }
        ])->join('product_prices', function ($join) use ($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })
            ->whereHas('promotions', function ($query) use ($model) {
                $query->where('products_promotions.promotion_id', '=', 2);
            })->whereIsVisible(true)
            ->whereNotIn('products.id', $model->topIds)
//            ->orderByRaw($orderByRaw)
//            ->offset($categoryProductsOffset)
//            ->limit($categoryProductsLimit)
            ->get([
                'products.id',
                "name_$model->language as name",
                'slug',
                'color_id',
                'group_id',
                'category_id',
                'breadcrumb_category_id',
                "description_$model->language as description",
                'products.priority',
                'vendor_code',
                'rating',
                'number_of_views',
                'products.created_at'
            ]);
    }

    public function getMainSlider($model)
    {
        return MainSlider::with([
            'image',
            'markers' => function ($query) use ($model) {
                $query->orderByRaw('priority desc');
            },
            'markers.product' => function ($query) use ($model) {
                $query->select([
                    'products.id',
                    "products.name_$model->language as name",
                    'products.slug',
                    'products.color_id',
                    'products.group_id',
                    'products.category_id',
                    'products.breadcrumb_category_id',
                    "products.description_$model->language as description",
                    'products.priority',
                    'products.is_visible',
                    'products.vendor_code',
                    'products.rating',
                    'products.number_of_views',
                    'products.created_at'
                ]);
                $query->where('products.is_visible', '=', true);
            },
            'markers.product.images',
            'markers.product.color' => function ($query) use ($model) {
                $query->select([
                    'colors.id',
                    "colors.name_$model->language as name",
                    'colors.slug',
                    'colors.html_code'
                ]);
            },
            'markers.product.product_group.products.color' => function ($query) use ($model) {
                $query->select([
                    'id',
                    "name_$model->language as name",
                    'slug',
                    'html_code'
                ]);
            },
            'markers.product.sizes' => function ($query) use ($model) {
                $query->select([
                    'sizes.id',
                    "sizes.name_$model->language as name",
                    'sizes.slug'
                ]);
            },
            'markers.product.price'  => function ($query) use ($model) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price',
                    'product_prices.old_price',
                    'product_prices.discount'
                ])->whereUserTypeId($model->userTypeId);
            },
            'markers.product.product_sizes.stocks' => function ($query) use ($model) {
                $query->whereUserTypeId($model->userTypeId);
            },
            'markers.product.promotions' => function ($query) {
                $query->orderByRaw('promotions.priority desc');
            },
            'markers.product.properties' => function ($query) use ($model) {
                $query->select([
                    'properties.id',
                    'properties.product_id',
                    'properties.property_name_id',
                    'properties.property_value_id',
                    'properties.priority',
                    'property_names.id',
                    'property_values.id',
                    'property_names.slug',
                    "property_names.name_$model->language as property_name",
                    "property_values.name_$model->language as property_value",
                ]);
                $query->join('property_names', function ($join) {
                    $join->on('properties.property_name_id', '=', 'property_names.id');
                });
                $query->join('property_values', function ($join) {
                    $join->on('properties.property_value_id', '=', 'property_values.id');
                });
            }
        ])
            ->whereHas('markers.product', function ($query) {
            $query->where('is_visible', '=', true);
        })
            ->whereIsVisible(true)->get();
    }
}