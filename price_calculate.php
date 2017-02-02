<?php
include 'products_record.php';
class CalculatePrice
{
    private $record;
    private $product_record;
    
    public function __construct($val)
    {
        $this->record=$val;
        $this->product_record = new Record();
    }
    
   
    public function calculatedPrice($product)
    {
        
        if(!empty($product) && trim($product)!='')
        {
            $productArray=array();
            $productArray['A']=0;
            $productArray['B']=0;
            $productArray['C']=0;
            $productArray['D']=0;
            for($i=0;$i<  strlen($product);$i++){
                switch($product[$i]){
                    case 'A':
                        $productArray['A']=$productArray['A']+1;
                        break;
                    case 'B':
                        $productArray['B']=$productArray['B']+1;
                        break;
                    case 'C':
                        $productArray['C']=$productArray['C']+1;
                        break;
                    case 'D':
                        $productArray['D']=$productArray['D']+1;
                        break;
                    
                } 
            }
            $productCost=0;
            foreach($productArray as $productName=>$price){
                $this->product_record->addRecord($productName);
                $chunked=$this->calculateQuantity($productName,$price);
                foreach($chunked as $quantity=>$price){ 
                    $productCost=$productCost+$this->record[$productName][$quantity]*$price;
                   
                }
            }
           
            return $productCost;
            
        }else{
            return '0';
        }
    }
    
    public function scanProduct($productName){
         return $this->product_record->scan($productName);
    }
    
    public function calculateQuantity($product,$quantity){ 
        $prices=$this->record[$product];
        $priceKeys=  array_keys($prices);
        sort($priceKeys);
        $priceKeys=  array_reverse($priceKeys);
        $datatoreturn=array();$modval='';
        foreach($priceKeys as $newQuantity){
            #echo $quantity."===".$newQuantity.'<br/>';
            if($quantity>=$newQuantity && $newQuantity!=1){ 
                $modval=$quantity%$newQuantity;
                $total=floor($quantity/$newQuantity);
                if(!isset($datatoreturn[$newQuantity])){
                    $datatoreturn[$newQuantity]=0;
                }
                $datatoreturn[$newQuantity]=$datatoreturn[$newQuantity]+$total;
                $quantity=$modval;
            }
            if($newQuantity==1){
                if(!isset($datatoreturn[$newQuantity])){
                    $datatoreturn[$newQuantity]=0;
                }
                #echo $quantity;exit;
                $datatoreturn[$newQuantity]=$datatoreturn[$newQuantity]+$quantity;
                $quantity=$modval;
            }
            
          
        }
         return $datatoreturn;
        
    }
    
}


?>
