<?php

use App\Classes\View;

$view = new View();
$view->setTitle("Contact");
$view->startBuffering();
?>
<main>
  <h1>Contact</h1>
  <section>
    <h2>Email</h2>
    <p>
      Feel free to shoot me an email at the address down below, especially if you need help with anything I&apos;ve talked about in a tutorial or have any feedback.</p>
    <a href="mailto:me@nicolldouglas.dev">me@nicolldouglas.dev</a>
  </section>
  <section>
    <h2 id="leave-a-message-heading">Leave a Message</h2>
    <p>If you wish to leave a quick anonymous message.</p>
    <?php require_once __DIR__ . "/../../partials/messageForm.php"; ?>
  </section>
  <section>
    <h2>Contributing</h2>
    <p>If you wish to contribute to this project I&apos;ll leave a link to the GitHub repo down below.</p>
    <a href="https://github.com/nicoll-douglas/1x1-web-fundamentals" target="_blank">
      1x1 Web Fundamentals Repo
    </a>
  </section>
</main>
<?php
$view->stopBuffering();
