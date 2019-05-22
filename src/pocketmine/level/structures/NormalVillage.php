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
 
namespace pocketmine\level\structures;

use pocketmine\Block\BlockFactory;
use pocketmine\level\generator\Generator;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\utils\Random;
use pocketmine\level\ChunkManager;
use pocketmine\level\biome\Biome;
use pocketmine\block\Block;

class NormalVillage extends Generator{
	
	public function __construct(Vector3 $pos){
		$pos = $pos->floor();
		
		$x = $pos->x;
		$y = $pos->y;
		$z = $pos->z;
		
		$this->make($x, $y, $z);
	}
	
	public function make($x, $y, $z) {
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
		$this->horse($x + mt_rand(4, 14), $y, $z + mt_rand(4, 14));
	}
	
	public function horse($x, $y, $z) {
		for($u = 1; $u < 5; $u++) {
		$this->getLevel()->setBlock(new Vector3($x, $y + $u, $z), BlockFactory::get(Block::WOOD));
		}
		
		for($u = 1; $u < 5; $u++) {
		$this->getLevel()->setBlock(new Vector3($x, $y + $u, $z + 4), BlockFactory::get(Block::WOOD));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x, $y + $u, $z + 1), BlockFactory::get(Block::PLANKS));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x, $y + $u, $z + 2), BlockFactory::get(Block::PLANKS));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x, $y + $u, $z + 3), BlockFactory::get(Block::PLANKS));
		}
		
		
		for($u = 1; $u < 5; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 1, $y + $u, $z), BlockFactory::get(Block::WOOD));
		}
		
		for($u = 1; $u < 5; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 4, $y + $u, $z), BlockFactory::get(Block::WOOD));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 1, $y + $u, $z + 1), BlockFactory::get(Block::PLANKS));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 2, $y + $u, $z + 2), BlockFactory::get(Block::PLANKS));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 3, $y + $u, $z + 3), BlockFactory::get(Block::PLANKS));
		}
		
		
		
		for($u = 1; $u < 5; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 4, $y + $u, $z), BlockFactory::get(Block::WOOD));
		}
		
		for($u = 1; $u < 5; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 4, $y + $u, $z + 4), BlockFactory::get(Block::WOOD));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 4, $y + $u, $z + 1), BlockFactory::get(Block::PLANKS));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 4, $y + $u, $z + 2), BlockFactory::get(Block::PLANKS));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 4, $y + $u, $z + 3), BlockFactory::get(Block::PLANKS));
		}
		
		
		
		for($u = 1; $u < 5; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 1, $y + $u, $z + 4), BlockFactory::get(Block::WOOD));
		}
		
		for($u = 1; $u < 5; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 4, $y + $u, $z + 4), BlockFactory::get(Block::WOOD));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 1, $y + $u, $z + 4), BlockFactory::get(Block::PLANKS));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 2, $y + $u, $z + 4), BlockFactory::get(Block::PLANKS));
		}
		
		for($u = 1; $u < 3; $u++) {
		$this->getLevel()->setBlock(new Vector3($x + 3, $y + $u, $z + 4), BlockFactory::get(Block::PLANKS));
		}
		
	}
	
}