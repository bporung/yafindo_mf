<?php

namespace App\Livewire\Cmos;

use Livewire\Component;
use App\Services\CmoService;
use App\Models\Cmo;
use App\Models\CmoDetail;
use App\Models\CmoShipment;
use App\Models\Forecast;
use App\Models\Product;
use App\Models\ZonePrice;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class DataInfo extends Component
{
    protected $cmoService;
    public $id;
    public $no_deliveryorder;
    public $date_received;


    public function __construct()
    {
        $cmoService = new CmoService();
        $this->cmoService = $cmoService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        
        $data = Cmo::findOrFail($this->id);
        if($data->status == '1'){
            $data->status = '7';
            $data->save();
            $this->dispatch('alert-success', message: 'Successfully Cancel CMO.');
        }else{
            $this->dispatch('alert-error', message: 'Couldnt Cancel CMO.');
        }

    }
    public function test()
    {
        $data = Cmo::findOrFail($this->id);
         // Initialize Excel writer
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'CONFIRMATION MONTHLY ORDER (CMO)')->mergeCells('A1:P1');

        $sheet->setCellValue('A2', 'DISTRIBUTOR [BILL TO]')->mergeCells('A2:H2');
        $sheet->setCellValue('A3', $data->customer->name)->mergeCells('A3:H3');
        $sheet->setCellValue('A4', 'ADDRESS :'.$data->customer->address)->mergeCells('A4:H4');
        $sheet->setCellValue('A5', 'PIC FINANCE :')->mergeCells('A5:C5');
        $sheet->setCellValue('D5', 'NO_TELP :')->mergeCells('D5:F5');

        
        $sheet->setCellValue('J2', 'DISTRIBUTOR [SHIP TO]')->mergeCells('J2:P2');
        $sheet->setCellValue('J3', $data->customer->name)->mergeCells('J3:P3');
        $sheet->setCellValue('J4', 'ADDRESS :'.$data->customer->address)->mergeCells('J4:P4');
        $sheet->setCellValue('J5', 'PIC :')->mergeCells('J5:L5');
        $sheet->setCellValue('M5', 'NO_TELP :')->mergeCells('M5:P5');
        

        $sheet->setCellValue('A7', 'NO.')->mergeCells('A7:A8');
        $sheet->setCellValue('B7', 'ITEM')->mergeCells('B7:D8');
        $sheet->setCellValue('E7', 'NAMA BARANG')->mergeCells('E7:H8');
        $sheet->setCellValue('I7', 'PENGIRIMAN')->mergeCells('I7:I8');
        $sheet->setCellValue('J7', 'KUBIKASI (m³)')->mergeCells('J7:J8');
        $sheet->setCellValue('K7', 'TONASE (KG)')->mergeCells('K7:K8');
        $sheet->setCellValue('L7', 'UOM')->mergeCells('L7:L8');
        $sheet->setCellValue('M7', 'TOTAL')->mergeCells('M7:O7');
        $sheet->setCellValue('M8', 'QTY');
        $sheet->setCellValue('N8', 'KUBIKASI (m³)');
        $sheet->setCellValue('O8', 'TONASE (TON)');
        $sheet->setCellValue('P7', 'NOMINAL (RP)')->mergeCells('P7:P8');

        $sheet->getStyle('A1:P1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A7:P8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set data rows
        $i = 9;
        $x = 1;
        $t_Qty = 0;
        $t_Volume = 0;
        $t_Weight = 0;
        $t_Nominal = 0;
        foreach($data->details as $detail){
            $sheet->setCellValue('A' . ($i), $x);
            $sheet->setCellValue('B' . ($i), $detail->product->code)->mergeCells('B'.($i).':D'.($i));
            $sheet->setCellValue('E' . ($i), $detail->product->nickname)->mergeCells('E'.($i).':H'.($i));
            $sheet->setCellValue('I' . ($i), $detail->shipmentdetail->name);
            $sheet->setCellValue('J' . ($i), $detail->volume);
            $sheet->setCellValue('K' . ($i), $detail->weight);
            $sheet->setCellValue('L' . ($i), $detail->uom->code);
            $sheet->setCellValue('M' . ($i), $detail->qty);
            $sheet->setCellValue('N' . ($i), $detail->total_volume);
            $sheet->setCellValue('O' . ($i), $detail->total_weight);
            $sheet->setCellValue('P' . ($i), $detail->nominal);

            $t_Qty += $detail->qty;
            $t_Volume += $detail->total_volume;
            $t_Weight += $detail->total_weight;
            $t_Nominal += $detail->nominal;
            $i++;
            $x++;
        }
        $sheet->setCellValue('A'.($i), 'TOTAL')->mergeCells('A'.($i).':L'.($i));
        $sheet->setCellValue('M'.($i), $t_Qty);
        $sheet->setCellValue('N'.($i), $t_Volume);
        $sheet->setCellValue('O'.($i), $t_Weight);
        $sheet->setCellValue('P'.($i), $t_Nominal);

        $sheet->getStyle('A'.($i).':L'.($i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        foreach(range('A', 'L') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        
        $styleArrayFill = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'f0ad48',
                ],
            ],
        ];

        $sheet->getStyle('A1:P1')->applyFromArray($styleArray)->applyFromArray($styleArrayFill);
        $sheet->getStyle('A7:P8')->applyFromArray($styleArrayFill);
        $sheet->getStyle('A7:P'.($i))->applyFromArray($styleArray);

        $x = $i + 2;
        $xStart = $x;
        $sheet->setCellValue('A'.($x),'ARMADA YG DI BUTUHKAN')->mergeCells('A'.($x).':E'.($x));
        $x++;
        $sheet->setCellValue('A'.($x),'JUMLAH');
        $sheet->setCellValue('B'.($x),'ARMADA');
        $sheet->setCellValue('C'.($x),'TN/m³');
        $sheet->setCellValue('D'.($x),'MUATAN');
        $sheet->setCellValue('E'.($x),'TTL');
        $x++;

        foreach($data->shipments as $sp){
            $shipment_ratio = 0;
            if($sp->shipment_type == '1' ){
                $shipment_ratio = $sp->shipment_volume;
            }
            if($sp->shipment_type == '2' ){
                $shipment_ratio = $sp->shipment_weight;
            }

            $sheet->setCellValue('A'.($x),$shipment_ratio)->mergeCells('A'.($x).':A'.($x+1));
            $sheet->setCellValue('B'.($x),$sp->shipmentdetail->name)->mergeCells('B'.($x).':B'.($x+1));
            $sheet->setCellValue('C'.($x),'TN');
            $sheet->setCellValue('C'.($x+1),'m³');
            $sheet->setCellValue('D'.($x),$sp->shipment_weight_quota);
            $sheet->setCellValue('D'.($x+1),$sp->shipment_volume_quota);
            $sheet->setCellValue('E'.($x),$sp->total_weight);
            $sheet->setCellValue('E'.($x+1),$sp->total_volume);
            

            $x++;
            $xEnd = $x;
            $x++;
        }
        
        $sheet->setCellValue('A'.($x),'TOTAL')->mergeCells('A'.($x).':D'.($x));
        $sheet->setCellValue('E'.($x),$sp->nominal);

        $sheet->getStyle('A'.($xStart).':E'.($x))->applyFromArray($styleArray);


        $approved_user = $data->approved ? $data->approved->name : '';
        $approved_user_at = $data->approved ? $data->approved_at : '';
        $sheet->setCellValue('G'.($xStart),'Approved By :')->mergeCells('G'.($xStart).':I'.($xStart));
        $sheet->setCellValue('J'.($xStart),$approved_user)->mergeCells('J'.($xStart).':K'.($xStart));
        $sheet->setCellValue('G'.($xStart+1),'Approved At :')->mergeCells('G'.($xStart+1).':I'.($xStart+1));
        $sheet->setCellValue('J'.($xStart+1),$approved_user_at)->mergeCells('J'.($xStart+1).':K'.($xStart+1));

        $sheet->getStyle('G'.($xStart).':K'.($xStart+1))->applyFromArray($styleArray);

        // Set headers and format
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // Save Excel file to storage/app directory
        $uuid = Str::uuid();
        $filename = 'export_' . time().'_'.$uuid . '.xlsx';
        $writer->save(storage_path('app/public/cmo/' . $filename));


        $path = '/storage/cmo/'.$filename;

        $updatePath = Cmo::findOrFail($data->id);
        $updatePath->file_path = $path;
        $updatePath->save();
        $this->dispatch('alert-success', message: 'Done Generate');


    }
    public function setPPNStatus($action)
    {
        if($action == 'exclude'){
            $cmo = Cmo::findOrFail($this->id);
            $cmo->ppnstatus = '0';
            $cmo->save();

            $this->calculate();
            $this->dispatch('alert-success', message: 'Change PPN Status to Exclude Has Been Finished.');
        }
        if($action == 'include'){
            $cmo = Cmo::findOrFail($this->id);
            $cmo->ppnstatus = '1';
            $cmo->save();
            $this->calculate();
            $this->dispatch('alert-success', message: 'Change PPN Status to Include Has Been Finished.');
            
        }

    }

    public function finalizeReport ($action){
        if($action == 'approve'){
            $this->calculate();
            $cmo = Cmo::findOrFail($this->id);
            if($cmo->status == '1'){
                $cmo->status = '2';
                $cmo->approved_at = now();
                $cmo->approved_by = Auth::user()->id;
                $cmo->save();
                $this->dispatch('alert-success', message: 'CMO Has Been Re-Calculate and Approved (Ready To Delivery).');
            }
        }
        if($action == 'on-delivery'){
            if($this->no_deliveryorder == ''){
                $this->dispatch('alert-warning', message: 'No. Delivery Order Must Be Filled.');
                return;
            }
            $cmo = Cmo::findOrFail($this->id);
            if($cmo->status == '2'){
                $cmo->status = '3';
                $cmo->no_deliveryorder = $this->no_deliveryorder;
                $cmo->deliveryupdated_at = now();
                $cmo->deliveryupdated_by = Auth::user()->id;
                $cmo->save();
                $this->dispatch('alert-success', message: 'CMO Has Been On Delivery.');
            }
        }
        if($action == 'received'){
            $cmo = Cmo::findOrFail($this->id);
            if($cmo->status == '3'){
                $cmo->status = '4';
                $cmo->received_at = now();
                $cmo->received_by = Auth::user()->id;
                $cmo->save();
                $this->dispatch('alert-success', message: 'CMO Has Been Received.');
            }
        }
    }
    
    public function calculate()
    {
        $cmo = $this->cmoService->findById($this->id);

        if($cmo->status != '1'){
            $this->dispatch('alert-warning', message: 'Calculate Couldnt Run.');
            return;
        }
        $cmodetails = CmoDetail::where('cmo_id',$this->id)->get();
        $zone_id = $cmo->customer ? $cmo->customer->sell_zone_id : 0;
        $ppn_status = $cmo->ppnstatus;
        foreach($cmodetails as $cmodetail){
            $price_inc = 0;
            $price_exc = 0;
            $margin = 0;
            $margin_2 = 0;
            $nominal = 0; 
            $price_use = 0;

            if($zone_id){
                $zonePrice = ZonePrice::where('zone_id',$zone_id)->where('product_id',$cmodetail->product_id)->first();
                
                $price_inc = $zonePrice->price_inc;
                $price_exc = $zonePrice->price_exc;
            }

            if($ppn_status == '0'){
                $price_use = $price_exc;
            }else{
                $price_use = $price_inc;
            }
            
            $margin = $cmodetail->customerproduct->margin;
            $margin_2 = $cmodetail->customerproduct->margin_2;
            $nominal = $cmodetail->qty * (($price_use - ($price_use * ($margin/100))) - (($price_use - ($price_use * ($margin/100))) * ($margin_2/100))); 

            $updateCMODetail = CmoDetail::findOrFail($cmodetail->id);
            $updateCMODetail->price_inc = $price_inc;
            $updateCMODetail->price_exc = $price_exc;
            $updateCMODetail->margin = $margin;
            $updateCMODetail->margin_2 = $margin_2;
            $updateCMODetail->nominal = $nominal;
            $updateCMODetail->save();
        }

        $cmoshipments = CmoShipment::where('cmo_id',$this->id)->get();
        foreach($cmoshipments as $cmoshipment){
            $totalMultiplier = 0;
            $price = $cmoshipment->shipmentdetail ? $cmoshipment->shipmentdetail->price : 0;
            $updateCMOShipment = CmoShipment::findOrFail($cmoshipment->id);
            $updateCMOShipment->price = $price;

            if($updateCMOShipment->shipment_type == '1'){
                $totalMultiplier = $updateCMOShipment->shipment_volume;
            }else{
                $totalMultiplier = $updateCMOShipment->shipment_weight;
            }

            $totalMultiplier = ceil($totalMultiplier);
            $updateCMOShipment->nominal = $totalMultiplier * $price;
            $updateCMOShipment->save();
        }

        $cmo->last_calculated_at = now();
        $cmo->save();
        $this->dispatch('alert-success', message: 'Calculated Has Been Finished.');
    }
    
    public function render()
    {
        return view('livewire.cmos.data-info',[
            'data' => $this->cmoService->findById($this->id),
        ]);
    }
}
