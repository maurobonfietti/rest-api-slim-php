<?php

namespace Tests\Controller;

class VersionTest extends BaseTestCase
{
    /**
     * Test that version endpoint, show the api version.
     */
    public function testVersion()
    {
        $response = $this->runApp('GET', '/version');

        //print_r((string) $response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('version', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }
}
