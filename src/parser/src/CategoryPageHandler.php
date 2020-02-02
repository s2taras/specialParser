<?php

namespace Parser;

class CategoryPageHandler extends PageHandler
{
    /**
     * CategoryPageHandler constructor.
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
        return $this->getSimpleHtmlDom()->find('h1.b-title', 0)->plaintext;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->getSimpleHtmlDom()->find('.b-product-line')  ;
    }

    /**
     * @return mixed
     */
    public function hasNext()
    {
        return $this->getSimpleHtmlDom()->find('a.b-pager__link.b-pager__link_pos_last', 0);
    }
}