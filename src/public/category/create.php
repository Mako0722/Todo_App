<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\CategoriesDao;

session_start();
$user_id = $_SESSION['formInputs']['userId'];
$name = filter_input(INPUT_POST, 'name');

$making = new CategoriesDao();
$making->create($name, $user_id);


header('Location: ./index.php');
exit();
?>
