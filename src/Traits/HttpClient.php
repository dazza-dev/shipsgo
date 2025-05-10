<?php

namespace DazzaDev\ShipsGo\Traits;

use DazzaDev\ShipsGo\Client;

trait HttpClient
{
    public Client $client;

    private bool $testing = false;

    private string $authToken;

    private array $headers = [];

    /**
     * Set Testing environment.
     */
    public function isTesting(bool $testing)
    {
        $this->testing = $testing;
    }

    /**
     * Get Client.
     */
    public function getClient(): Client
    {
        $client = new Client;
        $client->setEnvironment($this->testing);
        $this->client = $client;

        return $this->client;
    }

    /**
     * Get Headers.
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set Headers.
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Get Auth Token.
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * Set Auth Token.
     */
    public function setAuthToken(string $authToken): void
    {
        $this->authToken = $authToken;
    }
}
