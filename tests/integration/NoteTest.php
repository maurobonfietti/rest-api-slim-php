<?php declare(strict_types=1);

namespace Tests\integration;

class NoteTest extends BaseTestCase
{
    private static $id;

    /**
     * Test Get All Notes.
     */
    public function testGetNotes()
    {
        $response = $this->runApp('GET', '/api/v1/notes');

        $result = (string) $response->getBody();
        $value = json_encode(json_decode($result));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('description', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertRegExp('{"code":200,"status":"success"}', $value);
        $this->assertRegExp('{"name":"[A-Za-z0-9_. ]+","description":"[A-Za-z0-9_. ]+"}', $value);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get One Note.
     */
    public function testGetNote()
    {
        $response = $this->runApp('GET', '/api/v1/notes/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('description', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get Note Not Found.
     */
    public function testGetNoteNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/notes/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('description', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Search Notes.
     */
    public function testSearchNotes()
    {
        $response = $this->runApp('GET', '/api/v1/notes/search/n');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('description', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Search Note Not Found.
     */
    public function testSearchNoteNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/notes/search/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Note.
     */
    public function testCreateNote()
    {
        $response = $this->runApp(
            'POST', '/api/v1/notes',
            ['name' => 'My Test Note', 'description' => 'New Note...']
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->message->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('description', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Create Note Without Name.
     */
    public function testCreateNoteWithoutName()
    {
        $response = $this->runApp('POST', '/api/v1/notes');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('description', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Note With Invalid Name.
     */
    public function testCreateNoteWithInvalidName()
    {
        $response = $this->runApp(
            'POST', '/api/v1/notes',
            ['name' => 'z']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('description', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update Note.
     */
    public function testUpdateNote()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/notes/' . self::$id,
            ['name' => 'Victor Notes', 'description' => 'Pep.']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('description', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Update Note Without Send Data.
     */
    public function testUpdateNoteWithOutSendData()
    {
        $response = $this->runApp('PUT', '/api/v1/notes/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('name', $result);
        $this->assertStringNotContainsString('description', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update Note Not Found.
     */
    public function testUpdateNoteNotFound()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/notes/123456789', ['name' => 'Note']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('name', $result);
        $this->assertStringNotContainsString('description', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Delete Note.
     */
    public function testDeleteNote()
    {
        $response = $this->runApp('DELETE', '/api/v1/notes/' . self::$id);

        $result = (string) $response->getBody();
        
//        var_dump($result); exit;

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Delete Note Not Found.
     */
    public function testDeleteNoteNotFound()
    {
        $response = $this->runApp('DELETE', '/api/v1/notes/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('name', $result);
        $this->assertStringNotContainsString('description', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }
}
