<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Services\ProductService;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\UomService;

class FormEdit extends Component
{

    public $id;
    public $name;
    public $code;
    public $brand;
    public $category;
    public $nickname;

    public $varian;
    public $description;
    public $width;
    public $height;
    public $weight;
    public $depth;
    public $first_uom;
    public $second_uom;
    public $third_uom;
    public $fourth_uom;

    public $convert_first_to_fourth;
    public $convert_second_to_fourth;
    public $convert_third_to_fourth;

    public $selectBrands = [];
    public $selectCategories = [];
    public $selectUoms = [];

    
    public $uomMappingIds = [];

    protected $productService;
    protected $brandService;
    protected $categoryService;
    protected $uomService;


    public function __construct()
    {
        $productService = new ProductService();
        $brandService = new BrandService();
        $categoryService = new CategoryService();
        $uomService = new UomService();
        $this->productService = $productService;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
        $this->uomService = $uomService;
    }
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->productService->findById($id);

        $this->selectBrands = $this->brandService->allData();
        $this->selectCategories = $this->categoryService->allData();
        $this->selectUoms = $this->uomService->allData();

        $this->name = $data->name;
        $this->code = $data->code;
        $this->nickname = $data->nickname;
        $this->brand = $data->brand_id;
        $this->category = $data->category_id;
    
        $this->varian = $data->varian;
        $this->description = $data->description;
        $this->width = $data->width;
        $this->height = $data->height;
        $this->weight = $data->weight;
        $this->depth = $data->depth;
        $this->first_uom = $data->first_uom_id;
        $this->second_uom = $data->secondary_uom_id;
        $this->third_uom = $data->third_uom_id;
        $this->fourth_uom = $data->fourth_uom_id;
    
        $this->convert_first_to_fourth = $data->convert_first_to_fourth;
        $this->convert_second_to_fourth = $data->convert_second_to_fourth;
        $this->convert_third_to_fourth = $data->convert_third_to_fourth;

        $this->mappingUomBaseOnId();
    }
    public function mappingUomBaseOnId()
    {
        foreach($this->selectUoms as $uom){
            $this->uomMappingIds[$uom->id] = $uom->code;
        }

    }


    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:products,code,' . $this->id,
            'brand' => 'required',
            'category' => 'required',
            'nickname' => 'required|string|max:125',
            'varian' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'width' => 'required|numeric',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'depth' => 'required|numeric',
            'first_uom' => 'required',
            'second_uom' => 'required',
            'third_uom' => 'required',
            'fourth_uom' => 'required',
            'convert_first_to_fourth' => 'required|numeric',
            'convert_second_to_fourth' => 'required|numeric',
            'convert_third_to_fourth' => 'required|numeric',
        ]);
        $validatedData['first_uom_id'] = $validatedData['first_uom'];
        $validatedData['secondary_uom_id'] = $validatedData['second_uom'];
        $validatedData['third_uom_id'] = $validatedData['third_uom'];
        $validatedData['fourth_uom_id'] = $validatedData['fourth_uom'];
        $validatedData['brand_id'] = $validatedData['brand'];
        $validatedData['category_id'] = $validatedData['category'];
        
        unset($validatedData['first_uom']);
        unset($validatedData['second_uom']);
        unset($validatedData['third_uom']);
        unset($validatedData['fourth_uom']);
        unset($validatedData['brand']);
        unset($validatedData['category']);

        $updatedData = $this->productService->updateData($this->id,$validatedData);

        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.products.form-edit');
    }
}
