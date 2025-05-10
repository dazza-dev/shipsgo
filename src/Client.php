<?php

namespace DazzaDev\ShipsGo;

use DazzaDev\ShipsGo\Enums\Environment;
use DazzaDev\ShipsGo\Exceptions\ShipsGoException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

class Client
{
    public GuzzleClient $client;

    protected Environment $environment;

    /**
     * Get Client.
     */
    public function getClient(): GuzzleClient
    {
        // Validate Environment
        if (! $this->environment instanceof Environment) {
            throw new \InvalidArgumentException('Invalid environment provided');
        }

        // Set Client
        $this->client = new GuzzleClient([
            'base_uri' => $this->getBaseUrl(),
        ]);

        return $this->client;
    }

    /**
     * Get Base Url.
     */
    public function getBaseUrl(): string
    {
        return $this->environment->baseUrl();
    }

    /**
     * Get the environment.
     */
    public function getEnvironment(): Environment
    {
        return $this->environment;
    }

    /**
     * Set the environment.
     */
    public function setEnvironment(bool $testing = false): void
    {
        $this->environment = $testing ? Environment::Testing : Environment::Production;
    }

    /**
     * Handle Exception.
     */
    protected function handleException(RequestException $e): array
    {
        $response = $e->getResponse();

        $body = $response ? (string) $response->getBody() : null;

        return $this->tryParseJson($body);
    }

    /**
     * Try Parse Json.
     */
    private function tryParseJson(?string $body): mixed
    {
        if (! $body) {
            return null;
        }

        $json = json_decode($body, true);

        return json_last_error() === JSON_ERROR_NONE ? $json : $body;
    }

    /**
     * Make HTTP Request.
     */
    private function makeRequest(string $method, string $url, array $options = []): array
    {
        try {
            $response = $this->getClient()->{$method}($url, $options);

            if ($response->getStatusCode() !== 200) {
                throw new ShipsGoException('Failed to '.$method.' '.$url);
            }

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Get Request.
     */
    public function get(string $url, array $options = []): array
    {
        return $this->makeRequest('get', $url, $options);
    }

    /**
     * Post Request.
     */
    public function post(string $url, array $options = []): array
    {
        return $this->makeRequest('post', $url, $options);
    }

    /**
     * Patch Request.
     */
    public function patch(string $url, array $options = []): array
    {
        return $this->makeRequest('patch', $url, $options);
    }

    /**
     * Delete Request.
     */
    public function delete(string $url, array $options = []): array
    {
        return $this->makeRequest('delete', $url, $options);
    }
}
