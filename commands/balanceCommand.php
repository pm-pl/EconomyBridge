<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\commands;

use pocketmine\plugin\Plugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\player\Player;

use iNA16\EconomyBridge\api\getBal;
use iNA16\EconomyBridge\api\isExist;
class balanceCommand extends Command {

    private $plugin;
    private $config;
    public function __construct(Plugin $plugin){
        $this->setPermission("ecobridge.use");
        parent::__construct("balance", "Check your balance", "/balance");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
    $this->config = new Config($this->plugin->getDataFolder() . "config.yml", Config::YAML);

    if (empty($args)) {
        if ($sender instanceof Player) {
            $getBal = new getBal($this->plugin);
            $balance = $getBal->getBal($sender);
            $sender->sendMessage("Your balance is " . $this->config->getNested("Currency.Symbol") . $balance);
        } else {
            $sender->sendMessage("Your balance is " . $this->config->getNested("Currency.Symbol") . "0");
        }
    } else {
        $player = $args[0];
        $isExist = new isExist($this->plugin);
        if ($isExist->isExist($player)) {
            $getBal = new getBal($this->plugin);
            $balance = $getBal->getBal($player);

            $sender->sendMessage("$player's balance is " . $this->config->getNested("Currency.Symbol") . $balance);
        } else {
            $sender->sendMessage("The player '$player' does not exist");
        }
    }

    return true;
    }
}