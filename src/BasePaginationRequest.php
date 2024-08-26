<?php

namespace YukataRm\Laravel\Request;

use YukataRm\Laravel\Request\BaseRequest;

use YukataRm\Laravel\Request\Facade\Input;

/**
 * Base Pagination Request
 * 
 * @package YukataRm\Laravel\Request
 */
abstract class BasePaginationRequest extends BaseRequest
{
    /*----------------------------------------*
     * Override
     *----------------------------------------*/

    /**
     * set input array
     * 
     * @return void
     */
    #[\Override]
    protected function setInputs(): void
    {
        $this->inputs = array_merge($this->inputs(), [
            Input::filled("page")->integer(),
        ]);
    }

    /*----------------------------------------*
     * Pagination
     *----------------------------------------*/

    /**
     * page item limit
     *
     * @var int
     */
    protected int $pageItemLimit = 10;

    /**
     * get page item limit
     * 
     * @return int
     */
    protected function pageItemLimit(): int
    {
        return $this->pageItemLimit;
    }

    /**
     * get page
     * 
     * @return int
     */
    public function page(): int
    {
        return $this->bindNullableInt("page") ?? 1;
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
    public function start(int $default = 0): int
    {
        return $this->offset() + $default;
    }

    /**
     * get end position
     * 
     * @param int $default
     * @return int
     */
    public function end(int $default = 0): int
    {
        return $this->start($default) + $this->pageItemLimit() - 1;
    }
}
