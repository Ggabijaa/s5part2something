<?php

namespace App\DataFixtures;

use App\Entity\Owner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OwnerFixtures extends Fixture
{
    public const BOBIUKAS_REFERENCE = 'bobiukas';

    public function load(ObjectManager $manager)
    {
        $owner = new Owner();
        $owner->setName('Bobiukas');

        $manager->persist($owner);
        $manager->flush();

        $this->addReference(self::BOBIUKAS_REFERENCE, $owner);
    }
}
