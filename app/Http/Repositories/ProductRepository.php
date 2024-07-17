<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Http\Traits\Apidesigntrait;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductRepository implements ProductInterface{
    use Apidesigntrait;
    public function add_product($request)
    {
        $validate = Validator::make($request->all() , [
            'name'=>'required|min:3',
            'price' => 'required|numeric',
            'stack' => 'required|numeric'
        ]);

        if ($validate->fails())
        {
            return $this->apiresponse(400 , 'failed to add product' , $validate->errors());
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stack' => $request->stack
        ]);
        return $this->apiresponse(200 , 'product added successfully');
    }

    public function get_product()
    {
        $product = Product::get();
        return $this->apiresponse(200 , 'product data' , null , $product);
    }

    public function find_product($request){
        $validate = Validator::make($request->all() , [
            'id' => 'required|numeric|exists:products,id'
        ]);

        if($validate->fails()){
            return $this->apiresponse(400 , 'failed to find product' , $validate->errors());
        }
        $product = Product::find($request->id);
        return $this->apiresponse(200 , 'product data' , null , $product);
    }

    public function update_product($request, $id)
    {

        $validate = Validator::make($request->all() , [
            'name'=>'required|min:3',
            'price' => 'required|numeric',
            'stack' => 'required|numeric'
            ]);

            if ($validate->fails())
            {
                return $this->apiresponse(400 , 'failed to update product' , $validate->errors());
            }

            $product = Product::find($id);

            if (!$product) {
                return $this->apiresponse(404, 'Product not found');
            }

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stack' => $request->stack
            ]);

            return $this->apiresponse(200, 'Product updated successfully', $product);

    }

    public function delete_product($request)
    {
        $validate = Validator::make($request->all() , [
            'id' => 'required|numeric|exists:products,id'
            ]);
            if ($validate->fails())
            {
                return $this->apiresponse(400 , 'failed to delete product' , $validate->errors());
            }
            $product = Product::find($request->id);

            $product->delete();
            return $this->apiresponse(200 , 'product deleted successfully');


    }
}
?>
