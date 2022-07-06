<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\CategoriesDao;

$id = filter_input(INPUT_POST, 'id');
$name = filter_input(INPUT_POST, 'name');

$edit = new CategoriesDao();
$edit->edit($id, $name);

header('Location: ./index.php');
exit();
