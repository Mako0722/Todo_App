<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\TasksDao;

$id = filter_input(INPUT_POST, 'id');
$contents = filter_input(INPUT_POST, 'contents');
$deadline = filter_input(INPUT_POST, 'deadline');
$category_id = filter_input(INPUT_POST, 'category_id');

$update = new TasksDao();
$update->edit($id, $contents, $category_id, $deadline);

header('Location: ../index.php');
exit();
