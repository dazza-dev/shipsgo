<?php

namespace DazzaDev\ShipsGo;

use DazzaDev\ShipsGo\Traits\HttpClient;

class ShipsGo
{
    use HttpClient;

    public function __construct(string $authToken)
    {
        $this->setAuthToken($authToken);
        $this->setHeaders([
            'X-Shipsgo-User-Token' => $this->authToken,
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Format Filters
     */
    private function formatFilters(array $filters = []): array
    {
        $formatted = [];
        foreach ($filters as $key => $value) {
            $formatted['filters['.$key.']'] = $value;
        }

        return $formatted;
    }

    /**
     * Get Carriers
     */
    public function getCarriers(int $take = 10, int $skip = 0, array $filters = [], ?string $orderBy = null)
    {
        $response = $this->getClient()->get('ocean/carriers', [
            'headers' => $this->getHeaders(),
            'query' => [
                'order_by' => $orderBy,
                'skip' => $skip,
                'take' => $take,
                ...$this->formatFilters($filters),
            ],
        ]);

        return $response;
    }

    /**
     * Get Airlines
     */
    public function getAirlines(int $take = 10, int $skip = 0, array $filters = [], ?string $orderBy = null)
    {
        return $this->getClient()->get('air/airlines', [
            'headers' => $this->getHeaders(),
            'query' => [
                'order_by' => $orderBy,
                'skip' => $skip,
                'take' => $take,
                ...$this->formatFilters($filters),
            ],
        ]);
    }

    /**
     * Get Air Shipments
     */
    public function getShipments(string $type, int $take = 10, int $skip = 0, array $filters = [], ?string $orderBy = null)
    {
        return $this->getClient()->get($type.'/shipments', [
            'headers' => $this->getHeaders(),
            'query' => [
                'order_by' => $orderBy,
                'skip' => $skip,
                'take' => $take,
                ...$this->formatFilters($filters),
            ],
        ]);
    }

    /**
     * Get Shipment
     */
    public function getShipment(string $type, string $shipmentId)
    {
        return $this->getClient()->get($type.'/shipments/'.$shipmentId, [
            'headers' => $this->getHeaders(),
        ]);
    }

    /**
     * Create Shipment
     */
    public function createShipment(string $type, array $data)
    {
        return $this->getClient()->post($type.'/shipments', [
            'headers' => $this->getHeaders(),
            'json' => $data,
        ]);
    }

    /**
     * Update Shipment
     */
    public function updateShipment(string $type, string $shipmentId, array $data)
    {
        return $this->getClient()->patch($type.'/shipments/'.$shipmentId, [
            'headers' => $this->getHeaders(),
            'json' => $data,
        ]);
    }

    /**
     * Delete Shipment
     */
    public function deleteShipment(string $type, string $shipmentId)
    {
        return $this->getClient()->delete($type.'/shipments/'.$shipmentId, [
            'headers' => $this->getHeaders(),
        ]);
    }

    /**
     * Add Shipment Follower
     */
    public function addShipmentFollower(string $type, string $shipmentId, string $follower)
    {
        return $this->getClient()->post($type.'/shipments/'.$shipmentId.'/followers', [
            'headers' => $this->getHeaders(),
            'json' => ['follower' => $follower],
        ]);
    }

    /**
     * Delete Shipment Follower
     */
    public function deleteShipmentFollower(string $type, string $shipmentId, int $followerId)
    {
        return $this->getClient()->delete($type.'/shipments/'.$shipmentId.'/followers/'.$followerId, [
            'headers' => $this->getHeaders(),
        ]);
    }

    /**
     * Add Shipment Tag
     */
    public function addShipmentTag(string $type, string $shipmentId, string $tag)
    {
        return $this->getClient()->post($type.'/shipments/'.$shipmentId.'/tags', [
            'headers' => $this->getHeaders(),
            'json' => ['tag' => $tag],
        ]);
    }

    /**
     * Delete Shipment Tag
     */
    public function deleteShipmentTag(string $type, string $shipmentId, int $tagId)
    {
        return $this->getClient()->delete($type.'/shipments/'.$shipmentId.'/tags/'.$tagId, [
            'headers' => $this->getHeaders(),
        ]);
    }
}
