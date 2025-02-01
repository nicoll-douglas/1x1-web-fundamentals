<?php

declare(strict_types=1);

/**
 * Decoded the contents of the request body if it is JSON.
 * @return mixed The decoded JSON.
 */
function getJsonBody(): mixed
{
  $jsonBody = file_get_contents('php://input');
  if ($jsonBody === false) return null;
  return json_decode($jsonBody, true);
}
