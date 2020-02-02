<?php

namespace Parser;

use simple_html_dom;

class PageHandler implements PageHandlerInterface
{
    private $simpleHtmlDom;

    private $url;

    public function __construct($url)
    {
        $this->simpleHtmlDom = new simple_html_dom();
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getSimpleHtmlDom()
    {
        return $this->simpleHtmlDom;
    }

    public function setSimpleHtmlDom($simpleHtmlDom)
    {
        $this->simpleHtmlDom = $simpleHtmlDom;
    }

    public function initLoadFile()
    {
        $this->getSimpleHtmlDom()->load_file($this->getUrl());
    }

    public function clearFile()
    {
        $this->getSimpleHtmlDom()->clear();
    }
}