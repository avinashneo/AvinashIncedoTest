<?php
/*
* The record class. Checking product name.
*/
class Record {
	private $record;

	public function __construct() {
		$this->record = array();
		
	}
        /**
	* add the product into the system.
	* @param string $productName the product's name to enter into system.		
	*
	*/
        public function addRecord($productName) {
		
            if (!$this->isInRecord($productName))
                $this->record[$productName] = new Products($productName);

	}
	/**
	* check the product into the system.
	* @param string $productName the product's name to enter into system.
	*
	* @return boolean True if the system is found the product		
	* @return boolean False if the system is not found the product
	*/
	public function isInRecord($productName) {
		return array_key_exists($productName, $this->record);
	}
        /**
	* get the product into the system.
	* @param string $productName the product's name to enter into system.
	*
	*
	*/
        public function get($productName) {
		if ($this->isInRecord($productName))
                        return $this->record[$productName]; 
	}
        /**
	* Adds the product into the system.
	* @param string $productName the product's name to enter into system.
	*
	* @return boolean True if the system was able to add the product into the system, 
	* @return boolean False if the system wasn't able to add the product.			
	*
	*/
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
