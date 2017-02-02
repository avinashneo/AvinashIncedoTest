<!DOCTYPE html>
<html>
<head>
  <title>php demo</title>
  
  <style type="text/css">
    span.bold-red {
       color: red;
       font-weight: bold;
   }
</style>
</head>
<body>
  <h1>Question</h1>
  <pre>Consider a store where items have prices per unit but also volume
prices. For example, apples may be $1.00 each or 4 for $3.00.

Implement a point-of-sale scanning API that accepts an arbitrary
ordering of products (similar to what would happen at a checkout line)
and then returns the correct total price for an entire shopping cart
based on the per unit prices or the volume prices as applicable.

Here are the products listed by code and the prices to use (there is
no sales tax):
Product Code | Price
--------------------
A            | $2.00 each or 4 for $7.00
B            | $12.00
C            | $1.25 or $6 for a six pack
D            | $0.15

There should be a top level point of sale terminal service object that
looks something like the pseudo-code below. You are free to design and
implement the rest of the code however you wish, including how you
specify the prices in the system:

terminal->setPricing(...)
terminal->scan("A")
terminal->scan("C")
... etc.
result = terminal->total

Here are the minimal inputs you should use for your test cases. These
test cases must be shown to work in your program:

Scan these items in this order: ABCDABAA; Verify the total price is $32.40.
Scan these items in this order: CCCCCCC; Verify the total price is $7.25.
Scan these items in this order: ABCD; Verify the total price is $15.40.

</pre>

<script>
    function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }
</script>
<h1>Your answer can use the form below</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <input type="text" name="product_txt" onkeypress="return onlyAlphabets(event,this);" />
  <button type="submit" name="submit">Submit</button>
</form>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['submit'])){
    $products = $_POST["product_txt"];
    if (preg_match("/^[A-Za-z]+$/", $products)) {
        
        require_once 'price_calculate.php';
        // Initialize product record       
        $assignedArray=array();
        $assignedArray['A'][1]=2;
        $assignedArray['A'][4]=7;
        $assignedArray['B'][1]=12;
        $assignedArray['C'][1]=1.25;
        $assignedArray['C'][6]=6;
        $assignedArray['D'][1]=0.15;
        // Initialize CalculatePrice objects.
        $classObj=new CalculatePrice($assignedArray);
        $result= $classObj->calculatedPrice($products);

        for ($i = 0; $i < strlen($products); $i++) {

                    if ($products[$i] != " ")
                            $scannable = $classObj->scanProduct($products[$i]);

                    if (!$scannable)
                            echo "Unable to found price for: " . $products[$i] . "<br>";
            }


        echo "<span class='bold-red'>The total cost of: " . $products . " is: $".number_format($result, 2, '.', '')."</span>";
    }else{
        echo "<span class='bold-red'>Only alphabets are allowed.</span>";
    }

}
?>
</body>
</html>