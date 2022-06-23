<?php
declare(strict_types=1);

namespace App;

class Film
{
    public int $id;
    public string $title;
    public string $category;

    public function __construct()
    {
    }

    public function setAll($id, $title, $category){
        $this->id = (int)$id;
        $this->title = $title;
        $this->category = $category;
    }
}