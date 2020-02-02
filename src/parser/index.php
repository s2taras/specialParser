<?php

require_once './vendor/autoload.php';
require_once "simple_html_dom.php";

use Parser\CategoriesLoopHandler;
use Parser\MainPageHandler;

// $pdo->beginTransaction();
// $pdo->commit();
// $pdo->rollback();

$mainPageUrl = getenv("MAIN_URL");

$mainPage = new MainPageHandler($mainPageUrl);
$mainPage->initLoadFile();
$links = $mainPage->getClearedCategoriesLinks();

$testList[] = $links[1];
$categoriesLoop = new CategoriesLoopHandler($testList);
$categoriesLoop->execute();