<?php

use GameMasterTool\Command\CreateParticipantCommand;
use GameMasterTool\Factory\CommandFactory;
use GameMasterTool\GameState;

class CommandFactoryTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testShoulReturnAddParticipantCommand()
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject | \GameMasterTool\Service\ParticipantService $participantService */
        $participantService = self::createMock(\GameMasterTool\Service\ParticipantService::class);
        $gameState = new GameState($participantService);
        $commmandPromptInput = 'add ParticipantName x PHY x MEN x VIT x LUC Skill1 Skill2';
        $addParticipantCommand = CommandFactory::create($gameState, $commmandPromptInput);
        self::assertInstanceOf(CreateParticipantCommand::class, $addParticipantCommand);
    }

    public function testShouldThrowExceptionWhenCommandIsBad()
    {
        self::expectException(InvalidArgumentException::class);

        /** @var \PHPUnit\Framework\MockObject\MockObject | \GameMasterTool\Service\ParticipantService $participantService */
        $participantService = self::createMock(\GameMasterTool\Service\ParticipantService::class);
        $gameState = new GameState($participantService);
        $commmandPromptInput = 'bad command';
        CommandFactory::create($gameState, $commmandPromptInput);
    }


}