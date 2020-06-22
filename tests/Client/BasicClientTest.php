<?php
namespace Horaro\Tests;

use Horaro\Client;
use PHPUnit\Framework\TestCase;

class BasicClientTest extends TestCase
{
    /** @var stdClass|null The async received reply in the async test */
    protected $receivedReply = null;

    public function testHoraroClient()
    {
        $client = new Client();
        $schedule = $client->getSchedule('speedcombo', 'sta-twitch');

        $this->assertIsObject($schedule);
        $this->assertInstanceOf("stdClass", $schedule);
        $this->assertEquals("speedcombo", $schedule->slug);
    }

    public function testHiddenColumns()
    {
        $client = new Client();
        $schedule = $client->getSchedule('hsm2', 'sta-twitch', 'schwarzenegger');

        $expectedColumns = [
            "Runner",
            "Jeu",
            "Jeu Twitch",
            "Catégorie",
            "Support"
        ];

        $this->assertIsObject($schedule);
        $this->assertInstanceOf("stdClass", $schedule);
        $this->assertEquals("hsm2", $schedule->slug);
        $this->assertEquals($expectedColumns, $schedule->columns);
    }

    public function testAsyncRequest()
    {
        $client = new Client();
        $client->getScheduleAsync('hsm2', 'sta-twitch', 'schwarzenegger', [$this, 'asyncScheduleCallback']);

        while(empty($this->receivedReply)) {
            $client->asyncListen();
        }

        $expectedColumns = [
            "Runner",
            "Jeu",
            "Jeu Twitch",
            "Catégorie",
            "Support"
        ];

        $schedule = $this->receivedReply;

        $this->assertIsObject($schedule);
        $this->assertInstanceOf("stdClass", $schedule);
        $this->assertEquals("hsm2", $schedule->slug);
        $this->assertEquals($expectedColumns, $schedule->columns);
    }

    public function asyncScheduleCallback($scheduleId, $eventId, $schedule)
    {
        $this->receivedReply = $schedule;
    }
}