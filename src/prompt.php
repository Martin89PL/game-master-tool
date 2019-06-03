<?php

use GameMasterTool\Command\Invoker;
use GameMasterTool\DTO\PromptDTO;
use GameMasterTool\Factory\CommandFactory;
use GameMasterTool\GameState;

require_once __DIR__ . '/../vendor/autoload.php';

$input = '';
$invoker = new Invoker();
$gameState = new GameState();
GameMasterTool\Terminal::printWelcomeMessage('Put your names here');
while ($input !== 'exit') {
    GameMasterTool\Terminal::printCommandPrompt();
    $input = rtrim(fgets(STDIN));

    $command = CommandFactory::create($gameState, new PromptDTO($input));
    $invoker->setCommand($command);
    $invoker->run($input);
}
