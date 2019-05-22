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

use pocketmine\inventory\TradeInventory;
use pocketmine\inventory\TradeRecipe;
use pocketmine\entity\Ageable;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\Player;
use function array_rand;
use function count;
use function mt_rand;

class Villager extends Creature implements NPC, Ageable{

	public const NETWORK_ID = self::VILLAGER_V2;

	/* Profession */

	const UNEMPLOYED = 0;
	const ARMORER = 1;
	const BUTCHER = 2;
	const CARTOGRAPHER = 3;
	const CLERIC = 4;
	const FARMER = 5;
	const FISHERMAN = 6;
	const FLETCHER = 7;
	const LEATHERWORKER = 8;
	const LIBRARIAN = 9;
	const STONE_MASON‌ = 10;
	const NITWIT = 11;
	const SHEPHERD = 12;
	const TOOLSMITH = 13;
	const WEAPONSMITH = 14;


	public const PROFESSION_FARMER = 0;
	public const PROFESSION_LIBRARIAN = 1;
	public const PROFESSION_PRIEST = 2;
	public const PROFESSION_BLACKSMITH = 3;
	public const PROFESSION_BUTCHER = 4;

	public $width = 0.6;
	public $height = 1.8;

	/** @var bool */
	protected $canTrade;
	/** @var string */
	protected $traderName;
	/** @var ListTag */
	protected $recipes;

	public function getName() : string{
		return "Villager";
	}

	public function initEntity() : void{
		$this->setMaxHealth(20);
		$this->propertyManager->setInt(self::DATA_VARIANT, rand(0, 14));
		parent::initEntity();
	}

	public function onInteract(Player $player, Item $item, Vector3 $clickPos) : bool{
		if($this->hasNotTradingPlayer()){
			$player->addWindow(new TradeInventory($this));
		}
		return false;
	}

	/**
	 * Sets the villager profession
	 *
	 * @param int $profession
	 */
	public function setProfession(int $profession) : void{
		$this->propertyManager->setInt(self::DATA_VARIANT, $profession);
	}

	public function getProfession() : int{
		return $this->propertyManager->getInt(self::DATA_VARIANT);
	}

	public function setCanTrade(bool $value = true) : void{
		$this->canTrade = $value;
	}

	public function canTrade() : bool{
		return $this->canTrade;
	}

	public function setTradingPlayer(int $entityRuntimeId = 0) : void{
		$this->propertyManager->setLong(self::DATA_TRADING_PLAYER_EID, $entityRuntimeId);
	}

	public function hasNotTradingPlayer() : bool{
		return $this->propertyManager->getLong(self::DATA_TRADING_PLAYER_EID) === 0;
	}

	public function setTraderName(string $traderName) : void{
		$this->traderName = $traderName;
	}

	public function getTraderName() : string{
		return $this->traderName;
	}

	public function getRecipes() : ListTag{
		return $this->recipes;
	}

	public function entityBaseTick(int $tickDiff = 25) : bool{
		$level = $this->getLevel();
		if($this->closed){
			return false;
		}
		$f = sqrt(($this->motion->x ** 2) + ($this->motion->z ** 2));
		$yaw = (-atan2($this->motion->x, $this->motion->z) * 180 / M_PI);
		$pitch = (-atan2($f, $this->motion->y) * 180 / M_PI);

		$this->setRotation($yaw, $pitch);
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

	public function setRecipes(TradeRecipe ...$recipes) : void{
		$list = new ListTag(TradeRecipe::TAG_RECIPES);
		foreach($recipes as $recipe){
			$list->push($recipe->toNBT());
		}
		$this->recipes = $list;
	}

	public function getXpDropAmount() : int{
		return 5;
	}

	public function isBaby() : bool{
		return $this->getGenericFlag(self::DATA_FLAG_BABY);
	}
}
