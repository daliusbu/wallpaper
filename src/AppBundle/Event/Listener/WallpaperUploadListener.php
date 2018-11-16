<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Wallpaper;
use AppBundle\Service\FileMover;
use AppBundle\Service\WallpaperFilePathHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class WallpaperUploadListener
{

    /**
     * @var FileMover
     */
    private $fileMover;
    /**
     * @var WallpaperFilePathHelper
     */
    private $wallpaperFilePathHelper;

    public function __construct(FileMover $fileMover, WallpaperFilePathHelper $wallpaperFilePathHelper)
    {
        $this->fileMover = $fileMover;
        $this->wallpaperFilePathHelper = $wallpaperFilePathHelper;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        // if not wallpaper entity - return early

        $entity = $eventArgs->getEntity();
        if (false === $entity instanceof Wallpaper){
            return false;
        }

        /**
         * @var Wallpaper $entity
         */

        $file = $entity->getFile();

        $newFileLocation = $this->wallpaperFilePathHelper->getNewFilePath($file->getFilename());

        $this->fileMover->move(
            $file->getPathname(),
            $newFileLocation
        );

        return true;
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        return false;

    }

//    public function fileMover($argument1, $argument2)
//    {
//        // TODO: write logic here
//    }
}
