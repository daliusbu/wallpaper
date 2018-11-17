<?php

namespace AppBundle\Service;

class ImageFileDimensionsHelper
{

    private $imageSizeAttributes;

    public function setImageFilePath(string $filePath)
    {
        $this->imageSizeAttributes = getImagesize($filePath);
    }

    public function getWidth()
    {
        try {
            return (int) $this->imageSizeAttributes[0];
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getHeight()
    {
        try {
            return (int) $this->imageSizeAttributes[1];
        } catch (\Exception $e){
            return 0;
        }
    }
}
