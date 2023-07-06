<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\events;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use iNA16\EconomyBridge\api\isExists;
use iNA16\EconomyBridge\api\getBal;
use iNA16\EconomyBridge\api\setBal;

class addBal{
  private $plugin;
  public function __construct(PluginBase $plugin) {
    $this->plugin = $plugin;
  }
  public function addBal(string $player, int $amount) {
    $getBal = new getBal($this->plugin);
    $setBal = new setBal($this->plugin);
    $isExist = new isExist($this->plugin);
    if ($isExist->isExist($player)) {
      $balance = $getBal->getBal($player);
      $this->setBal($player, $balance + $amount);
    } else {
      $this->newAccount($player);
      $this
    }
  }
}