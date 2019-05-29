<?php

namespace GameMasterTool\Command;

class Invoker
{
    /** @var CommandInterface */
    private $command;

    public function setCommand(CommandInterface $cmd): void
    {
        $this->command = $cmd;
    }

    public function run(): void
    {
        $this->command->execute();
    }
}
