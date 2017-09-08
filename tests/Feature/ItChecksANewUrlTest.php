<?php

namespace Tests\Feature;

use Tests\TestCase;

class ItChecksANewUrlTest extends TestCase
{
    /** @test */
    public function it_gets_first_header_from_remote_url()
    {
        $response = $this->post('api/url-check', [
            'url' => 'http://pepperrodeo.com'
        ], array('HTTP_X-Requested-With' => 'XMLHttpRequest'));

        $this->assertEquals(json_decode($response->getContent())->heading, 'Pepper Rodeo');
    }

    /** @test */
    public function it_adds_a_http_prefix_to_url()
    {
        $response = $this->post('api/url-check', [
            'url' => 'facebook.com'
        ]);

        $this->assertEquals('http://facebook.com', json_decode($response->getContent())->url);
    }
}
