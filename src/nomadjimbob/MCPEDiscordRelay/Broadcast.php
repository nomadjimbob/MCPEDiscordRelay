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

    public function sendToDiscord(string $player = "nolog", string $msg, array $options) {
        $curlopts = [
            "content"    => $msg,
            "username"	=> $this->main->getDiscordWebHookName()
        ];

        if($options != null || count($options) > 0) {
            $embed = [];
            if(in_array("title", $options)) {
                $embed["title"] = $options["title"];
            }

            if(in_array("description", $options)) {
                $embed["description"] = $options["description"];
            }

            if(in_array("color", $options)) {
                $embed["color"] = $options["color"];
            }

            if(in_array("footer", $options)) {
                $embed["footer"] = array("text" => $options["footer"]);
            }

            $curlopts["embed"] = $embed;
        }
        
        $this->main->getServer()->getAsyncPool()->submitTask(new SendAsync($player, $this->main->getDiscordWebHookURL(), serialize($curlopts)));
    }
}
