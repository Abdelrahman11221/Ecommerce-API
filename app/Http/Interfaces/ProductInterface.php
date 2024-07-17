<?php
namespace App\Http\Interfaces;

interface ProductInterface{

    public function add_product($request);
    public function get_product();
    public function find_product($request);
    public function update_product($request , $id);
    public function delete_product($request);
}
?>
