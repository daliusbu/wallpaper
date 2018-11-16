<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Wallpaper;
use AppBundle\Service\LocalFilesystemFileMover;
use AppBundle\Service\WallpaperFilepathHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping\Entity;

class WallpaperUploadListener
{

    /**
     * @var LocalFilesystemFileMover
     */
    private $fileMover;
    /**
     * @var WallpaperFilepathHelper
     */
    private $wallpaperFilepathHelper;

    public function __construct(LocalFilesystemFileMover $fileMover, WallpaperFilepathHelper $wallpaperFilepathHelper)
    {
        $this->fileMover = $fileMover;
        $this->wallpaperFilepathHelper = $wallpaperFilepathHelper;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {

        $entity = $eventArgs->getEntity();

        if(false ===  $entity instanceof Wallpaper){
            return false;
        }

        /**
         * @var $entity Wallpaper
         */

        $file = $entity->getFile();
        $temporaryLocation = $file->getPathname();
        $newFileLocation = $this->wallpaperFilepathHelper->getNewFilePath($file->getClientOriginalName());

        //todo:
        // - Move the uploaded file
        $this->fileMover->move($temporaryLocation, $newFileLocation);

        //todo:
        // set additional parameters of the entity
        $width = getimagesize($newFileLocation)[0];
        $height = getimagesize($newFileLocation)[1];

        $entity
            ->setFilename($file->getClientOriginalName())
            ->setWidth($width)
            ->setHeight($height)
        ;


;
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
