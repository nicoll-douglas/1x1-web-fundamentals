<?php

use App\Middleware\Auth;

/**
 * The currently authentication status of the user.
 * @var false|array False if the user is not authenticated, the user's row in the DB otherwise.
 */
define("USER", Auth::verify());
/**
 * The nonce (number once) string used by the content security policy.
 */
define("NONCE", bin2hex(random_bytes(16)));
