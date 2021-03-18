<?php
/*
 * MCPEDiscordRelay
 * Developer: Nomadjimbob
 * Website: https://github.com/nomadjimbob/MCPEDiscordRelay
 * Licensed under GNU GPL 3.0 (https://github.com/nomadjimbob/MCPEDiscordRelay/blob/master/LICENSE)
 */
declare(strict_types=1);

namespace nomadjimbob\MCPEDiscordRelay;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\scheduler\TaskHandler;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;


class Main extends PluginBase implements Listener {

	public $attachment				= null;
	private $enabled				= false;
	private $discordWebHookURL		= "";
	private $discordWebHookName		= "";
	public $discordWebHookOptions	= array();
  private $task    = null;

	public function onLoad() {

	}

	public function onEnable() {
		$this->saveDefaultConfig();
		$this->reloadConfig();

		if($this->getConfig()->get("enabled")) {
			$this->initTasks();
		}
		
		if($this->enabled) {
			$this->sendToDiscord("MCPEDiscordRelay enabled");
		}
	}
	
	
	public function onDisable() {
		$this->endTasks();
		$this->enabled = false;
	}
	
	
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
			case "version":
				$sender->sendMessage("1.0.9");
				return true;
			default:
				return false;
		}
	}
	

    public function onPlayerCommandPreprocess(PlayerCommandPreprocessEvent $event) {
        $player = $event->getPlayer();
        $message = $event->getMessage();

        $this->sendToDiscord("<".$player->getName()."> ".$message);
    }
	
	
    public function onJoin(PlayerJoinEvent $event)
    {
        if($this->getConfig()->get("show_player_events") !== false) {
            $player = $event->getPlayer();
            $this->sendToDiscord("<".$player->getName()."> joined the server");
        }
    }

    public function onQuit(PlayerQuitEvent $event)
    {
        if($this->getConfig()->get("show_player_events") !== false) {
            $player = $event->getPlayer();
            $this->sendToDiscord("<".$player->getName()."> left the server");
        }
    }


    public function initTasks() {
		$url = $this->getConfig()->get("discord_webhook_url", "");
		
    $prefixMatch = $this->getConfig()->get("discord_webhook_override", false);
    
    if(!$prefixMatch) {
      $prefix = "https://discordapp.com/api/webhooks/";
  		$prefixLength = strlen($prefix);
      if(substr($url, 0, $prefixLength) == $prefix && strlen($url) > $prefixLength) {
        $prefixMatch = true;
      }
    }
    
    if(!$prefixMatch) {
      $prefix = "https://discord.com/api/webhooks/";
  		$prefixLength = strlen($prefix);
      if(substr($url, 0, $prefixLength) == $prefix && strlen($url) > $prefixLength) {
        $prefixMatch = true;
      }
    }
    
		if($prefixMatch) {
			$this->discordWebHookURL = $url;
			$this->discordWebHookName = $this->getConfig()->get("discord_webhook_name", "MCPEDiscordRelay");
		
			$embedOption = $this->getConfig()->get("discord_webhook_title", "");
			if($embedOption != "") {
				$this->discordWebHookOptions["title"] = $embedOption;
			}

			$embedOption = $this->getConfig()->get("discord_webhook_description", "");
			if($embedOption != "") {
				$this->discordWebHookOptions["description"] = $embedOption;
			}

			$embedOption = $this->getConfig()->get("discord_webhook_color", "");
			if($embedOption != "") {
				if(substr($embedOption, 1, 1) == '#') {
					$embedOption = hexdec($embedOption);
				} else {
					$embedOption = intval($embedOption);
				}
				$$this->discordWebHookOptions["color"] = $embedOption;
			}

			$embedOption = $this->getConfig()->get("discord_webhook_footer", "");
			if($embedOption != "") {
				$$this->discordWebHookOptions["footer"] = $embedOption;
			}

			if($this->attachment == null) {
				$this->attachment = new Attachment();

				if($this->getConfig()->get("send_console") !== true) {
					$this->attachment->enable(false);
				}

				$this->getServer()->getLogger()->addAttachment($this->attachment);

                $mtime = intval($this->getConfig()->get("discord_webhook_refresh", 10)) * 20;
                $this->task = $this->getScheduler()->scheduleRepeatingTask(new Broadcast($this), $mtime);

                $this->getServer()->getPluginManager()->registerEvents($this, $this);

				$this->enabled = true;
				return true;
			}		
		} else {
			$this->getLogger()->error(TextFormat::WHITE . "Webhook URL doesn't look right in config.yml. Disabling plugin. Use discord_webhook_override=true in config.yml to override");
		}
		
		$this->endTasks();
		return false;
	}
	
	
	public function endTasks() {
		if($this->task != null) {
			$this->task->remove();
			$this->task = null;
		}

		if($this->attachment != null) {
			$this->getServer()->getLogger()->removeAttachment($this->attachment);
			$this->attachment = null;
		}
	}


	public function sendToDiscord(string $msg) {
		if($this->enabled && $this->attachment != null) {
			$this->attachment->appendStream($msg);
		}
	}


	public function getDiscordWebHookURL() {
		return $this->discordWebHookURL;
	}


	public function getDiscordWebHookName() {
		return $this->discordWebHookName;
	}

	public function getEnabled() {
        return $this->enabled;
    }

	public function backFromAsync($player, $result) {

	}
}
