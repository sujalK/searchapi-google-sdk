<?php
declare(strict_types=1);

// Typed models for the SearchapiGoogle SDK.
//
// GENERATED from the API model: main.kit.entity.<e>.fields{} and per-op
// params (op.<name>.points[].g.params[]). Field/param types come from the
// canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
// @voxgig/apidef VALID_CANON). Do not edit by hand.
//
// These are documentation-grade value objects (PHP 8 typed properties),
// registered on the composer classmap autoload. The SDK boundary exchanges
// assoc-arrays; these classes name the shapes for tooling and typed callers.

/** Search entity data model. */
class Search
{
    public ?array $about_this_domain = null;
    public ?array $about_this_result = null;
    public ?array $ad_related_searches = null;
    public ?array $ads = null;
    public ?array $ai_overview = null;
    public mixed $answer_box = null;
    public ?array $courses = null;
    public ?array $discussions_and_forums = null;
    public ?array $dmca_messages = null;
    public ?string $error = null;
    public ?array $events = null;
    public ?array $explore_brands = null;
    public ?array $from_sources_across_the_web = null;
    public ?array $inline_images = null;
    public ?array $inline_recipes = null;
    public ?array $inline_shopping = null;
    public ?array $inline_shorts = null;
    public ?array $inline_tweets = null;
    public ?array $inline_videos = null;
    public ?array $jobs = null;
    public ?array $knowledge_graph = null;
    public ?array $latest_posts = null;
    public ?array $local_ads = null;
    public ?array $local_map = null;
    public ?array $local_news = null;
    public ?array $local_results = null;
    public ?array $nearby_events = null;
    public ?array $organic_results = null;
    public ?array $pagination = null;
    public ?array $perspectives = null;
    public ?array $popular_destinations = null;
    public ?array $questions_and_answers = null;
    public ?array $related_questions = null;
    public ?array $related_searches = null;
    public ?array $salary_estimates = null;
    public ?array $scholarly_articles = null;
    public ?array $search_information = null;
    public array $search_metadata;
    public ?array $search_parameters = null;
    public ?array $shopping_ads = null;
    public ?array $showtimes = null;
    public ?array $sponsored_tickets = null;
    public mixed $sports_results = null;
    public ?array $things_to_do = null;
    public ?array $top_stories = null;
    public ?array $train_results = null;
    public ?array $universities = null;
    public mixed $weather_result = null;
}

/** Request payload for Search#list. */
class SearchListMatch
{
    public string $api_key;
    public ?string $cr = null;
    public ?string $device = null;
    public string $engine;
    public ?string $filter = null;
    public ?string $gl = null;
    public ?string $hl = null;
    public ?string $kgmid = null;
    public ?float $latitude = null;
    public ?string $link = null;
    public ?string $location = null;
    public ?float $longitude = null;
    public ?string $lr = null;
    public ?string $nfpr = null;
    public ?string $optimization_strategy = null;
    public ?int $page = null;
    public ?string $q = null;
    public ?string $safe = null;
    public ?string $time_period = null;
    public ?string $time_period_max = null;
    public ?string $time_period_min = null;
    public ?string $uule = null;
    public ?string $verbatim = null;
}

