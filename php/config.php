<?php
declare(strict_types=1);

// SearchapiGoogle SDK configuration

class SearchapiGoogleConfig
{
    /** @var array<string,mixed>|null */
    private static ?array $shared_config = null;

    /**
     * Return the process-wide config, built once on first use. The SDK reads
     * the config on every request and never writes to it, so one instance is
     * shared by every client rather than rebuilt per client.
     *
     * PHP arrays are copy-on-write, so callers that do mutate the result get
     * their own copy and cannot disturb the shared one.
     */
    public static function shared_config(): array
    {
        if (self::$shared_config === null) {
            self::$shared_config = self::make_config();
        }
        return self::$shared_config;
    }

    /**
     * Build a fresh, fully materialised config array. Every call rebuilds the
     * whole structure, so prefer shared_config unless you need a private copy.
     */
    public static function make_config(): array
    {
        return [
            "main" => [
                "name" => "SearchapiGoogle",
                "slug" => "searchapi-google",
                "version" => "0.0.1",
                "target" => "php",
            ],
            "feature" => [
                "test" => [
          'options' => [
            'active' => false,
          ],
          'optspec' => [
            'entity' => '`$MAP`',
            'net' => '`$MAP`',
          ],
          'strict' => false,
          'transport' => 'base',
        ],
            ],
            "options" => [
                "base" => "https://www.searchapi.io/api/v1",
                "headers" => [
          'content-type' => 'application/json',
        ],
                "entity" => [
                    "search" => [],
                ],
            ],
            "entity" => [
        'search' => [
          'fields' => [
            [
              'name' => 'about_this_domain',
              'title' => 'About This Domain',
              'type' => '`$OBJECT`',
              'short' => 'Inline \'About this domain\' card shown for entity-style queries, with a brief overview and reference links to sources.',
            ],
            [
              'name' => 'about_this_result',
              'title' => 'About This Result',
              'type' => '`$ARRAY`',
              'short' => 'About this result information',
            ],
            [
              'name' => 'ad_related_searches',
              'title' => 'Ad Related Searches',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'ads',
              'title' => 'Ads',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'ai_overview',
              'title' => 'Ai Overview',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'answer_box',
              'title' => 'Answer Box',
              'type' => '`$ANY`',
            ],
            [
              'name' => 'courses',
              'title' => 'Courses',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'discussions_and_forums',
              'title' => 'Discussions And Forums',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'dmca_messages',
              'title' => 'Dmca Messages',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'error',
              'title' => 'Error',
              'type' => '`$STRING`',
              'short' => 'Error message when the page has no results, e.g.',
            ],
            [
              'name' => 'events',
              'title' => 'Events',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'explore_brands',
              'title' => 'Explore Brands',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'from_sources_across_the_web',
              'title' => 'From Sources Across The Web',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'inline_images',
              'title' => 'Inline Images',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'inline_recipes',
              'title' => 'Inline Recipes',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'inline_shopping',
              'title' => 'Inline Shopping',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'inline_shorts',
              'title' => 'Inline Shorts',
              'type' => '`$ARRAY`',
              'short' => 'Array of inline short video results',
            ],
            [
              'name' => 'inline_tweets',
              'title' => 'Inline Tweets',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'inline_videos',
              'title' => 'Inline Videos',
              'type' => '`$ARRAY`',
              'short' => 'Array of inline video results',
            ],
            [
              'name' => 'jobs',
              'title' => 'Jobs',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'knowledge_graph',
              'title' => 'Knowledge Graph',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'latest_posts',
              'title' => 'Latest Posts',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'local_ads',
              'title' => 'Local Ads',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'local_map',
              'title' => 'Local Map',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'local_news',
              'title' => 'Local News',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'local_results',
              'title' => 'Local Results',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'nearby_events',
              'title' => 'Nearby Events',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'organic_results',
              'title' => 'Organic Results',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'pagination',
              'title' => 'Pagination',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'perspectives',
              'title' => 'Perspectives',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'popular_destinations',
              'title' => 'Popular Destinations',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'questions_and_answers',
              'title' => 'Questions And Answers',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'related_questions',
              'title' => 'Related Questions',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'related_searches',
              'title' => 'Related Searches',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'salary_estimates',
              'title' => 'Salary Estimates',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'scholarly_articles',
              'title' => 'Scholarly Articles',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'search_information',
              'title' => 'Search Information',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'search_metadata',
              'title' => 'Search Metadata',
              'type' => '`$OBJECT`',
              'req' => true,
            ],
            [
              'name' => 'search_parameters',
              'title' => 'Search Parameters',
              'type' => '`$OBJECT`',
            ],
            [
              'name' => 'shopping_ads',
              'title' => 'Shopping Ads',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'showtimes',
              'title' => 'Showtimes',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'sponsored_tickets',
              'title' => 'Sponsored Tickets',
              'type' => '`$ARRAY`',
              'short' => 'Sponsored tickets and tours results',
            ],
            [
              'name' => 'sports_results',
              'title' => 'Sports Results',
              'type' => '`$ANY`',
            ],
            [
              'name' => 'things_to_do',
              'title' => 'Things To Do',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'top_stories',
              'title' => 'Top Stories',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'train_results',
              'title' => 'Train Results',
              'type' => '`$OBJECT`',
              'short' => 'Train itinerary widget for route queries.',
            ],
            [
              'name' => 'universities',
              'title' => 'Universities',
              'type' => '`$ARRAY`',
            ],
            [
              'name' => 'weather_result',
              'title' => 'Weather Result',
              'type' => '`$ANY`',
            ],
          ],
          'name' => 'search',
          'op' => [
            'list' => [
              'input' => 'data',
              'name' => 'list',
              'points' => [
                [
                  'kind' => 'http',
                  'method' => 'GET',
                  'orig' => '/search',
                  'segments' => [
                    [
                      'lit' => 'search',
                    ],
                  ],
                  'parts' => [
                    'search',
                  ],
                  'rename' => [],
                  'transform' => [
                    'req' => '`reqdata`',
                    'res' => '`body`',
                  ],
                  'args' => [
                    'query' => [
                      [
                        'name' => 'api_key',
                        'orig' => 'api_key',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'reqd' => true,
                      ],
                      [
                        'name' => 'cr',
                        'orig' => 'cr',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'device',
                        'orig' => 'device',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'example' => 'desktop',
                      ],
                      [
                        'name' => 'engine',
                        'orig' => 'engine',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'reqd' => true,
                      ],
                      [
                        'name' => 'filter',
                        'orig' => 'filter',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'example' => '1',
                      ],
                      [
                        'name' => 'gl',
                        'orig' => 'gl',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'hl',
                        'orig' => 'hl',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'example' => 'en',
                      ],
                      [
                        'name' => 'kgmid',
                        'orig' => 'kgmid',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'latitude',
                        'orig' => 'latitude',
                        'type' => '`$NUMBER`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'link',
                        'orig' => 'link',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'example' => 'raw',
                      ],
                      [
                        'name' => 'location',
                        'orig' => 'location',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'longitude',
                        'orig' => 'longitude',
                        'type' => '`$NUMBER`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'lr',
                        'orig' => 'lr',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'example' => 'lang_en|lang_de',
                      ],
                      [
                        'name' => 'nfpr',
                        'orig' => 'nfpr',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'example' => '0',
                      ],
                      [
                        'name' => 'optimization_strategy',
                        'orig' => 'optimization_strategy',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'example' => 'performance',
                      ],
                      [
                        'name' => 'page',
                        'orig' => 'page',
                        'type' => '`$INTEGER`',
                        'kind' => 'query',
                        'example' => 1,
                      ],
                      [
                        'name' => 'q',
                        'orig' => 'q',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'safe',
                        'orig' => 'safe',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                        'example' => 'blur',
                      ],
                      [
                        'name' => 'time_period',
                        'orig' => 'time_period',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'time_period_max',
                        'orig' => 'time_period_max',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'time_period_min',
                        'orig' => 'time_period_min',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'uule',
                        'orig' => 'uule',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                      [
                        'name' => 'verbatim',
                        'orig' => 'verbatim',
                        'type' => '`$STRING`',
                        'kind' => 'query',
                      ],
                    ],
                  ],
                  'select' => [
                    'exist' => [
                      'api_key',
                      'cr',
                      'device',
                      'engine',
                      'filter',
                      'gl',
                      'hl',
                      'kgmid',
                      'latitude',
                      'link',
                      'location',
                      'longitude',
                      'lr',
                      'nfpr',
                      'optimization_strategy',
                      'page',
                      'q',
                      'safe',
                      'time_period',
                      'time_period_max',
                      'time_period_min',
                      'uule',
                      'verbatim',
                    ],
                  ],
                ],
              ],
            ],
          ],
          'relations' => [
            'ancestors' => [],
          ],
        ],
      ],
        ];
    }


    public static function make_feature(string $name)
    {
        require_once __DIR__ . '/features.php';
        return SearchapiGoogleFeatures::make_feature($name);
    }
}
