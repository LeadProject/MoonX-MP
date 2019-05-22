<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\entity;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\EntityEventPacket;

class TropicalFish extends WaterAnimal{
	public const NETWORK_ID = self::TROPICAL_FISH;

	public $width = 0.5;
	public $height = 0.4;

	/** @var Vector3 */
	public $swimDirection = null;
	public $swimSpeed = 0.35;

	private $switchDirectionTicker = 0;

	public function initEntity() : void{
		$this->setMaxHealth(7);
		$this->propertyManager->setInt(self::DATA_VARIANT, rand(0, 235340288));
		parent::initEntity();
	}

	public function getName() : string{
		return "Tropical Fish";
	}

	protected function applyGravity() : void{
		if(!$this->isUnderwater()){
			parent::applyGravity();
		}
	}

	public function getDrops() : array{
    $chance = mt_rand(0, 2);
    switch($chance){
      case 0:
      return [
        ItemFactory::get(Item::TROPICAL_FISH, 0, 1)
      ];
      case 1:
      return [
        ItemFactory::get(Item::BONE, 0, mt_rand(0, 2))
      ];
      case 2:
      return [
  			ItemFactory::get(Item::FISH, 0, mt_rand(1, 2))
  		];
    }
	}
}
