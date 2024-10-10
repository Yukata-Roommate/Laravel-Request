<?php

namespace YukataRm\Laravel\Request\Entity;

use YukataRm\Entity\ArrayEntity;

use Illuminate\Http\UploadedFile;

/**
 * Base Entity
 * 
 * @package YukataRm\Laravel\Request\Entity
 */
abstract class BaseEntity extends ArrayEntity
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
     * Property
     *----------------------------------------*/

    /**
     * get property as nullable UploadedFile
     * 
     * @param string $name
     * @return \Illuminate\Http\UploadedFile|null
     */
    public function nullableFile(string $name): UploadedFile|null
    {
        $property = $this->get($name);

        return $property instanceof UploadedFile ? $property : null;
    }

    /**
     * get property as UploadedFile
     * 
     * @param string $name
     * @return \Illuminate\Http\UploadedFile
     */
    public function file(string $name): UploadedFile
    {
        $property = $this->nullableFile($name);

        if (is_null($property)) $this->throwRequiredException($name);

        return $property;
    }

    /**
     * get property as nullable UploadedFile array
     * 
     * @param string $name
     * @return array<string, \Illuminate\Http\UploadedFile>|null
     */
    public function nullableFiles(string $name): array|null
    {
        $property = $this->get($name);

        if (!is_array($property)) return null;

        $files = [];

        foreach ($property as $key => $value) {
            if ($value instanceof UploadedFile) {
                $files[$key] = $value;
            }
        }

        return count($files) > 0 ? $files : null;
    }

    /**
     * get property as UploadedFile array
     * 
     * @param string $name
     * @return array<string, \Illuminate\Http\UploadedFile>
     */
    public function files(string $name): array
    {
        $property = $this->nullableFiles($name);

        if (is_null($property)) $this->throwRequiredException($name);

        return $property;
    }
}
