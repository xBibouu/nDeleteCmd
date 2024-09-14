<?php

namespace xBibouDeleteCmd;

use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Main extends PluginBase
{
    private static self $this;

    public function onEnable(): void
    {
        self::$this = $this;
        $this->saveDefaultConfig();
        $this->unregister(Main::getInstance()->getConfig()->get("delete-commands"));
    }

    public static function getInstance(): self
    {
        return self::$this;
    }

    private function unregister(array $disabledCommands): void
    {
        $commandMap = Server::getInstance()->getCommandMap();

        foreach ($disabledCommands as $commandName) {
            $command = $commandMap->getCommand($commandName);

            if ($command instanceof Command) {
                $commandMap->unregister($command);
            }
        }
    }
}