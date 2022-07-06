<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\TasksDao;


session_start();
$user_id = $_SESSION['formInputs']['userId'];
$task = filter_input(INPUT_POST, 'task');
$category_id = filter_input(INPUT_POST, 'category');
$deadline = filter_input(INPUT_POST, 'deadline');


$post_list = new TasksDao();
$post_list->create($user_id, $task, $category_id, $deadline);


header('Location: ../index.php');
exit();
?>
