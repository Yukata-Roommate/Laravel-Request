<?php

namespace YukataRm\Laravel\Request\Entity;

use YukataRm\Entity\BaseEntity as PHPBaseEntity;

use Illuminate\Http\UploadedFile;

/**
 * Base Entity
 *
 * @package YukataRm\Laravel\Request\Entity
 */
abstract class BaseEntity extends PHPBaseEntity
{
    /**
     * constructor
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data);

        $this->prepare();

        $this->bind();

        $this->passed();
    }

    /**
     * prepare bind properties
     *
     * @return void
     */
    protected function prepare(): void {}

    /**
     * bind properties
     *
     * @return void
     */
    abstract protected function bind(): void;

    /**
     * passed bind properties
     *
     * @return void
     */
    protected function passed(): void {}

    /*----------------------------------------*
     * Value
     *----------------------------------------*/

    /**
     * get property as UploadedFile
     *
     * @param string $name
     * @return \Illuminate\Http\UploadedFile
     */
    public function file(string $name): UploadedFile
    {
        return $this->validated($name, null, function ($property) {
            return $property instanceof UploadedFile;
        });
    }

    /**
     * get property as nullable UploadedFile
     *
     * @param string $name
     * @return \Illuminate\Http\UploadedFile|null
     */
    public function nullableFile(string $name): UploadedFile|null
    {
        return $this->makeNullable(fn() => $this->file($name));
    }

    /**
     * get property as UploadedFile array
     *
     * @param string $name
     * @return array<string, \Illuminate\Http\UploadedFile>
     */
    public function files(string $name): array
    {
        return $this->validated($name, null, function ($property) {
            return is_array($property) && count($property) > 0 && array_reduce($property, function ($carry, $item) {
                return $carry && $item instanceof UploadedFile;
            }, true);
        });
    }

    /**
     * get property as nullable UploadedFile array
     *
     * @param string $name
     * @return array<string, \Illuminate\Http\UploadedFile>|null
     */
    public function nullableFiles(string $name): array|null
    {
        return $this->makeNullable(fn() => $this->files($name));
    }
}
