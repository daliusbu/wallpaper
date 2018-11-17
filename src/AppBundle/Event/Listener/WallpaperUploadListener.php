<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Wallpaper;
use AppBundle\Service\FileMover;
use AppBundle\Service\ImageFileDimensionsHelper;
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
    /**
     * @var ImageFileDimensionsHelper
     */
    private $imageFileDimensionsHelper;

    public function __construct(FileMover $fileMover,
                                WallpaperFilePathHelper $wallpaperFilePathHelper,
                                ImageFileDimensionsHelper $imageFileDimensionsHelper)
    {
        $this->fileMover = $fileMover;
        $this->wallpaperFilePathHelper = $wallpaperFilePathHelper;
        $this->imageFileDimensionsHelper = $imageFileDimensionsHelper;
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

        $this->imageFileDimensionsHelper->setImageFilePath($newFileLocation);
        $entity
            ->setFilename($file->getFilename())
            ->setWidth($this->imageFileDimensionsHelper->getWidth())
            ->setHeight($this->imageFileDimensionsHelper->getHeight());

//        return true;
        return $entity;
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
