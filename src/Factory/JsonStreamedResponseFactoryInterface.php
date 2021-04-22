<?php

declare(strict_types=1);

namespace DmytryHo\JsonStreamedResponse\Factory;

use Symfony\Component\HttpFoundation\StreamedResponse;

interface JsonStreamedResponseFactoryInterface
{
    public function createJsonStreamedResponse(iterable $iterableResponse): StreamedResponse;
}
