<?php
include "../Personn.class.php";
include "../Customer.class.php";


$customer = new Customer("titi","tata", DateTime:: createFromFormat("j-m-Y", '23-04-1988'), "20 rue de paris");
var_dump($customer);