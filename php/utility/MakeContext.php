<?php
declare(strict_types=1);

// SearchapiGoogle SDK utility: make_context

require_once __DIR__ . '/../core/Context.php';

class SearchapiGoogleMakeContext
{
    public static function call(array $ctxmap, ?SearchapiGoogleContext $basectx): SearchapiGoogleContext
    {
        return new SearchapiGoogleContext($ctxmap, $basectx);
    }
}
