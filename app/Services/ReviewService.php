<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 22.12.2017
 * Time: 10:56
 */

namespace App\Services;

use App\Repositories\ReviewRepository;

/**
 * Class ReviewService
 * @package App\Services
 */
class ReviewService
{
    /**
     * @var ReviewRepository
     */
    protected $reviewRepository;

    /**
     * ReviewService constructor.
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * add new review
     * @param $productId
     * @param $userId
     * @param $review
     * @param $name
     * @param $email
     * @param $rating
     */
    public function addReview($productId, $userId, $review, $name, $email, $rating)
    {
        $this->reviewRepository->addReview($productId, $userId, $review, $name, $email, $rating);
    }

    /**
     * return reviews with limit 5
     * @param $productId
     * @param $page
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getReviews($productId, $page)
    {
        $reviewLimit = 5;

        $reviewOffset = ($page - 1) * $reviewLimit;

        return $this->reviewRepository->getReviews($productId, $reviewOffset, $reviewLimit);
    }

    /**
     * return reviews count
     * @param $productId
     * @return int
     */
    public function getReviewsCount($productId)
    {
        return $this->reviewRepository->getReviewsCount($productId);
    }
}