<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
$data = $view->getData();
?>

<footer>
  <section>
    <h3 id="links-heading">Links</h3>
    <ul aria-labelledby="links-heading">
      <?php
      require_once __DIR__ . "/../data/nav.php";
      ?>
      <?php foreach ($nav as [$text, $href]): ?>
        <li>
          <a
            class="<?php echo $href === "/tutorials" ? "link-highlight" : "" ?>"
            href="<?php echo $href; ?>"><?php echo $text; ?></a>
        </li>
      <?php endforeach; ?>

      <li>
        <?php if ($data["user"]): ?>
          <a href="/api/me/logout">Logout</a>
        <?php else: ?>
          <a href="/auth/sign-in">Sign In</a>
        <?php endif; ?>
      </li>
    </ul>
  </section>
  <?php if ($data["user"]): ?>
    <section>
      <h3>Auth</h3>
      <p>You are signed in as <?php echo $data["user"]["name"]; ?>.</p>
      <h4 class="footer-extra-space">Actions</h4>
      <ul>
        <li>
          <a href="/api/me/logout">Logout</a>
        </li>
        <li>
          <a href="/auth/delete-data">Delete my data</a>
        </li>
      </ul>
    </section>
  <?php endif; ?>
  <?php if ($view->getTitle() !== "Contact"): ?>
    <section>
      <h3>Contact</h3>
      <div>
        <h4>Email</h4>
        <a href="mailto:me@nicolldouglas.dev">
          me@nicolldouglas.dev
        </a>
        <h4 class="footer-extra-space">Leave a Message</h4>
        <?php require_once __DIR__ . "/messageForm.php"; ?>
      </div>
    </section>
  <?php endif; ?>
</footer>