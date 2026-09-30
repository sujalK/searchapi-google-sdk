<?php
declare(strict_types=1);

// SearchapiGoogle SDK utility: result_body

class SearchapiGoogleResultBody
{
    public static function call(SearchapiGoogleContext $ctx): ?SearchapiGoogleResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result && $response && $response->json_func && $response->body) {
            $result->body = ($response->json_func)();
        }
        return $result;
    }
}
