<?php 

namespace App\CommandParser;

interface ICommand {
    public function execute($args);
}