<?php

namespace YukataRm\Laravel\Request;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Auth\Access\AuthorizationException;

/**
 * Base Request extends FormRequest for Laravel
 * 
 * @package YukataRm\Laravel\Request
 */
abstract class BaseRequest extends FormRequest
{
    /*----------------------------------------*
     * Validate Resolved
     *----------------------------------------*/

    /**
     * validate resolved
     * 
     * @see \Illuminate\Validation\ValidatesWhenResolvedTrait
     * 
     * @return void
     */
    #[\Override]
    public function validateResolved(): void
    {
        $this->setValidations();

        if (method_exists($this, 'prepareForValidateResolved')) $this->prepareForValidateResolved();

        parent::validateResolved();

        if (method_exists($this, 'passedValidateResolved')) $this->passedValidateResolved();
    }

    /**
     * set Validation array
     * 
     * @return void
     */
    abstract protected function setValidations(): void;

    /*----------------------------------------*
     * Passes Authorization
     *----------------------------------------*/

    /**
     * check if the request is authorized
     *
     * @see \Illuminate\Foundation\Http\FormRequest
     * @see \Illuminate\Validation\ValidatesWhenResolvedTrait
     * 
     * @return bool
     */
    #[\Override]
    protected function passesAuthorization(): bool
    {
        return $this->isAuthorized();
    }

    /**
     * check if request is authorized
     * 
     * @return bool
     */
    abstract protected function isAuthorized(): bool;

    /*----------------------------------------*
     * Failed Authorization
     *----------------------------------------*/

    /**
     * process when the request is not authorized
     * 
     * @see \Illuminate\Foundation\Http\FormRequest
     * @see \Illuminate\Validation\ValidatesWhenResolvedTrait
     *
     * @return void
     */
    #[\Override]
    protected function failedAuthorization()
    {
        return new AuthorizationException($this->getUnauthorizedMessage());
    }

    /**
     * get unauthorized message
     * 
     * @return string|null
     */
    abstract protected function getUnauthorizedMessage(): string|null;

    /*----------------------------------------*
     * Validation Properties
     *----------------------------------------*/

    /**
     * get rules for validation
     *
     * @return array<string, \Stringable|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->getRules();
    }

    /**
     * get rules for validation
     * 
     * @return array<string, \Stringable|array<mixed>|string>
     */
    abstract protected function getRules(): array;

    /**
     * get messages for validation
     *
     * @see \Illuminate\Foundation\Http\FormRequest
     * 
     * @return array<string, string>
     */
    #[\Override]
    public function messages(): array
    {
        return $this->getMessages();
    }

    /**
     * get messages for validation
     * 
     * @return array<string, string>
     */
    abstract protected function getMessages(): array;

    /**
     * get attributes for validation
     * 
     * @see \Illuminate\Foundation\Http\FormRequest
     *
     * @return array<string, string>
     */
    #[\Override]
    public function attributes(): array
    {
        return $this->getAttributes();
    }

    /**
     * get attributes for validation
     * 
     * @return array<string, string>
     */
    abstract protected function getAttributes(): array;

    /*----------------------------------------*
     * Validation Data
     *----------------------------------------*/

    /**
     * get validated data
     *
     * @see \Illuminate\Foundation\Http\FormRequest
     * 
     * @return array
     */
    #[\Override]
    public function validationData(): array
    {
        return array_merge(parent::validationData(), $this->additionalData());
    }

    /**
     * get additional data for validation
     * 
     * @return array<string, mixed>
     */
    abstract protected function additionalData(): array;
}
