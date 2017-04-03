<?php

namespace Tests\Functional;

require __DIR__.'/../../src/Controller/base.php';
require __DIR__.'/../../src/Controller/Tasks/Tasks.php';
require __DIR__.'/../../src/Controller/Users/Users.php';
require __DIR__.'/../../src/Repository/queries.php';

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
