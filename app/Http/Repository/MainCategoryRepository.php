<?php

namespace App\Http\Repository;

use DB;

class MainCategoryRepository
{
    public function get()
    {
        return DB::table('main_categories')->select('id', 'name')->get();
    }

}
