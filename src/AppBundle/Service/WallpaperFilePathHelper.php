<?php

namespace AppBundle\Service;

class WallpaperFilePathHelper
{
    /**
     * @var string
     */
    private $wallpaperFileDirectory;

    public function __construct($wallpaperFileDirectory)
    {
        $this->wallpaperFileDirectory = $this
            ->ensureHasTrailingSlash( $wallpaperFileDirectory);
    }

    public function getNewFilePath(string $newFilename)
    {
        return $this->wallpaperFileDirectory . $this
                ->removeLeadingSlashOfFilename($newFilename);
    }

    private function ensureHasTrailingSlash(string $path){
        if (substr($path, -1)==='/'){
            return $path;
        }
        return $path . '/';
    }

    private function removeLeadingSlashOfFilename($filename){
        if (substr($filename, 0, 1)==='/'){
            return substr($filename,1);
        }
        return $filename;
    }
}
