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

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\Player;
use function mt_rand;

class EnderDragon extends Monster{
	public const NETWORK_ID = self::ENDER_DRAGON;

	public $width = 3.5;
	public $height = 2.7;

	public function getName() : string{
		return "Ender Dragon";
	}

	public function getDrops() : array{
		$drops = [
			ItemFactory::get(Item::DRAGON_EGG, 0, 1)
		];
		return $drops;
	}

	public function initEntity() : void{
		$this->setMaxHealth(200);
		parent::initEntity();
	}

	public function smallSize(){
		$this->setScale(0.5);
	}

	public function getXpDropAmount() : int{
		return mt_rand(5000, 15000);
	}

}
