<?php 
namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Zone as DataModel;
use App\Models\Product as PDataModel;
use App\Models\ZonePrice as ZPDataModel;
use Illuminate\Support\Collection;

interface ZoneRepositoryInterface
{
    public function create(array $data): DataModel;
    public function update(DataModel $data, array $input): DataModel;
    public function delete(DataModel $data): bool;
    public function findById(int $id): ? DataModel;
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator;
    public function all(): Collection;
}

class ZoneRepository implements ZoneRepositoryInterface
{
    public function create(array $data): DataModel
    {
        
        $dm = DataModel::create($data);

        if($dm){
            $rows = PDataModel::all();
            foreach($rows as $row){
                $newZP = new ZPDataModel;
                $newZP->zone_id = $dm->id;
                $newZP->product_id = $row->id;
                $newZP->price_inc = 0;
                $newZP->price_exc = 0;
                $newZP->save();
            }
        }

        return $dm;

    }

    public function update(DataModel $data, array $input): DataModel
    {
        $data->update($input);
        return $data;
    }

    public function delete(DataModel $data): bool
    {
        if($data->sellcustomers()->exists() || $data->buycustomers()->exists()){
            return false;
        }
        $data->zoneprices()->delete();
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
            $datamodel = DataModel::where('name','LIKE','%'.$search.'%')->orWhere('code','LIKE','%'.$search.'%')->paginate($perPage);

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
