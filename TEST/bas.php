<?php
$name = "مخزن المنتجات";
$items = 50;
$price = 19.99;
$isAvailable = true;

echo "اسم المخزن: $name<br>";
echo "اسم المخزن: $name<br>";
echo "اسم المخزن: $price<br>";
echo "عدد المنتجات: $items<br>";
?>
<?php
define("STORE_NAME", "إدارة المخزن");
echo STORE_NAME;
?>

<?php
$stock = 10;

if ($stock > 0) {
    echo "المنتج متوفر";
} elseif ($stock == 0) {
    echo "المنتج غير متوفر";
} else {
    echo "خطأ في البيانات";
}


echo ($stock > 0) ? "متوفر" : "غير متوفر";
?>
<?php
for ($i = 1; $i <= 5; $i++) {
    echo "منتج رقم $i <br>";
}
?>
<?php
$count = 3;
while ($count > 0) {
    echo "منتج متبقي: $count <br>";
    $count--;
}
?>
<?php
$products = ["حاسوب", "هاتف", "لوحة مفاتيح"];
foreach ($products as $product) {
    echo "منتج: $product <br>";
}
?>
<?php
$items = ["تفاح", "موز", "برتقال"];
echo $items[1]; // موز
?>
<?php
$products = [
    ["اسم" => "حاسوب", "السعر" => 1000],
    ["اسم" => "هاتف", "السعر" => 500]
];

echo "اسم المنتج: " . $products[0]["اسم"];
?>
<?php
function calculateTotal($price, $quantity) {
    return $price * $quantity;
}

echo calculateTotal(10, 3); // 30
?>
