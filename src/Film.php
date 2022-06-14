<?php
declare(strict_types=1);

namespace App;

use PDO;

class Film
{
    private PDO $pdo;
    public int $id;
    public string $title;
    public string $category;

    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=mydb',
            'user123',
            'PASSWORD'
        );
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS films(id INT AUTO_INCREMENT, title VARCHAR(255), category VARCHAR(255), PRIMARY KEY(id))");
    }

    public function getAll()
    {
        $query = "SELECT * FROM films";
        $tmp = $this->pdo->prepare($query);
        $tmp->execute();
        return $this->pdo->query($query);
    }

    public function getById()
    {
        $query = "SELECT * FROM films WHERE id = $this->id";
        $tmp = $this->pdo->prepare($query);
        $tmp->execute();
        if ($tmp->fetchAll()){
            return $this->pdo->query($query);
        }
        else {
            echo '<br><label>Запись не найдена!</label>';
        }
    }

    public function getByField()
    {
        $query = "SELECT * FROM films WHERE title = '$this->title' OR category = '$this->category'";
        $tmp = $this->pdo->prepare($query);
        $tmp->execute();
        if ($tmp->fetchAll()){
            return $this->pdo->query($query);
        }
        else {
            echo '<br><label>Запись не найдена!</label>';
        }
    }

    public function addRow()
    {
        $query = "INSERT INTO films(title, category) VALUES('$this->title', '$this->category')";
        $tmp = $this->pdo->prepare($query);
        $tmp->execute();
        echo '<br><label>Запись добавлена!</label>';
    }

    public function deleteById()
    {
        $query = "DELETE FROM films WHERE id = $this->id";
        $tmp = $this->pdo->prepare($query);
        $tmp->execute();
        if ($tmp->rowCount() == 0) {
            echo '<br><label>Запись не найдена!</label>';
        } else {
            echo '<br><label>Запись удалена!</label>';
        }
    }
}