<?php

namespace YukataRm\Laravel\Request\Facade;

use YukataRm\Laravel\Request\Interface\InputInterface;
use YukataRm\Laravel\Request\Input;

/**
 * Facade Manager
 * 
 * @package YukataRm\Laravel\Request\Facade
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface make(string $keyName)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface array(string $keyName, array|string|null $acceptKeys = null, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredArrayKeys(string $keyName, array|string $keys, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface inArray(string $keyName, string $field, string $key, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface distinct(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface distinctStrict(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface distinctIgnoreCase(string $keyName, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface boolean(string $keyName, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface date(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface dateFormat(string $keyName, string $format, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface dateEqual(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface after(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface afterOrEqual(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface before(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface beforeOrEqual(string $keyName, string $date, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface timezone(string $keyName, string|null $identifier = null, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asDate(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asTime(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asDateTime(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asYearMonth(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asMonthDay(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asHourMinute(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asMinuteSecond(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asYear(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asMonth(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asMonthZero(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asMonthName(string $keyName, array|string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asMonthNameShort(string $keyName, array|string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asDay(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asDayZero(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asHour(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asHourZero(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asHourTwelveNotation(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asHourTwelveNotationZero(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asMinute(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface asSecond(string $keyName, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface enum(string $keyName, string $enumClass, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface same(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface different(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface gt(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface gte(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface lt(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface lte(string $keyName, string $field, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface confirmed(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface accepted(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface acceptedIf(string $keyName, string $field, mixed $value, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface declined(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface declinedIf(string $keyName, string $field, mixed $value, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface file(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface image(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface mimes(string $keyName, array<string>|string $extensions, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface mimetypes(string $keyName, array<string>|string $mimetypes, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface extensions(string $keyName, array<string>|string $extensions, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface dimensions(string $keyName, int|null $width = null, int|null $height = null, int|null $minWidth = null, int|null $minHeight = null, int|null $maxWidth = null, int|null $maxHeight = null, float|string|null $ratio = null, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface required(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredIfField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredUnlessField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredIfAccepted(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredWith(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredWithAll(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredWithout(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredWithoutAll(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface missing(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface missingIfField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface missingUnlessField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface missingWith(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface missingWithAll(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface missingWithout(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface missingWithoutAll(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface prohibited(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface prohibitedIfField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface prohibitedUnlessField(string $keyName, string $field, array<mixed> $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface prohibits(string $keyName, array<string>|string $fields, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface present(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface filled(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface nullable(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredIf(string $keyName, bool $isRequired, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface requiredUnless(string $keyName, bool $isRequired, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface missingIf(string $keyName, bool $isMissing, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface missingUnless(string $keyName, bool $isMissing, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface prohibitedIf(string $keyName, bool $isProhibited, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface prohibitedUnless(string $keyName, bool $isProhibited, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface numeric(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface integer(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface multipleOf(string $keyName, int $num, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface decimal(string $keyName, int $min, int|null $max = null, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface digits(string $keyName, int $min, int|null $max = null, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface maxDigits(string $keyName, int $max, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface minDigits(string $keyName, int $min, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface regex(string $keyName, string $pattern, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface notRegex(string $keyName, string $pattern, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface tel(string $keyName, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface postCode(string $keyName, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface size(string $keyName, int $size, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface max(string $keyName, int $max, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface min(string $keyName, int $min, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface between(string $keyName, int $min, int $max, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface string(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface json(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface currentPassword(string $keyName, string $guard = "web", string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface email(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface url(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface activeUrl(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface upperCase(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface lowerCase(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface ip(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface ipv4(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface ipv6(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface macAddress(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface uuid(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface ulid(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface ascii(string $keyName, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface alpha(string $keyName, bool $isAscii = false, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface alphaNum(string $keyName, bool $isAscii = false, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface alphaDash(string $keyName, bool $isAscii = false, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface hexColor(string $keyName, string|null $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface exists(string $keyName, string $table, string $column = null, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface existsNotDeleted(string $keyName, string $table, string $column = null, string $deletedAtColumn = "deleted_at", string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface unique(string $keyName, string $table, string $column = null, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface uniqueNotDeleted(string $keyName, string $table, string $column = null, string $deletedAtColumn = "deleted_at", string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface id(string $keyName, string $table, string $message = null)
 * 
 * @method \YukataRm\Laravel\Request\Interface\InputInterface in(string $keyName, \Illuminate\Contracts\Support\Arrayable|array<mixed>|string $values, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface notIn(string $keyName, \Illuminate\Contracts\Support\Arrayable|array<mixed>|string $values, string|null $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface startsWith(string $keyName, array<mixed>|string $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface doesntStartWith(string $keyName, array<mixed>|string $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface endsWith(string $keyName, array<mixed>|string $values, string $message = null)
 * @method \YukataRm\Laravel\Request\Interface\InputInterface doesntEndWith(string $keyName, array<mixed>|string $values, string $message = null)
 * 
 * @see \YukataRm\Laravel\Request\Interface\InputInterface
 */
class Manager
{
    /**
     * make Input instance
     *
     * @param string $keyName
     * @return \YukataRm\Laravel\Request\Interface\InputInterface
     */
    public function make(string $keyName): InputInterface
    {
        return new Input($keyName);
    }

    /**
     * call Input method
     * 
     * @param string $name
     * @param array<mixed> $arguments
     * @return \YukataRm\Laravel\Request\Interface\InputInterface
     */
    public function __call(string $name, array $arguments): InputInterface
    {
        $keyName = array_shift($arguments);

        if (is_null($keyName)) $this->throwTooFewArgumentsException();

        $instance = $this->make($keyName);

        if (!method_exists($instance, $name)) $this->throwBadMethodCallException($name);

        $instance = $instance->$name(...$arguments);

        if (!($instance instanceof Input)) $this->throwBadMethodCallException($name);

        return $instance;
    }

    /**
     * throw Too Few Arguments Exception
     * 
     * @return void
     */
    protected function throwTooFewArgumentsException(): void
    {
        throw new \BadMethodCallException("Too few arguments to function " . static::class . "::make(), 0 passed in. exactly 1 expected.");
    }

    /**
     * throw Bad Method Call Exception
     * 
     * @param string $name
     * @return void
     */
    protected function throwBadMethodCallException(string $name): void
    {
        throw new \BadMethodCallException("Method " . Input::class . "::{$name}() does not exist.");
    }
}
