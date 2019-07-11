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

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\EntityMetadataFlags;
use pocketmine\network\mcpe\protocol\types\EntityMetadataProperties;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\EntityEventPacket;

class Llama extends Animal{
	public const NETWORK_ID = self::LLAMA;

	public $width = 0.6;
	public $height = 1.8;

	public function getName() : string{
		return "Llama";
	}

	protected function initEntity(CompoundTag $nbt) : void{
		$this->propertyManager->setInt(EntityMetadataProperties::VARIANT, rand(0, 3));
		$this->propertyManager->setString("Owner", "");
		$this->propertyManager->setString("Chest", []);
		parent::initEntity($nbt);
	}

	public function attack(EntityDamageEvent $source) : void{
		parent::attack($source);
		if($source->isCancelled()){
			return;
		}

		if($source instanceof EntityDamageByEntityEvent){
			$this->ride($source->getDamager());
			$this->broadcastEntityEvent(EntityEventPacket::WITCH_SPELL_PARTICLES);
		}
	}

	public function saveNBT() : CompoundTag{
		$nbt = parent::saveNBT();
		return $nbt;
	}

	public function isBaby() : bool{
		return $this->getGenericFlag(EntityMetadataFlags::BABY);
	}
}
