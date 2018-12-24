<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Item\Service\ItemApiService;
use App\Http\Repository\CategoryRepository;
use App\Http\Repository\MainCategoryRepository;
use App\Http\Repository\SubCategoryRepository;
use \Illuminate\Http\Request;

class ItemApiController extends Controller
{
    private $service = null;

    private $mainCategoryRepository = null;

    private $subCategoryRepository = null;

    private $categoryRepository = null;

    public function __construct(
        ItemApiService $service,
        MainCategoryRepository $mainCategoryRepository,
        SubCategoryRepository $subCategoryRepository,
        CategoryRepository $categoryRepository)
    {
        $this->service = $service;
        $this->mainCategoryRepository = $mainCategoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * 商品の一覧検索 TODO 名称変更
     *
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $param = $request->all();

        $items = $this->service->search($param);
        
        return \Response::json($items);
    }

    /**
     * 商品の詳細取得
     *
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        $item = $this->service->getDetail($request->get('id'));

        return \Response::json($item);
    }

    /**
     * 商品の新規追加
     *
     * @param Request $request
     */
    public function save(Request $request)
    {
        $itemEntity = $request->all();

        // TODO トレイト使用
        $user_id = \Auth::id();
        \Debugbar::addMessage($user_id);

        \Debugbar::addMessage($itemEntity);

        $this->service->addItem($user_id, $itemEntity);
    }


    /**
     * メインカテゴリーIDに紐付くサブカテゴリー一覧の取得
     *
     * @param Request $request
     * @return mixed
     */
    public function getSubCategory(Request $request)
    {
        $id = $request->get('id');

        $subCategories = $this->subCategoryRepository->findByMainCategoryId($id);
        
        return \Response::json($subCategories);

    }

    /**
     * サブカテゴリーIDに紐付くカテゴリー一覧の取得
     *
     * @param Request $request
     * @return mixed
     */
    public function getCategory(Request $request)
    {
        $subCategoryId = $request->get('id');

        $categories = $this->categoryRepository->findBySubCategoryId($subCategoryId);

        return \Response::json($categories);
    }

}
