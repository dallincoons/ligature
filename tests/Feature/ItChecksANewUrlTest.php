<?php

namespace Tests\Feature;

use Tests\TestCase;

class ItChecksANewUrlTest extends TestCase
{
    /** @test */
    public function it_throws_error_when_url_is_invalid()
    {
        $this->withExceptionHandling();

        $response = $this->post('api/url-check', [
            'url' => 'INVALID'
        ], array('HTTP_X-Requested-With' => 'XMLHttpRequest'));

        $response->assertStatus(422);
    }

    /** @test */
    public function it_gets_first_header_from_remote_url()
    {
        $response = $this->post('api/url-check', [
            'url' => 'http://pepperrodeo.com'
        ]);

        $this->assertEquals(json_decode($response->getContent())->heading, 'Pepper Rodeo');
    }
}
