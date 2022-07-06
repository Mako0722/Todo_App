<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\CategoriesDao;

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$delete = new CategoriesDao();
$delete->delete($id);

header('Location: ./index.php');
exit();
