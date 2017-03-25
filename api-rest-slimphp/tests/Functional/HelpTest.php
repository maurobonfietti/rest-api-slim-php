<?php

namespace Tests\Functional;

require __DIR__.'/../../src/base.php';
require __DIR__.'/../../src/users.php';
require __DIR__.'/../../src/tasks.php';
require __DIR__.'/../../src/queries.php';

class HelpTest extends BaseTestCase
{
    /**
     * Test that default endpoint show a help.
     */
    public function testApiHelp()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('help', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }
}
