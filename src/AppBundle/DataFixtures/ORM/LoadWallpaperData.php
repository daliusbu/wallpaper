<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Wallpaper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWallpaperData extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $abstractFiles = [
            'abstract-background-pink.jpg'=>'abstract-background-pink',
            'abstract-black-and-white-wave.jpg'=>'abstract-black-and-white-wave',
            'abstract-black-multi-color-wave.jpg'=>'abstract-black-multi-color-wave',
            'abstract-blue-green.jpg'=>'abstract-blue-green',
            'abstract-blue-line-background.jpg'=>'abstract-blue-line-background',
            'abstract-red-background-pattern.jpg'=>'abstract-red-background-pattern',
            'abstract-shards.jpeg'=>'abstract-shards',
            'abstract-swirls.jpeg'=>'abstract-swirls',
        ];
        $abstractReference = 'category.abstract';

        $summerFiles = [
            'landscape-summer-beach.jpg'=>'landscape-summer-beach',
            'landscape-summer-field.jpg'=>'landscape-summer-field',
            'landscape-summer-flowers.jpg'=>'landscape-summer-flowers',
            'landscape-summer-hill.jpg'=>'landscape-summer-hill',
            'landscape-summer-mountain.png'=>'landscape-summer-mountain',
            'landscape-summer-sea.jpg'=>'landscape-summer-sea',
            'landscape-summer-sky.jpg'=>'landscape-summer-sky',
        ];
        $summerReference = 'category.summer';

        $winterFiles = [
            'landscape-winter-canada-lake.jpg'=>'landscape-winter-canada-lake',
            'landscape-winter-high-tatras.jpg'=>'landscape-winter-high-tatras',
            'landscape-winter-snow-lake.jpg'=>'landscape-winter-snow-lake',
            'landscape-winter-snow-mountain.jpeg'=>'landscape-winter-snow-mountain',
            'landscape-winter-snow-trees.jpg'=>'landscape-winter-snow-trees',
            'landscape-winter-snowboard-jump.jpg'=>'landscape-winter-snowboard-jump',
            'landscape-winter-snowy-fisheye.png'=>'landscape-winter-snowy-fisheye',
        ];
        $winterReference = 'category.winter';

        $this->iterateFilenames($abstractFiles, $abstractReference, $manager );
        $this->iterateFilenames($winterFiles, $winterReference, $manager );
        $this->iterateFilenames($summerFiles, $summerReference, $manager );
    }

    public function getOrder()
    {
        return 200;
    }

    private function iterateFilenames(array $filenames, $reference, ObjectManager $manager){

        foreach ($filenames as $file=>$slug){
            $wallpaper = (new Wallpaper())
                ->setFilename($file)
                ->setSlug($slug)
                ->setWidth(1920)
                ->setHeight(1080)
                ->setCategory(
                    $this->getReference($reference)
                );
            $manager->persist($wallpaper);
        }
        $manager->flush();

    }
}