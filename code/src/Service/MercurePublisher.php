<?php
namespace App\Service;

use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;

class MercurePublisher
{
private $publisher;

public function __construct(PublisherInterface $publisher)
{
$this->publisher = $publisher;
}

public function publishMessage($topic, $data)
{
$update = new Update(
$topic,  // This will be the Mercure topic (e.g., conversation ID)
json_encode($data)  // Data you want to send in the message
);

$this->publisher->publish($update);
}
}
