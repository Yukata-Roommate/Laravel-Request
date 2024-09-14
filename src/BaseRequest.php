<?php

namespace YukataRm\Laravel\Request;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Route;

use YukataRm\Laravel\Request\Entity\BaseEntity;

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
     * Validation array
     * 
     * @var array<\YukataRm\Laravel\Request\Interface\ValidationInterface>
     */
    protected array $validations = [];

    /**
     * get Validation array
     * 
     * @return array<\YukataRm\Laravel\Request\Interface\ValidationInterface>
     */
    protected function validations(): array
    {
        return [];
    }

    /**
     * set Validation array
     * 
     * @return void
     */
    protected function setValidations(): void
    {
        $this->validations = $this->validations();
    }

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
     * is request authorized
     * 
     * @var bool
     */
    protected bool $isAuthorized = true;

    /**
     * check if request is authorized
     * 
     * @return bool
     */
    protected function isAuthorized(): bool
    {
        return $this->isAuthorized;
    }

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
     * unauthorized message
     * 
     * @var string
     */
    protected string $unauthorizedMessage = "";

    /**
     * unauthorized message key
     * 
     * @var string
     */
    protected string $unauthorizedMessageKey = "";

    /**
     * get unauthorized message
     * 
     * @return string|null
     */
    protected function getUnauthorizedMessage(): string|null
    {
        $unauthorizedMessageKey = $this->unauthorizedMessageKey();

        $unauthorizedMessageFromLangFile = $this->unauthorizedMessageFromLangFile();

        if ($unauthorizedMessageKey !== $unauthorizedMessageFromLangFile) return $unauthorizedMessageFromLangFile;

        $unauthorizedMessage = $this->unauthorizedMessage();

        return empty($unauthorizedMessage) ? null : $unauthorizedMessage;
    }

    /**
     * get unauthorized message
     * 
     * @return string
     */
    protected function unauthorizedMessage(): string
    {
        return empty($this->unauthorizedMessage)
            ? $this->configUnauthorizedMessage()
            : $this->unauthorizedMessage;
    }

    /**
     * get unauthorized message key
     * 
     * @return string
     */
    protected function unauthorizedMessageKey(): string
    {
        return empty($this->unauthorizedMessageKey)
            ? $this->configUnauthorizedMessageKey()
            : $this->unauthorizedMessageKey;
    }

    /**
     * get unauthorized message from lang file
     * 
     * @return string
     */
    protected function unauthorizedMessageFromLangFile(): string
    {
        return __($this->unauthorizedMessageKey());
    }

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
    protected function getRules(): array
    {
        $rules = [];

        foreach ($this->validations as $validation) {
            $validationRules = $validation->getRules();

            if (empty($validationRules)) continue;

            $rules = array_merge($rules, [$validation->getKeyName() => $validationRules]);
        }

        return $rules;
    }

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
    protected function getMessages(): array
    {
        $messages = [];

        foreach ($this->validations as $validation) {
            $validationMessages = $validation->getMessages();

            if (empty($validationMessages)) continue;

            $messages = array_merge($messages, $validationMessages);
        }

        return $messages;
    }

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
    protected function getAttributes(): array
    {
        $attributes = [];

        foreach ($this->validations as $validation) {
            $attributeName = $validation->getAttributeName();

            if (empty($attributeName)) continue;

            $attributes = array_merge($attributes, [$validation->getKeyName() => $attributeName]);
        }

        return $attributes;
    }

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
     * additional data for validation
     * 
     * @var array<string> 
     */
    protected array $additionalData = [];

    /**
     * get additional data for validation
     * 
     * @return array<string, mixed>
     */
    protected function additionalData(): array
    {
        $additionalData = [];

        if (empty($this->additionalData)) return $additionalData;

        foreach ($this->additionalData as $name) {
            $input = Route::input($name);

            if (is_null($input)) continue;

            $additionalData[$name] = $input;
        }

        return $additionalData;
    }

    /*----------------------------------------*
     * Entity
     *----------------------------------------*/

    /**
     * entity class
     * 
     * @var string
     */
    protected string $entity;

    /**
     * get Entity
     * 
     * @return \YukataRm\Laravel\Request\Entity\BaseEntity
     */
    public function entity(): BaseEntity
    {
        if (!isset($this->entity)) throw new \RuntimeException("entity class is not set");

        $entityClass = $this->entity;

        return new $entityClass($this->entityData());
    }

    /**
     * get entity data
     * 
     * @return array<string, mixed>
     */
    protected function entityData(): array
    {
        return $this->validated();
    }

    /*----------------------------------------*
     * Config
     *----------------------------------------*/

    /**
     * get config or default
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function config(string $key, mixed $default): mixed
    {
        return config("yukata-roommate.request.{$key}", $default);
    }

    /**
     * get config unauthorized message
     * 
     * @return string
     */
    protected function configUnauthorizedMessage(): string
    {
        return $this->config("unauthorized_message", "");
    }

    /**
     * get config unauthorized message key
     * 
     * @return string
     */
    protected function configUnauthorizedMessageKey(): string
    {
        return $this->config("unauthorized_message_key", "");
    }
}
