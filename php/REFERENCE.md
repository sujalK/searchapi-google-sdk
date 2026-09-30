# SearchapiGoogle PHP SDK Reference

Complete API reference for the SearchapiGoogle PHP SDK.


## SearchapiGoogleSDK

### Constructor

```php
require_once __DIR__ . '/searchapigoogle_sdk.php';

$client = new SearchapiGoogleSDK($options);
```

Create a new SDK client instance.

**Parameters:**

| Name | Type | Description |
| --- | --- | --- |
| `$options` | `array` | SDK configuration options. |
| `$options["base"]` | `string` | Base URL for API requests. |
| `$options["prefix"]` | `string` | URL prefix appended after base. |
| `$options["suffix"]` | `string` | URL suffix appended after path. |
| `$options["headers"]` | `array` | Custom headers for all requests. |
| `$options["feature"]` | `array` | Feature configuration. |
| `$options["system"]` | `array` | System overrides (e.g. custom fetch). |


### Static Methods

#### `SearchapiGoogleSDK::test($testopts = null, $sdkopts = null)`

Create a test client with mock features active. Both arguments may be `null`.

```php
$client = SearchapiGoogleSDK::test();
```


### Instance Methods

#### `Search($data = null)`

Create a new `SearchEntity` instance. Pass `null` for no initial data.

#### `options_map(): array`

Return a deep copy of the current SDK options.

#### `get_utility(): SearchapiGoogleUtility`

Return a copy of the SDK utility object.

#### `direct(array $fetchargs = []): array`

Make a direct HTTP request to any API endpoint. This is the raw-HTTP escape
hatch: it does **not** throw. It returns a result array
`["ok" => bool, "status" => int, "headers" => array, "data" => mixed]`, or
`["ok" => false, "err" => \Exception]` on failure. Branch on `$result["ok"]`.

**Parameters:**

| Name | Type | Description |
| --- | --- | --- |
| `$fetchargs["path"]` | `string` | URL path with optional `{param}` placeholders. |
| `$fetchargs["method"]` | `string` | HTTP method (default: `"GET"`). |
| `$fetchargs["params"]` | `array` | Path parameter values for `{param}` substitution. |
| `$fetchargs["query"]` | `array` | Query string parameters. |
| `$fetchargs["headers"]` | `array` | Request headers (merged with defaults). |
| `$fetchargs["body"]` | `mixed` | Request body (arrays are JSON-serialized). |
| `$fetchargs["ctrl"]` | `array` | Control options. |

**Returns:** `array` — the result dict (see above); never throws.

#### `prepare(array $fetchargs = []): mixed`

Prepare a fetch definition without sending the request. Returns the
`$fetchdef` array. Throws on error.


---

## SearchEntity

```php
$search = $client->Search();
```

### Fields

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `about_this_domain` | `array` | No | Inline 'About this domain' card shown for entity-style queries, with a brief overview and reference links to sources. |
| `about_this_result` | `array` | No | About this result information |
| `ad_related_searches` | `array` | No |  |
| `ads` | `array` | No |  |
| `ai_overview` | `array` | No |  |
| `answer_box` | `mixed` | No |  |
| `courses` | `array` | No |  |
| `discussions_and_forums` | `array` | No |  |
| `dmca_messages` | `array` | No |  |
| `error` | `string` | No | Error message when the page has no results, e.g. |
| `events` | `array` | No |  |
| `explore_brands` | `array` | No |  |
| `from_sources_across_the_web` | `array` | No |  |
| `inline_images` | `array` | No |  |
| `inline_recipes` | `array` | No |  |
| `inline_shopping` | `array` | No |  |
| `inline_shorts` | `array` | No | Array of inline short video results |
| `inline_tweets` | `array` | No |  |
| `inline_videos` | `array` | No | Array of inline video results |
| `jobs` | `array` | No |  |
| `knowledge_graph` | `array` | No |  |
| `latest_posts` | `array` | No |  |
| `local_ads` | `array` | No |  |
| `local_map` | `array` | No |  |
| `local_news` | `array` | No |  |
| `local_results` | `array` | No |  |
| `nearby_events` | `array` | No |  |
| `organic_results` | `array` | No |  |
| `pagination` | `array` | No |  |
| `perspectives` | `array` | No |  |
| `popular_destinations` | `array` | No |  |
| `questions_and_answers` | `array` | No |  |
| `related_questions` | `array` | No |  |
| `related_searches` | `array` | No |  |
| `salary_estimates` | `array` | No |  |
| `scholarly_articles` | `array` | No |  |
| `search_information` | `array` | No |  |
| `search_metadata` | `array` | Yes |  |
| `search_parameters` | `array` | No |  |
| `shopping_ads` | `array` | No |  |
| `showtimes` | `array` | No |  |
| `sponsored_tickets` | `array` | No | Sponsored tickets and tours results |
| `sports_results` | `mixed` | No |  |
| `things_to_do` | `array` | No |  |
| `top_stories` | `array` | No |  |
| `train_results` | `array` | No | Train itinerary widget for route queries. |
| `universities` | `array` | No |  |
| `weather_result` | `mixed` | No |  |

### Operations

#### `list(?array $reqmatch = null, ?array $ctrl = null): mixed`

List entities matching the given criteria (call with no argument to list all). Returns an array. Throws on error.

```php
$results = $client->Search()->list();
```

### Common Methods

#### `data_get(): array`

Get the entity data. Returns a copy of the current data.

#### `data_set($data): void`

Set the entity data.

#### `match_get(): array`

Get the entity match criteria.

#### `match_set($match): void`

Set the entity match criteria.

#### `make(): SearchEntity`

Create a new `SearchEntity` instance with the same client and
options.

#### `get_name(): string`

Return the entity name.


---

## Features

| Feature | Version | Description |
| --- | --- | --- |
| `test` | 0.0.1 | Test transport |


Features are activated via the `feature` option:

```php
$client = new SearchapiGoogleSDK([
  "feature" => [
    "test" => ["active" => true],
  ],
]);
```


### Configuring features

Each feature is inactive until switched on, and an SDK with no feature
configured does no feature work at all. Every option below keeps its default
unless you name it.

The array form of \`feature\` is significant: several features wrap the
transport, and the order you list them in is the order they nest.

#### `test`

Test transport.

**Configuration**

| Option | Default |
|---|---|
| `active` | `false` |

| Option | Type |
|---|---|
| `entity` | map |
| `net` | map |

These take no default: the feature behaves one way when you supply them and
another when you do not.

**Usage**

Set `feature.test.active` to true in the client options, and override any option above in the same entry. Every option keeps
its default unless you name it.

**Considerations**

- Attaches to pipeline hooks, not the transport, so activation order does
  not change what it observes.
- Installs the BASE transport that the wrapping features wrap, so it must be
  activated before them.
- Inactive by default: leaving it out costs nothing at runtime.

