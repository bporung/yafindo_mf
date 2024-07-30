<?php 
namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Customer as DataModel;
use App\Models\Product as PDataModel;
use App\Models\CustomerProduct as CPDataModel;
use Illuminate\Support\Collection;
use Auth;

interface CustomerRepositoryInterface
{
    public function create(array $data): DataModel;
    public function update(DataModel $data, array $input): DataModel;
    public function delete(DataModel $data): bool;
    public function findById(int $id): ? DataModel;
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator;
    public function all(): Collection;
}

class CustomerRepository implements CustomerRepositoryInterface
{
    public function create(array $data): DataModel
    {
        $dm = DataModel::create($data);

        $pData = PDataModel::all();
        foreach($pData as $rData){
            $cpData = new CPDataModel;
            $cpData->customer_id = $dm->id;
            $cpData->product_id = $rData->id;
            $cpData->shipmentdetail_id = $dm->shipmentdetail_id;
            $cpData->save();
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
        if($data->cmos()->exists() || $data->reportsales()->exists() || $data->reportinventories()->exists() || 
        $data->reportdeliveryplans()->exists()){
            return false;
        }
        $data->customerproducts()->delete();
        $data->usercustomers()->delete();
        $data->delete();
        if($data){
            return true;
        }
        return false;
    }

    public function findById(int $id): ? DataModel
    {
        $data = DataModel::find($id);

            if (!Auth::user()->can('manage customer')) {
                $userCustomerIds = Auth::user()->usercustomers()->pluck('customer_id')->toArray();

                // Check if the required customer ID exists in the list of customer IDs
                if (in_array($data->id, $userCustomerIds)) {
                    // Return the data if the user is authorized
                    return $data;
                } else {
                    // Abort or return an appropriate response if the user is not authorized
                    abort(403, 'Unauthorized action.');
                }
            }
            return $data;

    }
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator
    {
        $datamodel = DataModel::query();
        if (!Auth::user()->can('manage customer')) {
            $userCustomerIds = Auth::user()->usercustomers()->pluck('customer_id')->toArray();
            $datamodel = $datamodel->whereIn('id',$userCustomerIds);
        }

        if($search){
            $datamodel = $datamodel->where('name','LIKE','%'.$search.'%')
            ->orWhere('code','LIKE','%'.$search.'%')
            ->orWhere('nickname','LIKE','%'.$search.'%')
            ->orWhere('description','LIKE','%'.$search.'%')
            ->orWhere('address','LIKE','%'.$search.'%')
            ->paginate($perPage);

        }else{
            $datamodel = $datamodel->paginate($perPage);
        }


        return $datamodel;
    }
    public function all(): Collection
    {
        $datamodel = DataModel::query();
        if (!Auth::user()->can('manage customer')) {
            $userCustomerIds = Auth::user()->usercustomers()->pluck('customer_id')->toArray();
            $datamodel = $datamodel->whereIn('id',$userCustomerIds);
        }

        $datamodel = $datamodel->get();
        return $datamodel;
    }
}
