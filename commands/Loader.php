<?php

declare(strict_types=1);
namespace iNA16\EconomyBridge\commands;

use pocketmine\plugin\PluginBase;
use iNA16\EconomyBridge\commands\{
  balanceCommand,
  ecoCommand
};

class Loader{
  public static function registerCommands(PluginBase $plugin): void {
    $plugin->getServer()->getCommandMap()->registerAll($plugin->getName(), [
                                                       new balanceCommand($plugin),
                                                       new ecoCommand($plugin)
    ]);
  }
}