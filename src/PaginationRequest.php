<?php

namespace YukataRm\Laravel\Request;

use YukataRm\Laravel\Request\BaseRequest;
use YukataRm\Laravel\Request\Pagination;

use YukataRm\Laravel\Validation\Facades\Rules;

/**
 * Pagination Request for Laravel
 *
 * @package YukataRm\Laravel\Request
 */
abstract class PaginationRequest extends BaseRequest
{
    use Pagination;

    /*----------------------------------------*
     * Pagination
     *----------------------------------------*/

    /**
     * set Validation array
     *
     * @return void
     */
    #[\Override]
    protected function setValidations(): void
    {
        parent::setValidations();

        $this->validations = array_merge(
            $this->validations,
            [
                Rules::filled("page")->integer(),
            ]
        );
    }

    /**
     * get additional data for validation
     *
     * @return array<string, mixed>
     */
    #[\Override]
    protected function additionalData(): array
    {
        $this->additionalData = array_merge(
            $this->additionalData,
            ["page"]
        );

        return parent::additionalData();
    }

    /**
     * get entity data
     *
     * @return array<string, mixed>
     */
    #[\Override]
    protected function entityData(): array
    {
        return array_merge(parent::entityData(), [
            "page"          => $this->page(),
            "pageItemLimit" => $this->pageItemLimit(),
            "startPosition" => $this->startPosition(),
        ]);
    }

    /**
     * passed validate resolved
     *
     * @return void
     */
    #[\Override]
    protected function passedValidateResolved(): void
    {
        $validated = $this->validated();

        $this->page = isset($validated["page"]) ? $validated["page"] : 1;
    }
}
