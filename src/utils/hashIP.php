<?php

declare(strict_types=1);

function hashIP(string $ip, string $salt): string
{
  return hash('sha256', $ip . $salt);
}
