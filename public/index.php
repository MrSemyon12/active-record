<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Film;
use App\View;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates/');
$twig = new Environment($loader);
$view = new View($twig);
$film = new Film();

$view->__invokeHeader();

if (isset($_GET['getAll'])) {
    $view->__invokeTable($film->getAll());
}

if (isset($_GET['getById'])) {
    $view->__invokeGetById();
}
if (isset($_GET['getIdButton'])) {
    $film->id = $_GET['getId'];
    if ($film->id != null) {
        $view->__invokeTable($film->GetById());
    }
}

if (isset($_GET['getByField'])) {
    $view->__invokeGetByField();
}
if (isset($_GET['getFieldButton'])) {
    $film->title = $_GET['field'];
    $film->category = $_GET['field'];
    if ($film->category != null) {
        $view->__invokeTable($film->getByField());
    }
}

if (isset($_GET['addRow'])) {
    $view->__invokeAddRow();
}
if (isset($_GET['addButton'])){
    $film->title = $_GET['title'];
    $film->category = $_GET['category'];
    if ($film->title != null && $film->category != null) {
        $film->addRow();
    }
}

if (isset($_GET['deleteById'])) {
    $view->__invokeDeleteById();
}
if (isset($_GET['deleteButton'])) {
    $film->id = $_GET['delId'];
    if ($film->id != null) {
        $film->deleteById();
    }
}
