<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\api;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class isExist{
  /* extends PluginBase{*/
  private $plugin;
  public function __construct(PluginBase $plugin) {
    $this->plugin = $plugin;
  }
             
  public function isExist(string $playerName): bool {
    $config = new Config($this->plugin->getDataFolder() . "players_data.yml", Config::YAML);
    return $config->exists($playerName);
  }
}