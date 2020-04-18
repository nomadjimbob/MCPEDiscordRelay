<a href="https://discord.gg/fpGK9Vr"><img src="https://discordapp.com/api/guilds/699956067781705759/embed.png" alt="Discord server"/></a>
<a href="https://poggit.pmmp.io/p/MCPEDiscordRelay"><img src="https://poggit.pmmp.io/shield.state/MCPEDiscordRelay"></a>

# MCPEDiscordRelay
Connect your PocketMine server to output to a Discord channel using a WebHook. Based on the archived plugin [MCPEToDiscord](https://poggit.pmmp.io/p/MCPEToDiscord) by JaxkDev and DiscordMCPE by NiekertDev

Version: 1.0.4

Author: Nomadjimbob (hello@jamescollins.com.au)

Source: (https://github.com/nomadjimbob/MCPEDiscordRelay)

# Features
  * Relay PocketMine console to Discord
  * Includes chat and commands from players (even /talk)

# Configuration
config.yml options:

**enabled**: If the plugin is enabled or not

**discord_webhook_url**: Your discord webhook url

**discord_webhook_name**: The username the plugin uses in discord

**send_console**: Send console to Discord. If false, only sends player chat and commands

## Making a Discord webhook:
1. Open Discord
2. Go to your server
3. Make a new chat channel / Open one
4. Click on the settings icon beside your chat channel name
5. Click Webhooks => New
6. Click "Copy" under Webhook URL
7. Paste it in the config

# Issues
As per the original plugin, this does not work on servers hosted on specific devices that do not have 'cURL' installed (eg android phone).

# Change log
1.0.4 - Removed startup/shutdown messages

1.0.3 - Fixed namspace issue

1.0.2 - Fixed version command to report correct version. Added config option send_console

1.0.1 - Fixed bug with curl response error message missing in certain circumstances

1.0.0 - Inital Release
