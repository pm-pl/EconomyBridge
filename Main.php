<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use iNA16\EconomyBridge\commands\Loader;

class Main extends PluginBase{
  public $config;
  public $playersdata;
  public function onEnable(): void {
    @mkdir($this->getDataFolder());
    $this->saveResource("config.yml");
    $this->saveResource("players_data.yml");

    $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    $this->playersdata = new Config($this->getDataFolder() . "players_data.yml", Config::YAML);

    Loader::registerCommands($this);
  }

  public function createAccount(string $player) {
    $StartingBalance = $this->config->getNested("PlayerBalance.StartingAmount");
    $StartingBank = $this->config->getNested("BankBalance.StartingAmount");
    $data = [
      "balance" => $StartingBalance,
      "bank" => $StartingBank,
    ];
    $this->playersdata->set($player, $data);
    $this->playersdata->save();
    $this->getLogger()->error("New Player $player has $StartingBalance now");
  }
}
