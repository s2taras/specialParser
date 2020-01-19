<?php

namespace Parser;

class CategoriesLoopHandler
{
    private array $htmlListCategories;

    private string $mainUrl;

    /**
     * CategoriesLoopHandler constructor.
     * @param array $htmlListCategories
     */
    public function __construct(array $htmlListCategories)
    {
        $this->htmlListCategories = $htmlListCategories;
        $this->mainUrl = getenv('MAIN_URL');
    }

    /**
     * @return array
     */
    public function getHtmlListCategories(): array
    {
        return $this->htmlListCategories;
    }

    /**
     * @param array $htmlListCategories
     */
    public function setHtmlListCategories(array $htmlListCategories): void
    {
        $this->htmlListCategories = $htmlListCategories;
    }

    /**
     * @return string
     */
    public function getMainUrl()
    {
        return $this->mainUrl;
    }

    /**
     * @param string $mainUrl
     */
    public function setMainUrl($mainUrl): void
    {
        $this->mainUrl = $mainUrl;
    }

    public function execute()
    {
        foreach ($this->getHtmlListCategories() as $category) {
            $this->executeCategoryPage($this->getMainUrl() . $category->href);
        }
    }

    protected function executeCategoryPage(string $url)
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
        }

        if($nextPage = $categoryPage->hasNext()) {
            $nextPageUrl = $this->mainUrl . $nextPage->href;
            $this->executeCategoryPage($nextPageUrl);
        }
    }

    /**
     * @param $categoryProductItem
     * @return bool
     */
    protected function isAvailable($categoryProductItem): bool
    {
        $productStatus = $categoryProductItem->find('.b-product-line__state', 0)->innertext;
        if ($productStatus == 'Нет в наличии' || $productStatus == 'Ожидается') {
            return false;
        }

        return true;
    }

    /**
     * @param $categoryProductItem
     * @return string
     */
    protected function getItemUrl($categoryProductItem): string
    {
        return $categoryProductItem->find('.b-centered-image.b-product-line__image-wrapper', 0)->href;
    }

    /**
     * @param $categoryProductItem
     * @return int
     */
    protected function getProductId($categoryProductItem): int
    {
        return $categoryProductItem->attr['data-product-id'];
    }
}