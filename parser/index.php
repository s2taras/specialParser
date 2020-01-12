<?php

require_once './vendor/autoload.php';
require_once "simple_html_dom.php";

use Parser\ExcludedCategories;

$html = new simple_html_dom();

// Get main page
$html->load_file(getenv("MAIN_URL"));

// Select categories
$links = $html->find('.sidebar-menu__link');

// Exclude unnecessary categories
$excludedCategories = ExcludedCategories::getExcludedCategories();
$newListCategories = [];

foreach ($links as $linkCategory) {
    if (!array_key_exists($linkCategory->attr['href'], $excludedCategories)) {
        $newListCategories[] = $linkCategory;
    }
}