<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\events;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class addBalEvent extends PluginBase{
  public $db = $this->getDataFolder() . "players_data.yml";
  
  public function addBal(string $player) {
    # codes using $db such as 
  }
}