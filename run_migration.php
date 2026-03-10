<?php
chdir(__DIR__ . '/symfony-app');
passthru('php bin/console doctrine:migrations:migrate --no-interaction');
