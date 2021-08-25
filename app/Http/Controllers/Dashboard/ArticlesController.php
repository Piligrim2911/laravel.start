<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\Articles\ArticlesService;
use App\Models\Article;
use Illuminate\Http\Response;

class ArticlesController extends DashboardController
{
    private $_articlesService;
    private $_fillable;

    public function __construct(ArticlesService $articlesService)
    {
        parent::__construct();
        $this->_articlesService = $articlesService;
        $this->_fillable = [
            'title',
            'announce',
            'content',
            'preview_image',
            'published',
        ];
    }

    /**
     * Показать список ресурсов
     *
     * @return Response
     */
    public function index(): Response
    {
        $items = $this->_articlesService->get_all_with_trashed();
        $viewData = [
            'items' => $items,
        ];
        return response()->view($this->template . '.pages.articles.index', $viewData);
    }

    /**
     * Показать форму для создания нового ресурса
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view($this->template . '.pages.articles.create');
    }

    /**
     * Сохранить вновь созданный ресурс в хранилище
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $data = $request->only($this->_fillable);
        $res = $this->_articlesService->create($data);
        return response($res);
    }

    /**
     * Отобразить указанный ресурс
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Показать форму редактирования указанного ресурса
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response
    {
        $item = $this->_articlesService->find($id);
        $viewData = [
            'item' => $item
        ];
        return response()->view($this->template . '.pages.articles.edit', $viewData);
    }

    /**
     * Обновить указанный ресурс в хранилище
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->only($this->_fillable);
        return $this->_articlesService->update($data, $id);
    }

    /**
     * Мягкое удаление указанного ресурса
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->_articlesService->destroy($id);
    }

    /**
     * Восстановление удаленного ресурса
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        return $this->_articlesService->restore($id);
    }

    /**
     * Полное удаление указанного ресурса из хранилища
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        return $this->_articlesService->delete($id);
    }

    /**
     * Обновление статуса публикации указанного ресурса
     *
     * @param Article|resource $item
     * @return JsonResponse
     */
    public function updStatus(Article $item): JsonResponse
    {
        return $this->_articlesService->update_status($item->published, $item);
    }
}
