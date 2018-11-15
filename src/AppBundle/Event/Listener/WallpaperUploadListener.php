<?php

namespace AppBundle\Event\Listener;

use AppBundle\Service\FileMover;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class WallpaperUploadListener
{

    /**
     * @var FileMover
     */
    private $fileMover;

    public function __construct(FileMover $fileMover)
    {
        // TODO: write logic here
        $this->fileMover = $fileMover;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
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
