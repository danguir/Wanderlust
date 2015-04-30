<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use UserBundle\Entity\Rank;

class LoadRank extends AbstractFixture implements OrderedFixtureInterface {

	public function load(ObjectManager $manager){
		$ranks = array(
			'rank-member' => array(
				'level' => 1,
				'name' => 'Membre',
			),
			'rank-moderator' => array(
				'level' => 2,
				'name' => 'Modérateur',
			),
			'rank-administrator' => array(
				'level' => 3,
				'name' => 'Administrateur',
			),
			'rank-robot' => array(
				'level' => 3,
				'name' => 'Robot',
			),
		);

		foreach ($ranks as $key => $data) {
			$rank = $this->createRank($data);
			$manager->persist($rank);
			$this->setReference($key, $rank);
		}
        $manager->flush();
	}

	function createRank($data){
		$rank = new Rank();

		$rank->setLevel($data['level']);
		$rank->setName($data['name']);

		return $rank;
	}

	public function getOrder()
    {
        return 1;
    }
}
