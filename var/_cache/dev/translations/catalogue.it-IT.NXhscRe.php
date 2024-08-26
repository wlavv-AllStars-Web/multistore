<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('it-IT', array (
));

$catalogueIt = new MessageCatalogue('it', array (
));
$catalogue->addFallbackCatalogue($catalogueIt);

return $catalogue;
