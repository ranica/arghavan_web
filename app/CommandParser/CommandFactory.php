<?php

namespace App\CommandParser;

use App\CommandParser\ICommand;
use App\CommandParser\Cmd5000;
use App\CommandParser\Cmd5308;
use App\CommandParser\Cmd63010;
use App\CommandParser\Cmd63011;
use App\CommandParser\Cmd5408;
use App\CommandParser\Cmd64010;
use App\CommandParser\Cmd64011;
use App\CommandParser\Cmd54010;


class CommandFactory {
    private static $commands;

    /**
     * Make commands
     */
    private static function makeCommands() {
        static::$commands = [
            "CMD_5000"      => new Cmd5000(),
            "CMD_5308"      => new Cmd5308(),
            "CMD_63010"     => new Cmd63010(),
            "CMD_63011"     => new Cmd63011(),
            "CMD_5408"      => new Cmd5408(),
            "CMD_54010"     => new Cmd54010(),
            "CMD_53010"     => new Cmd53010(),
            "CMD_64010"     => new Cmd64010(),
            "CMD_64011"     => new Cmd64011()
        ];
    }

    /**
     * Run Command
     */
    public static function runCommand($cmd, $args) {
        if (is_null (self::$commands)) {
            self::makeCommands();
        }

        $command = self::$commands[$cmd];
        return $command->execute($args);
    }
}
