<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\api;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use iNA16\EconomyBridge\api\isExists;
use iNA16\EconomyBridge\api\getBal;

class setBal{
  private $plugin;
  private $config;
  public function __construct(PluginBase $plugin) {
    $this->plugin = $plugin;
  }
  public function setBal(string $player, int $amount, int $type) {
    $this->config = new Config($this->plugin->getDataFolder() . "players_data.yml", Config::YAML);
    $getBal = new getBal($this->plugin);
    $isExist = new isExist($this->plugin);
    if ($isExist->isExist($player)) {
      if ($type == 0) {
        
        $balance = $amount;
        $this->config->set($player, [
                           "balance" => $balance
        ]);
        $this->config->save();
      } else if($type == 1) {
        $balance = $getBal->getBal($player) + $amount;
        $this->config->set($player, [
                           "balance" => $balance
        ]);
      } else if($type == 2) {
        $balance = $getBal->getBal($player) - $amount;
        $this->config->set($player, [
                           "balance" => $balance
        ]);
      }
    }
  }
}