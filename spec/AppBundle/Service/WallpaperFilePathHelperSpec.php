<?php

namespace spec\AppBundle\Service;

use AppBundle\Service\WallpaperFilePathHelper;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WallpaperFilePathHelperSpec extends ObjectBehavior
{

    function let(){
        $this->beConstructedWith('/new/path/to/');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(WallpaperFilePathHelper::class);
    }

    function it_can_give_filepath_when_give_filename()
    {
        $this
            ->getNewFilePath('some/file.name')
            ->shouldReturn('/new/path/to/some/file.name');
    }

    function it_gracefully_handles_no_trailing_slash()
    {
        $this->beConstructedWith('/oops/no/trailing/slash');
        $this
            ->getNewFilePath('some/file.name')
            ->shouldReturn('/oops/no/trailing/slash/some/file.name');
    }

    function it_removes_leading_slash_from_file_name(){
        $this
            ->getNewFilePath('/some/file.name')
            ->shouldReturn('/new/path/to/some/file.name');
    }


}
