<?php

namespace Tests\Unit;

use Tests\TestCase;

class MatchingAlgorithmTest extends TestCase
{
    public function test_match_percentage_calculation()
    {
        $volunteerSkills = ['PHP', 'Laravel', 'MySQL'];
        $projectSkills = ['Laravel', 'MySQL', 'Vue'];

        $matchPercentage = count(array_intersect($volunteerSkills, $projectSkills)) / count($projectSkills) * 100;

        $this->assertEqualsWithDelta(66.6666666667, $matchPercentage, 0.01);
    }
}