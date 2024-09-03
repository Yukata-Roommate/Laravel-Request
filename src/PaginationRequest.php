<?php

namespace YukataRm\Laravel\Request;

use YukataRm\Laravel\Request\Request;

use YukataRm\Laravel\Request\Facade\Validation;

/**
 * Pagination Request for Laravel
 * 
 * @package YukataRm\Laravel\Request
 */
abstract class PaginationRequest extends Request
{
    /*----------------------------------------*
     * Override
     *----------------------------------------*/

    /**
     * set Validation array
     * 
     * @return void
     */
    #[\Override]
    protected function setValidations(): void
    {
        $this->validations = array_merge($this->validations(), [
            Validation::filled("page")->integer(),
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
        return $this->entity()->nullableInt("page") ?? 1;
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
