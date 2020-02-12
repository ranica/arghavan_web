<?php

namespace App\CommandParser;

use App\CommandParser\ICommand;

class Cmd5000 implements ICommand {
    /**
     * Execute command
     */
    public function execute($args)
    {
        /* TODO COMMAND */
        dd(["COMMAND 5000", $args]);

        return 0;
    }
}