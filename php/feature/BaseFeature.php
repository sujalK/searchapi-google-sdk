<?php
declare(strict_types=1);

// SearchapiGoogle SDK base feature

class SearchapiGoogleBaseFeature
{
    public string $version;
    public string $name;
    public bool $active;

    // Positions this feature when added via the client `extend` option:
    // "__before__" / "__after__" / "__replace__" name an already-added
    // feature (mirrors the ts feature `_options`). Declared so setting it
    // on an extension instance avoids the dynamic-property deprecation.
    public ?array $_options = null;

    public function __construct()
    {
        $this->version = '0.0.1';
        $this->name = 'base';
        $this->active = true;
    }

    public function get_version(): string { return $this->version; }
    public function get_name(): string { return $this->name; }
    public function get_active(): bool { return $this->active; }

    public function init(SearchapiGoogleContext $ctx, array $options): void {}
    public function PostConstruct(SearchapiGoogleContext $ctx): void {}
    public function PostConstructEntity(SearchapiGoogleContext $ctx): void {}
    public function SetData(SearchapiGoogleContext $ctx): void {}
    public function GetData(SearchapiGoogleContext $ctx): void {}
    public function GetMatch(SearchapiGoogleContext $ctx): void {}
    public function SetMatch(SearchapiGoogleContext $ctx): void {}
    public function PrePoint(SearchapiGoogleContext $ctx): void {}
    public function PreSpec(SearchapiGoogleContext $ctx): void {}
    public function PreRequest(SearchapiGoogleContext $ctx): void {}
    public function PreResponse(SearchapiGoogleContext $ctx): void {}
    public function PreResult(SearchapiGoogleContext $ctx): void {}
    public function PreDone(SearchapiGoogleContext $ctx): void {}
    public function PreUnexpected(SearchapiGoogleContext $ctx): void {}
}
