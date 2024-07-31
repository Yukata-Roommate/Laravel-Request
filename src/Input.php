<?php

namespace YukataRm\Laravel\Request;

use YukataRm\Laravel\Request\Interface\InputInterface;

use Stringable;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Input in Request
 * 
 * @package YukataRm\Laravel\Request
 */
class Input implements InputInterface
{
    /*----------------------------------------*
     * Constructor
     *----------------------------------------*/

    /**
     * key name
     *
     * @var string
     */
    protected string $keyName;

    /**
     * constructor
     * 
     * @param string $keyName
     */
    function __construct(string $keyName)
    {
        if (empty($keyName)) throw new \RuntimeException("keyName cannot be empty.");

        $this->keyName = $keyName;
    }

    /**
     * get key name
     * 
     * @return string
     */
    public function getKeyName(): string
    {
        return $this->keyName;
    }

    /*----------------------------------------*
     * Property
     *----------------------------------------*/

    /**
     * attribute name
     * 
     * @var string|null
     */
    protected string|null $attributeName = null;

    /**
     * validation rules
     * 
     * @var array<\Stringable|array<mixed>|string>
     */
    protected array $rules = [];

    /**
     * failed validation messages
     * 
     * @var array<string, string>
     */
    protected array $messages = [];

    /**
     * set attribute name
     * 
     * @param string $attributeName
     * @return static
     */
    public function setAttributeName(string $attributeName): static
    {
        $this->attributeName = $attributeName;

        return $this;
    }

    /**
     * get attribute name
     * 
     * @return string|null
     */
    public function getAttributeName(): string|null
    {
        return __($this->attributeName);
    }

    /**
     * set validation rules
     * 
     * @param array<\Stringable|array<mixed>|string> $rules
     * @return static
     */
    public function setRules(array $rules): static
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * merge validation rules
     * 
     * @param array<\Stringable|array<mixed>|string> $rules
     * @return static
     */
    public function mergeRules(array $rules): static
    {
        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }

    /**
     * add validation rule
     * 
     * @param \Stringable|array<mixed>|string $rule
     * @return static
     */
    public function addRule(Stringable|array|string $rule): static
    {
        $this->rules[] = $rule;

        return $this;
    }

    /**
     * add validation rule with values
     * 
     * @param string $ruleName
     * @param array<mixed> $values
     * @return static
     */
    public function addRuleValues(string $ruleName, array ...$values): static
    {
        $values = implode(",", $values);

        return $this->addRule("{$ruleName}:{$values}");
    }

    /**
     * get validation rules
     * 
     * @return array<\Stringable|array<mixed>|string>
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * set failed validation messages
     * 
     * @param array<string, string> $messages
     * @return static
     */
    public function setMessages(array $messages): static
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * merge failed validation messages
     * 
     * @param array<string, string> $messages
     * @return static
     */
    public function mergeMessages(array $messages): static
    {
        $this->messages = array_merge($this->messages, $messages);

        return $this;
    }

    /**
     * add failed validation message
     * 
     * @param string $ruleKey
     * @param string $message
     * @return static
     */
    public function addMessage(string $ruleKey, string $message): static
    {
        $messageKey = "{$this->keyName}.{$ruleKey}";

        $this->messages[$messageKey] = $message;

        return $this;
    }

    /**
     * get failed validation messages
     * 
     * @return array<string, string>
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * get validation rules and failed validation messages
     * 
     * @param string $ruleKey
     * @param string|null $message
     * @return static
     */
    protected function addRuleAndMessage(string $ruleKey, string $message = null): static
    {
        $this->addRule($ruleKey);

        if (!is_null($message)) $this->addMessage($ruleKey, $message);

        return $this;
    }

    /**
     * add validation rule with values and failed validation message
     * 
     * @param string $ruleKey
     * @param array<string|int>|string|int $values
     * @param string|null $message
     * @return static
     */
    protected function addRuleValuesAndMessage(string $ruleKey, array|string|int $values, string $message = null): static
    {
        if (is_string($values) && $values !== "") $values = [$values];

        if (is_numeric($values)) $values = [$values];

        $this->addRuleValues($ruleKey, ...$values);

        if (!is_null($message)) $this->addMessage($ruleKey, $message);

        return $this;
    }

