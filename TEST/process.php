<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["product_name"]);// trim pour emiminer les espaces
    $price = floatval($_POST["price"]);//floatval pour 
   //$username = htmlspecialchars($_POST["username"]); هذا يمنع تشغيل أي كود JavaScript يتم إدخاله في الحقول.
    if (empty($name) || $price <= 0) {
        echo "خطأ: تأكد من إدخال بيانات صحيحة!";
    } else {
        echo "تم استلام المنتج: $name بسعر $price";
    }
} else {
    echo "طريقة الوصول غير صحيحة!";
}

?>
<?php/* 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = isset($_GET["product_name"]) ? trim($_GET["product_name"]) : "غير معروف";
    $price = isset($_GET["price"]) ? floatval($_GET["price"]) : 0;

    echo "تم استلام المنتج عبر GET: $name بسعر $price";
}*/
?>
