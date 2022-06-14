<?php

namespace App;

use Twig\Environment;

class View
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invokeHeader()
    {
        $this->twig->display('header.twig');
    }

    public function __invokeTable($table)
    {
        $this->twig->display('table.twig', ['table' => $table]);
    }

    public function __invokeGetById()
    {
        $this->twig->display('getById.twig');
    }

    public function __invokeGetByField()
    {
        $this->twig->display('getByField.twig');
    }

    public function __invokeAddRow()
    {
        $this->twig->display('addRow.twig');
    }

    public function __invokeDeleteById()
    {
        $this->twig->display('deleteById.twig');
    }
}