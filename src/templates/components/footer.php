<footer>
  <section>
    <h3 id="links-heading">Links</h3>
    <ul aria-labelledby="links-heading">
      <li>
        <a href="/course/index.php" class="link-alt">The Course</a>
      </li>
      <li>
        <a href="/about.php">About</a>
      </li>
      <li>
        <a href="/contact.php">Contact</a>
      </li>
      <li>
        <a href="/sign-in.php">Sign In</a>
      </li>
    </ul>
  </section>
  <section>
    <h3 id="course-modules-heading">Course Modules</h3>
    <ul aria-labelledby="course-modules-heading">
      <li>
        <a href="/course/the-web/index.php">The Web</a>
      </li>
      <li>
        <a href="/course/html/index.php">HTML</a>
      </li>
      <li>
        <a href="/course/css/index.php">CSS</a>
      </li>
      <li>
        <a href="/course/git/index.php">Git</a>
      </li>
      <li>
        <a href="/course/javascript/index.php">
          JavaScript
        </a>
      </li>
      <li>
        <a href="/course/php/index.php">PHP</a>
      </li>
      <li>
        <a href="/course/mysql/index.php">MySQL</a>
      </li>
    </ul>
  </section>
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