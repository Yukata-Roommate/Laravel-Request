<?php

namespace YukataRm\Laravel\Request;

use YukataRm\Laravel\Request\BaseRequest;

use YukataRm\Laravel\Request\Entity;

use Illuminate\Support\Facades\Route;

/**
 * Request for Laravel
 * 
 * @package YukataRm\Laravel\Request
 */
abstract class Request extends BaseRequest
{
    /*----------------------------------------*
     * Validate Resolved
     *----------------------------------------*/

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
            $additionalData[$name] = Route::input($name);
        }

        return $additionalData;
    }

    /*----------------------------------------*
     * Validated
     *----------------------------------------*/

    /**
     * entity class
     * 
     * @var string
     */
    protected string $entity = Entity::class;

    /**
     * get Entity
     * 
     * @return \YukataRm\Laravel\Request\Entity
     */
    public function entity(): Entity
    {
        $entityClass = $this->entity;

        return new $entityClass($this->validated());
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
