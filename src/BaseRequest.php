<?php

namespace YukataRm\Laravel\Request;

use Illuminate\Foundation\Http\FormRequest;

use YukataRm\Laravel\Request\Enum\AddParameterEnum;

use YukataRm\Laravel\Logger\Interface\LoggerInterface;
use YukataRm\Laravel\Logger\Facade\Logger as LoggerFacade;
use YukataRm\Logger\Enum\LogFormatEnum;

use UnitEnum;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\UploadedFile;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * Base Request extends FormRequest for Laravel
 * 
 * @package YukataRm\Laravel\Request
 */
abstract class BaseRequest extends FormRequest
{
    /*----------------------------------------*
     * Override
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
        $this->loggingParameters();
        $this->setInputs();
        $this->prepareForValidateResolved();

        parent::validateResolved();

        $this->passedValidateResolved();
        $this->prepareForBindValidatedResolved();
        $this->bindValidatedResolved();
        $this->passedBindValidatedResolved();
    }

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
        return $this->authorize();
    }

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
        throw $this->getAuthorizationException();
    }

    /**
     * prepare before validation
     *
     * @see \Illuminate\Validation\ValidatesWhenResolvedTrait
     * 
     * @return void
     */
    #[\Override]
    protected function prepareForValidation(): void {}

