<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;
use PHPUnit\Framework\TestCase;
use SalvaWorld\Envoyer\Envoyer;
use SalvaWorld\Envoyer\Exceptions\FailedActionException;
use SalvaWorld\Envoyer\Exceptions\NotFoundException;
use SalvaWorld\Envoyer\Exceptions\RateLimitExceededException;
use SalvaWorld\Envoyer\Exceptions\TimeoutException;
use SalvaWorld\Envoyer\Exceptions\ValidationException;
use SalvaWorld\Envoyer\MakesHttpRequests;

class EnvoyerSDKTest extends TestCase {
    protected function tearDown(): void {
        Mockery::close();
    }

    public function test_making_basic_requests() {
        $envoyer = new Envoyer('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('GET', 'projects', [])->andReturn(
            new Response(200, [], '{"projects": [{"key": "value"}]}')
        );

        $this->assertCount(1, $envoyer->projects());
    }

    // public function test_update_site() {
    //     $envoyer = new Envoyer('123', $http = Mockery::mock(Client::class));

    //     $http->shouldReceive('request')->once()->with('PUT', 'servers/123/sites/456', [
    //         'json' => ['aliases' => ['foo.com']],
    //     ])->andReturn(
    //         new Response(200, [], '{"site": {"aliases": ["foo.com"]}}')
    //     );

    //     $this->assertSame(['foo.com'], $envoyer->updateSite('123', '456', [
    //         'aliases' => ['foo.com'],
    //     ])->aliases);
    // }

    public function test_handling_validation_errors() {
        $envoyer = new Envoyer('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('GET', 'projects', [])->andReturn(
            new Response(422, [], '{"name": ["The name is required."]}')
        );

        try {
            $envoyer->projects();
        } catch (ValidationException $e) {
        }

        $this->assertEquals(['name' => ['The name is required.']], $e->errors());
    }

    public function test_handling_404_errors() {
        $this->expectException(NotFoundException::class);

        $envoyer = new Envoyer('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('GET', 'projects', [])->andReturn(
            new Response(404)
        );

        $envoyer->projects();
    }

    public function test_handling_failed_action_errors() {
        $envoyer = new Envoyer('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('GET', 'projects', [])->andReturn(
            new Response(400, [], 'Error!')
        );

        try {
            $envoyer->projects();
        } catch (FailedActionException $e) {
            $this->assertSame('Error!', $e->getMessage());
        }
    }

    public function testRetryHandlesFalseResultFromClosure() {
        $requestMaker = new class() {
            use MakesHttpRequests;
        };

        try {
            $requestMaker->retry(0, function () {
                return false;
            }, 0);
            $this->fail();
        } catch (TimeoutException $e) {
            $this->assertSame([], $e->output());
        }
    }

    public function testRetryHandlesNullResultFromClosure() {
        $requestMaker = new class() {
            use MakesHttpRequests;
        };

        try {
            $requestMaker->retry(0, function () {
                return null;
            }, 0);
            $this->fail();
        } catch (TimeoutException $e) {
            $this->assertSame([], $e->output());
        }
    }

    public function testRetryHandlesFalseyStringResultFromClosure() {
        $requestMaker = new class() {
            use MakesHttpRequests;
        };

        try {
            $requestMaker->retry(0, function () {
                return '';
            }, 0);
            $this->fail();
        } catch (TimeoutException $e) {
            $this->assertSame([''], $e->output());
        }
    }

    public function testRetryHandlesFalseyNumerResultFromClosure() {
        $requestMaker = new class() {
            use MakesHttpRequests;
        };

        try {
            $requestMaker->retry(0, function () {
                return 0;
            }, 0);
            $this->fail();
        } catch (TimeoutException $e) {
            $this->assertSame([0], $e->output());
        }
    }

    public function testRetryHandlesFalseyArrayResultFromClosure() {
        $requestMaker = new class() {
            use MakesHttpRequests;
        };

        try {
            $requestMaker->retry(0, function () {
                return [];
            }, 0);
            $this->fail();
        } catch (TimeoutException $e) {
            $this->assertSame([], $e->output());
        }
    }

    public function testRateLimitExceededWithHeaderSet() {
        $envoyer = new Envoyer('123', $http = Mockery::mock(Client::class));

        $timestamp = strtotime(date('Y-m-d H:i:s'));

        $http->shouldReceive('request')->once()->with('GET', 'projects', [])->andReturn(
            new Response(429, [
                'x-ratelimit-reset' => $timestamp,
            ], 'Too Many Attempts.')
        );

        try {
            $envoyer->projects();
        } catch (RateLimitExceededException $e) {
            $this->assertSame($timestamp, $e->rateLimitResetsAt);
        }
    }

    public function testRateLimitExceededWithHeaderNotAvailable() {
        $envoyer = new Envoyer('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('GET', 'projects', [])->andReturn(
            new Response(429, [], 'Too Many Attempts.')
        );

        try {
            $envoyer->projects();
        } catch (RateLimitExceededException $e) {
            $this->assertNull($e->rateLimitResetsAt);
        }
    }
}
