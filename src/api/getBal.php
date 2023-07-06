<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\api;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class getBal{
  /* extends PluginBase{*/
  private $plugin;
  public function __construct(PluginBase $plugin) {
    $this->plugin = $plugin;
  }
             
  public function getBal(string $player) {
    $config = new Config($this->plugin->getDataFolder() . "players_data.yml", Config::YAML);
    return $config->getNested($player . ".balance");
  }
}