    /**
     * add validation rule object and failed validation message
     * 
     * @param string $ruleKey
     * @param \Stringable $rule
     * @param string|null $message
     * @return static
     */
    protected function addRuleObjectAndMessage(string $ruleKey, Stringable $rule, string $message = null): static
    {
        $this->addRule($rule);

        if (!is_null($message)) $this->addMessage($ruleKey, $message);

        return $this;
    }

    /*----------------------------------------*
     * Rule Array
     *----------------------------------------*/

    /**
     * validate the parameter as an array
     * if acceptKeys is specified, validate the parameter has the specified keys
     * 
     * @param array<string>|string|null $acceptKeys
     * @param string|null $message
     * @return static
     */
    public function array(array|string|null $acceptKeys = null, string $message = null): static
    {
        return empty($acceptKeys)
            ? $this->addRuleAndMessage("array", $message)
            : $this->addRuleValuesAndMessage("array", $acceptKeys, $message);
    }

    /**
     * validate the parameter as an array and validate the parameter has the specified keys
     * 
     * @param array<string>|string $keys
     * @param string|null $message
     * @return static
     */
    public function requiredArrayKeys(array|string $keys, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("required_array_keys", $keys, $message);
    }

    /**
     * validate the parameter is one of the values field has
     * 
     * @param string $field
     * @param string $key
     * @param string|null $message
     * @return static
     */
    public function inArray(string $field, string $key, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("in_array", [$field, $key], $message);
    }

    /**
     * validate the parameter is an array and has no duplicate values
     * 
     * @param string|null $message
     * @return static
     */
    public function distinct(string $message = null): static
    {
        return $this->addRuleAndMessage("distinct", $message);
    }

    /**
     * validate strict the parameter is an array and has no duplicate values
     * 
     * @param string|null $message
     * @return static
     */
    public function distinctStrict(string $message = null): static
    {
        return $this->addRuleValuesAndMessage("distinct", "strict", $message);
    }

    /**
     * validate case-insensitive the parameter is an array and has no duplicate values
     * 
     * @param string|null $message
     * @return static
     */
    public function distinctIgnoreCase(string $message = null): static
    {
        return $this->addRuleValuesAndMessage("distinct", "ignore_case", $message);
    }

    /*----------------------------------------*
     * Rule Boolean
     *----------------------------------------*/

    /**
     * validate the parameter as a boolean value
     * 
     * @param string|null $message
     * @return static
     */
    public function boolean(string $message = null): static
    {
        return $this->addRuleAndMessage("boolean", $message);
    }

    /*----------------------------------------*
     * Rule Date
     *----------------------------------------*/

    /**
     * validate the parameter as a date value
     * 
     * @param string|null $message
     * @return static
     */
    public function date(string $message = null): static
    {
        return $this->addRuleAndMessage("date", $message);
    }

