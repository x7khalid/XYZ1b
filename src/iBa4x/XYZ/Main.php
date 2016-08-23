<?php
namespace iBa4x\XYZ;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\scheduler\PluginTask;

class Main extends PluginBase{
	public function onEnable(){
		$this->getLogger()->info(TextFormat::YELLOW . "By iBa4x");
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this),1);
	}
}
class Task extends PluginTask{
	public $owner;
	public function __construct($owner){
		parent::__construct($owner);
		$this->owner = $owner;
	}
	public function onRun($currentTick){
		foreach ($this->owner->getServer()->getOnlinePlayers() as $p){
			$x = $p->getFloorX();
			$y = $p->getFloorY();
			$z = $p->getFloorZ();
			$message = TextFormat::YELLOW."x$x : y$y : z$z";
			 $p->sendPopup($message);
		}
	}
}
