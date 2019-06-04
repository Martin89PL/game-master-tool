<?php

namespace GameMasterTool\Specification;

interface Specification
{
    public function isSatisfiedBy($prompt): bool;
}