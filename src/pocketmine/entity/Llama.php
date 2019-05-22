<?php

/*
 *
 *  _____            _               _____
 * / ____|          (_)             |  __ \
 *| |  __  ___ _ __  _ ___ _   _ ___| |__) | __ ___
 *| | |_ |/ _ \ '_ \| / __| | | / __|  ___/ '__/ _ \
 *| |__| |  __/ | | | \__ \ |_| \__ \ |   | | | (_) |
 * \_____|\___|_| |_|_|___/\__, |___/_|   |_|  \___/
 *                         __/ |
 *                        |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author GenisysPro
 * @link https://github.com/GenisysPro/GenisysPro
 *
 *
 */

namespace pocketmine\entity;

use pocketmine\item\Item as ItemItem;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\Player;
use pocketmine\Entity;

class Llama extends Animal {
	const NETWORK_ID = 29;

	const CREAMY = 0;
	const WHITE = 1;
	const BROWN = 2;
	const GRAY = 3;

	public $width = 0.3;
	public $length = 0.9;
	public $height = 0;

	public $dropExp = [1, 3];

	/**
	 * @return string
	 */
	public function getName() : string{
		return "Llama";
	}

	public function initEntity() : void{
		$this->setMaxHealth(30);
		$this->propertyManager->setInt(self::DATA_VARIANT, rand(0, 3));
		parent::initEntity();
	}

	public function entityBaseTick(int $tickDiff = 25) : bool{
		$level = $this->getLevel();
		if($this->closed){
			return false;
		}
		$this->setRotation(mt_rand(0, 360), mt_rand(0, 360));
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

	/**
	 * @return array
	 */
	public function getDrops() : array{
		$drops = [
			ItemItem::get(ItemItem::LEATHER, 0, mt_rand(0, 2))
		];

		return $drops;
	}
}
