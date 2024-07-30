<?php 
namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Forecast as DataModel;
use Illuminate\Support\Collection;

interface ForecastRepositoryInterface
{
    public function create(array $data): DataModel;
    public function update(DataModel $data, array $input): DataModel;
    public function delete(DataModel $data): bool;
    public function findById(int $id): ? DataModel;
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator;
    public function all(): Collection;
}

class ForecastRepository implements ForecastRepositoryInterface
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

    public function delete(DataModel $data): bool
    {
        if($data->status == '1'){
            return false;
        }
        $data->details()->delete();
        $data->shipments()->delete();
        $data->delete();
        if($data){
            return true;
        }
        return false;
    }

    public function findById(int $id): ? DataModel
    {
        return DataModel::find($id);
    }
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator
    {
        if($search){
            $datamodel = DataModel::
            whereHas('customer',function($query) use($search){
                $query->where('code','LIKE','%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%')->orWhere('nickname','LIKE','%'.$search.'%');
            })->orderBy('created_at','DESC')->paginate($perPage);

        }else{
            $datamodel = DataModel::orderBy('created_at','DESC')->paginate($perPage);
        }

        return $datamodel;
    }
    public function all(): Collection
    {
        return DataModel::all();
    }
}
