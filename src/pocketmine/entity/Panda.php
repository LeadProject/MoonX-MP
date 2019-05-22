<?php

/*
    _____ _                 _        __  __ _____
  / ____| |               | |      |  \/  |  __ \
 | |    | | ___  _   _  __| |______| \  / | |__) |
 | |    | |/ _ \| | | |/ _` |______| |\/| |  ___/
 | |____| | (_) | |_| | (_| |      | |  | | |
  \_____|_|\___/ \__,_|\__,_|      |_|  |_|_|

     Make of Things.
 */

declare(strict_types=1);

namespace pocketmine\entity;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\EntityEventPacket;

class Panda extends Animal{
	public const NETWORK_ID = self::PANDA;

	public $width = 1.85;
	public $height = 1.45;

	const BROWN = 0;
	const LAZY = 1;
	const WORRIED = 2;
	const PLAYFUL = 3;
	const WEAK = 4;
	const AGGRESSIVE = 5;
	const NORMAL = 6;

	public function getName() : string{
		return "Panda";
	}

	public function entityBaseTick(int $tickDiff = 25) : bool{
		$level = $this->getLevel();
		if($this->closed){
			return false;
		}
		$this->setRotation(mt_rand(180, 360), mt_rand(180, 360));
		switch(mt_rand(0, 4)){
			case 0:
			$this->setMotion(new Vector3(0.1, 0, 0));
			return true;
			case 1:
			$this->jump();
			return true;
			case 2:
			$this->setMotion(new Vector3(0, 0, 0.2));
			return true;
			case 3:
			$this->setMotion(new Vector3(-0.2, 0, 0));
			return true;
			case 4:
			$this->setMotion(new Vector3(0, 0, -0.2));
			return true;
			case 5:
			$this->setMotion(new Vector3(0.2, 0, 0));
			return true;
		}
		return true;
	}

	public function getDrops() : array{
		$drops = [
			ItemFactory::get(Item::BAMBOO, 0, mt_rand(0, 3))
		];
		return $drops;
	}

	public function initEntity() : void{
		$this->setMaxHealth(25);
		$this->propertyManager->setInt(self::DATA_VARIANT, rand(0, 6));
		parent::initEntity();
	}

	public function getXpDropAmount() : int{
		return 5;
	}
}
