<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Item\Service\ItemApiService;
use App\Http\Repository\MainCategoryRepository;
use App\Http\Repository\SubCategoryRepository;
use App\Http\Repository\CategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

/**
 * Class ItemApiController
 * @package App\Http\Controllers\Item
 */
class ItemApiController extends Controller
{
    /**
     * @var ItemApiService
     */
    private $service;

    /**
     * @var MainCategoryRepository
     */
    private $mainCategoryRepository;

    /**
     * @var SubCategoryRepository
     */
    private $subCategoryRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(
        ItemApiService $service,
        MainCategoryRepository $mainCategoryRepository,
        SubCategoryRepository $subCategoryRepository,
        CategoryRepository $categoryRepository
    ){
        $this->service = $service;
        $this->mainCategoryRepository = $mainCategoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * 一覧検索 TODO 名称変更
     */
    public function search(Request $request): JsonResponse
    {
        $param = $request->all();

        $items = $this->service->search($param);
        
        return Response::json($items);
    }

    /**
     * 詳細取得
     */
    public function get(Request $request): JsonResponse
    {
        $item = $this->service->getDetail($request->get('id'));

        return Response::json($item);
    }

    /**
     * 新規追加
     */
    public function save(Request $request): void
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
     */
    public function getSubCategory(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $subCategories = $this->subCategoryRepository->findByMainCategoryId($id);
        
        return Response::json($subCategories);

    }

    /**
     * サブカテゴリーIDに紐付くカテゴリー一覧の取得
     */
    public function getCategory(Request $request): JsonResponse
    {
        $subCategoryId = $request->get('id');

        $categories = $this->categoryRepository->findBySubCategoryId($subCategoryId);

        return Response::json($categories);
    }

}
