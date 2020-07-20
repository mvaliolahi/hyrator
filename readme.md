## PHP Hydrator

#### Install

```bash
composer require mvaliolahi/hydrate
```

#### Example

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

* Tip: third argument of to() method can be use to overwrite data.

#### todo

    - cast some fields to specefic object after hydrate.
    - add toArray method.

