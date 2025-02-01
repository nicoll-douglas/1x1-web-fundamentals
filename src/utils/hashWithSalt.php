<?php

declare(strict_types=1);

/**
 * Hashes a value with salt.
 * @param string $algo Name of selected hashing algorithm (i.e. "md5", "sha256", "haval160,4", etc..)
 * @param string $data Value to be hashed.
 * @param string $salt The salt to hash with.
 * @return string The hashed result.
 */
function hashWithSalt(string $ip, string $salt, string $algo = "sha256"): string
{
  return hash($algo, $ip . $salt);
}
