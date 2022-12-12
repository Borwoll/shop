<?php

namespace App\UseCases\Admin\Shop;

use App\Entity\Shop\Product\Product;
use App\Entity\Shop\Review;
use App\Command\Admin\Shop\Review\Update\Command as ReviewUpdateCommand;
use App\Command\Admin\Shop\Review\Remove\Command as ReviewRemoveCommand;
use App\Query\Shop\Review\Find\FindReviewsQuery;
use App\UseCases\Service;

class ReviewManageService extends Service {
    public function remove(Product $product, Review $review): void {
        $this->commandBus->handle(new ReviewRemoveCommand($product, $review));
    }

    public function getReviews() {
        $users = $this->queryBus->query(new FindReviewsQuery());
        return $users;
    }
}