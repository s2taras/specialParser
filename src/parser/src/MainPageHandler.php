<?php

namespace Parser;

class MainPageHandler extends PageHandler
{
    /**
     * MainPageHandler constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        parent::__construct($url);
    }

    /**
     * @return mixed
     */
    public function getCategoriesLinks()
    {
        return $this->getSimpleHtmlDom()->find('.sidebar-menu__link');
    }

    /**
     * @return array
     */
    public function getClearedCategoriesLinks(): array
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