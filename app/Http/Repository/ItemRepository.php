<?php

namespace App\Http\Repository;

use App\Item;
use DB;

class ItemRepository
{
    /**
     * 検索
     */
    public function search(array $param)
    {
        $builder = DB::table('items')
            ->select('items.created_at as items_created_at', 'main_category_id',
                'items.updated_at as items_updated_at', 'items.sub_category_id', 'items.name',
                'items.category_id', 'items.price', 'items.size', 'items.status', 'items.id',
                'items.is_unbuyable', 'images.url1', 'images.url2', 'images.url3', 'images.url4')
            ->leftJoin('images', 'items.id', '=', 'images.item_id');

        if (isset($param['name'])) {
            $builder->where('items.name', 'LIKE', "%{$param['name']}%");
        }
        if (isset($param['main_category_id'])) {
            $builder->where('items.main_category_id', '=', $param['main_category_id']);
        }
        if (isset($param['sub_category_id'])) {
            $builder->where('items.sub_category_id', '=', $param['sub_category_id']);
        }
        if (isset($param['category_id'])) {
            $builder->where('items.category_id', '=', $param['category_id']);
        }
        if (isset($param['minPrice'])) {
            $builder->where('items.price', '>=', $param['minPrice']);
        }
        if (isset($param['maxPrice'])) {
            $builder->where('items.price', '<=', $param['maxPrice']);
        }
        if (isset($param['status'])) {
            $builder->where('items.status', '=', $param['status']);
        }
        if (isset($param['size'])) {
            $builder->where('items.size', '=', $param['size']);
        }
        if (isset($param['is_unbuyable'])) {
            $builder->where('items.is_unbuyable', '=', $param['is_unbuyable']);
        }
        if (isset($param['sort']) && isset($param['order'])) {
            $builder->orderBy('items.' . $param['sort'], $param['order']);
        }

        return $builder->get();
    }

    /**
     * 詳細
     */
    public function get(int $id)
    {
        return DB::table('items as a')
            ->where('a.id', $id)
            ->leftJoin('images as b', 'a.id', '=', 'b.item_id')
            ->leftJoin('main_categories as c', 'a.main_category_id', '=', 'c.id')
            ->leftJoin('sub_categories as d', 'a.sub_category_id', '=', 'd.id')
            ->leftJoin('categories as e', 'a.category_id', '=', 'e.id')
            ->select([
                'a.id', 'a.name as item_name', 'a.price', 'a.description', 'a.is_unbuyable', 'a.size', 'a.status',
                'b.url1', 'b.url2', 'b.url3', 'b.url4',
                'c.name as main_category_name', 'd.name as sub_category_name', 'e.name as category_name'
            ])
            ->first();
    }

    /**
     * 追加
     */
    public function add(int $user_ud, array $itemEntity)
    {
        $item = new Item();
        $item->user_id = $user_ud;
        $item->name = $itemEntity["name"];
        $item->price = $itemEntity["price"];
        $item->size = $itemEntity["size"];
        $item->status = $itemEntity["status"];
        $item->description = $itemEntity["description"];
        $item->main_category_id = $itemEntity["main_category_id"];
        $item->sub_category_id = $itemEntity["sub_category_id"];
        $item->category_id = $itemEntity["category_id"];
        $item->is_unbuyable = 0;

        $item->save();

        return $item->getKey();
    }

    /**
     * 更新
     */
    public function update()
    {

    }

}
