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
        $category = (new Category())
            ->setName('Abstract');
        $this->addReference('category.abstract', $category);

        $manager->persist($category);
        $manager->flush();
    }

    public function getOrder()
    {
        return 100;
    }
}