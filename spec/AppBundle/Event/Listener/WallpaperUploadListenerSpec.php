<?php

namespace spec\AppBundle\Event\Listener;

use AppBundle\Entity\Category;
use AppBundle\Entity\Wallpaper;
use AppBundle\Event\Listener\WallpaperUploadListener;
use AppBundle\Service\FileMover;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping\PrePersist;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class WallpaperUploadListenerSpec extends ObjectBehavior
{
    private $fileMover;

    function let(FileMover $fileMover){
        $this->beConstructedWith($fileMover);

        $this->fileMover = $fileMover;
    }


    function it_is_initializable()
    {
        $this->shouldHaveType(WallpaperUploadListener::class);
    }




    function it_returns_early_if_entity_not_Wallpaper(LifecycleEventArgs $eventArgs){

        $eventArgs->getEntity()->willReturn(new Category());
        $this->prePersist($eventArgs)->shouldReturn(false);
        $this->fileMover->move(
            Argument::any(),
            Argument::any()
        )->shouldNotHaveBeenCalled();
    }





    function it_can_prePersist(
        LifecycleEventArgs $eventArgs
    ){

        $fakeTemp = "/fake/temp/path/";
        $fakeDestination= "/fake/destination/path";

        $uploadedFile = new UploadedFile($fakeTemp, 'some.file');
        $uploadedFile->getPathname()->willReturn($fakeTemp);
        $wallpaper = new Wallpaper();
        $wallpaper->setFile($uploadedFile);
        $eventArgs->getEntity()->willReturn($wallpaper);

        $this->prePersist($eventArgs);

        $this->fileMover->move($fakeTemp, $fakeDestination)->shouldHaveBeenCalled();


    }



    function it_can_preUpdate(PreUpdateEventArgs $eventArgs){
        $this->preUpdate($eventArgs);
    }


}
