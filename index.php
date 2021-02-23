<?php
echo "hello";

require('vendor/autoload.php');

if($_SERVER['HTTP_HOST'] !="supercoffee.herokuapp.com/"){
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();}

$path="mysql:host=".$_ENV['DB_DNS'].";dbname=".$_ENV['DB_NAME'].";port=".$_ENV['DB_port'];
try{
   $db = new PDO($path,$_ENV['DB_USER'],$_ENV['DB_PASS']);
    echo "connected";
}   catch (PDOException $e){
    echo "not connected error:" .$e->getMessage();
}

$jojos = $db->query('SELECT * from waiter');

foreach($jojos as $jojo){
    echo $jojo['name'];
}


$sqlRec = 'SELECT w.name as name, format(sum(price),2) as turnover  
                    FROM orders as o
                    inner join ordersfood as of on o.id=of.idOrders
                    inner join fooditem as f on f.id=of.idFood
                    inner join waiter as w on o.idWaiter = w.id
                    group by w.id ';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>superCoffee</title>
</head>
<body>
<main>
<table>
<thead>
    <tr>
        <th>NOM</th>
        <th>CA</th>
    </tr>
</thead>
<tbody>
<?php
         foreach($db->query($sqlRec) as $waiter){
             echo "<tr>";
         echo "<td>".$waiter['name']."</td>";
         echo "<td>".$waiter['turnover']."</td>";  
         echo "</tr>";   
         };
         ?> 
</tbody>
</table>
    
</main>
    
</body>
</html>