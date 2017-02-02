<?php

class Record {
	private $record;

	public function __construct() {
		$this->record = array();
		
	}
        
        public function addRecord($productName) {
		
            if (!$this->isInRecord($productName))
                $this->record[$productName] = new Products($productName);

	}
	
	public function isInRecord($productName) {
		return array_key_exists($productName, $this->record);
	}
        
        public function get($productName) {
		if ($this->isInRecord($productName))
                        return $this->record[$productName]; 
	}
        
        public function scan($productName) {
            
		if ($this->getProductFromRecord($productName)) {
                    	return True;
		} else{
                    return False;
                }
	}
        

	private function getProductFromRecord($productName) {
            
		return $this->get($productName);
	}
}
/*
* The product class. Contains basic information about product such as name.
*/
class Products {
	private $name;
	
	public function __construct($product_name) {
		$this->name = $product_name;
		
	}

	public function getName() {
		return $this->name;
	}
        
        public function setName($name) {
		return $this->name;
	}
}
?>