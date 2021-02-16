<?php

namespace App\DataFixtures;

use App\Entity\Board;
use App\Entity\Owner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BoardFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //$names = ['Bobiukas Board', 'Kaziukas oho'];

        $board = new Board();
        $board->setName('Bobiukas Bordukas');
        $board->addUser($this->getReference(OwnerFixtures::BOBIUKAS_REFERENCE));

        $manager->persist($board);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OwnerFixtures::class,
        ];
    }
}
