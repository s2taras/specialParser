<?php

require_once './vendor/autoload.php';
require_once "simple_html_dom.php";

use Parser\CategoriesLoopHandler;
use Parser\MainPageHandler;

const MAIN_URL = "https://malinki.prom.ua/";


$mainPage = new MainPageHandler(MAIN_URL);
$mainPage->initLoadFile();
$links = $mainPage->getClearedCategoriesLinks();

// $testList[] = $links[1];
$categoriesLoop = new CategoriesLoopHandler($links);
$categoriesLoop->execute();
