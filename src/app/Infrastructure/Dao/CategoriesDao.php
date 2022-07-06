<?php
namespace app\Infrastructure\Dao;

use PDO;

final class CategoriesDao
{
    /**
     * DBのテーブル名
     */
    const TABLE_NAME = 'categories';
    private $pdo;

    public function __construct()
    {
        try {
            $dbUserName = 'root';
            $dbPassword = 'password';
            $this->pdo = new PDO(
                'mysql:dbname=todo;host=mysql;charset=utf8',
                $dbUserName,
                $dbPassword
            );
        } catch (PDOException $e) {
            exit('DB接続エラー:' . $e->getMessage());
        }
    }

    public function ArticleList()
    {
        $sql = 'SELECT * FROM categories';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $category = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $category;
    }

    public function create(string $name, string $user_id)
    {

        $sql = sprintf(
            'INSERT INTO %s (name, user_id) VALUES (:name, :user_id)',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $statement->execute();
    }

    public function edit_form($id)
    {
        $sql = 'SELECT * FROM categories WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $category = $statement->fetch(PDO::FETCH_ASSOC);
        return $category ? $category : null;
    }

    public function edit($id, $name)
    {
        $sql = 'UPDATE categories SET name=:name WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categories where id = $id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }

}
