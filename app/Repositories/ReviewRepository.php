<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 22.12.2017
 * Time: 11:00
 */

namespace App\Repositories;

use App\DatabaseModels\Review;

class ReviewRepository
{
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
    
    public function getReviews($productId, $reviewOffset, $reviewLimit)
    {
        return Review::whereProductId($productId)
                ->whereIsModerated(true)
                ->offset($reviewOffset)
                ->orderByRaw('created_at desc')
                ->limit($reviewLimit)
                ->get();
    }

    public function getReviewsCount($productId)
    {
        return Review::whereProductId($productId)
            ->whereIsModerated(true)
            ->count();
    }
}