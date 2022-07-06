<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Infrastructure\Dao\CategoriesDao;

$sql = 'SELECT * FROM categories';

$post_list = new CategoriesDao();
$categories = $post_list->ArticleList();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 w-full h-screen flex justify-center items-center">
    <div class="bg-white pt-10 pb-10 px-10 rounded-xl">
        <div class="text-blue-600 mb-2">
            <a href="../category/index.php">カテゴリを追加</a><br>
        </div>

        <form action=create.php method=POST>
            <select name='category'>
                <option value="">カテゴリを選んでください</option>
                <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <input class='border-2 border-gray-300' type=text  id="contents" name="contents" placeholder=タスクを追加>
            <input class='border-2 border-gray-300' type=date id="deadline" name=deadline>
            <button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mb-5' type="submit">追加</button>
        </form>
        <a class="text-blue-600" href=../index.php>戻る</a>
    </div>
</body>
</html>
