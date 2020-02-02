<?php

namespace Parser;

class CategoryPageHandler extends PageHandler
{
    public function __construct($url)
    {
        parent::__construct($url);
    }

    public function getCategoryTitle()
    {
        return $this->getSimpleHtmlDom()->find('h1.b-title', 0)->plaintext;
    }

    public function getProducts()
    {
        return $this->getSimpleHtmlDom()->find('.b-product-line')  ;
    }

    public function hasNext()
    {
        return $this->getSimpleHtmlDom()->find('a.b-pager__link.b-pager__link_pos_last', 0);
    }
}