    /**
     * validate the parameter as a date value and format it with the specified format
     * 
     * @param string $format
     * @param string|null $message
     * @return static
     */
    public function dateFormat(string $format, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("date_format", $format, $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is equal to date
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function dateEqual(string $date, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("date_equals", $date, $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is later than date
     * date is either the date to be compared or a parameter name
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function after(string $date, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("after", $date, $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is later than or equal to date
     * date is either the date to be compared or a parameter name
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function afterOrEqual(string $date, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("after_or_equal", $date, $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is earlier than date
     * date is either the date to be compared or a parameter name
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function before(string $date, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("before", $date, $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is earlier than or equal to date
     * date is either the date to be compared or a parameter name
     * 
     * @param string $date
     * @param string|null $message
     * @return static
     */
    public function beforeOrEqual(string $date, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("before_or_equal", $date, $message);
    }

    /**
     * validate the parameter is a valid time zone
     * if an identifier is specified, validate the time zone is available in the identifier
     * 
     * @param string|null $identifier
     * @param string|null $message
     * @return static
     */
    public function timezone(string $identifier = null, string $message = null): static
    {
        return is_null($identifier) ? $this->addRuleAndMessage("timezone", $message) : $this->addRuleValuesAndMessage("timezone", $identifier, $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and follows the Y-m-d format
     * 
     * @param string|null $message
     * @return static
     */
    public function asDate(string $message = null): static
    {
        return $this->dateFormat("Y-m-d", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and follows the H:i:s format
     * 
     * @param string|null $message
     * @return static
     */
    public function asTime(string $message = null): static
    {
        return $this->dateFormat("H:i:s", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and follows the Y-m-d H:i:s format
     * 
     * @param string|null $message
     * @return static
     */
    public function asDateTime(string $message = null): static
    {
        return $this->dateFormat("Y-m-d H:i:s", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and follows the Y-m format
     * 
     * @param string|null $message
     * @return static
     */
    public function asYearMonth(string $message = null): static
    {
        return $this->dateFormat("Y-m", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and follows the m-d format
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonthDay(string $message = null): static
    {
        return $this->dateFormat("m-d", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and follows the H:i format
     * 
     * @param string|null $message
     * @return static
     */
    public function asHourMinute(string $message = null): static
    {
        return $this->dateFormat("H:i", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and follows the i:s format
     * 
     * @param string|null $message
     * @return static
     */
    public function asMinuteSecond(string $message = null): static
    {
        return $this->dateFormat("i:s", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid year
     * 
     * @param string|null $message
     * @return static
     */
    public function asYear(string $message = null): static
    {
        return $this->dateFormat("Y", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid month
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonth(string $message = null): static
    {
        return $this->dateFormat("n", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid 0-padded month
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonthZero(string $message = null): static
    {
        return $this->dateFormat("m", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid month name
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonthName(array|string $message = null): static
    {
        return $this->dateFormat("F", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid short month name
     * 
     * @param string|null $message
     * @return static
     */
    public function asMonthNameShort(array|string $message = null): static
    {
        return $this->dateFormat("M", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid day
     * 
     * @param string|null $message
     * @return static
     */
    public function asDay(string $message = null): static
    {
        return $this->dateFormat("j", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid 0-padded day
     * 
     * @param string|null $message
     * @return static
     */
    public function asDayZero(string $message = null): static
    {
        return $this->dateFormat("d", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid hour
     * 
     * @param string|null $message
     * @return static
     */
    public function asHour(string $message = null): static
    {
        return $this->dateFormat("G", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid 0-padded hour
     * 
     * @param string|null $message
     * @return static
     */
    public function asHourZero(string $message = null): static
    {
        return $this->dateFormat("H", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid 12-hour notation hour
     * 
     * @param string|null $message
     * @return static
     */
    public function asHourTwelveNotation(string $message = null): static
    {
        return $this->dateFormat("g", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid 0-padded 12-hour notation hour
     * 
     * @param string|null $message
     * @return static
     */
    public function asHourTwelveNotationZero(string $message = null): static
    {
        return $this->dateFormat("h", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid minute
     * 
     * @param string|null $message
     * @return static
     */
    public function asMinute(string $message = null): static
    {
        return $this->dateFormat("i", $message);
    }

    /**
     * validate the parameter is a value can be treated as a date and is a valid second
     * 
     * @param string|null $message
     * @return static
     */
    public function asSecond(string $message = null): static
    {
        return $this->dateFormat("s", $message);
    }

    /*----------------------------------------*
     * Rule Field
     *----------------------------------------*/

    /**
     * validate the parameter matches the value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function same(string $field, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("same", $field, $message);
    }

    /**
     * validate the parameter does not match the value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function different(string $field, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("different", $field, $message);
    }

    /**
     * validate the parameter is greater than the value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function gt(string $field, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("gt", $field, $message);
    }

    /**
     * validate the parameter is greater than or equal to the value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function gte(string $field, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("gte", $field, $message);
    }

    /**
     * validate the parameter is less than the value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function lt(string $field, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("lt", $field, $message);
    }

    /**
     * validate the parameter is less than or equal to the value of field
     * 
     * @param string $field
     * @param string|null $message
     * @return static
     */
    public function lte(string $field, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("lte", $field, $message);
    }

    /**
     * validate {field}_confirmation exists as a parameter and the parameter matches it
     * 
     * @param string|null $message
     * @return static
     */
    public function confirmed(string $message = null): static
    {
        return $this->addRuleAndMessage("confirmed", $message);
    }

    /**
     * validate the parameter is 1, true, “on”, “yes”
     * 
     * @param string|null $message
     * @return static
     */
    public function accepted(string $message = null): static
    {
        return $this->addRuleAndMessage("accepted", $message);
    }

    /**
     * validate the parameter is 1, true, “on”, “yes” if field is equal to value
     * 
     * @param string $field
     * @param mixed $value
     * @param string|null $message
     * @return static
     */
    public function acceptedIf(string $field, mixed $value, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("accepted_if", [$field, $value], $message);
    }

    /**
     * validate the parameter is 0, false, “off”, “no”
     * 
     * @param string|null $message
     * @return static
     */
    public function declined(string $message = null): static
    {
        return $this->addRuleAndMessage("declined", $message);
    }

    /**
     * validate the parameter is 0, false, “off”, “no” if field is equal to value
     * 
     * @param string $field
     * @param mixed $value
     * @param string|null $message
     * @return static
     */
    public function declinedIf(string $field, mixed $value, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("declined_if", [$field, $value], $message);
    }

    /*----------------------------------------*
     * Rule File
     *----------------------------------------*/

    /**
     * validate the parameter as a file
     * 
     * @param string|null $message
     * @return static
     */
    public function file(string $message = null): static
    {
        return $this->addRuleAndMessage("file", $message);
    }

    /**
     * validate the parameter as an image
     * 
     * @param string|null $message
     * @return static
     */
    public function image(string $message = null): static
    {
        return $this->addRuleAndMessage("image", $message);
    }

    /**
     * validate the parameter is a file, mime type corresponding to one of the extensions specified in the extensions
     * 
     * @param array<string>|string $extensions
     * @param string|null $message
     * @return static
     */
    public function mimes(array|string $extensions, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("mimes", $extensions, $message);
    }

    /**
     * validate the parameter is a file, mime type corresponding to one of the mimetypes specified in the mimetypes
     * 
     * @param array<string>|string $mimetypes
     * @param string|null $message
     * @return static
     */
    public function mimetypes(array|string $mimetypes, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("mimetypes", $mimetypes, $message);
    }

    /**
     * validate the parameter is a file and the extension is one of those specified in extensions
     * 
     * @param array<string>|string $extensions
     * @param string|null $message
     * @return static
     */
    public function extensions(array|string $extensions, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("extensions", $extensions, $message);
    }

    /**
     * validate the parameter is a file and matches the specified size
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
    public function dimensions(int $width = null, int $height = null, int $minWidth = null, int $minHeight = null, int $maxWidth = null, int $maxHeight = null, float|string $ratio = null, string $message = null): static
    {
        $rules = [];

        if (!is_null($width)) $rules[] = "width={$width}";

        if (!is_null($height)) $rules[] = "height={$height}";

        if (!is_null($minWidth)) $rules[] = "min_width={$minWidth}";

        if (!is_null($minHeight)) $rules[] = "min_height={$minHeight}";

        if (!is_null($maxWidth)) $rules[] = "max_width={$maxWidth}";

        if (!is_null($maxHeight)) $rules[] = "max_height={$maxHeight}";

        if (!is_null($ratio)) $rules[] = "ratio={$ratio}";

        return empty($rules) ? $this : $this->addRuleValuesAndMessage("dimensions", $rules, $message);
    }

    /*----------------------------------------*
     * Rule Necessary
     *----------------------------------------*/

    /**
     * validate the parameter is required
     * 
     * @param string|null $message
     * @return static
     */
    public function required(string $message = null): static
    {
        return $this->addRuleAndMessage("required", $message);
    }

    /**
     * validate the parameter is required if field matches value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function requiredIfField(string $field, array $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("required_if", [$field, ...$values], $message);
    }

    /**
     * validate the parameter is required if field matches 1, true, “on”, “yes”
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredIfAccepted(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("required_if_accepted", $fields, $message);
    }

    /**
     * validate the parameter is required if field does not match value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function requiredUnlessField(string $field, array $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("required_unless", [$field, ...$values], $message);
    }

    /**
     * validate the parameter is required if some of the fields are present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredWith(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("required_with", $fields, $message);
    }

    /**
     * validate the parameter is required if all of the fields are present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredWithAll(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("required_with_all", $fields, $message);
    }

    /**
     * validate the parameter is required if some of the fields are not present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredWithout(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("required_without", $fields, $message);
    }

    /**
     * validate the parameter is required if all of the fields are not present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function requiredWithoutAll(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("required_without_all", $fields, $message);
    }

    /**
     * validate the parameter is not present
     * 
     * @param string|null $message
     * @return static
     */
    public function missing(string $message = null): static
    {
        return $this->addRuleAndMessage("missing", $message);
    }

    /**
     * validate the parameter is not present if field matches value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function missingIfField(string $field, array $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("missing_if", [$field, ...$values], $message);
    }

    /**
     * validate the parameter is not present if field does not match value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function missingUnlessField(string $field, array $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("missing_unless", [$field, ...$values], $message);
    }

    /**
     * validate the parameter is not present if some of the fields are present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function missingWith(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("missing_with", $fields, $message);
    }

    /**
     * validate the parameter is not present if all of the fields are present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function missingWithAll(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("missing_with_all", $fields, $message);
    }

    /**
     * validate the parameter is not present if some of the fields are not present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function missingWithout(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("missing_without", $fields, $message);
    }

    /**
     * validate the parameter is not present if all of the fields are not present
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function missingWithoutAll(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("missing_without_all", $fields, $message);
    }

    /**
     * validate the parameter is not present, or is an empty
     * 
     * @param string|null $message
     * @return static
     */
    public function prohibited(string $message = null): static
    {
        return $this->addRuleAndMessage("prohibited", $message);
    }

    /**
     * validate the parameter is not present, or is an empty if field matches value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function prohibitedIfField(string $field, array $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("prohibited_if", [$field, ...$values], $message);
    }

    /**
     * validate the parameter is not present, or is an empty if field does not match value
     * 
     * @param string $field
     * @param array<mixed> $values
     * @param string|null $message
     * @return static
     */
    public function prohibitedUnlessField(string $field, array $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("prohibited_unless", [$field, ...$values], $message);
    }

    /**
     * validate all fields in fields are absent or empty if the parameter is present and non-empty
     * 
     * @param array<string>|string $fields
     * @param string|null $message
     * @return static
     */
    public function prohibits(array|string $fields, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("prohibits", $fields, $message);
    }

    /**
     * validate the parameter is present
     * 
     * @param string|null $message
     * @return static
     */
    public function present(string $message = null): static
    {
        return $this->addRuleAndMessage("present", $message);
    }

    /**
     * validate the parameter is not empty if the parameter is present
     * 
     * @param string|null $message
     * @return static
     */
    public function filled(string $message = null): static
    {
        return $this->addRuleAndMessage("filled", $message);
    }

    /**
     * nullable the parameter
     * 
     * @param string|null $message
     * @return static
     */
    public function nullable(string $message = null): static
    {
        return $this->addRuleAndMessage("nullable", $message);
    }

    /**
     * validate the parameter is required if isRequired is true
     * 
     * @param bool $isRequired
     * @param string|null $message
     * @return static
     */
    public function requiredIf(bool $isRequired, string $message = null): static
    {
        return $isRequired ? $this->required($message) : $this;
    }

    /**
     * validate the parameter is required if isRequired is false
     * 
     * @param bool $isRequired
     * @param string|null $message
     * @return static
     */
    public function requiredUnless(bool $isRequired, string $message = null): static
    {
        return !$isRequired ? $this->required($message) : $this;
    }

    /**
     * validate the parameter is not present if isMissing is true
     * 
     * @param bool $isMissing
     * @param string|null $message
     * @return static
     */
    public function missingIf(bool $isMissing, string $message = null): static
    {
        return $isMissing ? $this->missing($message) : $this;
    }

    /**
     * validate the parameter is not present if isMissing is false
     * 
     * @param bool $isMissing
     * @param string|null $message
     * @return static
     */
    public function missingUnless(bool $isMissing, string $message = null): static
    {
        return !$isMissing ? $this->missing($message) : $this;
    }

    /**
     * validate the parameter is not present, or is an empty if isProhibited is true
     * 
     * @param bool $isProhibited
     * @param string|null $message
     * @return static
     */
    public function prohibitedIf(bool $isProhibited, string $message = null): static
    {
        return $isProhibited ? $this->prohibited($message) : $this;
    }

    /**
     * validate the parameter is not present, or is an empty if isProhibited is false
     * 
     * @param bool $isProhibited
     * @param string|null $message
     * @return static
     */
    public function prohibitedUnless(bool $isProhibited, string $message = null): static
    {
        return !$isProhibited ? $this->prohibited($message) : $this;
    }

    /*----------------------------------------*
     * Rule Numeric
     *----------------------------------------*/

    /**
     * validate the parameter is numeric
     * 
     * @param string|null $message
     * @return static
     */
    public function numeric(string $message = null): static
    {
        return $this->addRuleAndMessage("numeric", $message);
    }

    /**
     * validate the parameter is an integer
     * 
     * @param string|null $message
     * @return static
     */
    public function integer(string $message = null): static
    {
        return $this->addRuleAndMessage("integer", $message);
    }

    /**
     * validate the parameter is a number multiple of num
     * 
     * @param int $num
     * @param string|null $message
     * @return static
     */
    public function multipleOf(int $num, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("multiple_of", $num, $message);
    }

    /**
     * validate the parameter has a number of decimal places greater than or equal to min and less than or equal to max
     * if max is omitted, the number of decimal places must be equal to min
     * 
     * @param int $min
     * @param int|null $max
     * @param string|null $message
     * @return static
     */
    public function decimal(int $min, int $max = null, string $message = null): static
    {
        return is_null($max)
            ? $this->addRuleValuesAndMessage("decimal", $min, $message)
            : $this->addRuleValuesAndMessage("decimal", [$min, $max], $message);
    }

    /**
     * validate the parameter has a number of digits greater than min and less than max
     * if max is omitted, the number of digits must be equal to min
     * 
     * @param int $min
     * @param int|null $max
     * @param string|null $message
     * @return static
     */
    public function digits(int $min, int $max = null, string $message = null): static
    {
        return is_null($max)
            ? $this->addRuleValuesAndMessage("digits", $min, $message)
            : $this->addRuleValuesAndMessage("digits_between", [$min, $max], $message);
    }

    /**
     * validate the number of digits in the parameter is less than or equal to max
     * 
     * @param int $max
     * @param string|null $message
     * @return static
     */
    public function maxDigits(int $max, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("max_digits", $max, $message);
    }

    /**
     * validate the number of digits in the parameter is greater than or equal to min
     * 
     * @param int $min
     * @param string|null $message
     * @return static
     */
    public function minDigits(int $min, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("min_digits", $min, $message);
    }

    /*----------------------------------------*
     * Rule Regex
     *----------------------------------------*/

    /**
     * validate the parameter matches the regular expression pattern
     * 
     * @param string $pattern
     * @param string|null $message
     * @return static
     */
    public function regex(string $pattern, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("regex", $pattern, $message);
    }

    /**
     * validate the parameter does not match the regular expression pattern
     * 
     * @param string $pattern
     * @param string|null $message
     * @return static
     */
    public function notRegex(string $pattern, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("not_regex", $pattern, $message);
    }

    /**
     * validate the parameter matches the pattern of a valid telephone number
     * 
     * @param string|null $message
     * @return static
     */
    public function tel(string $message = null): static
    {
        return $this->regex("/^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/", $message);
    }

    /**
     * validate the parameter matches the pattern of a valid post code
     * 
     * @param string|null $message
     * @return static
     */
    public function postCode(string $message = null): static
    {
        return $this->regex("/^[0-9]{3}-[0-9]{4}$/", $message);
    }

    /*----------------------------------------*
     * Rule Size
     *----------------------------------------*/

    /**
     * validate the parameter has a size of value
     * 
     * @param int $size
     * @param string|null $message
     * @return static
     */
    public function size(int $size, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("size", $size, $message);
    }

    /**
     * validate the parameter is less than or equal to max
     * 
     * @param int $max
     * @param string|null $message
     * @return static
     */
    public function max(int $max, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("max", $max, $message);
    }

    /**
     * validate the parameter is greater than or equal to min
     * 
     * @param int $min
     * @param string|null $message
     * @return static
     */
    public function min(int $min, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("min", $min, $message);
    }

    /**
     * validate the parameter is between min and max
     * 
     * @param int $min
     * @param int $max
     * @param string|null $message
     * @return static
     */
    public function between(int $min, int $max, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("between", [$min, $max], $message);
    }

    /*----------------------------------------*
     * Rule String
     *----------------------------------------*/

    /**
     * validate the parameter is a string
     * 
     * @param string|null $message
     * @return static
     */
    public function string(string $message = null): static
    {
        return $this->addRuleAndMessage("string", $message);
    }

    /**
     * validate the parameter is a JSON string
     * 
     * @param string|null $message
     * @return static
     */
    public function json(string $message = null): static
    {
        return $this->addRuleAndMessage("json", $message);
    }

    /**
     * validate the parameter matches the password of the authenticated user
     * 
     * @param string $guard
     * @param string|null $message
     * @return static
     */
    public function currentPassword(string $guard = "web", string $message = null): static
    {
        return $this->addRuleValuesAndMessage("current_password", $guard, $message);
    }

    /**
     * validate the parameter is an email address
     * 
     * @param string|null $message
     * @return static
     */
    public function email(string $message = null): static
    {
        return $this->addRuleAndMessage("email", $message);
    }

    /**
     * validate the parameter is a URL
     * 
     * @param string|null $message
     * @return static
     */
    public function url(string $message = null): static
    {
        return $this->addRuleAndMessage("url", $message);
    }

    /**
     * validate the parameter is a valid URL
     * 
     * @param string|null $message
     * @return static
     */
    public function activeUrl(string $message = null): static
    {
        return $this->addRuleAndMessage("active_url", $message);
    }

    /**
     * validate parameters are uppercase
     * 
     * @param string|null $message
     * @return static
     */
    public function uppercase(string $message = null): static
    {
        return $this->addRuleAndMessage("uppercase", $message);
    }

    /**
     * validate parameters are lowercase
     * 
     * @param string|null $message
     * @return static
     */
    public function lowercase(string $message = null): static
    {
        return $this->addRuleAndMessage("lowercase", $message);
    }

    /**
     * validate the parameter is a valid IP address
     * 
     * @param string|null $message
     * @return static
     */
    public function ip(string $message = null): static
    {
        return $this->addRuleAndMessage("ip", $message);
    }

    /**
     * validate the parameter is an IPv4 address
     * 
     * @param string|null $message
     * @return static
     */
    public function ipv4(string $message = null): static
    {
        return $this->addRuleAndMessage("ipv4", $message);
    }

    /**
     * validate the parameter is an IPv6 address
     * 
     * @param string|null $message
     * @return static
     */
    public function ipv6(string $message = null): static
    {
        return $this->addRuleAndMessage("ipv6", $message);
    }

    /**
     * validate the parameter is a valid MAC address
     * 
     * @param string|null $message
     * @return static
     */
    public function macAddress(string $message = null): static
    {
        return $this->addRuleAndMessage("mac_address", $message);
    }

    /**
     * validate the parameter is a UUID
     * 
     * @param string|null $message
     * @return static
     */
    public function uuid(string $message = null): static
    {
        return $this->addRuleAndMessage("uuid", $message);
    }

    /**
     * validate the parameter is a ULID
     * 
     * @param string|null $message
     * @return static
     */
    public function ulid(string $message = null): static
    {
        return $this->addRuleAndMessage("ulid", $message);
    }

    /**
     * validate the parameter consist of ASCII characters
     * 
     * @param string|null $message
     * @return static
     */
    public function ascii(string $message = null): static
    {
        return $this->addRuleAndMessage("ascii", $message);
    }

    /**
     * validate the parameters consist of Unicode alphabetic characters
     * if isAscii is true, validate the parameters consist of ASCII characters
     * 
     * @param bool $isAscii
     * @param string|null $message
     * @return static
     */
    public function alpha(bool $isAscii = false, string $message = null): static
    {
        return $isAscii
            ? $this->addRuleValuesAndMessage("alpha", "ascii", $message)
            : $this->addRuleAndMessage("alpha", $message);
    }

    /**
     * validate the parameters consist of Unicode alphabetic characters and numbers
     * if isAscii is true, validate the parameters consist of ASCII characters and numbers
     * 
     * @param bool $isAscii
     * @param string|null $message
     * @return static
     */
    public function alphaNum(bool $isAscii = false, string $message = null): static
    {
        return $isAscii
            ? $this->addRuleValuesAndMessage("alpha_num", "ascii", $message)
            : $this->addRuleAndMessage("alpha_num", $message);
    }

    /**
     * validate the parameters consist of Unicode alphabetic characters, numbers, underscores and hyphens
     * if isAscii is true, validate the parameters consist of ASCII characters, numbers, underscores and hyphens
     * 
     * @param bool $isAscii
     * @param string|null $message
     * @return static
     */
    public function alphaDash(bool $isAscii = false, string $message = null): static
    {
        return $isAscii
            ? $this->addRuleValuesAndMessage("alpha_dash", "ascii", $message)
            : $this->addRuleAndMessage("alpha_dash", $message);
    }

    /**
     * validate the parameter is a valid color code in hexadecimal format
     * 
     * @param string|null $message
     * @return static
     */
    public function hexColor(string $message = null): static
    {
        return $this->addRuleAndMessage("hex_color", $message);
    }

    /*----------------------------------------*
     * Rule Table
     *----------------------------------------*/

    /**
     * validate the parameter is present in the column of the table
     * if column is not specified, keyName is used instead
     * 
     * @param string $table
     * @param string|null $column
     * @param string|null $message
     * @return static
     */
    public function exists(string $table, string $column = null, string $message = null): static
    {
        if (is_null($column)) $column = $this->keyName;

        return $this->addRuleObjectAndMessage("exists", Rule::exists($table, $column), $message);
    }

    /**
     * validate the parameter is present in the column of the table and is not deleted
     * if column is not specified, keyName is used instead
     * 
     * @param string $table
     * @param string|null $column
     * @param string $deletedAtColumn
     * @param string|null $message
     * @return static
     */
    public function existsNotDeleted(string $table, string $column = null, string $deletedAtColumn = "deleted_at", string $message = null): static
    {
        if (is_null($column)) $column = $this->keyName;

        return $this->addRuleObjectAndMessage("exists", Rule::exists($table, $column)->whereNull($deletedAtColumn), $message);
    }

    /**
     * validate the parameter is not present in the column of the table
     * if column is not specified, keyName is used instead
     * 
     * @param string $table
     * @param string|null $column
     * @param string|null $message
     * @return static
     */
    public function unique(string $table, string $column = null, string $message = null): static
    {
        if (is_null($column)) $column = $this->keyName;

        return $this->addRuleObjectAndMessage("unique", Rule::unique($table, $column), $message);
    }

    /**
     * validate the parameter is not present in the column of the table in which the deleted_at column is null
     * if column is not specified, keyName is used instead
     * 
     * @param string $table
     * @param string|null $column
     * @param string $deletedAtColumn
     * @param string|null $message
     * @return static
     */
    public function uniqueNotDeleted(string $table, string $column = null, string $deletedAtColumn = "deleted_at", string $message = null): static
    {
        if (is_null($column)) $column = $this->keyName;

        return $this->addRuleObjectAndMessage("unique", Rule::unique($table, $column)->whereNull($deletedAtColumn), $message);
    }

    /**
     * validate the parameter is present in the id column of the table
     * 
     * @param string $table
     * @param string|null $message
     * @return static
     */
    public function id(string $table, string $message = null): static
    {
        return $this->exists($table, "id", $message);
    }

    /*----------------------------------------*
     * Rule Values
     *----------------------------------------*/

    /**
     * validate the parameter is in values
     * 
     * @param \Illuminate\Contracts\Support\Arrayable|array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function in(Arrayable|array|string $values, string $message = null): static
    {
        return $this->addRuleObjectAndMessage("in", Rule::in($values), $message);
    }

    /**
     * validate the parameter is not in values
     * 
     * @param \Illuminate\Contracts\Support\Arrayable|array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function notIn(Arrayable|array|string $values, string $message = null): static
    {
        return $this->addRuleObjectAndMessage("not_in", Rule::notIn($values), $message);
    }

    /**
     * validate the parameter starts with one of the values
     * 
     * @param array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function startsWith(array|string $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("starts_with", $values, $message);
    }

    /**
     * validate the parameter doesn't start with any of the values
     * 
     * @param array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function doesntStartWith(array|string $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("doesnt_start_with", $values, $message);
    }

    /**
     * validate the parameter ends with one of the values
     * 
     * @param array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function endsWith(array|string $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("ends_with", $values, $message);
    }

    /**
     * validate the parameter doesn't end with any of the values
     * 
     * @param array<mixed>|string $values
     * @param string|null $message
     * @return static
     */
    public function doesntEndWith(array|string $values, string $message = null): static
    {
        return $this->addRuleValuesAndMessage("doesnt_end_with", $values, $message);
    }
}
