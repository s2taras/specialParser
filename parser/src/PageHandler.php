<?php

namespace Parser;

use simple_html_dom;

class PageHandler implements PageHandlerInterface
{
    private simple_html_dom $simpleHtmlDom;

    private string $url;

    /**
     * PageHandler constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->simpleHtmlDom = new simple_html_dom();
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return simple_html_dom
     */
    public function getSimpleHtmlDom(): simple_html_dom
    {
        return $this->simpleHtmlDom;
    }

    /**
     * @param simple_html_dom $simpleHtmlDom
     */
    public function setSimpleHtmlDom(simple_html_dom $simpleHtmlDom): void
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