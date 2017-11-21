<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 15:33
 */

namespace App\Repositories;

use App\DatabaseModels\Product;
use App\DatabaseModels\Property;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository
{
    /**
     * return single product by slug and language, userTypeId define prices etc.
     * @param string $slug
     * @param string $language
     * @param integer $userTypeId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getProductBySlug($slug, $language, $userTypeId)
    {
        return Product::with([
            'images',
            'color',
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
                    'product_prices.price'
                ])->whereUserTypeId($userTypeId);
            },
            'product_sizes.stocks' => function ($query) use ($userTypeId) {
                $query->whereUserTypeId($userTypeId);
            }
        ])
            ->whereSlug($slug)
            ->first([
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
     * MAYBE WILL NOT USE!!!!!!
     * @param $productId
     * @param $language
     * @param $userTypeId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getProductById($productId, $language, $userTypeId)
    {
        return Product::with([
            'images',
            'color',
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
                    'product_prices.price'
                ])->whereUserTypeId($userTypeId);
            },
        ])
            ->whereId($productId)
            ->first([
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
     * return all products for category (with pagination)
     * @param $currentCategory
     * @param $categoryProductsLimit
     * @param $categoryProductsOffset
     * @param $language
     * @param $userTypeId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllProductsForCategory(
        $currentCategory,
        $categoryProductsLimit,
        $categoryProductsOffset,
        $language,
        $userTypeId
    )
    {
        return Product::with([
            'images',
            'color',
            'product_group.products.color' => function ($query) use ($language) {
                $query->select([
                    'id',
                    "name_$language",
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
                    'product_prices.price'
                ])->whereUserTypeId($userTypeId);
            }
        ])
            ->whereCategoryId($currentCategory->id)
            ->offset($categoryProductsOffset)
            ->limit($categoryProductsLimit)
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
     * return count of all products related to current Category
     * @param $currentCategory
     * @return int
     */
    public function getCountProductsCategory($currentCategory)
    {
        return Product::whereCategoryId($currentCategory->id)->count();
    }
    
    public function getSimilarProducts($productId, $categoryId, $language, $userTypeId)
    {
        return Product::with([
            'images',
            'price' => function ($query) use ($language, $userTypeId) {
                $query->select([
                    'product_prices.id',
                    'product_prices.product_id',
                    'product_prices.user_type_id',
                    'product_prices.price'
                ])->whereUserTypeId($userTypeId);
            }
        ])
            ->whereCategoryId($categoryId)
            ->whereNotIn('id', [$productId])
            ->limit(8)
            ->get([
                'id',
                "name_$language as name",
                'slug',
                'category_id',
                'breadcrumb_category_id',
                "description_$language as description",
                'priority',
                'vendor_code',
                'rating',
                'number_of_views'
            ]);
    }
    
    public function getCartProducts($productIds, $language, $userTypeId)
    {
        return Product::with([
            'images',
            'color',
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
                    'product_prices.price'
                ])->whereUserTypeId($userTypeId);
            },
        ])
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
    
    public function getAllProductsForFiltersCategory(
        $currentCategory,
        $categoryProductsLimit,
        $categoryProductsOffset,
        $language,
        $userTypeId,
        $model
    )
    {
        $query = Product::query();

        $query->with([
            'images',
            'color',
            'product_group.products.color' => function ($query) use ($language) {
                $query->select([
                    'id',
                    "name_$language",
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
                    'product_prices.price'
                ])->whereUserTypeId($userTypeId);
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

        $query->whereCategoryId($currentCategory->id)
            ->offset($categoryProductsOffset)
            ->limit($categoryProductsLimit);


        return $query->get([
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

    public function getCountProductsFiltersCategory($model)
    {
        $query = Product::query();

//        $query->with([
//            'images',
//            'color',
//            'product_group.products.color' => function ($query) use ($language) {
//                $query->select([
//                    'id',
//                    "name_$language",
//                    'slug',
//                    'html_code'
//                ]);
//            },
//            'sizes' => function ($query) use ($language) {
//                $query->select([
//                    'sizes.id',
//                    "sizes.name_$language as name",
//                    'sizes.slug'
//                ]);
//            },
//            'price' => function ($query) use ($language, $userTypeId) {
//                $query->select([
//                    'product_prices.id',
//                    'product_prices.product_id',
//                    'product_prices.user_type_id',
//                    'product_prices.price'
//                ])->whereUserTypeId($userTypeId);
//            }
//        ]);

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

        $query->whereCategoryId($model->currentCategory->id);


        return $query->count();
//        return Product::whereCategoryId($currentCategory->id)->count();
    }
    
    public function getPriceMinForCategoryProducts($model)
    {
        return Product::join('product_prices', function ($join) use($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })->whereCategoryId($model->currentCategory->id)->min('price');
    }
    
    public function getPriceMaxForCategoryProducts($model)
    {
        return Product::join('product_prices', function ($join) use($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })->whereCategoryId($model->currentCategory->id)->max('price');
    }
    
    public function getPriceMinForFiltersCategoryProducts($model)
    {
        $query = Product::query();

        $query->join('product_prices', function ($join) use($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })->whereCategoryId($model->currentCategory->id)->min('price');

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

        return $query->min('price');
    }

    public function getPriceMaxForFiltersCategoryProducts($model)
    {
        $query = Product::query();

        $query->join('product_prices', function ($join) use($model) {
            $join->on('products.id', '=', 'product_prices.product_id')
                ->where('product_prices.user_type_id', '=', $model->userTypeId);
        })->whereCategoryId($model->currentCategory->id)->max('price');

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

        return $query->max('price');

//        return Product::join('product_prices', function ($join) use($model) {
//            $join->on('products.id', '=', 'product_prices.product_id')
//                ->where('product_prices.user_type_id', '=', $model->userTypeId);
//        })->whereCategoryId($model->currentCategory->id)->max('price');
    }
}