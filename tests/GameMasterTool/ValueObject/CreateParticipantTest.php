<?php

namespace GameMasterTool\ValueObject;

use Codeception\Test\Unit;
use GameMasterTool\DTO\Prompt;
use GameMasterTool\ValueObject\CreateParticipant;

class CreateParticipantTest extends Unit
{
    public function testShouldCreateAddParticipantVO()
    {
        $participantAddVO = new CreateParticipant(new Prompt('add Johan JQuery 1 PHY 2 MEN 1 VIT 15 LUC Lore Psionics'));

        self::assertEquals('Johan JQuery', $participantAddVO->name);
        self::assertEquals(1, $participantAddVO->PHY);
        self::assertEquals(2, $participantAddVO->MEN);
        self::assertEquals(1, $participantAddVO->VIT);
        self::assertEquals(15, $participantAddVO->LUC);
        self::assertEquals('Lore', $participantAddVO->skill1);
        self::assertEquals('Psionics', $participantAddVO->skill2);

    }
}
