<?php
declare(strict_types=1);

// SearchapiGoogle SDK exists test

require_once __DIR__ . '/../searchapigoogle_sdk.php';

use PHPUnit\Framework\TestCase;

class ExistsTest extends TestCase
{
    public function test_create_test_sdk(): void
    {
        $testsdk = SearchapiGoogleSDK::test(null, null);
        $this->assertNotNull($testsdk);
    }
}
