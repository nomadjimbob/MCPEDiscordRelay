<img src="https://i.imgur.com/POnNBZX.png" width="100%">

# MCPEDiscordRelay
<a href="https://poggit.pmmp.io/p/MCPEDiscordRelay"><img src="https://poggit.pmmp.io/shield.state/MCPEDiscordRelay"></a>

### Connect your Minecraft PocketMine server chat and console to a Discord channel.

* Outputs player chat and commands to a Discord channel
* Option to output the console to the same Discord channel
 

## Getting Started

<img align="right" src="https://i.imgur.com/3ijsHmh.png" width="30%">

It's is easy to get going...

1. [Download the latest release](https://github.com/nomadjimbob/MCPEDiscordRelay/releases/download/v1.0.6/MCPEDiscordRelay.phar.zip) and place it in your plugins folder
2. Restart your Minecraft server. This will create a MCPEDiscordRelay folder containing the config.yml file in your plugins folder
3. Open your Discord server and create or open a chat channel
4. Click on the settings icon beside your chat channel name
5. Click Webhooks and New
6. Click "Copy" under the Webhook URL
7. In the config.yml file, paste the Webhook URL in the discord_webhook_url option
8. Restart your Minecraft server

You should now see your server outputting to your Discord channel.

## Found a Bug? Need a feature?

If you think you have found a problem, or would like to see a feature, please [open an issue](https://github.com/nomadjimbob/MCPEDiscordRelay/issues).

If you are a coder, feel free to create a pull request, but please be detailed about your changes!

## Detailed configuration
**enabled** (true|false)
If the plugin is to be loaded or not

**discord_webhook_url** (string)
The Discord Webhook URL to use when connecting to Discord

**discord_webhook_name** (string)
The username the plugin uses in Discord

**discord_webhook_refresh** (number)
The amount of seconds to wait before updating Discord. Setting this number too low may cause Discord to take spam action

**discord_webhook_override** (true|false)
The plugin verifies the Discord Webhook URL against its own internal checks. If the plugin thinks your Webhook URL is wrong, it will disable itself. If you know better, set this to true to override the check

**send_console** (true|false)
The default is to just send player chat and commands to Discord. If you would like to also send the servers console, set this to true

#### Discord Embed options

The following discord webhook embeds are not used by the official discord clients, but maybe used by others. These options maybe removed in the future when removed from the Discord API as they short be considered deprecated.

**discord_webhook_title** (string)
The embed title string to send to Discord.

**discord_webhook_description** (string)
The embed description string to send to Discord

**discord_webhook_color** (hex color|number)
The embed color to send to Discord. Hex colors must start with a hashtag

**discord_webhook_footer** (string)
The embed footer to send to Discord


## Known Issues

This plugin will not work on servers hosted on specific devices that do not have 'cURL' installed (eg android phone).

## Final mention

* Based off the plugins MCPEToDiscord by JaxkDev and DiscordMCPE by NiekertDev
