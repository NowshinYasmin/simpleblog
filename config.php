<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'simpleblog';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
session_start();

// Default language
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// Change language
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Load language file
$lang_code = $_SESSION['lang'];
include_once "lang/$lang_code.php";
