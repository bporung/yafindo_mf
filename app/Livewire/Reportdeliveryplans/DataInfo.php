<?php

namespace App\Livewire\Reportdeliveryplans;

use Livewire\Component;
use App\Services\ReportDeliveryPlanService;
use App\Models\ReportDeliveryPlan;
use App\Models\ReportDeliveryPlanDetail;
use App\Models\Product;
use App\Models\CustomerProduct;


class DataInfo extends Component
{
    protected $reportDeliveryPlanService;
    public $id;


    public function __construct()
    {
        $reportDeliveryPlanService = new ReportDeliveryPlanService();
        $this->reportDeliveryPlanService = $reportDeliveryPlanService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        $del = $this->reportDeliveryPlanService->deleteData($this->id);
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
            $pub = ReportDeliveryPlan::findOrFail($this->id);
            $pub->isPublished = '1';
            $pub->save();
            
            $this->dispatch('alert-success', message: 'Success Publish Report');
        }else{
            
            $this->dispatch('alert-error', message: 'Failed to Publish Report. There is something wrong with the conversion.');
        }
    }
    public function closeReport(){
            $pub = ReportDeliveryPlan::findOrFail($this->id);
            $pub->status = '1';
            $pub->save();
            
            $this->dispatch('alert-success', message: 'Success Close Report');
        
    }
    public function conversionProcess(){
        $datas = ReportDeliveryPlanDetail::where('reportdeliveryplan_id',$this->id)->get();
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
            $updata = ReportDeliveryPlanDetail::findOrFail($dat->id);
            $updata->conversion_uom = $conversion_uom;
            $updata->conversion_qty = $conversion_qty;
            $updata->save();
            
        }
        return $returnDone;
    }
    public function render()
    {
        return view('livewire.reportdeliveryplans.data-info',[
            'data' => $this->reportDeliveryPlanService->findById($this->id),
        ]);
    }
}