    /**
     * process when validation is passed
     *
     * @see \Illuminate\Validation\ValidatesWhenResolvedTrait
     * 
     * @return void
     */
    #[\Override]
    protected function passedValidation(): void {}

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
     * process when validation is failed
     *
     * @see \Illuminate\Foundation\Http\FormRequest
     * 
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    #[\Override]
    protected function failedValidation(Validator $validator): void
    {
        parent::failedValidation($validator);
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

    /*----------------------------------------*
     * Custom Methods
     *----------------------------------------*/

    /**
     * get is request authorized
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->isAuthorized();
    }

    /**
     * get rules for validation
     *
     * @return array<string, \Stringable|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->getRules();
    }

    /*----------------------------------------*
     * Validate Resolved
     *----------------------------------------*/

    /**
     * prepare before validate resolved
     * 
     * @return void
     */
    protected function prepareForValidateResolved(): void {}

    /**
     * process when validate resolved is passed
     * 
     * @return void
     */
    protected function passedValidateResolved(): void {}

    /*----------------------------------------*
     * Additional Data
     *----------------------------------------*/

    /**
     * query parameters
     * 
     * @var array<string> 
     */
    protected array $queryParameters = [];

    /**
     * get additional data for validation
     * 
     * @return array<string, mixed>
     */
    protected function additionalData(): array
    {
        $additionalData = [];

        if (empty($this->queryParameters)) return $additionalData;

        foreach ($this->queryParameters as $queryParameter) {
            $additionalData[$queryParameter] = Route::input($queryParameter);
        }

        return $additionalData;
    }

    /*----------------------------------------*
     * Bind Validated
     *----------------------------------------*/

    /**
     * validated data
     * 
     * @var array<string, mixed>
     */
    protected array $validated;

    /**
     * bind validated data
     * 
     * @return void
     */
    protected function bindValidatedResolved(): void
    {
        $this->setValidated($this->validator->validated());

        $this->prepareForBindValidated();

        $this->bindValidated();

        $this->passedBindValidated();
    }

    /**
     * prepare before bind validate resolved
     * 
     * @return void
     */
    protected function prepareForBindValidatedResolved(): void {}

    /**
     * process when bind validate resolved is passed
     * 
     * @return void
     */
    protected function passedBindValidatedResolved(): void {}

    /**
     * set validated data
     * 
     * @return void
     */
    protected function setValidated(array $validated): void
    {
        $this->validated = $validated;
    }

    /**
     * bind validated data
     * 
     * @return void
     */
    abstract protected function bindValidated(): void;

    /**
     * prepare before bind validated
     * 
     * @return void
     */
    protected function prepareForBindValidated(): void {}

    /**
     * process when bind validated is passed
     * 
     * @return void
     */
    protected function passedBindValidated(): void {}

    /**
     * check if validated data is set by key
     * 
     * @param string $key
     * @return bool
     */
    protected function issetValidated(string $key): bool
    {
        return isset($this->validated[$key]);
    }

    /**
     * get validated data by key
     * 
     * @param string $key
     * @return mixed
     */
    protected function bind(string $key): mixed
    {
        return $this->issetValidated($key) ? $this->validated[$key] : null;
    }

    /**
     * get validated data as nullable string by key
     * 
     * @param string $key
     * @return string|null
     */
    protected function bindNullableString(string $key): string|null
    {
        $bind = $this->bind($key);

        return is_string($bind) ? strval($bind) : null;
    }

    /**
     * get validated data as string by key
     * if not exists, return default
     * 
     * @param string $key
     * @return string
     */
    protected function bindString(string $key): string
    {
        $bind = $this->bindNullableString($key);

        if (is_null($bind)) throw $this->requiredException($key);

        return $bind;
    }

    /**
     * get validated data as nullable int by key
     * 
     * @param string $key
     * @return int|null
     */
    protected function bindNullableInt(string $key): int|null
    {
        $bind = $this->bind($key);

        return is_numeric($bind) ? intval($bind) : null;
    }

    /**
     * get validated data as int by key
     * if not exists, return default
     * 
     * @param string $key
     * @return int
     */
    protected function bindInt(string $key): int
    {
        $bind = $this->bindNullableInt($key);

        if (is_null($bind)) throw $this->requiredException($key);

        return $bind;
    }

    /**
     * get validated data as nullable float by key
     * 
     * @param string $key
     * @return float|null
     */
    protected function bindNullableFloat(string $key): float|null
    {
        $bind = $this->bind($key);

        return is_numeric($bind) ? floatval($bind) : null;
    }

    /**
     * get validated data as float by key
     * if not exists, return default
     * 
     * @param string $key
     * @return float
     */
    protected function bindFloat(string $key): float
    {
        $bind = $this->bindNullableFloat($key);

        if (is_null($bind)) throw $this->requiredException($key);

        return $bind;
    }

    /**
     * get validated data as nullable bool by key
     * 
     * @param string $key
     * @return bool|null
     */
    protected function bindNullableBool(string $key): bool|null
    {
        $bind = $this->bind($key);

        return is_bool($bind) ? boolval($bind) : null;
    }

    /**
     * get validated data as bool by key
     * if not exists, return default
     * 
     * @param string $key
     * @return bool
     */
    protected function bindBool(string $key): bool
    {
        $bind = $this->bindNullableBool($key);

        if (is_null($bind)) throw $this->requiredException($key);

        return $bind;
    }

    /**
     * get validated data as nullable array by key
     * 
     * @param string $key
     * @return array|null
     */
    protected function bindNullableArray(string $key): array|null
    {
        $bind = $this->bind($key);

        return is_array($bind) ? $bind : null;
    }

    /**
     * get validated data as array by key
     * if not exists, return default
     * 
     * @param string $key
     * @return array
     */
    protected function bindArray(string $key): array
    {
        $bind = $this->bindNullableArray($key);

        if (is_null($bind)) throw $this->requiredException($key);

        return $bind;
    }

    /**
     * get validated data as nullable UploadedFile by key
     * 
     * @param string $key
     * @return UploadedFile|array<UploadedFile>|null
     */
    protected function bindNullableFile(string $key): UploadedFile|array|null
    {
        $bind = $this->bind($key);

        return $bind instanceof UploadedFile || is_array($bind) ? $bind : null;
    }

    /**
     * get validated data as nullable UnitEnum by key
     * 
     * @param string $key
     * @param string $enumClass
     * @return UnitEnum|null
     */
    protected function bindNullableEnum(string $key, string $enumClass): UnitEnum|null
    {
        $bind = $this->bind($key);

        return enum_exists($enumClass) ? $enumClass::tryFrom($bind) : null;
    }

    /**
     * get validated data as UnitEnum by key
     * if not exists, return default
     * 
     * @param string $key
     * @param string $enumClass
     * @return UnitEnum
     */
    protected function bindEnum(string $key, string $enumClass): UnitEnum
    {
        $bind = $this->bindNullableEnum($key, $enumClass);

        if (is_null($bind)) throw $this->requiredException($key);

        return $bind;
    }

    /**
     * get required exception
     * 
     * @param string $key
     * @return \Throwable
     */
    protected function requiredException(string $key): \Throwable
    {
        return new \RuntimeException("{$key} is required.");
    }

    /*----------------------------------------*
     * Authorize
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
     * get AuthorizationException
     * 
     * @return \Illuminate\Auth\Access\AuthorizationException
     */
    protected function getAuthorizationException(): AuthorizationException
    {
        return new AuthorizationException($this->getUnauthorizedMessage());
    }

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
     * Inputs
     *----------------------------------------*/

    /**
     * Input array
     * 
     * @var array<\YukataRm\Laravel\Request\Interface\InputInterface>
     */
    protected array $inputs = [];

    /**
     * get Input array
     * 
     * @return array<\YukataRm\Laravel\Request\Interface\InputInterface>
     */
    abstract protected function inputs(): array;

    /**
     * set Input array
     * 
     * @return void
     */
    protected function setInputs(): void
    {
        $this->inputs = $this->inputs();
    }

    /**
     * get rules for validation
     * 
     * @return array<string, \Stringable|array<mixed>|string>
     */
    protected function getRules(): array
    {
        $rules = [];

        foreach ($this->inputs as $input) {
            $inputRules = $input->getRules();

            if (empty($inputRules)) continue;

            $rules = array_merge($rules, [$input->getKeyName() => $inputRules]);
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

        foreach ($this->inputs as $input) {
            $inputMessages = $input->getMessages();

            if (empty($inputMessages)) continue;

            $messages = array_merge($messages, $inputMessages);
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

        foreach ($this->inputs as $input) {
            $attributeName = $input->getAttributeName();

            if (empty($attributeName)) continue;

            $attributes = array_merge($attributes, [$input->getKeyName() => $attributeName]);
        }

        return $attributes;
    }

    /*----------------------------------------*
     * Logging Parameters
     *----------------------------------------*/

    /**
     * is logging parameters
     * 
     * @var bool
     */
    protected bool $isLoggingParameters = false;

    /**
     * get is logging parameters
     * 
     * @return bool
     */
    protected function isLoggingParameters(): bool
    {
        if ($this->isLoggingParameters) return true;

        return $this->configLoggingParameters();
    }

    /**
     * execute logging parameters
     * 
     * @return void
     */
    protected function loggingParameters(): void
    {
        if (!$this->isLoggingParameters()) return;

        $parameters = $this->validationData();

        $parameters = $this->addParameters($parameters);

        $parameters = $this->maskParameters($parameters);

        $logger = $this->getLogger();

        $logger->add(json_encode($parameters, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $logger->logging();
    }

    /**
     * add parameters
     * 
     * @param array<string, mixed> $parameters
     * @return array<string, mixed>
     */
    protected function addParameters(array $parameters): array
    {
        $addParameters = $this->configAddParameters();

        if (empty($addParameters)) return $parameters;

        $addParameter = null;

        foreach ($addParameters as $key) {
            $key = AddParameterEnum::tryFrom($key);

            if (is_null($key)) continue;

            $addParameter = match ($key) {
                AddParameterEnum::URL        => e(request()->getRequestUri()),
                AddParameterEnum::METHOD     => request()->method(),
                AddParameterEnum::IP         => request()->ip(),
                AddParameterEnum::USER_AGENT => request()->userAgent(),
                AddParameterEnum::DATETIME   => now()->format("Y-m-d H:i:s"),
            };

            $parameters[$key->value] = $addParameter;
        }

        return $parameters;
    }

    /**
     * mask parameters
     * 
     * @param array<string, mixed> $parameters
     * @return array<string, mixed>
     */
    protected function maskParameters(array $parameters): array
    {
        $maskedParameters = $this->configMaskingParameters();

        if (empty($maskedParameters)) return $parameters;

        foreach ($maskedParameters as $key) {
            if (!isset($parameters[$key])) continue;

            $parameters[$key] = $this->configMaskingText();
        }

        return $parameters;
    }

    /**
     * get Logger instance
     * 
     * @return \YukataRm\Laravel\Logger\Interface\LoggerInterface
     */
    protected function getLogger(): LoggerInterface
    {
        $logger = LoggerFacade::info();

        $logger->setDirectory($this->configLoggingDirectly());

        $logger->setLogFormat(LogFormatEnum::MESSAGE);

        return $logger;
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

    /**
     * get config logging parameters
     * 
     * @return bool
     */
    protected function configLoggingParameters(): bool
    {
        return $this->config("logging_parameters", false);
    }

    /**
     * get config logging directly
     * 
     * @return string
     */
    protected function configLoggingDirectly(): string
    {
        return $this->config("logging_directly", "request");
    }

    /**
     * get config add parameters
     * 
     * @return array<string>
     */
    protected function configAddParameters(): array
    {
        return $this->config("add_parameters", []);
    }

    /**
     * get config masking text
     * 
     * @return string
     */
    protected function configMaskingText(): string
    {
        return $this->config("masking_text", "********");
    }

    /**
     * get config masking parameters
     * 
     * @return array<string>
     */
    protected function configMaskingParameters(): array
    {
        return $this->config("masking_parameters", []);
    }
}
