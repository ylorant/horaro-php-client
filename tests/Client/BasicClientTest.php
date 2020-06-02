<?php
namespace Horaro\Tests;

use Horaro\Client;
use PHPUnit\Framework\TestCase;

class BasicClientTest extends TestCase
{
    public function testHoraroClient()
    {
        $client = new Client();
        $schedule = $client->getSchedule('speedcombo', 'sta-twitch');

        $this->assertIsObject($schedule);
        $this->assertInstanceOf("stdClass", $schedule);
        $this->assertEquals("speedcombo", $schedule->slug);
    }
}