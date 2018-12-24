<?php

namespace App\Http\Repository;

use DB;

class SubCategoryRepository
{
    public function findByMainCategoryId(int $id)
    {
        return DB::table('sub_categories')
            ->where('main_category_id', $id)
            ->select('id', 'name', 'main_category_id')
            ->get();
    }

}
