<?php
namespace App\Http\Interfaces;

interface CartInterface{

    public function add_cart($request);
    public function get_cart();
    public function delete_from_cart($request);
}
?>