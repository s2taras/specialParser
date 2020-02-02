<?php

namespace Parser;

class ItemPageHandler extends PageHandler
{
    private string $categoryTitle = '';

    /**
     * ItemPageHandler constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        parent::__construct($url);
    }

    /**
     * @return string
     */
    public function getCategoryTitle(): string
    {
        return $this->categoryTitle;
    }

    /**
     * @param null|string $categoryTitle
     */
    public function setCategoryTitle(?string $categoryTitle): void
    {
        if ($categoryTitle !== null) {
            $this->categoryTitle = $categoryTitle;
        }
    }

    /**
     * @return string
     */
    public function getPriceString(): string
    {
        return preg_replace("/(<span.*|&nbsp;)/", "", $this->getPriceDirty());
    }

    /**
     * @return int
     */
    public function getPriceInt(): int
    {
        return (int)preg_replace("/(<span.*|&nbsp;|[ ]{1,})/", "", $this->getPriceDirty());
    }

    /**
     * @return string
     */
    protected function getPriceDirty(): string
    {
        return $this->getSimpleHtmlDom()->find('.b-product__price-holder .b-product__price', 0)->innertext;
    }

    /**
     * @return string
     */
    public function getBigImageUrl(): string
    {
        return $this->getSimpleHtmlDom()->find('.b-centered-image.b-product__image', 0)->href;
    }

    /**
     * @return string
     */
    public function getSmallImageUrl(): string
    {
        return $this->getSimpleHtmlDom()->find('.b-centered-image__img', 0)->src;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getSimpleHtmlDom()->find('.b-title_type_b-product', 0)->plaintext;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getSimpleHtmlDom()->find('.b-content__body.b-user-content', 0)->plaintext;
    }
}