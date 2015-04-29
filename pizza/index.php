<!DOCTYPE html>
<html>
<!-- INCLUDE HEADER HERE -->


<head>
<script type="text/javascript" src="head.js"></script>
</head>
<body>
<h2>Xiaochen Zhuo's Pizza Shop</h2>
<p>I think it's a very bad idea to implement an online store using XML, 
and since I will learning MySQL latter I just made the simplest version that works.</p>
<p>I used SimpleXML to display the menu, Javascript and PHP to do the counting</p>
<h3 align="center" >Menu</h1>
<table border = "1" style="width:100%">
  <tr>
    <td>Name</td>
    <td>Price</td>		
    <td>Buy</td>
  </tr>
<!-- first we should read the xml menu and display it as a webpage -->
<?php
$xml=simplexml_load_file("pizza.xml") or die("Error: Cannot create object");
$i=0;
foreach($xml->children() as $item) {

	echo "  <tr><td>";
	echo $item["name"];
	echo "</td><td>";
	echo $item->price;
	echo "</td><td>";
	echo "<button type=\"button\" onClick=\"onClick$i()\">Add One</button>";
	echo "&nbsp&nbsp&nbsp";
	echo "<button type=\"button\" onClick=\"D$i()\">Remove One</button>";
	echo "Total: <a id=\"Total$i\">0</a>";
	echo "</td>";
	$i=$i+1;
	
}
?> 
</table>
<div align="center">
</div>

<script type="text/javascript">
    var clicks0 = clicks1 = clicks2 = clicks3 =0;
    var total = 0;
    function display() {
    	document.write("You've bought :");
		if (clicks0>0){
		document.write(clicks0+" Tomato");
		document.write("\n");}
		if (clicks1>0){
		document.write(clicks1+" Onion");
		document.write("\n");}
		if (clicks2>0){
		document.write(clicks2+" Pepper");
		document.write("\n");}
		if (clicks3>0){
		document.write(clicks3+" Hawaii");
		}
		document.write(" .\nTotal amount is: $");
		total = (clicks0*5.5+clicks1*6.85+clicks2*6.85+clicks3*7.95);
		document.write(total);
    };
    function onClick0() {
        clicks0 += 1;
        document.getElementById("Total0").innerHTML = clicks0;
    };
    function D0() {
    	if (clicks0>0){
        clicks0 -= 1;
        document.getElementById("Total0").innerHTML = clicks0;
        }
    };
    function onClick1() {
        clicks1 += 1;
        document.getElementById("Total1").innerHTML = clicks1;
    };
     function D1() {
       if (clicks1>0) {
        clicks1 -= 1;
        document.getElementById("Total1").innerHTML = clicks1;
        }
    };
    function onClick2() {
        clicks2 += 1;
        document.getElementById("Total2").innerHTML = clicks2;
    };
     function D2() {
        if (clicks2>0) {
        clicks2 -= 1;
        document.getElementById("Total2").innerHTML = clicks2;
        }
    };
    function onClick3() {
        clicks3 += 1;
        document.getElementById("Total3").innerHTML = clicks3;
    };
     function D3() {
        if (clicks3>0) {
        clicks3 -= 1;
        document.getElementById("Total3").innerHTML = clicks3;
    	}
    };

</script>
<button align="middle" type="button" onClick="display()">Checkout</button>
<br>
</body>
<!--INCLUDE FOOTER HERE -->
</html> 