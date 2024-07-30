<?php

namespace App\Livewire\Forecastdetails;

use Livewire\Component;
use App\Models\ForecastDetail;
use App\Models\ForecastShipment;
use Illuminate\Validation\Rule;
class FormEdit extends Component
{

    public $id;
    public $forecast_id;

    public $adj_left_current;
    public $adj_plan_sell_out_special;
    public $adj_cmo_left;
    public $adj_cmo;

    
    
    public function __construct()
    {
    }
    public function mount($forecast_id,$id)
    {
        $this->id = $id;
        $this->forecast_id = $forecast_id;
        $data = ForecastDetail::findOrFail($id);

        $this->adj_left_current = $data->adj_left_current;
        $this->adj_plan_sell_out_special = $data->adj_plan_sell_out_special;
        $this->adj_cmo_left = $data->adj_cmo_left;
        $this->adj_cmo = $data->adj_cmo;
    }

    public function submitForm(){
        
        $forecast_id = $this->forecast_id;
        // Validate the form data
        $validatedData  = $this->validate([
            'adj_left_current' => 'required|numeric|min:0',
            'adj_plan_sell_out_special' => 'required|numeric|min:0',
            'adj_cmo_left' => 'required|numeric|min:0',
            'adj_cmo' => 'required|numeric|min:0',
        ]);

        $updatedData = ForecastDetail::findOrFail($this->id);
        
        $adj_left_current = $this->adj_left_current;
        $est_sell_out_current = $updatedData->est_sell_out_current + $adj_left_current;
        $adj_plan_sell_out_special = $this->adj_plan_sell_out_special;
        $final_plan_sell_out_special = $updatedData->final_plan_sell_out_special + $adj_plan_sell_out_special;

        $adj_cmo_left = $this->adj_cmo_left;
        $adj_cmo = $this->adj_cmo;

        $safety_stock = $updatedData->safety_stock;
        $stock = $updatedData->stock;
        $cmo_sent = $updatedData->cmo_sent;
        $cmo_plan = $updatedData->cmo_plan;
        $cmo_left = $updatedData->cmo_left;
        $est_left_current = $updatedData->est_left_current;
        $average_sell_out_per_day = $updatedData->average_sell_out_per_day;
        $plan_sell_out_next_month = $updatedData->plan_sell_out_next_month;

        $doi_current_month = 0;
        if ($average_sell_out_per_day > 0) {
            $doi_current_month = ($stock + $cmo_sent+$cmo_plan+$adj_cmo_left+$cmo_left - $est_left_current) / $average_sell_out_per_day;
            if ($doi_current_month <= 0) {
                $doi_current_month = 0;
            }
        }

        $cmo = 0;
        $cmo = ($final_plan_sell_out_special + $safety_stock) - ($stock + $cmo_sent + $cmo_plan + $cmo_left + $adj_cmo_left) + ($est_left_current + $adj_cmo);
        if ($cmo <= 0) {
            $cmo = 0;
        }

        $doi_next_month = 0;
        if ($average_sell_out_per_day > 0) {
            $doi_next_month = (($stock + $cmo_sent + $cmo_plan + $cmo_left+$adj_cmo_left+$cmo) - ($est_left_current + $plan_sell_out_next_month)) / $average_sell_out_per_day;
            if ($doi_next_month <= 0) {
                $doi_next_month = 0;
            }
        }

        $old_total_volume = $updatedData->total_volume;
        $old_total_weight = $updatedData->total_weight;
        $shipmentdetail_id = $updatedData->shipmentdetail_id;
        
        $total_volume = $updatedData->volume * $cmo;
        $total_weight = $updatedData->weight * $cmo;

        $updatedData->adj_left_current = $this->adj_left_current;
        $updatedData->adj_plan_sell_out_special = $this->adj_plan_sell_out_special;
        $updatedData->adj_cmo_left = $this->adj_cmo_left;
        $updatedData->adj_cmo = $this->adj_cmo;

        $updatedData->est_sell_out_current = $est_sell_out_current;
        $updatedData->final_plan_sell_out_special = $final_plan_sell_out_special;

        $updatedData->doi_current_month = number_format($doi_current_month, 2, '.', '');
        $updatedData->cmo = $cmo;
        $updatedData->doi_next_month = number_format($doi_next_month, 2, '.', '');
        $updatedData->total_volume = $total_volume;
        $updatedData->total_weight = $total_weight;

        $updatedData->save();

        $shipData = ForecastShipment::where('forecast_id',$forecast_id)->where('shipmentdetail_id',$shipmentdetail_id)->first();

        $shipTotalVolume = $shipData->total_volume;
        $shipTotalWeight = $shipData->total_weight;
        $newShipTotalVolume = $shipTotalVolume - $old_total_volume + $total_volume;
        $newShipTotalWeight = $shipTotalWeight - ($old_total_weight/1000) + ($total_weight/1000);


        $sType = $this->checkShipmentType($shipData->shipment_volume_quota,$shipData->shipment_weight_quota,$newShipTotalVolume,$newShipTotalWeight);
            
        $shipData->total_weight = $newShipTotalWeight;
        $shipData->total_volume = $newShipTotalVolume;
        $shipData->shipment_volume = $newShipTotalVolume / $shipData->shipment_volume_quota;
        $shipData->shipment_weight = $newShipTotalWeight / $shipData->shipment_weight_quota;
        $shipData->shipment_type = $sType;
        $shipData->save();
        

        if($updatedData){
            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }

    
    public function checkShipmentType($a,$b,$c,$d){
        $shipment_volume_quota = $a;
        $use_shipment_volume_quota = $a;
        $shipment_weight_quota = $b;
        $use_shipment_weight_quota = $b;
        $total_volume = $c;
        $total_weight = $d;

        $ratio_volume = $total_volume/$shipment_volume_quota;
        $ratio_weight = $total_weight/$shipment_weight_quota;

        if($ratio_volume > $ratio_weight){return  '1';}
        if($ratio_weight > $ratio_volume){return  '2';}
        
        return '1';
    }


    public function render()
    {
        return view('livewire.forecastdetails.form-edit');
    }
}
