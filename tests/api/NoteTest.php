<?php

namespace Tests\api;

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

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('Note', $result);
        $this->assertContains('online', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Get One Note.
     */
    public function testGetNote()
    {
        $response = $this->runApp('GET', '/api/v1/notes/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Note', $result);
        $this->assertContains('online', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Get Note Not Found.
     */
    public function testGetNoteNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/notes/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Search Notes.
     */
    public function testSearchNotes()
    {
        $response = $this->runApp('GET', '/api/v1/notes/search/n');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Note', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Search Note Not Found.
     */
    public function testSearchNoteNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/notes/search/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
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
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Note', $result);
        $this->assertContains('New', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Create Note Without Name.
     */
    public function testCreateNoteWithoutName()
    {
        $response = $this->runApp('POST', '/api/v1/notes');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
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
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
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
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Victor', $result);
        $this->assertContains('Pep', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Update Note Without Send Data.
     */
    public function testUpdateNoteWithOutSendData()
    {
        $response = $this->runApp('PUT', '/api/v1/notes/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
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
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Delete Note.
     */
    public function testDeleteNote()
    {
        $response = $this->runApp('DELETE', '/api/v1/notes/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('success', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Delete Note Not Found.
     */
    public function testDeleteNoteNotFound()
    {
        $response = $this->runApp('DELETE', '/api/v1/notes/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('success', $result);
        $this->assertContains('error', $result);
    }
}
