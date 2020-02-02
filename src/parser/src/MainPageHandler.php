<?php

namespace Parser;

class MainPageHandler extends PageHandler
{
    public function __construct($url)
    {
        parent::__construct($url);
    }

    public function getCategoriesLinks()
    {
        return $this->getSimpleHtmlDom()->find('.sidebar-menu__link');
    }

    public function getClearedCategoriesLinks()
    {
        $result = [];
        $links = $this->getCategoriesLinks();
        $excludedCategories = ExcludedCategories::getExcludedCategories();

        foreach ($links as $linkCategory) {
            if (!array_key_exists($linkCategory->href, $excludedCategories)) {
                $result[] = $linkCategory;
            }
        }

        return $result;
    }
}