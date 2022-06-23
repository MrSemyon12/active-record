<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\ActiveRecord;
use App\View;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates/');
$twig = new Environment($loader);
$view = new View($twig);
$AR = new ActiveRecord();

$view->showHeader();

if (isset($_GET['getAll'])) {
    $view->showTable($AR->getAll());
}

if (isset($_GET['getById'])) {
    $view->showGetById();
}
if (isset($_GET['getIdButton'])) {
    if ($_GET['getId'] != null) {
        $AR->film->id = (int)$_GET['getId'];
        $view->showTable($AR->GetById());
    }
}

if (isset($_GET['getByField'])) {
    $view->showGetByField();
}
if (isset($_GET['getFieldButton'])) {
    if ($_GET['field'] != null) {
        $AR->film->title = $_GET['field'];
        $AR->film->category = $_GET['field'];
        $view->showTable($AR->getByField());
    }
}

if (isset($_GET['addRow'])) {
    $view->showAddRow();
}
if (isset($_GET['addButton'])){
    if ($_GET['title'] != null && $_GET['category'] != null) {
        $AR->film->title = $_GET['title'];
        $AR->film->category = $_GET['category'];
        $AR->addRow();
    }
}

if (isset($_GET['deleteById'])) {
    $view->showDeleteById();
}
if (isset($_GET['deleteButton'])) {
    if ($_GET['delId'] != null) {
        $AR->film->id = (int)$_GET['delId'];
        $AR->deleteById();
    }
}
