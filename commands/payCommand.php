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

class payCommand extends Command {
    private $plugin;
  
    public function __construct(Plugin $plugin){
        $this->setPermission("ecobridge.use");
        parent::__construct("pay", "", "/pay <player> <amount>");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
        if(!$sender instanceof Player){
            $sender->sendMessage("This command can only be used by a player.");
            return false;
        }
      
        if(count($args) < 2){
            $sender->sendMessage("Usage: /pay <player> <amount>");
            return false;
        }
      
        $player = $args[0];
        $amount = (int) $args[1];
        
        if($amount < 1){
            $sender->sendMessage("Invalid amount. Please provide a positive number.");
            return false;
        }
      
        $senderName = $sender->getName();

        $isExist = new isExist();
        if($isExist->isPlayer($player)){
            $setBal = new setBal();
            $setBal->setBal($player, $amount, 1); // Add the amount to the recipient's balance
            $setBal->setBal($senderName, $amount, 2); // Remove the amount from the sender's balance
            $sender->sendMessage("Paid $amount to $player.");
        }else{
            $sender->sendMessage("Player $player does not exist.");
        }

        return true;
    }
}