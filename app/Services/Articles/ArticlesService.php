<?php

namespace App\Services\Articles;

use App\Services\Articles\Repositories\ArticleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ArticlesService
{
    private $_repository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->_repository = $articleRepository;
    }

    /**
     * Получить полный список ресурсов (за исключением удаленных) без пагинации
     *
     * @return Collection
     */
    public function get_full_list(): Collection
    {
        return $this->_repository->get_full_list();
    }

    /**
     * Получить полный список ресурсов (включая удаленные) без пагинации
     *
     * @return Collection
     */
    public function get_full_list_with_trashed(): Collection
    {
        return $this->_repository->get_full_list_with_trashed();
    }

    /**
     * Получить список всех ресурсов (за исключением удаленных) с пагинацией
     *
     * @return LengthAwarePaginator
     */
    public function get_all(): LengthAwarePaginator
    {
        return $this->_repository->get_all();
    }

    /**
     * Получить полный список ресурсов (включая удаленные) с пагинацией
     *
     * @return LengthAwarePaginator
     */
    public function get_all_with_trashed(): LengthAwarePaginator
    {
        return $this->_repository->get_all_with_trashed();
    }

    /**
     * Поиск ресурса по его идентификатору (ID)
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model
    {
        return $this->_repository->find($id);
    }

    /**
     * Поиск ресурсов по заданным параметрам
     *
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function search(array $filter): LengthAwarePaginator
    {
        return $this->_repository->search($filter);
    }

    /**
     * Создание нового ресурса в хранилище
     *
     * @param array $data
     * @return JsonResponse
     */
    public function create(array $data): JsonResponse
    {
        if (empty($data)) {
            return response()->json([
                'error' => true,
                'errorTitle'=>'Ошибка!',
                'errorMessage'=>'Пустой массив данных'
            ]);
        }

        if (!empty($data['started_at'])) {
            $date = $data['started_at'];
            $data['started_at'] = date('Y-m-d H:i:s', strtotime($date));
        } else {
            $data['started_at'] = date('Y-m-d H:i:s');
        }

        $data['user_id'] = Auth::user()->id;

        $result = $this->_repository->create($data);

        if ($result && $result->id) {
            return response()->json([
                'error' => false,
                'id' => $result->id,
                'successTitle' => 'Успешно!',
                'successMessage' => 'Информация успешно сохранена'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'id' => $result->id,
                'errorTitle' => 'Ошибка!',
                'errorMessage' => 'При сохранении данных произошла ошибка'
            ]);
        }
    }

    /**
     * Обновление ресурса в хранилище
     *
     * @param array $data
     * @param int $id
     * @return JsonResponse
     */
    public function update(array $data, int $id): JsonResponse
    {
        if (empty($data)) {
            return response()->json([
                'error' => true,
                'errorTitle'=>'Ошибка!',
                'errorMessage'=>'Пустой массив данных'
            ]);
        }

        if (!empty($data['started_at'])) {
            $date = $data['started_at'];
            $data['started_at'] = date('Y-m-d H:i:s', strtotime($date));
        }

        $result = $this->_repository->update($data, $id);

        if ($result) {
            return response()->json([
                'error' => false,
                'successTitle' => 'Успешно!',
                'successMessage' => 'Информация успешно сохранена'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'id' => $result->id,
                'errorTitle' => 'Ошибка!',
                'errorMessage' => 'При сохранении данных произошла ошибка'
            ]);
        }
    }

    /**
     * Мягкое удаление ресурса
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if (!$id) {
            return response()->json([
                'error' => true,
                'errorCode'=>'#0001',
                'errorMessage'=>'Не указан ID ресурса'
            ]);
        }

        $result = $this->_repository->destroy($id);

        if ($result) {
            return response()->json([
                "error" => false,
                "successTitle" => "Успешно!",
                "successMessage" => "Ресурс удален успешно",
                "restoreLink" => route('dashboard.articles.restore', ['id'=>$id]),
                "deleteLink" => route('dashboard.articles.delete', ['id'=>$id])
            ]);
        } else {
            return response()->json([
                'error' => true,
                'errorCode'=>'#D0003',
                'errorMessage'=>'Не удалось удалить ресурс'
            ]);
        }
    }

    /**
     * Восстановление удаленного ресурса
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        if (!$id) {
            return response()->json([
                'error' => true,
                'errorCode'=>'#0001',
                'errorMessage'=>'Не указан ID ресурса'
            ]);
        }

        $result = $this->_repository->restore($id);

        if ($result) {
            return response()->json([
                'error' => false,
                'successTitle' => 'Успешно!',
                'successMessage' => 'Ресурс восстановлен успешно',
                'updateStatusLink' => route('dashboard.articles.updateStatus', ['item'=>$id]),
                'editLink' => route('dashboard.articles.edit', ['id'=>$id]),
                'destroyLink' => route('dashboard.articles.destroy', ['id'=>$id]),
                'published' => $result
            ]);
        } else {
            return response()->json([
                'error' => true,
                'errorCode'=>'#0004',
                'errorMessage'=>'Не удалось восстановить ресурс'
            ]);
        }
    }

    /**
     * Удаление ресурса из хранилища (восстановлению не подлежит)
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        if (!$id) {
            return response()->json([
                'error' => true,
                'errorCode'=>'#0001',
                'errorMessage'=>'Не указан ID ресурса'
            ]);
        }

        $result = $this->_repository->delete($id);

        if ($result) {
            return response()->json([
                'error' => false,
                'successTitle' => 'Успешно!',
                'successMessage' => 'Ресурс удален успешно',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'errorCode'=>'#0003',
                'errorMessage'=>'Не удалось удалить ресурс'
            ]);
        }
    }

    /**
     * Изменение статуса публикации ресурса
     *
     * @param int $currentStatus
     * @param resource $item
     * @return JsonResponse
     */
    public function update_status(int $currentStatus, $item): JsonResponse
    {
        $status = ($currentStatus == 0) ? 1 : 0;
        $data = array('published'=>$status);
        $result = $this->_repository->updateStatus($data, $item);
        if ($result) {
            $class = ($item->published) ? 'icon far fa-circle published' : 'icon far fa-circle unpublished';
            return response()->json([
                'error' => false,
                'class' => $class
            ]);
        } else {
            return response()->json([
                'error' => true,
                'errorCode'=>'###',
                'errorMessage'=>'Не удалось обновить статус для данного элемента'
            ]);
        }
    }
}
