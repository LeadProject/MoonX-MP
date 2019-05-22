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

namespace pocketmine\entity\Projectile;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\Player;
use function mt_rand;

class DragonFireBall extends Projectile{
	public const NETWORK_ID = self::DRAGON_FIREBALL;

  public $height = 0.3125;
	public $width = 0.3125;

	protected $damage = 5.0;
	protected $life = 0;

	public function getName() : string{
		return "Ender Dragon";
	}

	public function initEntity() : void{
		$this->setMaxHealth(1);
		parent::initEntity();
	}

  public function onUpdate(int $currentTick) : bool{
		if($this->isAlive() and !$this->closed and !$this->isFlaggedForDespawn()){
			$this->setOnFire(1);

			if($this->life++ > 600){
				$this->flagForDespawn();
			}
		}
		return parent::onUpdate($currentTick);
	}

	public function onHitBlock(Block $blockHit, RayTraceResult $hitResult) : void{
		parent::onHitBlock($blockHit, $hitResult);

		$this->flagForDespawn();

		$owner = $this->getOwningEntity();
		if($owner instanceof Living){
				$block = $this->level->getBlock($this);
					$this->explode();
				}
	}

  public function explode() : void{
		$ev = new ExplosionPrimeEvent($this, 4);
		$ev->call();
		if(!$ev->isCancelled()){
			$explosion = new Explosion($this, $ev->getForce(), $this);
			if($ev->isBlockBreaking()){
				$explosion->explodeA();
			}
			$explosion->explodeB();
		}
	}

}
