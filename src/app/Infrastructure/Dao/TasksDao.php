<?php
namespace app\Infrastructure\Dao;

use PDO;
/**
 * ユーザー情報を操作するDAO
 */
final class TasksDao
{
    /**
     * DBのテーブル名
     */
    const TABLE_NAME = 'tasks';
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

    public function OrderSearchList($tasks, $status, $searchWord, $direction, $category_id){
        $sql = " SELECT * FROM tasks,
                tasks.contents
                , tasks.deadline
                , categories.name AS category_name
                , CASE
                    tasks.status
                    WHEN 0 THEN 未完了
                    WHEN 1 THEN 完了
                    END AS status
                FROM
                    tasks
                JOIN categories
                    ON tasks.category_id = categories.id
                WHERE
                    tasks.contents LIKE :contents
                AND
                    $status
                    $category_id
                ORDER BY
                    tasks.id $direction";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':contents', '%' . $searchWord . '%', PDO::PARAM_STR);
        $statement->execute();
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $tasks ;
    }



    public function create($user_id, $task, $category_id, $deadline)
    {
    $sql = sprintf(
            'INSERT INTO %s (user_id, contents, category_id, deadline) VALUES (:user_id, :contents, :category_id, :deadline)',
            self::TABLE_NAME
    );
    // $sql = 'INSERT INTO tasks(user_id, contents, category_id, deadline) VALUES (:user_id, :contents, :category_id, :deadline)';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindValue(':contents', $task, PDO::PARAM_STR);
    $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    $statement->bindValue(':deadline', $deadline, PDO::PARAM_STR);
    $statement->execute();
    }




    public function edit_form($id)
    {
        $sql = 'SELECT * FROM tasks WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $task = $statement->fetch(PDO::FETCH_ASSOC);
        return $task ? $task : null;
    }

    public function edit($id, $contents, $category_id, $deadline)
    {
        $sql =
        'UPDATE tasks SET contents=:contents, category_id=:category_id, deadline=:deadline  WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':contents', $contents, PDO::PARAM_STR);
        $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $statement->bindParam(':deadline', $deadline, PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tasks where id = $id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }

}
