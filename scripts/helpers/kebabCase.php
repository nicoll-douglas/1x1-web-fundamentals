<?php

/**
 * Kebab cases a string.
 * @param string $string The string to modify.
 * @return string The new kebab cased string.
 */
function kebabCase(string $string): string
{
  $parts = explode(" ", strtolower($string));
  return implode("-", $parts);
}
