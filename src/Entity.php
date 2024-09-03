<?php

namespace YukataRm\Laravel\Request;

use YukataRm\Entity\ArrayEntity;

use Illuminate\Http\UploadedFile;

/**
 * Base Entity
 * 
 * @package YukataRm\Laravel\Request
 */
abstract class Entity extends ArrayEntity
{
    /**
     * constructor
     * 
     * @param array $validated
     */
    public function __construct(array $validated)
    {
        $this->set($validated);
    }

    /*----------------------------------------*
     * Property
     *----------------------------------------*/

    /**
     * get property as UploadedFile or null
     * 
     * @param string $name
     * @return \Illuminate\Http\UploadedFile|null
     */
    public function file(string $name): UploadedFile|null
    {
        $property = $this->get($name);

        return $property instanceof UploadedFile ? $property : null;
    }

    /**
     * get property as UploadedFile array or null
     * 
     * @param string $name
     * @return array<string, \Illuminate\Http\UploadedFile>|null
     */
    public function files(string $name): array|null
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
}
