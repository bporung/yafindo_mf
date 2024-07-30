<?php

namespace App\Livewire\Reportdeliveryplans;

use Livewire\Component;
use App\Services\CustomerService;
use Livewire\WithFileUploads;
use App\Models\ReportDeliveryPlan;
use App\Models\ReportDeliveryPlanDetail;
use App\Models\Uom;
use App\Models\CustomerProduct;
use App\Models\Product;

class FormCreate extends Component
{
    use WithFileUploads;
    public $name;
    public $code;
    public $date;


    public $customer;
    public $filereport;
    public $csvData;

    public $validatePreview = '';

    public $results = [];

    public $selectCustomers = [];
    public $lockCustomer = false;


    protected $customerService;
    
    
    public function __construct()
    {
        
        $customerService = new CustomerService();
        $this->customerService = $customerService;
    }
    public function mount()
    {
        $this->selectCustomers = $this->customerService->allData();
    }
    public function updatedFilereport()
    {
        $this->validatePreview = '';
        $this->csvData = null;
        $this->processFile();
    }
    public function updatedCustomer()
    {
        $this->validatePreview = '';
        $this->filereport = null;
        $this->csvData = null;
        $this->results = [];
    }
    public function runLockCustomer(){
        if($this->customer != ''){
            $this->lockCustomer = true;
            $this->dispatch('alert-info', message: 'Customer Has Been Locked.');
        }else{
            $this->dispatch('alert-warning', message: 'Choose Customer Before Locking.');
        }
    }

    
    public function setCsvData()
    {
        $i = 0;
        $x = 0;
        $data = [];
        foreach($this->csvData as $row){
            $y=0;
            foreach($row as $col){
                if($i > 0){

                    $validate = true;

                    if($y==0){$validate = $this->isValidDate($col);}
                    if($y==1){$validate = $this->checkValidCode($col);}
                    if($y==3){$validate = is_numeric($col);}
                    if($y==4){$validate = $this->checkUomCode($col);}
                    if($y==5){$validate = is_numeric($col);}

                    $data[$x][$y] = ['value' => $col , 'isValid' => $validate];

                    if(!$validate){
                        $this->validatePreview = 'NOT_OK';
                    }else{
                        if(!$this->validatePreview == 'NOT_OK'){
                            $this->validatePreview == 'OK';
                        }
                    }
                }else{
                    $data[$x][$y] = ['value' => $col , 'isValid' => true];
                }
                $y++;
            }
            $i++;
            $x++;
        }

        $this->results = $data;
    }

    public function checkValidCode($val){
        $data = Product::where('code',$val)->count();
        if($data){
            return true;
        }
        return false;
    }
    public function lookUpProductId($val){
        $data = Product::where('code',$val)->first();
        if($data){
            return $data->id;
        }
        return false;
    }
    public function getCustomerProductId($val){
        $data = CustomerProduct::where('product_id',$val)->where('customer_id',$this->customer)->first();
        if($data){
            return $data->product_id;
        }
        return false;
    }
    public function checkUomCode($val){
        $data = Uom::where('code',$val)->count();
        if($data){
            return true;
        }
        return false;
    }

    public function isValidDate($date, $format = 'Y-m-d') {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function processFile()
    {
        $validatedData = $this->validate([
            'filereport' => 'required|max:2048',
        ]);

        if ($this->filereport) {
            $path = $this->filereport->storeAs('temp', $this->filereport->getClientOriginalName());

            // Read the CSV file
            if (($handle = fopen(storage_path('app/' . $path), 'r')) !== false) {
                while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                    $this->csvData[] = $data;
                }
                fclose($handle);

                // Optionally, delete the temporary file after reading
                \Storage::delete($path);

                $this->setCsvData();
            }
        }

        $this->dispatch('alert-success', message: 'Preview File.');
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'customer' => 'required',
            'date' => 'required',
            'filereport' => 'required|max:2048',
        ]);
        $file_name = $this->filereport->getClientOriginalName();
        $path = $this->filereport->store('reportdeliveryplans', 'public');
        if(!$path){
            $this->dispatch('alert-error', message: 'Failed to save file. Please try again.');
            return;
        }

        $parentfile = new ReportDeliveryPlan;
        $parentfile->customer_id = $this->customer;
        $parentfile->date = $this->date;
        $parentfile->file_name = $file_name;
        $parentfile->path = $path;
        $parentfile->save();

        
        $i = 0;
        foreach($this->results as $row){
            if($i == 0){$i++;continue;}

            $date = $row[0]['value'];
            $product_code = $row[1]['value'];
            $product_id = $this->lookUpProductId($product_code);
            $uom = $row[4]['value'];
            $qty = $row[3]['value'];

            $detail = new ReportDeliveryPlanDetail;
            $detail->reportdeliveryplan_id = $parentfile->id;
            $detail->date = $date;
            $detail->product_id = $product_id;
            $detail->customer_product_id = $this->getCustomerProductId($product_id);
            $detail->uom = $uom;
            $detail->qty = $qty;
            $detail->save();

        }
        
        
        $this->dispatch('alert-success', message: 'Form has been saved.');
        

    }

    public function render()
    {
        return view('livewire.reportdeliveryplans.form-create');
    }
}
