<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Validators\ValidationException;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    public $row_number;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $this->row_number++;
        // dd($row);
        return new Product([
            'name' => $row['product_name'],
            'price' => $row['product_price'],
            'stack' => $row['product_stock']
        ]);
    }

    public function fail($key , $error , $row){
        $failure[] = new Failure($this->row_number , $key , $error , $row);
        throw new ValidationException(ValidationValidationException::withMessages($error) , 
            $failure
        );
    }

    public function rules(): array
    {
        return [
            'product_name' => 'required|string|min:3',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer',
        ];
    }
}
