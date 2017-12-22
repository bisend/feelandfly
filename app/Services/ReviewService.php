<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 22.12.2017
 * Time: 10:56
 */

namespace App\Services;

use App\Repositories\ReviewRepository;

class ReviewService
{
    protected $reviewRepository;
    
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }
    
    public function addReview($productId, $userId, $review, $name, $email, $rating)
    {
        $this->reviewRepository->addReview($productId, $userId, $review, $name, $email, $rating);
    }

    public function getReviews($productId, $page)
    {
        $reviewLimit = 5;

        $reviewOffset = ($page - 1) * $reviewLimit;

        return $this->reviewRepository->getReviews($productId, $reviewOffset, $reviewLimit);
    }

    public function getReviewsCount($productId)
    {
        return $this->reviewRepository->getReviewsCount($productId);
    }
}