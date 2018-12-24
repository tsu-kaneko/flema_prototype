<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use App\Http\Repository\MainCategoryRepository;
use App\Http\Repository\Repository;
//use App\Http\Repository\CategoryRepository;

class ItemController extends Controller
{
    private $mainCategoryRepository;
//    private $Repository;
//    private $categoryRepository;

    public function __construct(MainCategoryRepository $mainCategoryRepository
//                                SubCategoryRepository $subCategoryRepository,
//                                CategoryRepository $categoryRepository
    )
    {
        $this->mainCategoryRepository = $mainCategoryRepository;
//        $this->subCategoryRepository = $subCategoryRepository;
//        $this->categoryRepository = $categoryRepository;
    }

    /**
     * トップページ
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * 商品詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $id = $request->get('id');

        return view('detail', compact('id'));
    }
    
    /**
     * 商品の出品
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // カテゴリーの取得
        $mainCategories = $this->mainCategoryRepository->get();

        \Debugbar::info($mainCategories);

        return view('create', compact('mainCategories'));
    }

    /**
     * 商品の出品
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $id = $request->get('id');



        // カテゴリーの取得
        $mainCategories = $this->mainCategoryRepository->get();

        \Debugbar::info($mainCategories);

        return view('create', compact('mainCategories'));
    }

}
