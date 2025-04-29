<?php

use App\Classes\View;

$view = new View();
$view->setTitle("1x1 Web Fundamentals");
$view->style("/home.css");
$view->startBuffering();
?>
<main>
  <pre id="ascii-heading" aria-hidden="true">
 __     __  __          __  _                                     
/_ |   /_ | \ \        / / | |                                    
 | |_  _| |  \ \  /\  / /__| |__                                  
 | \ \/ / |   \ \/  \/ / _ \ '_ \                                 
 | |>  <| |    \  /\  /  __/ |_) |                                
 |_/_/\_\_|     \/  \/_\___|_.__/                  _        _     
|  ____|             | |                          | |      | |    
| |__ _   _ _ __   __| | __ _ _ __ ___   ___ _ __ | |_ __ _| |___ 
|  __| | | | '_ \ / _` |/ _` | '_ ` _ \ / _ \ '_ \| __/ _` | / __|
| |  | |_| | | | | (_| | (_| | | | | | |  __/ | | | || (_| | \__ \
|_|   \__,_|_| |_|\__,_|\__,_|_| |_| |_|\___|_| |_|\__\__,_|_|___/
</pre>
  <section>
    <h1>Hello world.</h1>
    <p>Welcome to 1x1 Web Fundamentals: the no-nonsense one-stop shop for learning the fundamentals of how to build websites and web applications. </p>
    <p>
      Backed by an independent, self-taught developer, 1x1 Web Fundamentals is a series of tutorials where you learn how the web works and how to build on the web from the ground up using HTML, CSS, JavaScript, PHP and MySQL. If those terms don&apos;t mean anything to you now but you are curious, why not check it out? It&apos;s free.
    </p>
    <p>
      Here the goal is take the large and complicated scope of the web and web development, and transform it into the simple thing it really is under the surface. If you&apos;re looking for a solid foundation for a career in web development, are just a hobbyist, or want the insights of your average web developer, this is the place for you.
    </p>
    <p>New tutorials are added regularly so if you find something missing, stay tuned, I&apos;m working on it.</p>
  </section>
  <section>
    <h2>Overview</h2>
    <p>If you wish to see a list of all the current available tutorials and modules, check out the tutorial index <a href="/tutorials/index.php">here</a>.</p>
    <p>
      If you wish to get started, check out the first tutorial
      <a href="/tutorials/the-web/how-the-web-works">here</a>.
    </p>
    <p>Otherwise, happy learning.</p>
  </section>
</main>
<?php
$view->stopBuffering();
