## PHP Hydrator

```php
$hydrate = new Hydrate();

/**
 * @var PostDTO
 */
$post = $hydrate->to(PostDTO::class, [
  'title' => 'Test',
  'description' =>  'sample post'
]);

```

#### todo

    - cast some fields to specefic object after hydrate.
    - add toArray method.

