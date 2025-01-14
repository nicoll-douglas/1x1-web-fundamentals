<?php
require_once __DIR__ . "/../../middleware/Session.php";
require_once __DIR__ . "/../../models/User.php";
?>

<footer>
  <section>
    <h3 id="links-heading">Links</h3>
    <ul aria-labelledby="links-heading">
      <li>
        <a href="/tutorials/index.php" class="link-alt">Tutorials</a>
      </li>
      <li>
        <a href="/about.php">About</a>
      </li>
      <li>
        <a href="/contact.php">Contact</a>
      </li>
      <li>
        <a href="/privacy.php">Privacy</a>
      </li>
      <li>
        <?php if (USER): ?>
          <a href="/api/auth/logout.php">Logout</a>
        <?php else: ?>
          <a href="/sign-in.php">Sign In</a>
        <?php endif; ?>
      </li>
    </ul>
  </section>
  <?php
  if (USER):
    $name = USER["name"];
  ?>
    <section>
      <h3>Auth</h3>
      <p>You are signed in as <?php echo $name; ?>.</p>
      <h4>Actions</h4>
      <ul>
        <li>
          <a href="/api/auth/logout.php">Logout</a>
        </li>
        <li>
          <a href="/delete.php">Delete my data</a>
        </li>
      </ul>
    </section>
  <?php endif; ?>
  <?php
  if (!isset($footer_contact) || $footer_contact === true):
  ?>
    <section>
      <h3>Contact</h3>
      <div>
        <h4>Email</h4>
        <a href="mailto:dev.nicoll.douglas@gmail.com">
          dev.nicoll.douglas@gmail.com
        </a>
        <h4 id="leave-a-message-heading">Leave a Message</h4>
        <?php require_once __DIR__ . "/message_form.php"; ?>
      </div>
    </section>
  <?php endif; ?>
</footer>