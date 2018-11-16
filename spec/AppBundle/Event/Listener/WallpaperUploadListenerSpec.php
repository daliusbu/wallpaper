<?php

namespace spec\AppBundle\Event\Listener;

use AppBundle\Entity\Category;
use AppBundle\Event\Listener\WallpaperUploadListener;
use AppBundle\Service\LocalFilesystemFileMover;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping\PrePersist;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WallpaperUploadListenerSpec extends ObjectBehavior
{
    private $fileMover;

    function let(LocalFilesystemFileMover $fileMover){
        $this->beConstructedWith($fileMover);

        $this->fileMover = $fileMover;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(WallpaperUploadListener::class);
    }

    function it_returns_early_if_lifecycleEventArgs_is_not_Wallpaper_entity(
        LifecycleEventArgs $eventArgs)
    {

        $eventArgs->getEntity()->willReturn(new Category());
        $this->prePersist($eventArgs)->shouldReturn(false);
        $this->fileMover->move(
            Argument::any(),
            Argument::any()
        )->shouldNotHaveBeenCalled();


    }


    function it_can_prePersist(LifecycleEventArgs $eventArgs){

        $fakeTemp = "/fake/temp/path";
        $fakeDestination= "/fake/destination/path";

        $this->prePersist($eventArgs);

        $this->fileMover->move($fakeTemp, $fakeDestination)->shouldHaveBeenCalled();


    }



    function it_can_preUpdate(PreUpdateEventArgs $eventArgs){
        $this->preUpdate($eventArgs);
    }


}
