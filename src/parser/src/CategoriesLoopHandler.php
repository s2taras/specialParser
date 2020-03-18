<?php

namespace Parser;

use Exception;
use Parser\PDO\PDOCategory;
use Parser\PDO\PDOProduct;
use Parser\PDO\PDOSingleton;

class CategoriesLoopHandler
{
    private $htmlListCategories;
    private $mainUrl;
    private $pdo;
    private $pdoCategory;
    private $pdoProduct;

    public function __construct($htmlListCategories)
    {
        $this->htmlListCategories = $htmlListCategories;
        $this->mainUrl = MAIN_URL;
        $this->pdo = PDOSingleton::getInstance();
        $this->pdoCategory = new PDOCategory();
        $this->pdoProduct = new PDOProduct();
    }

    public function getHtmlListCategories()
    {
        return $this->htmlListCategories;
    }

    public function getMainUrl()
    {
        return $this->mainUrl;
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function getPDOCategory()
    {
        return $this->pdoCategory;
    }

    public function getPDOProduct()
    {
        return $this->pdoProduct;
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

        $categoryId = $this->getPDOCategory()->findCategoryIdByName($categoryTitle);
        if ($categoryId === null) {
            $this->getPDOCategory()->createCategory($categoryTitle);
            $categoryId = $this->getPDOCategory()->findLastCreatedCategoryId();
            $this->getPDOCategory()->createCategoryDescription($categoryTitle, $categoryId);
            $this->getPDOCategory()->createCategoryToStore($categoryId);
        }

        foreach ($categoryPage->getProducts() as $categoryProductItem) {
            if (!$this->isAvailable($categoryProductItem)) {
                continue;
            }

            try {
                $this->getPdo()->beginTransaction();
                $itemPage = new ItemPageHandler($this->getItemUrl($categoryProductItem));
                $itemPage->initLoadFile();

                $itemPage->setCategoryTitle($categoryTitle);
                $productId = $this->getProductId($categoryProductItem);
                $priceString = $itemPage->getPriceString();
                $priceInt = $itemPage->getPriceInt();
                $bigImageUrl = $itemPage->getBigImageUrl();
                $smallImageUrl = $itemPage->getSmallImageUrl();
                $productModel = $itemPage->getTitle();
                $productDescription = $itemPage->getDescription();

                $this->getPDOProduct()->createProduct($productModel, $productId, $priceInt);
                $createdProductId = $this->getPDOProduct()->findLastCreatedProductId();
                $this->getPDOProduct()->createProductToCategory($categoryId, $createdProductId);
                $this->getPDOProduct()->createProductToStore(0, $createdProductId);
                $this->getPDOProduct()->createProductDescription(
                    $productModel, $productDescription, '', $productModel, $productModel, $productModel, $productModel, $createdProductId
                );
                $this->getPDOProduct()->parseAndUpdateProductImage($bigImageUrl, 1, $createdProductId);
                $this->getPDOProduct()->parseAndUpdateProductImage($smallImageUrl, 1, $createdProductId);

                $this->log($categoryTitle, $productModel);
            } catch (Exception $ex) {
                $this->getPdo()->rollback();
                throw $ex;
            }

            $this->getPdo()->commit();
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

    protected function log($categoryTitle, $productModel)
    {
        $log = "Category: {$categoryTitle}" . PHP_EOL .
            "Product: {$productModel}" . PHP_EOL .
            "------------------------" . PHP_EOL;
        file_put_contents('./progress_log.log', $log, FILE_APPEND);
    }
}