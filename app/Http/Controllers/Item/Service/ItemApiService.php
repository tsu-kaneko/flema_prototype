<?php

namespace App\Http\Controllers\Item\Service;

use App\Http\Repository\CategoryRepository;
use App\Http\Repository\ImageRepository;
use App\Http\Repository\ItemRepository;
use App\Resource\Size;
use App\Resource\Status;
use Illuminate\Http\Request;

class ItemApiService
{
    /**
     * @var ItemRepository
     */
    private $itemRepository = null;

    /**
     * @var ImageRepository
     */
    private $imageRepository = null;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository = null;
    
    public function __construct(ItemRepository $itemRepository,
                                CategoryRepository $categoryRepository,
                                ImageRepository $imageRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->imageRepository = $imageRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function search(array $param)
    {
        return $this->itemRepository->search($param);
    }
    
    public function getDetail(int $id)
    {
        $item = $this->itemRepository->get($id);

        // 名称設定
        $item->size_name = Size::getName($item->size);
        $item->status_name = Status::getName($item->status);

        return $item;
    }

    public function addItem(int $user_id, array $itemEntity)
    {
        // カテゴリー取得
        $category = $this->categoryRepository->findById($itemEntity["category_id"]);
        $itemEntity["main_category_id"] = $category->main_category_id;
        $itemEntity["sub_category_id"] = $category->sub_category_id;

        // 商品の保存
        $item_id = $this->itemRepository->add($user_id, $itemEntity);

        // TODO 画像の保存
        $this->imageRepository->add($item_id);
    }
    
}
