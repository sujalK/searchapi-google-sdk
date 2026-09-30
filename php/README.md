# SearchapiGoogle PHP SDK



The PHP SDK for the SearchapiGoogle API — an entity-oriented client using PHP conventions.

The SDK exposes the API as capitalised, semantic **Entities** — for example `$client->Search()` — with named operations (`list`) instead of raw URL paths and query strings. Working with resources and verbs keeps call sites self-describing and reduces cognitive load.

> Other languages, the CLI, and MCP server live alongside this one — see
> the [top-level README](../README.md).


## Install
This package is not yet published to Packagist. Install it from the
GitHub release tag (`php/vX.Y.Z`, see [Releases](https://github.com/voxgig-sdk/searchapi-google-sdk/releases)), or
from a clone as a Composer path repository:

```bash
git clone https://github.com/voxgig-sdk/searchapi-google-sdk
composer config repositories.searchapi-google-sdk path ./searchapi-google-sdk/php
composer require voxgig-sdk/searchapi-google-sdk:@dev
```


## Tutorial: your first API call

This tutorial walks through creating a client, listing entities, and
loading a specific record.

### 1. Create a client

```php
<?php
require_once 'searchapigoogle_sdk.php';

$client = new SearchapiGoogleSDK();
```

### 2. List search records

```php
try {
    // list() returns entity instances; data_get() reads each record.
    $searchs = $client->Search()->list();
    foreach ($searchs as $record) {
        $item = $record->data_get();
        echo $item["about_this_domain"] . "\n";
    }
} catch (\Throwable $err) {
    echo "Error: " . $err->getMessage();
}
```


## Error handling

Entity operations throw a `\Throwable` on failure, so wrap them in
`try` / `catch`:

```php
try {
    $searchs = $client->Search()->list();
} catch (\Throwable $err) {
    echo "Error: " . $err->getMessage();
}
```

`direct()` does **not** throw — it returns the result array. Branch on
`ok`; on failure `status` holds the HTTP status (for error responses) and
`err` holds a transport error, so read both defensively:

```php
$result = $client->direct([
    "path" => "/api/resource/{id}",
    "method" => "GET",
    "params" => ["id" => "example_id"],
]);

if (! $result["ok"]) {
    $err = $result["err"] ?? null;
    echo "request failed: " . ($err ? $err->getMessage() : "HTTP " . $result["status"]);
}
```


## How-to guides

### Make a direct HTTP request

For endpoints not covered by entity methods:

```php
// direct() is the raw-HTTP escape hatch: it returns a result array
// (it does not throw). Branch on $result["ok"].
$result = $client->direct([
    "path" => "/api/resource/{id}",
    "method" => "GET",
    "params" => ["id" => "example"],
]);

if ($result["ok"]) {
    echo $result["status"];  // 200
    print_r($result["data"]);  // response body
} else {
    // On an HTTP error status there is no err (only a transport failure sets
    // it), so fall back to the status code.
    $err = $result["err"] ?? null;
    echo "Error: " . ($err ? $err->getMessage() : "HTTP " . $result["status"]);
}
```

### Prepare a request without sending it

```php
// prepare() throws on error and returns the fetch definition.
$fetchdef = $client->prepare([
    "path" => "/api/resource/{id}",
    "method" => "DELETE",
    "params" => ["id" => "example"],
]);

echo $fetchdef["url"];
echo $fetchdef["method"];
print_r($fetchdef["headers"]);
```

### Use test mode

Create a mock client for unit testing — no server required:

```php
$client = SearchapiGoogleSDK::test();

// list() returns entity instances (throws on error);
// call data_get() for the mock record.
$search = $client->Search()->list();
print_r(array_map(fn($item) => $item->data_get(), $search));
```

### Use a custom fetch function

Replace the HTTP transport with your own function:

```php
$mock_fetch = function ($url, $init) {
    return [
        [
            "status" => 200,
            "statusText" => "OK",
            "headers" => [],
            "json" => function () { return ["id" => "mock01"]; },
        ],
        null,
    ];
};

$client = new SearchapiGoogleSDK([
    "base" => "http://localhost:8080",
    "system" => [
        "fetch" => $mock_fetch,
    ],
]);
```

### Run live tests

Create a `.env.local` file at the project root:

```
SEARCHAPI_GOOGLE_TEST_LIVE=TRUE
```

Then run:

```bash
cd php && ./vendor/bin/phpunit test/
```


## Reference

### SearchapiGoogleSDK

```php
require_once 'searchapigoogle_sdk.php';
$client = new SearchapiGoogleSDK($options);
```

Creates a new SDK client.

| Option | Type | Description |
| --- | --- | --- |
| `base` | `string` | Base URL of the API server. |
| `prefix` | `string` | URL path prefix prepended to all requests. |
| `suffix` | `string` | URL path suffix appended to all requests. |
| `feature` | `array` | Feature activation flags. |
| `extend` | `array` | Additional Feature instances to load. |
| `system` | `array` | System overrides (e.g. custom `fetch` callable). |

### test

```php
$client = SearchapiGoogleSDK::test($testopts, $sdkopts);
```

Creates a test-mode client with mock transport. Both arguments may be `null`.

### SearchapiGoogleSDK methods

| Method | Signature | Description |
| --- | --- | --- |
| `options_map` | `(): array` | Deep copy of current SDK options. |
| `get_utility` | `(): Utility` | Copy of the SDK utility object. |
| `prepare` | `(array $fetchargs): array` | Build an HTTP request definition without sending. |
| `direct` | `(array $fetchargs): array` | Build and send an HTTP request. |
| `Search` | `($data): SearchEntity` | Create a Search entity instance. |

### Entity interface

All entities share the same interface.

| Method | Signature | Description |
| --- | --- | --- |
| `list` | `(?array $reqmatch = null, $ctrl): array` | List entities matching the criteria (call with no argument to list all). |
| `data_get` | `(): array` | Get entity data. |
| `data_set` | `($data): void` | Set entity data. |
| `match_get` | `(): array` | Get entity match criteria. |
| `match_set` | `($match): void` | Set entity match criteria. |
| `make` | `(): Entity` | Create a new instance with the same options. |
| `get_name` | `(): string` | Return the entity name. |

### Result shape

Entity operations return the ENTITY (call data_get() for the record) (an `array` for single-entity
ops, a `list` for `list`) and throw on error. Wrap calls in
`try`/`catch` to handle failures.

The `direct()` escape hatch never throws — it returns a result `array`
you branch on via `$result["ok"]`:

| Key | Type | Description |
| --- | --- | --- |
| `ok` | `bool` | `true` if the HTTP status is 2xx. |
| `status` | `int` | HTTP status code. |
| `headers` | `array` | Response headers. |
| `data` | `mixed` | Parsed JSON response body. |

On error, `ok` is `false` and `$err` contains the error value.

### Entities

#### Search

| Field | Description |
| --- | --- |
| `about_this_domain` | Inline 'About this domain' card shown for entity-style queries, with a brief overview and reference links to sources. |
| `about_this_result` | About this result information |
| `ad_related_searches` |  |
| `ads` |  |
| `ai_overview` |  |
| `answer_box` |  |
| `courses` |  |
| `discussions_and_forums` |  |
| `dmca_messages` |  |
| `error` | Error message when the page has no results, e.g. |
| `events` |  |
| `explore_brands` |  |
| `from_sources_across_the_web` |  |
| `inline_images` |  |
| `inline_recipes` |  |
| `inline_shopping` |  |
| `inline_shorts` | Array of inline short video results |
| `inline_tweets` |  |
| `inline_videos` | Array of inline video results |
| `jobs` |  |
| `knowledge_graph` |  |
| `latest_posts` |  |
| `local_ads` |  |
| `local_map` |  |
| `local_news` |  |
| `local_results` |  |
| `nearby_events` |  |
| `organic_results` |  |
| `pagination` |  |
| `perspectives` |  |
| `popular_destinations` |  |
| `questions_and_answers` |  |
| `related_questions` |  |
| `related_searches` |  |
| `salary_estimates` |  |
| `scholarly_articles` |  |
| `search_information` |  |
| `search_metadata` |  |
| `search_parameters` |  |
| `shopping_ads` |  |
| `showtimes` |  |
| `sponsored_tickets` | Sponsored tickets and tours results |
| `sports_results` |  |
| `things_to_do` |  |
| `top_stories` |  |
| `train_results` | Train itinerary widget for route queries. |
| `universities` |  |
| `weather_result` |  |

Operations: List.

API path: `/search`



## Entities


### Search

Create an instance: `$search = $client->Search();`

#### Operations

| Method | Description |
| --- | --- |
| `list(match)` | List entities matching the criteria. |

#### Fields

| Field | Type | Description |
| --- | --- | --- |
| `about_this_domain` | `array` | Inline 'About this domain' card shown for entity-style queries, with a brief overview and reference links to sources. |
| `about_this_result` | `array` | About this result information |
| `ad_related_searches` | `array` |  |
| `ads` | `array` |  |
| `ai_overview` | `array` |  |
| `answer_box` | `mixed` |  |
| `courses` | `array` |  |
| `discussions_and_forums` | `array` |  |
| `dmca_messages` | `array` |  |
| `error` | `string` | Error message when the page has no results, e.g. |
| `events` | `array` |  |
| `explore_brands` | `array` |  |
| `from_sources_across_the_web` | `array` |  |
| `inline_images` | `array` |  |
| `inline_recipes` | `array` |  |
| `inline_shopping` | `array` |  |
| `inline_shorts` | `array` | Array of inline short video results |
| `inline_tweets` | `array` |  |
| `inline_videos` | `array` | Array of inline video results |
| `jobs` | `array` |  |
| `knowledge_graph` | `array` |  |
| `latest_posts` | `array` |  |
| `local_ads` | `array` |  |
| `local_map` | `array` |  |
| `local_news` | `array` |  |
| `local_results` | `array` |  |
| `nearby_events` | `array` |  |
| `organic_results` | `array` |  |
| `pagination` | `array` |  |
| `perspectives` | `array` |  |
| `popular_destinations` | `array` |  |
| `questions_and_answers` | `array` |  |
| `related_questions` | `array` |  |
| `related_searches` | `array` |  |
| `salary_estimates` | `array` |  |
| `scholarly_articles` | `array` |  |
| `search_information` | `array` |  |
| `search_metadata` | `array` |  |
| `search_parameters` | `array` |  |
| `shopping_ads` | `array` |  |
| `showtimes` | `array` |  |
| `sponsored_tickets` | `array` | Sponsored tickets and tours results |
| `sports_results` | `mixed` |  |
| `things_to_do` | `array` |  |
| `top_stories` | `array` |  |
| `train_results` | `array` | Train itinerary widget for route queries. |
| `universities` | `array` |  |
| `weather_result` | `mixed` |  |

#### Example: List

```php
// list() returns an array of Search records (throws on error).
$searchs = $client->Search()->list();
```

## Features

This SDK ships 1 optional features. Each is **inactive until you
switch it on**, so an SDK you have not configured behaves exactly as if none of
them existed — no retries, no cache, no logging, no measurable overhead.

Activate a feature by name in the client options, alongside the options shown
above:

| Feature | What it does |
|---|---|
| [`test`](#test) | Test transport |

### test

Test transport.

| Option | Default |
|---|---|
| `active` | `false` |

Set `feature.test.active` to enable it, then override any of the options above.


## Advanced

> The sections above cover everyday use. The material below explains the
> SDK's internals — useful when extending it with custom features, but not
> needed for normal use.

### The operation pipeline

Every entity operation follows a six-stage pipeline. Each stage fires a
feature hook before executing:

```
PrePoint → PreSpec → PreRequest → PreResponse → PreResult → PreDone
```

- **PrePoint**: Resolves which API endpoint to call based on the
  operation name and entity configuration.
- **PreSpec**: Builds the HTTP spec — URL, method, headers, body —
  from the resolved point and the caller's parameters.
- **PreRequest**: Sends the HTTP request. Features can intercept here
  to replace the transport (as TestFeature does with mocks).
- **PreResponse**: Parses the raw HTTP response.
- **PreResult**: Extracts the business data from the parsed response.
- **PreDone**: Final stage before returning to the caller. Entity
  state (match, data) is updated here.

If any stage errors, the pipeline short-circuits and the error surfaces
to the caller — see [Error handling](#error-handling) for how that looks
in this language.

### Features and hooks

Features are the extension mechanism. A feature is a PHP class
with hook methods named after pipeline stages (e.g. `PrePoint`,
`PreSpec`). Each method receives the context.

The SDK ships with built-in features:

- **TestFeature**: Test transport

Features are initialized in order. Hooks fire in the order features
were added, so later features can override earlier ones.

### Data as arrays

The PHP SDK uses plain PHP associative arrays throughout rather than typed
objects. This mirrors the dynamic nature of the API and keeps the
SDK flexible — no code generation is needed when the API schema
changes.

Use `Helpers::to_map()` to safely validate that a value is an array.

### Directory structure

```
php/
├── searchapigoogle_sdk.php          -- Main SDK class
├── config.php                     -- Configuration
├── schema.php                     -- Generated option + entity specs
├── features.php                   -- Feature factory
├── core/                          -- Core types and context
├── entity/                        -- Entity implementations
├── feature/                       -- Built-in features (Base, Test, Log)
├── utility/                       -- Utility functions and struct library
└── test/                          -- Test suites
```

The main class (`searchapigoogle_sdk.php`) exports the SDK class
and test helper. Import entity or utility modules directly only
when needed.

### Entity state

Entity instances are stateful. After a successful `list`, the entity
stores the returned data and match criteria internally.

```php
$search = $client->Search();
$search->list();

// $search->data_get() now returns the search data from the last list
// $search->match_get() returns the last match criteria
```

Call `make()` to create a fresh instance with the same configuration
but no stored state.

### Direct vs entity access

The entity interface handles URL construction, parameter placement,
and response parsing automatically. Use it for standard CRUD operations.

`direct()` gives full control over the HTTP request. Use it for
non-standard endpoints, bulk operations, or any path not modelled as
an entity. `prepare()` builds the request without sending it — useful
for debugging or custom transport.


## Full Reference

See [REFERENCE.md](REFERENCE.md) for complete API reference
documentation including all method signatures, entity field schemas,
and detailed usage examples.
