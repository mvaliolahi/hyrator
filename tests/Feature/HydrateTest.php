<?php

namespace Tests\Feature;

use Mvaliolahi\Hydrate\Hydrate;
use Tests\DataContracts\PostDTO;
use Tests\TestCase;

/**
 * Class HydrateTest
 * @package Tests\Unit
 */
class HydrateTest extends TestCase
{
  /**
   * @test
   */
  public function it_should_hydrate_object_from_array()
  {
    /**
     * @var PostDTO
     */
    $post = (new Hydrate)->to(PostDTO::class, [
      'title' => 'Test',
      'description' =>  'sample post'
    ]);

    $this->assertInstanceOf(PostDTO::class, $post);
    $this->assertEquals('Test', $post->getTitle());
    $this->assertEquals('sample post', $post->getDescription());
  }

  /**
   * @test
   */
  public function it_should_override_some_properties()
  {
    $hydrate = new Hydrate();

    /**
     * @var PostDTO
     */
    $post = $hydrate->to(
      PostDTO::class,
      [
        'title' => 'Test',
        'description' =>  'sample post'
      ],
      [
        'title' => 'override'
      ]
    );

    $this->assertInstanceOf(PostDTO::class, $post);
    $this->assertEquals('override', $post->getTitle());
    $this->assertEquals('sample post', $post->getDescription());
  }
}
