<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.14
 * Time: 15.01
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $category1 = (new Category())
            ->setName('Abstract');
        $this->addReference('category.abstract', $category1);

        $manager->persist($category1);

        $category2 = (new Category())
            ->setName('Winter');
        $this->addReference('category.winter', $category2);

        $manager->persist($category2);
             $category3 = (new Category())
            ->setName('Summer');
        $this->addReference('category.summer', $category3);

        $manager->persist($category3);


        $manager->flush();
    }

    public function getOrder()
    {
        return 100;
    }
}