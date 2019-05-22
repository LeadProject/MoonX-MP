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

class Turtle extends Animal{
	public const NETWORK_ID = self::TURTLE;

	public $width = 1.25 + M_PI - 3;
	public $height = 0.15;

	/** @var Vector3 */
	public $swimDirection = null;
	public $swimSpeed = 0.35;

	public function getName() : string{
		return "Turtle";
	}

	public function entityBaseTick(int $tickDiff = 1) : bool{
		if($this->closed){
			return false;
		}

		if(++$this->switchDirectionTicker === 100 or $this->isCollided){
			$this->switchDirectionTicker = 0;
			if(mt_rand(0, 100) < 50){
				$this->swimDirection = null;
			}
		}

		$hasUpdate = parent::entityBaseTick($tickDiff);

		if($this->isAlive()){

			if($this->y > 62 and $this->swimDirection !== null){
				$this->swimDirection->y = -0.5;
			}

			$inWater = $this->isUnderwater();
			if(!$inWater){
				$this->swimDirection = null;
			}elseif($this->swimDirection !== null){
				if($this->motion->lengthSquared() <= $this->swimDirection->lengthSquared()){
					$this->motion = $this->swimDirection->multiply($this->swimSpeed);
				}
			}else{
				$this->swimDirection = $this->generateRandomDirection();
				$this->swimSpeed = mt_rand(50, 100) / 2000;
			}

			$f = sqrt(($this->motion->x ** 2) + ($this->motion->z ** 2));
			$this->yaw = (-atan2($this->motion->x, $this->motion->z) * 180 / M_PI);
			$this->pitch = (-atan2($f, $this->motion->y) * 180 / M_PI);
		}

		return $hasUpdate;
	}

	protected function applyGravity() : void{
		if(!$this->isUnderwater()){
			parent::applyGravity();
		}
	}

	public function getDrops() : array{
		$drops = [
			ItemFactory::get(Item::TURTLE_SHELL_PIECE, 0, mt_rand(0, 3))
		];
		return $drops;
	}

	public function initEntity() : void{
		$this->setMaxHealth(30);
		parent::initEntity();
	}

	public function getXpDropAmount() : int{
		return 5;
	}
}
