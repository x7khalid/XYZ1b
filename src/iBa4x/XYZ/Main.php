<?php
namespace iBa4x\XYZ;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{
	public function onEnable(){
		$this->getLogger()->info(TextFormat::YELLOW . "By iBa4x");
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this),1);
		@mkdir($this->getDataFolder());
		$i = [
				xyz => true,
		];
		$xyz = new Config($this->getDataFolder() . "config.yml", Config::YAML, $i);
		$xyz->save();
	}
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		switch($command->getName()){
			case "xyz":
				if($sender->hasPermission("xyz.command")){
			            if(isset($args[0])){
			                switch($args[0]){
			        		case "on":
			        			$this->getConfig()->set("xyz", true);
			        			$sender->sendMessage(TextFormat::GREEN . "xyz is on");
			        		break;
			        		case "off":
			        			$this->getConfig()->set("xyz", false);
			        			$sender->sendMessage(TextFormat::RED . "xyz is off");
			        		break;
			        	}
			            }
				}
			break;
		}
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
			if($this->owner->getConfig()->get("xyz") == true){
				$x = $p->getFloorX();
				$y = $p->getFloorY();
				$z = $p->getFloorZ();
				$message = "x:$x , y:$y , z:$z";
				$p->sendTip($message);
			}
		}
	}
}
