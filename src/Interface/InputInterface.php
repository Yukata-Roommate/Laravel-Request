<?php

namespace YukataRm\Laravel\Request\Interface;

use Stringable;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Input Interface
 * 
 * @package YukataRm\Laravel\Request\Interface
 */
interface InputInterface
{
    /*----------------------------------------*
     * Constructor
     *----------------------------------------*/

    /**
     * get key name
     * 
     * @return string
     */
    public function getKeyName(): string;

    /*----------------------------------------*
     * Property
     *----------------------------------------*/

    /**
     * set attribute name
     * 
     * @param string $attributeName
     * @return static
     */
    public function setAttributeName(string $attributeName): static;

    /**
     * get attribute name
     * 
     * @return string|null
     */
    public function getAttributeName(): string|null;

    /**
     * set validation rules
     * 
     * @param array<\Stringable|array<mixed>|string> $rules
     * @return static
     */
    public function setRules(array $rules): static;

    /**
     * merge validation rules
     * 
     * @param array<\Stringable|array<mixed>|string> $rules
     * @return static
     */
    public function mergeRules(array $rules): static;

    /**
     * add validation rule
     * 
     * @param \Stringable|array<mixed>|string $rule
     * @return static
     */
    public function addRule(Stringable|array|string $rule): static;

    /**
     * add validation rule with values
     * 
     * @param string $ruleName
     * @param array<mixed> $values
     * @return static
     */
    public function addRuleValues(string $ruleName, array $values): static;

    /**
     * get validation rules
     * 
     * @return array<\Stringable|array<mixed>|string>
     */
    public function getRules(): array;

    /**
     * set failed validation messages
     * 
     * @param array<string, string> $messages
     * @return static
     */
    public function setMessages(array $messages): static;

    /**
     * merge failed validation messages
     * 
     * @param array<string, string> $messages
     * @return static
     */
    public function mergeMessages(array $messages): static;

    /**
     * add failed validation message
     * 
     * @param string $ruleKey
     * @param string $message
     * @return static
     */
    public function addMessage(string $ruleKey, string $message): static;

    /**
     * get failed validation messages
     * 
     * @return array<string, string>
     */
    public function getMessages(): array;

    /*----------------------------------------*
     * Rule Array
     *----------------------------------------*/

    /**
     * validate parameter as an array
     * if acceptKeys is specified, validate parameter has specified keys
     * 
     * @param array<string>|string|null $acceptKeys
     * @param string|null $message
     * @return static
     */
    public function array(array|string|null $acceptKeys = null, string $message = null): static;

    /**
     * validate parameter as an array and validate parameter has specified keys
     * 
     * @param array<string>|string $keys
     * @param string|null $message
     * @return static
     */
    public function requiredArrayKeys(array|string $keys, string $message = null): static;

    /**
     * validate parameter is one of values field has
     * 
     * @param string $field
     * @param string $key
     * @param string|null $message
     * @return static
     */
    public function inArray(string $field, string $key, string $message = null): static;

    /**
     * validate parameter is an array and has no duplicate values
     * 
     * @param string|null $message
     * @return static
     */
    public function distinct(string $message = null): static;

    /**
     * validate strict parameter is an array and has no duplicate values
     * 
     * @param string|null $message
     * @return static
     */
    public function distinctStrict(string $message = null): static;

    /**
     * validate case-insensitive parameter is an array and has no duplicate values
     * 
     * @param string|null $message
     * @return static
     */
    public function distinctIgnoreCase(string $message = null): static;

    /*----------------------------------------*
     * Rule Boolean
     *----------------------------------------*/

    /**
     * validate parameter as a boolean value
     * 
     * @param string|null $message
     * @return static
     */
    public function boolean(string $message = null): static;

    /*----------------------------------------*
     * Rule Date
     *----------------------------------------*/

    /**
     * validate parameter as a date value
     * 
     * @param string|null $message
     * @return static
     */
    public function date(string $message = null): static;

