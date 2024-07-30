<?php 
namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Shipment as DataModel;
use Illuminate\Support\Collection;

interface ShipmentRepositoryInterface
{
    public function create(array $data): DataModel;
    public function update(DataModel $data, array $input): DataModel;
    public function delete(DataModel $data): bool;
    public function findById(int $id): ? DataModel;
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator;
    public function all(): Collection;
}

class ShipmentRepository implements ShipmentRepositoryInterface
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
        foreach($data->details as $detail){
            if($detail->customers()->exists()||$detail->customerproducts()->exists()||$detail->forecastshipments()->exists()||$detail->cmoshipments()->exists()||
            $detail->forecastdetails()->exists()||$detail->cmodetails()->exists()){
                return false;
            }
        }

        $data->details()->delete();
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
