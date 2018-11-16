<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.16
 * Time: 08.05
 */

namespace AppBundle\Service;


class WallpaperFilepathHelper
{

    /**
     * @var string
     */
    private $wallpaperFileDirectory;

    public function __construct(string $wallpaperFileDirectory)
    {
        $this->wallpaperFileDirectory = $wallpaperFileDirectory;
    }

    public function getNewFilePath(string $newFilename)
    {
        return $this->wallpaperFileDirectory . $newFilename;
    }
}