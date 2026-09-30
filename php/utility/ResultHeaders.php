<?php
declare(strict_types=1);

// SearchapiGoogle SDK utility: result_headers

class SearchapiGoogleResultHeaders
{
    public static function call(SearchapiGoogleContext $ctx): ?SearchapiGoogleResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result) {
            if ($response && is_array($response->headers)) {
                $result->headers = $response->headers;
            } else {
                $result->headers = [];
            }
        }
        return $result;
    }
}
