<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\api;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class registerAccount {
    private $plugin;
    private $confif;
    public function __construct(PluginBase $plugin) {
        $this->plugin = $plugin;
    }
    
    public function registerAccount(string $player): void {
        $config = new Config($this->plugin->getDataFolder() . "players_data.yml");
        $startingBalance = $this->config->getNested("PlayerBalance.StartingAmount");
        $startingBank = $this->config->getNested("BankBalance.StartingAmount");
        
        $data = [
            "balance" => $startingBalance,
            "bank" => $startingBank,
        ];
        
        $config->set($player, $data);
        $config->save();
        $this->plugin->getLogger()->error("New Player $player has $startingBalance now");
    }
}