<?php
namespace App\Services;

use App\Repositories\RoleRepository as SvcRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Role as DataModel;
use Illuminate\Support\Collection;

class RoleService
{
    protected $svcRepository;

    public function __construct()
    {
        $svcRepository = new SvcRepository();
        $this->svcRepository = $svcRepository;
    }

    public function createData(array $input): DataModel
    {
        return $this->svcRepository->create($input);
    }

    public function updateData(int $dataId, array $input): DataModel
    {
        $data = $this->svcRepository->findById($dataId);
        if (!$data) {
            return null;
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

    public function paginateData(int $perPage = 10): LengthAwarePaginator
    {
        return $this->svcRepository->paginate($perPage);
    }

    
    public function allData(): Collection
    {
        return $this->svcRepository->all();
    }
}
