<?php

namespace App\Http\Controllers\Item\Service;

use App\Http\Repository\ItemRepository;

class ItemService
{
    private $itemRepository = null;
    
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function getItems()
    {
        return $this->itemRepository->getItems();
    }
    
    public function getDetail(int $id)
    {
        return $this->itemRepository->getItem($id);
    }

    
}
