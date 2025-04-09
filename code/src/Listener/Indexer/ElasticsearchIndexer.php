<?php

// src/Listener/Indexer/ElasticsearchIndexer.php

declare(strict_types=1);

namespace App\Listener\Indexer;

use Doctrine\ORM\Event\PostRemoveEventArgs;
use Doctrine\ORM\Events;

// #[AsDoctrineListener(event: Events::postRemove)]  // Listener is commented out
class ElasticsearchIndexer
{
    // The method is commented out as well
    /*
    public function index(PostRemoveEventArgs $event): void
    {
        $object = $event->getObject();  // Entity to be deleted
        $manager = $event->getObjectManager(); // Object manager

        // Check if the object is an instance of a specific class
        // if ($object instanceof Blog::class)
    }
    */
}
