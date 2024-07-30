<?php
namespace App\Services;

use App\Repositories\UomRepository as SvcRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Uom as DataModel;
use Illuminate\Support\Collection;

class UomService
{
    protected $svcRepository;

    public function __construct()
    {
        $svcRepository = new SvcRepository();
        $this->svcRepository = $svcRepository;
    }

    public function createData(array $input): DataModel
    {
        if (!empty($input['code'])) {
        $input['code'] = strtoupper($input['code']);
        }
        return $this->svcRepository->create($input);
    }

    public function updateData(int $dataId, array $input): DataModel
    {
        if (!empty($input['code'])) {
        $input['code'] = strtoupper($input['code']);
        }
        
        $data = $this->svcRepository->findById($dataId);
        return $this->svcRepository->update($data, $input);
    }

    public function deleteData(int $dataId): bool
    {
        $data = $this->svcRepository->findById($dataId);
        if (!$data) {
            return false;
        }

        $ret = $this->svcRepository->delete($data);
        return $ret;
    }

    public function findById(int $id): ? DataModel
    {
        return $this->svcRepository->findById($id);
    }

    public function paginateData(int $perPage = 10,string $search = ''): LengthAwarePaginator
    {
        return $this->svcRepository->paginate($perPage,$search);
    }
    public function allData(): Collection
    {
        return $this->svcRepository->all();
    }
}
