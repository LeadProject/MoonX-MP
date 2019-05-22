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
use function mt_rand;

class WanderingTrader extends Animal{
	public const NETWORK_ID = self::WANDERING_TRADER;

	public $width = 0.95;
	public $height = 0.85;

	public function getName() : string{
		return "Wandering Trader";
	}

	public function getDrops() : array{
		$drops = [
			ItemFactory::get(Item::ELEMENT_I_1, 0, mt_rand(0, 1)),
			ItemFactory::get(Item::ELEMENT_I_8, 0, mt_rand(0, 1)),
			ItemFactory::get(Item::ELEMENT_I_87, 0, mt_rand(0, 1))
		];
		return $drops;
	}

	public function initEntity() : void{
		$this->setMaxHealth(35);
		parent::initEntity();
	}

	public function getXpDropAmount() : int{
		return 15;
	}
}
