<?php
namespace App\Services;

use App\Repositories\UserRepository as SvcRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User as DataModel;

class UserService
{
    protected $svcRepository;

    public function __construct()
    {
        $svcRepository = new SvcRepository();
        $this->svcRepository = $svcRepository;
    }

    public function createData(array $input): DataModel
    {
        // Check if password input is provided and not empty
        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }
        return $this->svcRepository->create($input);
    }

    public function updateData(int $dataId, array $input): DataModel
    {
        $data = $this->svcRepository->findById($dataId);
        if (!$data) {
            return null;
        }

        // Check if password input is provided and not empty
        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }

        return $this->svcRepository->update($data, $input);
    }

    public function deleteData(int $dataId): void
    {
        $data = $this->svcRepository->findById($dataId);
        if (!$data) {
            return;
        }

        $this->svcRepository->delete($data);
    }

    public function findById(int $id): ? DataModel
    {
        return $this->svcRepository->findById($id);
    }

    public function paginateData(int $perPage = 10,string $search = ''): LengthAwarePaginator
    {
        return $this->svcRepository->paginate($perPage,$search);
    }
}
