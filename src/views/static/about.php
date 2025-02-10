<?php

use App\Classes\View;

$view = new View();
$view->setTitle("About");
?>

<?php $view->startBuffering(); ?>

<main>
  <article>
    <h1>About 1x1 Web Fundamentals</h1>
    <section>
      <h2 id="background">Background</h2>
      <p>1x1 Web Fundamentals is a project created by me, <a href="https://nicolldouglas.dev/" target="_blank">Nicoll Douglas</a>,. I&apos;m a self-taught programmer who has been learning web development since late 2023.</p>
      <p>
        So far in my journey I&apos;ve watched countless tutorials, spent countless days reading documentation, building projects, and all the other 101 things you go through on the self-taught programming path. I&apos;ve made it quite far, and 1x1 Web Fundamentals is my attempt at compiling the most essential and practical knowledge I&apos;ve learnt, as well as the resource I would&apos;ve wished to have early on as I was learning.
      </p>
      <p>The tutorials I provide help you learn the fundamentals that are necessary and beneficial for building on the web. These include frontend technologies such as HTML, CSS and JavaScript; backend technologies such as PHP and MySQL; and other fundamental topics suchs as Git, web security, and how the internet works. The last item is perhaps one of the more important. If you have a grasp of what the hell the web is and does, you will have a better grasp of what it is <strong>you</strong> as a web developer are trying to do.</p>
    </section>
    <section>
      <h2>The State of the Web</h2>
      <p>Any other web developer out there knows that the web dev practice and ecosystem has become overwhelmingly complex over the last few years. The kinds of things that we can and want to do on the web have demanded more complexity. As a result, the ecosystem and community is flooded with a million and one technologies, abstractions, attitudes, content creators, and just overall noise that newbies don&apos;t need to hear.</p>
      <p>
        What this means is that if you are someone trying to get into web dev, you will find a lot of conflicting and opinionated views about how to do so, or whether you should get into it at all. The aim here is not to dispute those views with my own take, but rather provide some basic sense for those that want a start in web dev.
      </p>
      <p>
        A strong understanding of these fundamentals and building with elementary web tools means you will have a core understanding of how any complex website or web app works under the hood and be able to build almost anything you can imagine. One of the goals of 1x1 Web Fundamentals is to simplify the daunting scope of modern web development and help you realise, the scope is not that scary, and under the hood it&apos;s not as complicated as the echoes from the community will have you think.
      </p>
      <p>
        You will also understand why the web dev ecosystem has evolved the way it has, the changing attitudes, and what problems newer developments are trying to solve.
      </p>
    </section>
    <section>
      <h2>Final Note</h2>
      <p>I believe that one of the joys of web dev and programming as a whole, is that you have an incredible amount of creative freedom to build whatever you can think up. If you&apos;re someone pragmatic, you can solve that problem you wish you had a solution for; if you&apos;re someone more artsy, the web is your perfect canvas. This limitless potential is and can be, one of the wonders of the web for programmers and individuals alike.
      </p>
      <p>One of the best skills and qualities you can have is a curiosity and motivation to learn and build new things, regardless if its been done. Web dev and programming in general facilitates that and its a quality that will always be needed. So if you are interested in learning web dev, get inspired, take a look around, and happy learning!</p>
    </section>
  </article>
</main>

<?php $view->stopBuffering(); ?>