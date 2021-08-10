<?php
namespace nomadjimbob\MCPEDiscordRelay;

use pocketmine\scheduler\Task;

class Broadcast extends Task {

    private $main;

    public function __construct(Main $main) {
        $this->main = $main;
    }

    public function onRun(int $currentTick) {
        if($this->main->getEnabled() && $this->main->attachment != null) {
            $stream = $this->main->attachment->clearStream();
            $this->sendToDiscord("nolog", $stream, $this->main->discordWebHookOptions);
        }
    }

    public function sendToDiscord(string $player = "nolog", string $msg = "", array $options = []) {
        $curlopts = [
            "content"    => $msg,
            "username"	=> $this->main->getDiscordWebHookName()
        ];

        if(is_array($options) && count($options) > 0) {
            $embed = Array();
            if(array_key_exists("title", $options)) {
                
                $embed["title"] = $options["title"];
            }

            if(array_key_exists("description", $options)) {
                $embed["description"] = $options["description"];
            }

            if(array_key_exists("color", $options)) {
                $embed["color"] = $options["color"];
            }

            if(array_key_exists("footer", $options)) {
                $embed["footer"] = array("text" => $options["footer"]);
            }
            
            if(array_key_exists("enable_pings", $options) && $options["enable_pings"] !== true) {
              $curlopts["allowed_mentions"]["parse"] = Array();
            }

            $curlopts["embed"] = $embed;
        }
        
        $this->main->getServer()->getAsyncPool()->submitTask(new SendAsync($player, $this->main->getDiscordWebHookURL(), serialize($curlopts)));
    }
}
