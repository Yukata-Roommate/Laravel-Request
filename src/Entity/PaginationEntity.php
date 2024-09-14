<?php

namespace YukataRm\Laravel\Request\Entity;

use YukataRm\Laravel\Request\Entity\BaseEntity;
use YukataRm\Laravel\Request\Trait\Pagination;

/**
 * Pagination Entity
 * 
 * @package YukataRm\Laravel\Request\Entity
 */
abstract class PaginationEntity extends BaseEntity
{
    use Pagination;

    /*----------------------------------------*
     * Override
     *----------------------------------------*/

    /**
     * prepare bind properties
     * 
     * @return void
     */
    #[\Override]
    protected function prepare(): void
    {
        parent::prepare();

        $this->page          = $this->int("page");
        $this->pageItemLimit = $this->int("pageItemLimit");
        $this->startPosition = $this->int("startPosition");
    }
}
