<?php

namespace AppBundle\File;

use AppBundle\Model\FileInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SymfonyUploadedFile implements FileInterface
{

    /**
     * @var UploadedFile $uplloadedFile
     */
    private $file;

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
    }

        public function getPathname()
    {
        return $this->file->getPathname();
    }

    public function getFilename()
    {
        return $this->file->getClientOriginalName();
    }


}
