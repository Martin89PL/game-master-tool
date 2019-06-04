<?php

use GameMasterTool\Command\Invoker;
use GameMasterTool\DTO\Prompt;
use GameMasterTool\Factory\CommandFactory;
use GameMasterTool\GameState;
use GameMasterTool\Service\ParticipantService;
use GameMasterTool\Repository\ParticipantRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$input = '';
$invoker = new Invoker();
$gameState = new GameState(
    new ParticipantService(new ParticipantRepository())
);

GameMasterTool\Terminal::printWelcomeMessage('Put your names here');
while ($input !== 'exit') {
    GameMasterTool\Terminal::printCommandPrompt();
    $input = rtrim(fgets(STDIN));

    $command = CommandFactory::create($gameState, new Prompt($input));
    $invoker->setCommand($command);
    $invoker->run($input);
}
