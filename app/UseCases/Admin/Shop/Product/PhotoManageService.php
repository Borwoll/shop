<?php

namespace App\UseCases\Admin\Shop\Product;

use App\Entity\Shop\Product\Product;
use App\Entity\Shop\Product\Photo;
use App\Command\Admin\Shop\Product\Photo\Remove\Command as RemovePhotoCommand;
use App\Command\Admin\Shop\Product\Photo\RemoveAll\Command as RemoveAllPhotosCommand;
use App\Query\Shop\Product\Photo\FindPhotosByProductIdQuery;
use App\UseCases\Service;

class PhotoManageService extends Service
{
    public function remove(Photo $photo): void
    {
        $this->commandBus->handle(new RemovePhotoCommand($photo));
    }

    public function removeAll(Product $product): void
    {
        $photos = $this->queryBus->query(new FindPhotosByProductIdQuery($product->id));
        $this->commandBus->handle(new RemoveAllPhotosCommand($photos));
    }
}