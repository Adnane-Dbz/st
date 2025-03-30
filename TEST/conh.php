<?php

$servername = "127.0.0.1";  // أو جرّب "127.0.0.1"
$username = "root";  
$password = "1234";  
$dbname = "stock_management";
$port = 3307;  // استخدم المنفذ الصحيح هنا

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("❌ فشل الاتصال: " . $conn->connect_error);
}
echo "✅ تم الاتصال بقاعدة البيانات!";
?>
