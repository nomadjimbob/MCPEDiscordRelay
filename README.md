<a href="https://poggit.pmmp.io/p/MCPEDiscordRelay"><img src="https://poggit.pmmp.io/shield.state/MCPEDiscordRelay"></a>

# MCPEDiscordRelay
Connect your PocketMine server to output to a Discord channel using a WebHook. Based on the archived plugin [MCPEToDiscord](https://poggit.pmmp.io/p/MCPEToDiscord) by JaxkDev and DiscordMCPE by NiekertDev

Version: 1.0.6

Author: Nomadjimbob (james@jamescollins.com.au)

Source: (https://github.com/nomadjimbob/MCPEDiscordRelay)


Bugs, issues and feature requests can be made over on the projects github page, under issues  (https://github.com/nomadjimbob/MCPEDiscordRelay/issues)

# Features
  * Relay PocketMine console to Discord
  * Includes chat and commands from players (even /talk)

# Configuration
config.yml options:

**enabled**: If the plugin is enabled or not

**discord_webhook_url**: Your discord webhook url

**discord_webhook_name**: The username the plugin uses in discord

**discord_webhook_override**: Allows overriding the discord webhook check

**send_console**: Send console to Discord. If false, only sends player chat and commands

### Optional

The following discord webhook embeds are not used by the official discord clients, but maybe used by others. These options maybe removed in the future when removed from the Discord API as they short be considered deprecated.

**discord_webhook_title**: Embed title to use in the webhook

**discord_webhook_description**: Embed description to use in the webhook

**discord_webhook_color**: Embed color to use in the webhook. Hex colors must have # at the start else it will be treated as a number

**discord_webhook_footer**: Embed footer to use in the webhook


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
**1.0.6**
- Added option to override discord_webhook_url with discord_webhook_override=true
- Added options to use the discord embed feature set

**1.0.5**
- Fixed permission issue

**1.0.4**
- Removed startup/shutdown messages

**1.0.3**
- Fixed namspace issue

**1.0.2**
- Fixed version command to report correct version. Added config option send_console

**1.0.1**
- Fixed bug with curl response error message missing in certain circumstances

**1.0.0**
- Inital Release
