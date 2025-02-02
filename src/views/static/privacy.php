<?php

use App\Classes\View;

$view = new View();
$view->setTitle("Privacy");
?>

<?php $view->startBuffering(); ?>

<main>
  <h1>Privacy</h1>
  <p>I do not sell your data or collect analytics. Below is a quick rundown of how your data is used for the site to function.</p>
  <section>
    <h2>What&apos;s Collected</h2>
    <p>
      When you sign in using OAuth (Google, etc.), your name and account ID are used to help you set up your account.
    </p>
    <p>Your IP address is also hashed and stored to maintain the security of your session.</p>
  </section>
  <section>
    <h2>More Specifically</h2>
    <p>Your data is used to help you:</p>
    <ul>
      <li>Log in to the site.</li>
      <li>Stay logged into the site with a session.</li>
      <li>Make sure you and only you are the one accessing your account.</li>
      <li>Personalise your experience (showing your name).</li>
      <li>Save your progress on the tutorials.</li>
    </ul>
  </section>
  <section>
    <h2>Your Control</h2>
    <?php
    $p = "You can revoke access to your information any time by managing app permissions in your Google account settings";
    ?>
    <?php if (USER): ?>
      <p><?php echo $p . "."; ?></p>
      <p>You can also click the link below to purge all your data.</p>
      <a href="/auth/delete-data">Delete my data</a>
    <?php else: ?>
      <p><?php echo $p . " or by logging in to purge all your data."; ?></p>
    <?php endif; ?>
  </section>
</main>

<?php $view->stopBuffering(); ?>