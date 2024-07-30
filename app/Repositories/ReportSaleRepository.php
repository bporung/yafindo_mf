<?php 
namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\ReportSale as DataModel;
use Illuminate\Support\Collection;
use Auth;
interface ReportSaleRepositoryInterface
{
    public function create(array $data): DataModel;
    public function update(DataModel $data, array $input): DataModel;
    public function delete(DataModel $data): bool;
    public function findById(int $id): ? DataModel;
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator;
    public function all(): Collection;
}

class ReportSaleRepository implements ReportSaleRepositoryInterface
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
        if($data->isPublished == '1'){
            return false;
        }
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
                if (in_array($data->customer_id, $userCustomerIds)) {
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
            $datamodel = $datamodel->whereIn('customer_id',$userCustomerIds);
        }

        if($search){
            $datamodel = $datamodel->where(function($q) use ($search) {
                $q->where('file_name','LIKE','%'.$search.'%')
                ->orWhereHas('customer',function($query) use($search){
                    $query->where('code','LIKE','%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%')->orWhere('nickname','LIKE','%'.$search.'%');
                });
            })->paginate($perPage);

        }else{
            $datamodel = $datamodel->paginate($perPage);
        }

        return $datamodel;
    }
    public function all(): Collection
    {
        return DataModel::all();
    }
}
