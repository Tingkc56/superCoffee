<?php
echo 'hello world test';

try{
    $conn = new PDO('mysql:host=127.0.0.1:8888; dbname=supercoffee', 'root', '');

    echo "连接成功";
}catch (PDOException $e){
    echo $e->getMessage();
}finally{
    $conn = null;
    echo "关闭数据库连接";
}

// $waiters = $db->query('SELECT * from waiter')->fetchAll(PDO::FETCH_ASSOC);

?>