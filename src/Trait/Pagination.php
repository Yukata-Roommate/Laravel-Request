<?php

namespace YukataRm\Laravel\Request\Trait;

/**
 * Pagination Trait
 * 
 * @package YukataRm\Laravel\Request\Trait
 */
trait Pagination
{
    /**
     * page
     * 
     * @var int
     */
    protected int $page;

    /**
     * page item limit
     * 
     * @var int
     */
    protected int $pageItemLimit;

    /**
     * start position
     * 
     * @var int
     */
    protected int $startPosition;


    /**
     * get page
     * 
     * @return int
     */
    public function page(): int
    {
        return isset($this->page) ? $this->page : 1;
    }

    /**
     * get page item limit
     * 
     * @return int
     */
    public function pageItemLimit(): int
    {
        return isset($this->pageItemLimit) ? $this->pageItemLimit : 10;
    }

    /**
     * get start position
     * 
     * @return int
     */
    public function startPosition(): int
    {
        return isset($this->startPosition) ? $this->startPosition : 0;
    }

    /**
     * get offset
     * 
     * @return int
     */
    public function offset(): int
    {
        return ($this->page() - 1) * $this->pageItemLimit();
    }

    /**
     * get start position
     * 
     * @return int
     */
    public function start(): int
    {
        return $this->offset() + $this->startPosition();
    }

    /**
     * get end position
     * 
     * @return int
     */
    public function end(): int
    {
        return $this->start() + $this->pageItemLimit() - 1;
    }
}
