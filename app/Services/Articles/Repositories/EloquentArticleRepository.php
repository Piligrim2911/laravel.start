<?php

namespace App\Services\Articles\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class EloquentArticleRepository implements ArticleRepositoryInterface
{
    /**
     * Получить полный список ресурсов (за исключением удаленных) без пагинации
     *
     * @return Collection
     */
    public function get_full_list(): Collection
    {
        return Article::all();
    }

    /**
     * Получить полный список ресурсов (включая удаленные) без пагинации
     *
     * @return Collection
     */
    public function get_full_list_with_trashed(): Collection
    {
        return Article::withTrashed()->all();
    }

    /**
     * Получить список всех ресурсов (за исключением удаленных) с пагинацией
     *
     * @return LengthAwarePaginator
     */
    public function get_all(): LengthAwarePaginator
    {
        return Article::query()->paginate(20);
    }

    /**
     * Получить список всех ресурсов (включая удаленные) с пагинацией
     *
     * @return LengthAwarePaginator
     */
    public function get_all_with_trashed(): LengthAwarePaginator
    {
        return Article::withTrashed()->paginate(20);
    }

    /**
     * Поиск ресурса по его идентификатору (ID)
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model
    {
        return Article::query()->find($id);
    }

    /**
     * Поиск ресурсов по заданным параметрам
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function search(array $filter): LengthAwarePaginator
    {
        $query = Article::query();
        if (!empty($filter)) {
            if ($filter['title']) {
                $query->where('title', 'like', '%' . $filter['title'] . '%');
            }
        }
        $query->orderBy('title', 'ASC');
        return $query->paginate(20);
    }

    /**
     * Создание нового ресурса в хранилище
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return Article::create($data);
    }

    /**
     * Обновление ресурса в хранилище
     *
     * @param array $data
     * @param int $id
     * @return int
     */
    public function update(array $data, int $id): int
    {
        return Article::query()->where('id', $id)->update($data);
    }

    /**
     * Мягкое удаление ресурса
     *
     * @param int $id
     * @return bool|Response|int
     */
    public function destroy(int $id)
    {
        return Article::query()->where('id', $id)->delete();
    }

    /**
     * Восстановление удаленного ресурса
     *
     * @param int $id
     * @return bool|Response|int
     */
    public function restore(int $id)
    {
        return Article::query()->where('id', $id)->restore();
    }

    /**
     * Удаление ресурса из хранилища (восстановлению не подлежит)
     *
     * @param int $id
     * @return bool|Response|int
     */
    public function delete(int $id)
    {
        return Article::query()->where('id', $id)->forceDelete();
    }

    /**
     * Изменение статуса публикации ресурса
     *
     * @param array $data
     * @param Article|resource $item
     * @return bool|Response|int
     */
    public function updateStatus(array $data, $item)
    {
        return $item->update($data);
    }
}
