<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
$data = $view->getData();
?>
<main>
  <h1>Sign In</h1>
  <section>
    <p>Authorize with one of the services below to sign in and save your progress:</p>
    <ul id="oauth-providers-list">
      <li>
        <a href="<?php echo $data["authUrl"]; ?>">
          Sign in with Google
        </a>
      </li>
    </ul>
  </section>
</main>