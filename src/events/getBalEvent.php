<?php

declare(strict_types=1);

namespace iNA16\EconomyBridge\events;

use pocketmine\plugin\PluginBase;
use SQLite3;

class getBalEvent extends PluginBase{
  
  private $db;

  public function __construct() {
    // Initialize the SQLite database
    $this->db = new SQLite3($this->getDataFolder() . "players_data.sqlite");
  }

  public function getBal(string $player) {
    $stmt = $this->db->prepare("SELECT balance FROM players WHERE player_name = :player");
    $stmt->bindValue(":player", $player, SQLITE3_TEXT);
    $result = $stmt->execute();

    if($row = $result->fetchArray(SQLITE3_ASSOC)) {
      return $row["balance"];
    } else {
      return 0;
    }
  }
}