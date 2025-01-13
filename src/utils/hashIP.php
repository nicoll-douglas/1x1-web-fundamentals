<?php

declare(strict_types=1);

/**
 * Hashes an IP address with SHA256
 * @param string $ip The ip address or any string to hash.
 * @param string $salt The salt to hash with.
 * @return string The hashed IP address.
 */
function hashIP(string $ip, string $salt): string
{
  return hash('sha256', $ip . $salt);
}
