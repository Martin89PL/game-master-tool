<?php

use GameMasterTool\Command\AddParticipantCommand;
use GameMasterTool\Factory\CommandFactory;

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
        $commmandPromptInput = 'add ParticipantName x PHY x MEN x VIT x LUC Skill1 Skill2';
        $addParticipantCommand = CommandFactory::create($commmandPromptInput);
        self::assertInstanceOf(AddParticipantCommand::class, $addParticipantCommand);
    }
}