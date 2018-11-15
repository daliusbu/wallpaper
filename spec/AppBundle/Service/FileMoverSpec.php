<?php

namespace spec\AppBundle\Service;

use AppBundle\Service\FileMover;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Filesystem\Filesystem;

class FileMoverSpec extends ObjectBehavior
{
    private $filesystem;

    public function let(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        $this->beConstructedWith($filesystem);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FileMover::class);
    }

    function it_can_move_file_from_temp_to_our_location()
    {
        $currentLocation = "/some/current/location";
        $newLoction = "/some/new/location";

        $this->move($currentLocation, $newLoction)->shouldReturn(true);
        $this->filesystem->rename($currentLocation, $newLoction)->shouldHaveBeenCalled();
    }
}
