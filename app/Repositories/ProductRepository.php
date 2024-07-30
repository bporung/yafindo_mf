<?php 
namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product as DataModel;
use App\Models\CustomerProduct as CPDataModel;
use App\Models\Customer as CDataModel;


use App\Models\Zone as ZDataModel;
use App\Models\ZonePrice as ZPDataModel;

interface ProductRepositoryInterface
{
    public function create(array $data): DataModel;
    public function update(DataModel $data, array $input): DataModel;
    public function delete(DataModel $data): bool;
    public function findById(int $id): ? DataModel;
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator;
}

class ProductRepository implements ProductRepositoryInterface
{
    public function create(array $data): DataModel
    {

        $dm = DataModel::create($data);

        if($dm){
            $cData = CDataModel::all();
            foreach($cData as $rData){
                $cpData = new CPDataModel;
                $cpData->customer_id = $rData->id;
                $cpData->product_id = $dm->id;
                $cpData->shipmentdetail_id = $rData->shipmentdetail_id;
                $cpData->save();
            }

            $zData = ZDataModel::all();
            foreach($zData as $row){
                $newZP = new ZPDataModel;
                $newZP->zone_id = $row->id;
                $newZP->product_id = $dm->id;
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
        if($data->forecastdetails()->exists() || $data->cmodetails()->exists() || $data->reportinventorydetails()->exists() || 
        $data->reportsaledetails()->exists() || $data->reportdeliveryplandetails()->exists()){
            return false;
        }
        $data->customerproducts()->delete();
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
            $datamodel = DataModel::where('name','LIKE','%'.$search.'%')
            ->orWhere('code','LIKE','%'.$search.'%')
            ->orWhere('nickname','LIKE','%'.$search.'%')
            ->orWhere('description','LIKE','%'.$search.'%')
            ->orWhere('varian','LIKE','%'.$search.'%')
            ->orWhereHas('brand',function($query) use($search){
                $query->where('code','LIKE','%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%');
            })
            ->orWhereHas('category',function($query) use($search){
                $query->where('code','LIKE','%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%');
            })
            ->paginate($perPage);

        }else{
            $datamodel = DataModel::paginate($perPage);
        }

        return $datamodel;
    }
}
