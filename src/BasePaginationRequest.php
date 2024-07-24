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

    /**
     * default page number
     * 
     * @return int
     */
    protected function defaultPage(): int
    {
        return 1;
    }

    /**
     * default page item limit
     * 
     * @return int
     */
    protected function pageItemLimit(): int
    {
        return 10;
    }

    /**
     * get page number
     * 
     * @return int
     */
    public function page(): int
    {
        return $this->bindInt("page", $this->defaultPage());
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
