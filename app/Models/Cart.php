<?php
    namespace App\Models;
    class Cart{
        public $products=null;
        public function __construct($cart)
        {
            if($cart){
                $this->products=$cart->products;
            }
            
        }
        public function addCart($id,$product,$qty){
            $newproduct=['qty'=>0,'productinfo'=>null];
            if($this->products){
                if(array_key_exists($id,$this->products)){
                    $newproduct=$this->products[$id];
                }
            }
            $newproduct['qty']=$qty;
            $newproduct['productinfo']=$product;
            $this->products[$id]=$newproduct;
 

        }
        public function deleteCart($id){
            unset($this->products[$id]);
        }
        public function updateCart($id,$qty){
            // $product=['qty'=>0,'productinfo'=>null];
            if($this->products){
                if(array_key_exists($id,$this->products)){
                    $this->products[$id]['qty']=$qty;
                }
            }
        }
        public function __destruct()
        {
            
        }

    }
