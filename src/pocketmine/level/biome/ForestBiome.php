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

namespace pocketmine\level\biome;

use pocketmine\block\Sapling;
use pocketmine\level\generator\populator\TallGrass;
use pocketmine\level\generator\populator\Tree;

class ForestBiome extends GrassyBiome{

	public const TYPE_NORMAL = 0;
	public const TYPE_BIRCH = 1;
	public const TYPE_ACACIA = 2;
	public const TYPE_JUNGLE = 3;
	public const TYPE_VILLAGER = 4;

	public $type;

	public function __construct(int $type = self::TYPE_NORMAL){
		parent::__construct();

		$this->type = mt_rand(0, 4);
		
		$this->setElevation(63, 78);
		
		if ($type === 0) {
			$trees = new Tree(Sapling::OAK);
			$trees->setBaseAmount(5);
		}
		
		if ($type === 1) {
			$trees = new Tree(Sapling::BIRCH);
			$trees->setBaseAmount(5);
		}
		
		if ($type === 2) {
			$trees = new Tree(Sapling::ACACIA);
			$trees->setBaseAmount(7);
		}
		
		if ($type === 3) {
			$trees = new Tree(Sapling::JUNGLE);
			$trees->setBaseAmount(10);
		}
		
		if ($type === 4) {
			$trees = new Tree(Sapling::OAK);
			$trees->setBaseAmount(2);
			$this->setElevation(53, 54);
		}
		
		$this->addPopulator($trees);

		$tallGrass = new TallGrass();
		$tallGrass->setBaseAmount(3);

		$this->addPopulator($tallGrass);

		if($type === self::TYPE_BIRCH){
			$this->temperature = 0.6;
			$this->rainfall = 0.5;
		}else{
			$this->temperature = 0.7;
			$this->rainfall = 0.8;
		}
	}

	public function getName() : string{
		return $this->type === self::TYPE_BIRCH ? "Birch Forest" : "Forest";
	}
}
