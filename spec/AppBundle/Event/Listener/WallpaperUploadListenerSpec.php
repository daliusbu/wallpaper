<?php

namespace spec\AppBundle\Event\Listener;

use AppBundle\Entity\Category;
use AppBundle\Entity\Wallpaper;
use AppBundle\Event\Listener\WallpaperUploadListener;
use AppBundle\Service\FileMover;
use AppBundle\Model\FileInterface;
use AppBundle\Service\WallpaperFilePathHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping\PrePersist;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WallpaperUploadListenerSpec extends ObjectBehavior
{
    private $fileMover;
    private $wallpaperFilePathHelper;

    function let(FileMover $fileMover, WallpaperFilePathHelper $wallpaperFilePathHelper){
        $this->beConstructedWith($fileMover, $wallpaperFilePathHelper);

        $this->fileMover = $fileMover;
        $this->wallpaperFilePathHelper = $wallpaperFilePathHelper;
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
        LifecycleEventArgs $eventArgs,
        FileInterface $file
    ){

        $fakeTemp = "/fake/temp/path/";
        $fakeFilename= "fake.file";

        $file->getPathname()->willReturn($fakeTemp);
        $file->getFilename()->willReturn($fakeFilename);


;
        $wallpaper = new Wallpaper();
        $wallpaper->setFile($file->getWrappedObject());
        $eventArgs->getEntity()->willReturn($wallpaper);

        $fakeNewFileLocation = 'some/new/fake' . $fakeFilename;
        $this
            ->wallpaperFilePathHelper
            ->getNewFilePath($fakeFilename)
            ->willReturn($fakeNewFileLocation);

        $this->prePersist($eventArgs)->shouldReturn(true);

        $this->fileMover->move($fakeTemp, $fakeNewFileLocation)->shouldHaveBeenCalled();


    }



    function it_can_preUpdate(PreUpdateEventArgs $eventArgs){
        $this->preUpdate($eventArgs);
    }


}
