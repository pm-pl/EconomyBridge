<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\events;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use iNA16\EconomyBridge\events\userExistsEvent;

class addBalEvent extends PluginBase{
  public $db = $this->getDataFolder() . "players_data.yml";
  
  public function addBal(string $player, int $amount) {
    if ($this->userExists($player)) {
      $this->updateBalance($player, $amount);
      echo "Balance updated successfully.";
    } else {
      $this->newAccount($player);
      echo "New account created successfully.";
    }
  }
}