    /**
     * validate parameter as a date value and format it with specified format
     * 
     * @param string $format
     * @param string|null $message
     * @return static
     */
    public function dateFormat(string $format, string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is equal to date
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function dateEqual(string $date, string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is later than date
     * date is either date to be compared or a parameter name
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function after(string $date, string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is later than or equal to date
     * date is either date to be compared or a parameter name
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function afterOrEqual(string $date, string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is earlier than date
     * date is either date to be compared or a parameter name
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function before(string $date, string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is earlier than or equal to date
     * date is either date to be compared or a parameter name
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function beforeOrEqual(string $date, string $message = null): static;

    /**
     * validate parameter is a valid time zone
     * if an identifier is specified, validates time zone is available in identifier
     * 
     * @param string|null $identifier
     * @param string|null $message
     * @return static
     */
    public function timezone(string $identifier = null, string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and follows Y-m-d format
     * 
     * @param string|null $message
     * @return static
     */
    public function asDate(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and follows H:i:s format
     * 
     * @param string|null $message
     * @return static
     */
    public function asTime(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and follows Y-m-d H:i:s format
     * 
     * @param string|null $message
     * @return static
     */
    public function asDateTime(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and follows Y-m format
     * 
     * @param string|null $message
     * @return static
     */
    public function asYearMonth(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and follows m-d format
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonthDay(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and follows H:i format
     * 
     * @param string|null $message
     * @return static
     */
    public function asHourMinute(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and follows i:s format
     * 
     * @param string|null $message
     * @return static
     */
    public function asMinuteSecond(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid year
     * 
     * @param string|null $message
     * @return static
     */
    public function asYear(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid month
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonth(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid 0-padded month
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonthZero(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid month name
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonthName(array|string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid short month name
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonthNameShort(array|string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid day
     * 
     * @param string|null $message
     * @return static
     */
    public function asDay(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid 0-padded day
     * 
     * @param string|null $message
     * @return static
     */
    public function asDayZero(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid hour
     * 
     * @param string|null $message
     * @return static
     */
    public function asHour(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid 0-padded hour
     * 
     * @param string|null $message
     * @return static
     */
    public function asHourZero(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid 12-hour notation hour
     * 
     * @param string|null $message
     * @return static
     */
    public function asHourTwelveNotation(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid 0-padded 12-hour notation hour
     * 
     * @param string|null $message
     * @return static
     */
    public function asHourTwelveNotationZero(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid minute
     * 
     * @param string|null $message
     * @return static
     */
    public function asMinute(string $message = null): static;

    /**
     * validate parameter is a value can be treated as a date and is a valid second
     * 
     * @param string|null $message
     * @return static
     */
    public function asSecond(string $message = null): static;

    /*----------------------------------------*
     * Rule Field
     *----------------------------------------*/

    /**
     * validate parameter matches value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function same(string $field, string $message = null): static;

    /**
     * validate parameter does not match value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function different(string $field, string $message = null): static;

    /**
     * validate parameter is greater than value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function gt(string $field, string $message = null): static;

    /**
     * validate parameter is greater than or equal to value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function gte(string $field, string $message = null): static;

    /**
     * validate parameter is less than value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function lt(string $field, string $message = null): static;

    /**
     * validate parameter is less than or equal to value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function lte(string $field, string $message = null): static;

    /**
     * validate {field}_confirmation exists as a parameter and parameter matches it
     * 
     * @param string|null $message
     * @return static
     */
    public function confirmed(string $message = null): static;

    /**
     * validate parameter is 1, true, “on”, “yes”
     * 
     * @param string|null $message
     * @return static
     */
    public function accepted(string $message = null): static;

    /**
     * validate parameter is 1, true, “on”, “yes” if field is equal to value
     * 
     * @param string $field
     * @param mixed $value
     * @param string|null $message
     * @return static
     */
    public function acceptedIf(string $field, mixed $value, string $message = null): static;

    /**
     * validate parameter is 0, false, “off”, “no”
     * 
     * @param string|null $message
     * @return static
     */
    public function declined(string $message = null): static;

    /**
     * validate parameter is 0, false, “off”, “no” if field is equal to value
     * 
     * @param string $field
     * @param mixed $value
     * @param string|null $message
     * @return static
     */
    public function declinedIf(string $field, mixed $value, string $message = null): static;

    /*----------------------------------------*
     * Rule File
     *----------------------------------------*/

    /**
     * validate parameter as a file
     * 
     * @param string|null $message
     * @return static
     */
    public function file(string $message = null): static;

    /**
     * validate parameter as an image
     * 
     * @param string|null $message
     * @return static
     */
    public function image(string $message = null): static;

    /**
     * validate parameter is a file, mime type corresponding to one of extensions specified in extensions
     * 
     * @param array<string>|string $extensions
     * @param string|null $message
     * @return static
     */
    public function mimes(array|string $extensions, string $message = null): static;

    /**
     * validate parameter is a file, mime type corresponding to one of mimetypes specified in mimetypes
     * 
     * @param array<string>|string $mimetypes
     * @param string|null $message
     * @return static
     */
    public function mimetypes(array|string $mimetypes, string $message = null): static;

    /**
     * validate parameter is a file and extension is one of those specified in extensions
     * 
     * @param array<string>|string $extensions
     * @param string|null $message
     * @return static
     */
    public function extensions(array|string $extensions, string $message = null): static;

    /**
     * validate parameter is a file and matches specified size
     * 
     * @param int|null $width
     * @param int|null $height
     * @param int|null $minWidth
     * @param int|null $minHeight
     * @param int|null $maxWidth
     * @param int|null $maxHeight
     * @param float|string|null $ratio
     * @param string|null $message
     * @return static
     */
    public function dimensions(int $width = null, int $height = null, int $minWidth = null, int $minHeight = null, int $maxWidth = null, int $maxHeight = null, float|string $ratio = null, string $message = null): static;

    /*----------------------------------------*
     * Rule Necessity
     *----------------------------------------*/

    /**
     * validate parameter is required
     * 
     * @param string|null $message
     * @return static
     */
    public function required(string $message = null): static;

    /**
     * validate parameter is required if field matches value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function requiredIfField(string $field, array $values, string $message = null): static;

    /**
     * validate parameter is required if field matches 1, true, “on”, “yes”
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredIfAccepted(array|string $fields, string $message = null): static;

    /**
     * validate parameter is required if field does not match value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function requiredUnlessField(string $field, array $values, string $message = null): static;

    /**
     * validate parameter is required if some of fields are present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredWith(array|string $fields, string $message = null): static;

    /**
     * validate parameter is required if all of fields are present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredWithAll(array|string $fields, string $message = null): static;

    /**
     * validate parameter is required if some of fields are not present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredWithout(array|string $fields, string $message = null): static;

    /**
     * validate parameter is required if all of fields are not present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredWithoutAll(array|string $fields, string $message = null): static;

    /**
     * validate parameter is not present
     * 
     * @param string|null $message
     * @return static
     */
    public function missing(string $message = null): static;

    /**
     * validate parameter is not present if field matches value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function missingIfField(string $field, array $values, string $message = null): static;

    /**
     * validate parameter is not present if field does not match value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function missingUnlessField(string $field, array $values, string $message = null): static;

    /**
     * validate parameter is not present if some of fields are present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function missingWith(array|string $fields, string $message = null): static;

    /**
     * validate parameter is not present if all of fields are present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function missingWithAll(array|string $fields, string $message = null): static;

    /**
     * validate parameter is not present if some of fields are not present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function missingWithout(array|string $fields, string $message = null): static;

    /**
     * validate parameter is not present if all of fields are not present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function missingWithoutAll(array|string $fields, string $message = null): static;

    /**
     * validate parameter is not present, or is an empty
     * 
     * @param string|null $message
     * @return static
     */
    public function prohibited(string $message = null): static;

    /**
     * validate parameter is not present, or is an empty if field matches value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function prohibitedIfField(string $field, array $values, string $message = null): static;

    /**
     * validate parameter is not present, or is an empty if field does not match value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function prohibitedUnlessField(string $field, array $values, string $message = null): static;

    /**
     * validate all fields in fields are absent or empty if parameter is present and non-empty
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function prohibits(array|string $fields, string $message = null): static;

    /**
     * validate parameter is present
     * 
     * @param string|null $message
     * @return static
     */
    public function present(string $message = null): static;

    /**
     * validate parameter is not empty if parameter is present
     * 
     * @param string|null $message
     * @return static
     */
    public function filled(string $message = null): static;

    /**
     * nullable parameter
     * 
     * @param string|null $message
     * @return static
     */
    public function nullable(string $message = null): static;

    /**
     * validate parameter is required if isRequired is true
     * 
     * @param bool $isRequired
     * @param string|null $message
     * @return static
     */
    public function requiredIf(bool $isRequired, string $message = null): static;

    /**
     * validate parameter is required if isRequired is false
     * 
     * @param bool $isRequired
     * @param string|null $message
     * @return static
     */
    public function requiredUnless(bool $isRequired, string $message = null): static;

    /**
     * validate parameter is not present if isMissing is true
     * 
     * @param bool $isMissing
     * @param string|null $message
     * @return static
     */
    public function missingIf(bool $isMissing, string $message = null): static;

    /**
     * validate parameter is not present if isMissing is false
     * 
     * @param bool $isMissing
     * @param string|null $message
     * @return static
     */
    public function missingUnless(bool $isMissing, string $message = null): static;

    /**
     * validate parameter is not present, or is an empty if isProhibited is true
     * 
     * @param bool $isProhibited
     * @param string|null $message
     * @return static
     */
    public function prohibitedIf(bool $isProhibited, string $message = null): static;

    /**
     * validate parameter is not present, or is an empty if isProhibited is false
     * 
     * @param bool $isProhibited
     * @param string|null $message
     * @return static
     */
    public function prohibitedUnless(bool $isProhibited, string $message = null): static;

    /*----------------------------------------*
     * Rule Numeric
     *----------------------------------------*/

    /**
     * validate parameter is numeric
     * 
     * @param string|null $message
     * @return static
     */
    public function numeric(string $message = null): static;

    /**
     * validate parameter is an integer
     * 
     * @param string|null $message
     * @return static
     */
    public function integer(string $message = null): static;

    /**
     * validate parameter is a number multiple of num
     * 
     * @param int $num
     * @param string|null $message
     * @return static
     */
    public function multipleOf(int $num, string $message = null): static;

    /**
     * validate parameter has a number of decimal places greater than or equal to min and less than or equal to max
     * if max is omitted, number of decimal places must be equal to min
     * 
     * @param int $min
     * @param int|null $max
     * @param string|null $message
     * @return static
     */
    public function decimal(int $min, int $max = null, string $message = null): static;

    /**
     * validate parameter has a number of digits greater than min and less than max
     * if max is omitted, number of digits must be equal to min
     * 
     * @param int $min
     * @param int|null $max
     * @param string|null $message
     * @return static
     */
    public function digits(int $min, int $max = null, string $message = null): static;

    /**
     * validate number of digits in parameter is less than or equal to max
     * 
     * @param int $max
     * @param string|null $message
     * @return static
     */
    public function maxDigits(int $max, string $message = null): static;

    /**
     * validate number of digits in parameter is greater than or equal to min
     * 
     * @param int $min
     * @param string|null $message
     * @return static
     */
    public function minDigits(int $min, string $message = null): static;

    /*----------------------------------------*
     * Rule Regex
     *----------------------------------------*/

    /**
     * validate parameter matches regular expression pattern
     * 
     * @param string $pattern
     * @param string|null $message
     * @return static
     */
    public function regex(string $pattern, string $message = null): static;

    /**
     * validate parameter does not match regular expression pattern
     * 
     * @param string $pattern
     * @param string|null $message
     * @return static
     */
    public function notRegex(string $pattern, string $message = null): static;

    /**
     * validate parameter matches pattern of a valid telephone number
     * 
     * @param string|null $message
     * @return static
     */
    public function tel(string $message = null): static;

    /**
     * validate parameter matches pattern of a valid post code
     * 
     * @param string|null $message
     * @return static
     */
    public function postCode(string $message = null): static;

    /*----------------------------------------*
     * Rule Size
     *----------------------------------------*/

    /**
     * validate parameter has a size of value
     * 
     * @param int $size
     * @param string|null $message
     * @return static
     */
    public function size(int $size, string $message = null): static;

    /**
     * validate parameter is less than or equal to max
     * 
     * @param int $max
     * @param string|null $message
     * @return static
     */
    public function max(int $max, string $message = null): static;

    /**
     * validate parameter is greater than or equal to min
     * 
     * @param int $min
     * @param string|null $message
     * @return static
     */
    public function min(int $min, string $message = null): static;

    /**
     * validate parameter is between min and max
     * 
     * @param int $min
     * @param int $max
     * @param string|null $message
     * @return static
     */
    public function between(int $min, int $max, string $message = null): static;

    /**
     * validate parameter is flag integer
     * 
     * @param string|null $message
     * @return static
     */
    public function flag(string $message = null): static;

    /*----------------------------------------*
     * Rule String
     *----------------------------------------*/

    /**
     * validate parameter is a string
     * 
     * @param string|null $message
     * @return static
     */
    public function string(string $message = null): static;

    /**
     * validate parameter is a JSON string
     * 
     * @param string|null $message
     * @return static
     */
    public function json(string $message = null): static;

    /**
     * validate parameter matches password of authenticated user
     * 
     * @param string $guard
     * @param string|null $message
     * @return static
     */
    public function currentPassword(string $guard = "web", string $message = null): static;

    /**
     * validate parameter is an email address
     * 
     * @param string|null $message
     * @return static
     */
    public function email(string $message = null): static;

    /**
     * validate parameter is a URL
     * 
     * @param string|null $message
     * @return static
     */
    public function url(string $message = null): static;

    /**
     * validate parameter is a valid URL
     * 
     * @param string|null $message
     * @return static
     */
    public function activeUrl(string $message = null): static;

    /**
     * validate parameters are uppercase
     * 
     * @param string|null $message
     * @return static
     */
    public function uppercase(string $message = null): static;

    /**
     * validate parameters are lowercase
     * 
     * @param string|null $message
     * @return static
     */
    public function lowercase(string $message = null): static;

    /**
     * validate parameter is a valid IP address
     * 
     * @param string|null $message
     * @return static
     */
    public function ip(string $message = null): static;

    /**
     * validate parameter is an IPv4 address
     * 
     * @param string|null $message
     * @return static
     */
    public function ipv4(string $message = null): static;

    /**
     * validate parameter is an IPv6 address
     * 
     * @param string|null $message
     * @return static
     */
    public function ipv6(string $message = null): static;

    /**
     * validate parameter is a valid MAC address
     * 
     * @param string|null $message
     * @return static
     */
    public function macAddress(string $message = null): static;

    /**
     * validate parameter is a UUID
     * 
     * @param string|null $message
     * @return static
     */
    public function uuid(string $message = null): static;

    /**
     * validate parameter is a ULID
     * 
     * @param string|null $message
     * @return static
     */
    public function ulid(string $message = null): static;

    /**
     * validate parameter consist of ASCII characters
     * 
     * @param string|null $message
     * @return static
     */
    public function ascii(string $message = null): static;

    /**
     * validate parameters consist of Unicode alphabetic characters
     * if isAscii is true, validate parameters consist of ASCII characters
     * 
     * @param bool $isAscii
     * @param string|null $message
     * @return static
     */
    public function alpha(bool $isAscii = false, string $message = null): static;

    /**
     * validate parameters consist of Unicode alphabetic characters and numbers
     * if isAscii is true, validate parameters consist of ASCII characters and numbers
     * 
     * @param bool $isAscii
     * @param string|null $message
     * @return static
     */
    public function alphaNum(bool $isAscii = false, string $message = null): static;

    /**
     * validate parameters consist of Unicode alphabetic characters, numbers, underscores and hyphens
     * if isAscii is true, validate parameters consist of ASCII characters, numbers, underscores and hyphens
     * 
     * @param bool $isAscii
     * @param string|null $message
     * @return static
     */
    public function alphaDash(bool $isAscii = false, string $message = null): static;

    /**
     * validate parameter is a valid color code in hexadecimal format
     * 
     * @param string|null $message
     * @return static
     */
    public function hexColor(string $message = null): static;

    /*----------------------------------------*
     * Rule Table
     *----------------------------------------*/

    /**
     * validate parameter is present in column of table
     * if column is not specified, keyName is used instead
     * 
     * @param string $table
     * @param string|null $column
     * @param string|null $message
     * @return static
     */
    public function exists(string $table, string $column = null, string $message = null): static;

    /**
     * validate parameter is present in column of table and is not deleted
     * if column is not specified, keyName is used instead
     * 
     * @param string $table
     * @param string|null $column
     * @param string $deletedAtColumn
     * @param string|null $message
     * @return static
     */
    public function existsNotDeleted(string $table, string $column = null, string $deletedAtColumn = "deleted_at", string $message = null): static;

    /**
     * validate parameter is not present in column of table
     * if column is not specified, keyName is used instead
     * 
     * @param string $table
     * @param string|null $column
     * @param string|null $message
     * @return static
     */
    public function unique(string $table, string $column = null, string $message = null): static;

    /**
     * validate parameter is not present in column of table in which deleted_at column is null
     * if column is not specified, keyName is used instead
     * 
     * @param string $table
     * @param string|null $column
     * @param string $deletedAtColumn
     * @param string|null $message
     * @return static
     */
    public function uniqueNotDeleted(string $table, string $column = null, string $deletedAtColumn = "deleted_at", string $message = null): static;

    /**
     * validate parameter is present in id column of table
     * 
     * @param string $table
     * @param string|null $message
     * @return static
     */
    public function id(string $table, string $message = null): static;

    /*----------------------------------------*
     * Rule Values
     *----------------------------------------*/

    /**
     * validate parameter is in values
     * 
     * @param \Illuminate\Contracts\Support\Arrayable|array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function in(Arrayable|array|string $values, string $message = null): static;

    /**
     * validate parameter is not in values
     * 
     * @param \Illuminate\Contracts\Support\Arrayable|array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function notIn(Arrayable|array|string $values, string $message = null): static;

    /**
     * validate parameter starts with one of values
     * 
     * @param array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function startsWith(array|string $values, string $message = null): static;

    /**
     * validate parameter does not start with any of values
     * 
     * @param array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function doesntStartWith(array|string $values, string $message = null): static;

    /**
     * validate parameter ends with one of values
     * 
     * @param array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function endsWith(array|string $values, string $message = null): static;

    /**
     * validate parameter does not end with any of values
     * 
     * @param array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function doesntEndWith(array|string $values, string $message = null): static;
}
