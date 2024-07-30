<?php

namespace App\Livewire\Reportsales;

use Livewire\Component;
use App\Services\ReportSaleService;
use App\Models\ReportSale;
use App\Models\ReportSaleDetail;
use App\Models\Product;


class DataInfo extends Component
{
    protected $reportSaleService;
    public $id;


    public function __construct()
    {
        $reportSaleService = new ReportSaleService();
        $this->reportSaleService = $reportSaleService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        $del = $this->reportSaleService->deleteData($this->id);
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
            $pub = ReportSale::findOrFail($this->id);
            $pub->isPublished = '1';
            $pub->save();
            
            $this->dispatch('alert-success', message: 'Success Publish Report');
        }else{
            
            $this->dispatch('alert-error', message: 'Failed to Publish Report. There is something wrong with the conversion.');
        }
    }
    public function conversionProcess(){
        $datas = ReportSaleDetail::where('reportsale_id',$this->id)->get();
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
            $updata = ReportSaleDetail::findOrFail($dat->id);
            $updata->conversion_uom = $conversion_uom;
            $updata->conversion_qty = $conversion_qty;
            $updata->save();
            
        }
        return $returnDone;
    }
    public function render()
    {
        return view('livewire.reportsales.data-info',[
            'data' => $this->reportSaleService->findById($this->id),
        ]);
    }
}
