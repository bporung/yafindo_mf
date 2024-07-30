<?php 
namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\CustomerProduct as DataModel;
use Illuminate\Support\Collection;
use Auth;
interface CustomerProductRepositoryInterface
{
    public function create(array $data): DataModel;
    public function update(DataModel $data, array $input): DataModel;
    public function delete(DataModel $data): void;
    public function findById(int $id): ? DataModel;
    public function paginate(int $perPage = 10,string $search = ''): LengthAwarePaginator;
    public function all(): Collection;
}

class CustomerProductRepository implements CustomerProductRepositoryInterface
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
        $data = DataModel::find($id);

            if (!Auth::user()->can('manage self customerproduct')) {
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
        if($search){
            $datamodel = DataModel::paginate($perPage);

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
