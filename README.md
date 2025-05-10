# ShipsGo API

ShipsGo API Client.

## Install

```bash
composer require dazza-dev/shipsgo
```

## Instance Client

```php
use DazzaDev\ShipsGo\ShipsGo;

$client = new ShipsGo($accessToken);
$client->isTesting(true);
```

## Get Carriers (Ocean)

```php
$carriers = $client->getCarriers();
```

## Get Airlines

```php
$airlines = $client->getAirlines();
```

## Get Shipments

```php
$shipments = $client->getShipments(
  type: 'air or ocean',
  take: 10,
  skip: 0,
  filters: [
    'tags' => 'with:filtertag',
    'status' => 'eq:ARRIVED'
  ]
);
```

## Get Shipment

```php
$shipmentId = '123456';
$shipment = $client->getShipment(
  type: 'air or ocean',
  shipmentId: $shipmentId
);
```

## Create Shipment

```php
$shipment = $client->createShipment(
  type: 'air or ocean',
  data: [
    'reference' => '<string>',
    'container_number' => '<string>',
    'booking_number' => '<string>',
    'carrier' => '<string>',
    'followers' => [
      '<string>',
      '<string>'
    ],
    'tags' => [
      '<string>',
      '<string>'
    ]
  ]
);
```

## Update Shipment

```php
$shipmentId = '123456';
$shipment = $client->updateShipment(
  type: 'air or ocean',
  shipmentId: $shipmentId,
  data: [
    'reference' => '<string>',
  ]
);
```

## Delete Shipment

```php
$shipmentId = '123456';
$shipment = $client->deleteShipment(
  type: 'air or ocean',
  shipmentId: $shipmentId,
);
```

## Add Shipment Follower

```php
$shipmentId = '123456';
$shipment = $client->addShipmentFollower(
  type: 'air or ocean',
  shipmentId: $shipmentId,
  follower: 'email@follower.com'
);
```

## Delete Shipment Follower

```php
$shipmentId = '123456';
$shipment = $client->deleteShipmentFollower(
  type: 'air or ocean',
  shipmentId: $shipmentId,
  followerId: 1234
);
```

## Add Shipment Tag

```php
$shipmentId = '123456';
$shipment = $client->addShipmentTag(
  type: 'air or ocean',
  shipmentId: $shipmentId,
  tag: 'test tag'
);
```

## Delete Shipment Tag

```php
$shipmentId = '123456';
$shipment = $client->deleteShipmentTag(
  type: 'air or ocean',
  shipmentId: $shipmentId,
  tagId: 1234
);
```

## Contributions

Contributions are welcome. If you find any errors or have ideas for improvements, please open an issue or submit a pull request. Make sure to follow the contribution guidelines.

## Author

ShipsGo API Client was created by [DAZZA](https://github.com/dazza-dev).

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
