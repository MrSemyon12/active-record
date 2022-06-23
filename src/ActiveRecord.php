<?php

namespace App;

use PDO;

class ActiveRecord
{
    private PDO $pdo;
    public Film $film;

    public function __construct()
    {
        $this->film = new Film();
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=mydb',
            'user123',
            'PASSWORD'
        );
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS films(id INT AUTO_INCREMENT, title VARCHAR(255), category VARCHAR(255), PRIMARY KEY(id))');
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM films';
        $tmp = $this->pdo->prepare($query);
        $tmp->execute();
        $data = $tmp->fetchAll();
        $objects = array();
        foreach ($data as $row){
            $this->film->setAll($row['id'], $row['title'], $row['category']);
            $objects[] = clone $this->film;
        }
        return $objects;
    }

    public function getById(): array
    {
        $query = 'SELECT * FROM films WHERE id = :id';
        $tmp = $this->pdo->prepare($query);
        $tmp->execute(['id' => $this->film->id]);
        $data = $tmp->fetchAll();
        $objects = array();
        if (!empty($data)) {
            foreach ($data as $row) {
                $this->film->setAll($row['id'], $row['title'], $row['category']);
                $objects[] = clone $this->film;
            }
        }
        else {
            echo 'Запись не найдена!';
        }
        return $objects;
    }

    public function getByField(): array
    {
        $query = 'SELECT * FROM films WHERE title = :field OR category = :field';
        $tmp = $this->pdo->prepare($query);
        $tmp->execute(['field' => $this->film->title]);
        $data = $tmp->fetchAll();
        $objects = array();
        if (!empty($data)) {
            foreach ($data as $row){
                $this->film->setAll($row['id'], $row['title'], $row['category']);
                $objects[] = clone $this->film;
            }
        }
        else {
            echo 'Запись не найдена!';
        }
        return $objects;
    }

    public function addRow(): void
    {
        $query = 'INSERT INTO films(title, category) VALUES(:title, :category)';
        $tmp = $this->pdo->prepare($query);
        $tmp->execute(['title' => $this->film->title, 'category' => $this->film->category]);
        echo 'Запись добавлена!';
    }

    public function deleteById(): void
    {
        $query = 'DELETE FROM films WHERE id = :id';
        $tmp = $this->pdo->prepare($query);
        $tmp->execute(['id' => $this->film->id]);
        if ($tmp->rowCount() == 0) {
            echo 'Запись не найдена!';
        } else {
            echo 'Запись удалена!';
        }
    }
}