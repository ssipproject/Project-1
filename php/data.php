<?php
$conn = mysqli_connect("localhost", "root", "", "productdb");

$result = mysqli_query($conn, "SELECT * FROM product");

$data = array();
while ($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

echo json_encode($data);
?>
