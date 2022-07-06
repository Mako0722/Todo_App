<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\CategoriesDao;

$id = filter_input(INPUT_GET, 'id');

$Category_list  = new CategoriesDao();
$category = $Category_list->edit_form($id);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>
    <form action="edit.php" method="post">
        <div class="form-group">
        <input type="hidden" name="id" value=<?php echo $category['id']; ?>>
            <labe>カテゴリー登録</labe><br>
                <input type="text" name="name" class="form-control" value=<?php echo $category[
                    'name'
                ]; ?>>
            </div>
        </div>
        <button type="submit" value="カテゴリー" class="btn-primary" name="button">更新</button>
    </form>
