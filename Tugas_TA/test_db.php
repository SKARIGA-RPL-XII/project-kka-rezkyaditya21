<?php
$host = 'aws-1-ap-southeast-1.pooler.supabase.com';
$port = '6543';
$db   = 'postgres';
$user = 'postgres.jxegvvsevlzajggoglwh';
$pass = 'SNzzScNP9CY48z2V';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";

try {
     $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
     echo "Koneksi Berhasil!\n";
} catch (PDOException $e) {
     echo "Koneksi Gagal: " . $e->getMessage() . "\n";
}
