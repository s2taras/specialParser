<?php

namespace Parser;

class ItemPageHandler extends PageHandler
{
    private $categoryTitle = '';

    public function __construct($url)
    {
        parent::__construct($url);
    }

    public function getCategoryTitle()
    {
        return $this->categoryTitle;
    }

    public function setCategoryTitle($categoryTitle)
    {
        if ($categoryTitle !== null) {
            $this->categoryTitle = $categoryTitle;
        }
    }

    public function getPriceString()
    {
        return preg_replace("/(<span.*|&nbsp;)/", "", $this->getPriceDirty());
    }

    public function getPriceInt()
    {
        return (int)preg_replace("/(<span.*|&nbsp;|[ ]{1,})/", "", $this->getPriceDirty());
    }

    protected function getPriceDirty()
    {
        return $this->getSimpleHtmlDom()->find('.b-product__price-holder .b-product__price', 0)->innertext;
    }

    public function getBigImageUrl()
    {
        return $this->getSimpleHtmlDom()->find('.b-centered-image.b-product__image', 0)->href;
    }

    public function getSmallImageUrl()
    {
        return $this->getSimpleHtmlDom()->find('.b-centered-image__img', 0)->src;
    }

    public function getTitle()
    {
        return $this->getSimpleHtmlDom()->find('.b-title_type_b-product', 0)->plaintext;
    }

    public function getDescription()
    {
        return $this->getSimpleHtmlDom()->find('.b-content__body.b-user-content', 0)->plaintext;
    }
}