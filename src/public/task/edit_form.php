<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\TasksDao;

$id = filter_input(INPUT_GET, 'id');

$tasks = new TasksDao();
$task  = $tasks->edit_form($id);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="row justify-content-center">
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value=<?php echo $task['id']; ?>>
            <div class="form-group">
                <label>編集</label>
            </div>
            <div class="form-group">
                <label>タスク</label>
                <input type="text" name="contents" class="form-control" value=<?php echo $task[
                    'contents'
                ]; ?>>
            </div>
            <div class="form-group">
                <label>締め切り日</label>
                <input type="text" name="deadline" class="form-control" value=<?php echo $task[
                    'deadline'
                ]; ?>>
            </div>
            <div class="form-group">
                <label>カテゴリー</label>
                <input type="text" name="category_id" class="form-control" value=<?php echo $task[
                    'category_id'
                ]; ?>>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-primary" name="sava">更新</button>
            </div>
        </form>
    </div>
</body>
</html>
