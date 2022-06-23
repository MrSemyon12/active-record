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

    public function showHeader()
    {
        $this->twig->display('header.twig');
    }

    public function showTable($table)
    {
        $this->twig->display('table.twig', ['table' => $table]);
    }

    public function showGetById()
    {
        $this->twig->display('getById.twig');
    }

    public function showGetByField()
    {
        $this->twig->display('getByField.twig');
    }

    public function showAddRow()
    {
        $this->twig->display('addRow.twig');
    }

    public function showDeleteById()
    {
        $this->twig->display('deleteById.twig');
    }
}