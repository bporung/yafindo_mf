<?php

namespace App\Livewire\Reportinventories;

use Livewire\Component;
use App\Services\ReportInventoryService;
use App\Models\ReportInventory;
use App\Models\ReportInventoryDetail;
use App\Models\Product;
use App\Models\CustomerProduct;


class DataInfo extends Component
{
    protected $reportInventoryService;
    public $id;


    public function __construct()
    {
        $reportInventoryService = new ReportInventoryService();
        $this->reportInventoryService = $reportInventoryService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        $del = $this->reportInventoryService->deleteData($this->id);
        if($del){
            $this->dispatch('alert-info', message: 'Data has been deleted.');
            sleep(3);
            return redirect()->to('/customers');
        }else{
            $this->dispatch('alert-error', message: 'Data couldnt be deleted.');
        }
    }
    public function publishReport(){
        $run = $this->conversionProcess();

        if($run){
            $pub = ReportInventory::findOrFail($this->id);
            $pub->isPublished = '1';
            $pub->save();
            
            $this->dispatch('alert-success', message: 'Success Publish Report');
        }else{
            
            $this->dispatch('alert-error', message: 'Failed to Publish Report. There is something wrong with the conversion.');
        }
    }
    public function conversionProcess(){
        $datas = ReportInventoryDetail::where('reportinventory_id',$this->id)->get();
        $returnDone = true;

        foreach($datas as $dat){
            $flag = false;
            $conversion_uom = '';
            $conversion_qty = 0;
            $prod = $dat->product;
            if(strtolower($prod->first_uom->code) == strtolower($dat->uom)){
                $conversion_qty = $dat->qty;
                $flag = true;
            }
            if(strtolower($prod->secondary_uom->code) == strtolower($dat->uom)){
                $conversion_qty = ($dat->qty * $prod->convert_second_to_fourth)/$prod->convert_first_to_fourth;
                $flag = true;
            }
            if(strtolower($prod->third_uom->code) == strtolower($dat->uom)){
                $conversion_qty = ($dat->qty * $prod->convert_third_to_fourth)/$prod->convert_first_to_fourth;
                $flag = true;
            }
            if(strtolower($prod->fourth_uom->code) == strtolower($dat->uom)){
                $conversion_qty = $dat->qty / $prod->convert_first_to_fourth;
                $flag = true;
            }
            $conversion_uom = $prod->first_uom_id;

            if(!$flag){
                $returnDone = false;
                $this->dispatch('alert-warning', message: 'Uom not registered.Conversion not possible.');
                break;
            }
            // UPDATE
            $updata = ReportInventoryDetail::findOrFail($dat->id);
            $updata->conversion_uom = $conversion_uom;
            $updata->conversion_qty = $conversion_qty;
            $updata->save();


            $stokupd = CustomerProduct::where('code',$dat->customer_product_id)->where('customer_id',$dat->reportinventory->customer_id)->first();
            if ($stokupd) {
                $stokupd->stock = $conversion_qty;
                $stokupd->last_updated_stock_at = $dat->date;
                $stokupd->save();
            } else {
                
            }
            
        }
        return $returnDone;
    }
    public function render()
    {
        return view('livewire.reportinventories.data-info',[
            'data' => $this->reportInventoryService->findById($this->id),
        ]);
    }
}
