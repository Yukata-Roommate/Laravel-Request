<?php

namespace YukataRm\Laravel\Request\Facade;

use YukataRm\Laravel\Request\Interface\ValidationInterface;
use YukataRm\Laravel\Request\Validation;

/**
 * Facade Manager
 * 
 * @package YukataRm\Laravel\Request\Facade
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface make(string $keyName)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface array(string $keyName, array|string|null $acceptKeys = null, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredArrayKeys(string $keyName, array|string $keys, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface inArray(string $keyName, string $field, string $key, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface distinct(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface distinctStrict(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface distinctIgnoreCase(string $keyName, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface boolean(string $keyName, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface date(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface dateFormat(string $keyName, string $format, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface dateEqual(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface after(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface afterOrEqual(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface before(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface beforeOrEqual(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface timezone(string $keyName, string|null $identifier = null, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asDate(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asTime(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asDateTime(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asYearMonth(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asMonthDay(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asHourMinute(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asMinuteSecond(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asYear(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asMonth(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asMonthZero(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asMonthName(string $keyName, array|string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asMonthNameShort(string $keyName, array|string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asDay(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asDayZero(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asHour(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asHourZero(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asHourTwelveNotation(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asHourTwelveNotationZero(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asMinute(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface asSecond(string $keyName, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface enum(string $keyName, string $enumClass, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface same(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface different(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface gt(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface gte(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface lt(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface lte(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface confirmed(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface accepted(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface acceptedIf(string $keyName, string $field, mixed $value, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface declined(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface declinedIf(string $keyName, string $field, mixed $value, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface file(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface image(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface mimes(string $keyName, array<string>|string $extensions, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface mimetypes(string $keyName, array<string>|string $mimetypes, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface extensions(string $keyName, array<string>|string $extensions, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface dimensions(string $keyName, int|null $width = null, int|null $height = null, int|null $minWidth = null, int|null $minHeight = null, int|null $maxWidth = null, int|null $maxHeight = null, float|string|null $ratio = null, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface required(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredIfField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredUnlessField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredIfAccepted(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredWith(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredWithAll(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredWithout(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredWithoutAll(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface missing(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface missingIfField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface missingUnlessField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface missingWith(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface missingWithAll(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface missingWithout(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface missingWithoutAll(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface prohibited(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface prohibitedIfField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface prohibitedUnlessField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface prohibits(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface present(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface filled(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface nullable(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredIf(string $keyName, bool $isRequired, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface requiredUnless(string $keyName, bool $isRequired, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface missingIf(string $keyName, bool $isMissing, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface missingUnless(string $keyName, bool $isMissing, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface prohibitedIf(string $keyName, bool $isProhibited, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface prohibitedUnless(string $keyName, bool $isProhibited, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface numeric(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface integer(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface multipleOf(string $keyName, int $num, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface decimal(string $keyName, int $min, int|null $max = null, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface digits(string $keyName, int $min, int|null $max = null, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface maxDigits(string $keyName, int $max, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface minDigits(string $keyName, int $min, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface regex(string $keyName, string $pattern, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface notRegex(string $keyName, string $pattern, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface tel(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface postCode(string $keyName, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface size(string $keyName, int $size, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface max(string $keyName, int $max, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface min(string $keyName, int $min, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface between(string $keyName, int $min, int $max, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface string(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface json(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface currentPassword(string $keyName, string $guard = "web", string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface email(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface url(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface activeUrl(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface upperCase(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface lowerCase(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface ip(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface ipv4(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface ipv6(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface macAddress(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface uuid(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface ulid(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface ascii(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface alpha(string $keyName, bool $isAscii = false, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface alphaNum(string $keyName, bool $isAscii = false, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface alphaDash(string $keyName, bool $isAscii = false, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface hexColor(string $keyName, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface exists(string $keyName, string $table, string $column = null, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface existsNotDeleted(string $keyName, string $table, string $column = null, string $deletedAtColumn = "deleted_at", string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface unique(string $keyName, string $table, string $column = null, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface uniqueNotDeleted(string $keyName, string $table, string $column = null, string $deletedAtColumn = "deleted_at", string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface id(string $keyName, string $table, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface in(string $keyName, \Illuminate\Contracts\Support\Arrayable|array<mixed>|string $values, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface notIn(string $keyName, \Illuminate\Contracts\Support\Arrayable|array<mixed>|string $values, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface startsWith(string $keyName, array<mixed>|string $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface doesntStartWith(string $keyName, array<mixed>|string $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface endsWith(string $keyName, array<mixed>|string $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\ValidationInterface doesntEndWith(string $keyName, array<mixed>|string $values, string $message = null)
 * 
 * @see \YukataRm\Laravel\Request\Interface\ValidationInterface
 */
class Manager
{
    /**
     * make Validation instance
     *
     * @param string $keyName
     * @return \YukataRm\Laravel\Request\Interface\ValidationInterface
     */
    public function make(string $keyName): ValidationInterface
    {
        return new Validation($keyName);
    }

    /**
     * call Validation method
     * 
     * @param string $name
     * @param array<mixed> $arguments
     * @return \YukataRm\Laravel\Request\Interface\ValidationInterface
     */
    public function __call(string $name, array $arguments): ValidationInterface
    {
        $keyName = array_shift($arguments);

        if (is_null($keyName)) $this->throwTooFewArgumentsException();

        $instance = $this->make($keyName);

        if (!method_exists($instance, $name)) $this->throwBadMethodCallException($name);

        $instance = $instance->$name(...$arguments);

        if (!($instance instanceof Validation)) $this->throwBadMethodCallException($name);

        return $instance;
    }

    /**
     * throw Too Few Arguments Exception
     * 
     * @return void
     */
    protected function throwTooFewArgumentsException(): void
    {
        throw new \BadMethodCallException("too few arguments to function " . static::class . "::make(), 0 passed in. exactly 1 expected.");
    }

    /**
     * throw Bad Method Call Exception
     * 
     * @param string $name
     * @return void
     */
    protected function throwBadMethodCallException(string $name): void
    {
        throw new \BadMethodCallException("method " . Validation::class . "::{$name}() does not exist.");
    }
}
