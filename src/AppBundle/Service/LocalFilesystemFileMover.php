<?php

namespace AppBundle\Service;

use Symfony\Component\Filesystem\Filesystem;

class LocalFilesystemFileMover implements FileMover
{

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }


    public function move($fromLocation, $toLocation)
    {
        $this->filesystem->rename( $fromLocation, $toLocation);
        return true;
    }
}
