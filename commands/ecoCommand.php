<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\commands;

use pocketmine\plugin\Plugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\player\Player;

use iNA16\EconomyBridge\api\{
  getBal,
  setBal,
  isExist
};
#getBal;
#use iNA16\EconomyBridge\api\setBal;
#use iNA16\EconomyBridge\api\isExist;
use iNA16\EconomyBridge\VersionInfo;
class ecoCommand extends Command {

    private $plugin;
    public function __construct(Plugin $plugin){
        $this->setPermission("ecobridge.op");
        parent::__construct("eco", "", "/eco help");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
    $setBal = new setBal($this->plugin);
    if (count($args) < 3 || (count($args) === 0 && $args[0] !== "help")) {
      $sender->sendMessage("§e*-- EconomyBridge §f v" . VersionInfo::VERSION . " §cby §fiNA16 §e--*");
      $sender->sendMessage("§8Use `/eco help` for help.");
    } else if(count($args) == 3 or $args[0] == "help") {
      if ($args[0] == "help") {
        $sender->sendMessage("§e*-- EconomyBridge Commands --*");
        $sender->sendMessage("§6/eco set <player> <amount> - Sey Player balance to input Amount");
        $sender->sendMessage("§6/eco give <player> <amount> - Give the input Amount to Player balance");
        $sender->sendMessage("§6/eco take <player> <amount> - Take the input Amount from Player balance");
        $sender->sendMessage("§e*-- EconomyBridge Commands --*");
      } else if($args[0] == "set") {
        $setBal->setBal($args[1], (int)$args[2], 0);
        $sender->sendMessage("$args[1] balance has been set to $args[2].");
      } else if($args[0] == "give") {
        $setBal->setBal($args[1], (int)$args[2], 1);
        $sender->sendMessage("Added $args[2] to $args[1].");
      } else if($args[0] == "take") {
        $setBal->setBal($args[1], (int)$args[2], 2);
        $sender->sendMessage("Took $args[2] from $args[1].");
      }
    }

    return true;
    }
}
