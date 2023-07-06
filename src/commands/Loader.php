<?php

declare(strict_types=1);
namespace iNA16\EconomyBridge\commands;

#use pocketmine\command\CommandMap;
use pocketmine\plugin\PluginBase;
use iNA16\EconomyBridge\commands\balanceCommand;

class Loader{
  public static function registerCommands(Plugin $plugin): void {
    #$commandMap = $plugin->getServer()->getCommandMap();
    #$commandMap->register("balance", new balanceCommand($plugin));
    $plugin->getServer()->getCommandMap()->registerAll($plugin->getName(), [
                                                       new balanceCommand($plugin)
    ]);
  }
}