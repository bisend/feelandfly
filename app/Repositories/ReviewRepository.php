<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 22.12.2017
 * Time: 11:00
 */

namespace App\Repositories;

use App\DatabaseModels\Review;

/**
 * Class ReviewRepository
 * @package App\Repositories
 */
class ReviewRepository
{
    /**
     * save new review to DB
     * @param $productId
     * @param $userId
     * @param $review
     * @param $name
     * @param $email
     * @param $rating
     */
    public function addReview($productId, $userId, $review, $name, $email, $rating)
    {
        $model = new Review();
        $model->product_id = $productId;
        $model->user_id = $userId;
        $model->review = $review;
        $model->name = $name;
        $model->email = $email;
        $model->rating = $rating;
        $model->save();
    }

    /**
     * return reviews
     * @param $productId
     * @param $reviewOffset
     * @param $reviewLimit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getReviews($productId, $reviewOffset, $reviewLimit)
    {
        return Review::whereProductId($productId)
                ->whereIsModerated(true)
                ->offset($reviewOffset)
                ->orderByRaw('created_at desc')
                ->limit($reviewLimit)
                ->get();
    }

    /**
     * return reviews count
     * @param $productId
     * @return int
     */
    public function getReviewsCount($productId)
    {
        return Review::whereProductId($productId)
            ->whereIsModerated(true)
            ->count();
    }
}