<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('es-ES', array (
));

$catalogueEs = new MessageCatalogue('es', array (
));
$catalogue->addFallbackCatalogue($catalogueEs);

return $catalogue;
