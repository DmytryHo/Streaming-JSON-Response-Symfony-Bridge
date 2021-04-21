<?php

declare(strict_types=1);

namespace DmytryHo\JsonStreamedResponse\Factory;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Violet\StreamingJsonEncoder\BufferJsonEncoder;
use iterable;

class JsonStreamedResponseFactory implements JsonStreamedResponseFactoryInterface
{
    public function createJsonStreamedResponse(iterable $iterableResponse): StreamedResponse
    {
        $response = new StreamedResponse(
            function () use ($iterableResponse) {
                $jsonPortionGenerator = new BufferJsonEncoder(function () use ($iterableResponse) {
                    foreach ($iterableResponse as $key => $value) {
                        yield $key => $value;
                    }
                });
                foreach ($jsonPortionGenerator as $jsonPortion) {
                    echo $jsonPortion;
                }
            }
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
