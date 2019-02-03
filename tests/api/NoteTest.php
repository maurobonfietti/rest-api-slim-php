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
        $value = json_encode(json_decode($result));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('success', $result);
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('description', $result);
        $this->assertContains('updated', $result);
//        $this->assertRegExp('{"code":200,"status":"success"}', $value);
        $this->assertRegExp('{"id":"[0-9]+","name":"[A-Za-z0-9_. ]+","description":"[A-Za-z0-9_. ]+","updated"}', $value);
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
        $this->assertContains('success', $result);
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('description', $result);
        $this->assertContains('updated', $result);
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
        $this->assertNotContains('success', $result);
        $this->assertNotContains('id', $result);
        $this->assertNotContains('description', $result);
        $this->assertNotContains('updated', $result);
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
        $this->assertContains('success', $result);
        $this->assertContains('id', $result);
        $this->assertContains('description', $result);
        $this->assertContains('updated', $result);
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
        $this->assertNotContains('success', $result);
        $this->assertNotContains('id', $result);
        $this->assertNotContains('description', $result);
        $this->assertNotContains('updated', $result);
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
        $this->assertContains('success', $result);
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('description', $result);
        $this->assertContains('updated', $result);
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
        $this->assertNotContains('success', $result);
        $this->assertNotContains('id', $result);
        $this->assertNotContains('description', $result);
        $this->assertNotContains('updated', $result);
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
        $this->assertNotContains('success', $result);
        $this->assertNotContains('description', $result);
        $this->assertNotContains('updated', $result);
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
        $this->assertContains('success', $result);
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('description', $result);
        $this->assertContains('updated', $result);
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
        $this->assertNotContains('success', $result);
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertNotContains('description', $result);
        $this->assertNotContains('updated', $result);
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
        $this->assertNotContains('success', $result);
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertNotContains('description', $result);
        $this->assertNotContains('updated', $result);
        $this->assertContains('error', $result);
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
        $this->assertContains('success', $result);
        $this->assertContains('The note was deleted.', $result);
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
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertNotContains('description', $result);
        $this->assertNotContains('updated', $result);
        $this->assertContains('error', $result);
    }
}
