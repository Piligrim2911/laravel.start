<?php

namespace App\Services\Articles\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    /**
     * Получить полный список ресурсов (за исключением удаленных) без пагинации
     *
     * @return Collection
     */
    public function get_full_list(): Collection;

    /**
     * Получить полный список ресурсов (включая удаленные) без пагинации
     *
     * @return Collection
     */
    public function get_full_list_with_trashed(): Collection;

    /**
     * Получить список всех ресурсов (за исключением удаленных) с пагинацией
     *
     * @return LengthAwarePaginator
     */
    public function get_all(): LengthAwarePaginator;

    /**
     * Получить список всех ресурсов (включая удаленные) с пагинацией
     *
     * @return LengthAwarePaginator
     */
    public function get_all_with_trashed(): LengthAwarePaginator;

    /**
     * Поиск ресурса по его идентификатору (ID)
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model;

    /**
     * Поиск ресурсов по заданным параметрам
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function search(array $filter): LengthAwarePaginator;

    /**
     * Создание нового ресурса в хранилище
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Обновление ресурса в хранилище
     *
     * @param array $data
     * @param int $id
     * @return bool|int
     */
    public function update(array $data, int $id);

    /**
     * Мягкое удаление ресурса
     *
     * @param int $id
     * @return bool|int
     */
    public function destroy(int $id);

    /**
     * Восстановление удаленного ресурса
     *
     * @param int $id
     * @return bool|int
     */
    public function restore(int $id);

    /**
     * Удаление ресурса из хранилища (восстановлению не подлежит)
     *
     * @param int $id
     * @return bool|int
     */
    public function delete(int $id);

    /**
     * Изменение статуса публикации ресурса
     *
     * @param array $data
     * @param Article|resource $item
     * @return bool|int
     */
    public function updateStatus(array $data, Article $item);
}
