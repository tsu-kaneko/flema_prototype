<?php

namespace App\Http\Repository;

use DB;

class CategoryRepository
{

    public function findById(int $id)
    {
      return DB::table('categories')->where('id', $id)->first();
    }

    public function findBySubCategoryId($id)
    {
        return DB::table('categories')
            ->where('sub_category_id', $id)
            ->select('id', 'name', 'main_category_id', 'sub_category_id')
            ->get();
    }

}
