<?php

namespace App\Http\Controllers\Item;

use App\Http\Repository\MainCategoryRepository;
use App\Http\Controllers\Controller;
use App\Http\Repository\Repository;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ItemController
 * @package App\Http\Controllers\Item
 */
class ItemController extends Controller
{
    /**
     * @var MainCategoryRepository
     */
    private $mainCategoryRepository;

    public function __construct(MainCategoryRepository $mainCategoryRepository)
    {
        $this->mainCategoryRepository = $mainCategoryRepository;
    }


    /**
     * 商品一覧
     */
    public function list(): View
    {
        return view('list');
    }

    /**
     * 商品詳細
     */
    public function detail(Request $request): View
    {
        $id = $request->get('id');

        return view('detail', compact('id'));
    }
    
    /**
     * 商品の出品
     */
    public function create(): View
    {
        // カテゴリーの取得
        $mainCategories = $this->mainCategoryRepository->get();

        \Debugbar::info($mainCategories);

        return view('create', compact('mainCategories'));
    }

    /**
     * 商品の出品
     */
    public function edit(Request $request): View
    {
        $id = $request->get('id');



        // カテゴリーの取得
        $mainCategories = $this->mainCategoryRepository->get();

        \Debugbar::info($mainCategories);

        return view('create', compact('mainCategories'));
    }

}
