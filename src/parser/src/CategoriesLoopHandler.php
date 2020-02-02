<?php

namespace Parser;

use Exception;

class CategoriesLoopHandler
{
    private $htmlListCategories;

    private $mainUrl;

    public function __construct($htmlListCategories)
    {
        $this->htmlListCategories = $htmlListCategories;
        $this->mainUrl = MAIN_URL;
    }

    public function getHtmlListCategories()
    {
        return $this->htmlListCategories;
    }

    public function setHtmlListCategories($htmlListCategories)
    {
        $this->htmlListCategories = $htmlListCategories;
    }

    public function getMainUrl()
    {
        return $this->mainUrl;
    }

    public function setMainUrl($mainUrl)
    {
        $this->mainUrl = $mainUrl;
    }

    public function execute()
    {
        foreach ($this->getHtmlListCategories() as $category) {
            try {
                $this->executeCategoryPage($this->getMainUrl() . $category->href);
            } catch (Exception $ex) {
                $log  = "Error code: {$ex->getCode()}".PHP_EOL.
                    "Message: {$ex->getMessage()}".PHP_EOL.
                    "-------------------------".PHP_EOL;
                file_put_contents('./error_log_file.log', $log, FILE_APPEND);
            }
        }
    }

    protected function executeCategoryPage($url)
    {
        $categoryPage = new CategoryPageHandler($url);
        $categoryPage->initLoadFile();
        $categoryTitle = $categoryPage->getCategoryTitle();

        foreach ($categoryPage->getProducts() as $categoryProductItem) {
            if (!$this->isAvailable($categoryProductItem)) {
                continue;
            }

            $itemPage = new ItemPageHandler($this->getItemUrl($categoryProductItem));
            $itemPage->initLoadFile();

            $itemPage->setCategoryTitle($categoryTitle);
            $productId = $this->getProductId($categoryProductItem);
            $priceString = $itemPage->getPriceString();
            $priceInt = $itemPage->getPriceInt();
            $bigImageUrl = $itemPage->getBigImageUrl();
            $smallImageUrl = $itemPage->getSmallImageUrl();
            $title = $itemPage->getTitle();
            $description = $itemPage->getDescription();

            $log  = "Category: {$categoryTitle}".PHP_EOL.
                    "Product: {$title}".PHP_EOL.
                    "------------------------".PHP_EOL;
            file_put_contents('./progress_log.log', $log, FILE_APPEND);
        }

        if($nextPage = $categoryPage->hasNext()) {
            $nextPageUrl = $this->mainUrl . $nextPage->href;
            $this->executeCategoryPage($nextPageUrl);
        }
    }

    protected function isAvailable($categoryProductItem)
    {
        $productStatus = $categoryProductItem->find('.b-product-line__state', 0)->innertext;
        if ($productStatus == 'Нет в наличии' || $productStatus == 'Ожидается') {
            return false;
        }

        return true;
    }

    protected function getItemUrl($categoryProductItem)
    {
        return $categoryProductItem->find('.b-centered-image.b-product-line__image-wrapper', 0)->href;
    }

    protected function getProductId($categoryProductItem)
    {
        return $categoryProductItem->attr['data-product-id'];
    }
}