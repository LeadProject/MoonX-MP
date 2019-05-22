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
 namespace pocketmine\block;
 use pocketmine\block\utils\PillarRotationHelper;
 use pocketmine\item\Item;
 use pocketmine\math\Vector3;
 use pocketmine\Player;
 class Kelp extends Solid{

 	protected $id = 393;
 	public function __construct(int $meta = 0){
 		$this->meta = $meta;
 	}
 	public function getHardness() : float{
 		return 2;
 	}
 	public function getName() : string{
 		return "Kelp";
 	}

  public function place(Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, Player $player = null) : bool{
				$this->getLevel()->setBlock($this, $this, true);
        return true;
	}

 	public function getVariantBitmask() : int{
 		return 0x03;
 	}
 	public function getToolType() : int{
 		return BlockToolType::TYPE_SHEARS;
 	}
 	public function getFuelTime() : int{
 		return 10;
 	}
 	public function getFlameEncouragement() : int{
 		return 5;
 	}
 	public function getFlammability() : int{
 		return 5;
 	}
 }
