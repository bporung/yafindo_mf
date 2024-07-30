<?php 
namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\ZonePrice as DataModel;
use Illuminate\Support\Collection;

interface ZonePriceRepositoryInterface
{
    public function create(array $data): DataModel;
    public function update(DataModel $data, array $input): DataModel;
    public function delete(DataModel $data): void;
    public function findById(int $id): ? DataModel;
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator;
    public function all(): Collection;
}

class ZonePriceRepository implements ZonePriceRepositoryInterface
{
    public function create(array $data): DataModel
    {
        return DataModel::create($data);
    }

    public function update(DataModel $data, array $input): DataModel
    {
        $data->update($input);
        return $data;
    }

    public function delete(DataModel $data): void
    {
        $data->delete();
    }

    public function findById(int $id): ? DataModel
    {
        return DataModel::find($id);
    }
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator
    {
        if($search){
            $datamodel = DataModel::where('name','LIKE','%'.$search.'%')->paginate($perPage);

        }else{
            $datamodel = DataModel::paginate($perPage);
        }

        return $datamodel;
    }
    public function all(): Collection
    {
        return DataModel::all();
    }
}
