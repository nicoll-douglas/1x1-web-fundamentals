<main>
  <article>
    <?php
    $breadcrumb = ["The Web", "Common Terms On The Web"];
    require_once __DIR__ . "/../../../partials/breadcrumb.php";
    ?>
    <h1>Common Terms On The Web</h1>
    <?php
    $tutorialNav = [
      [
        "text" => "A Quick Recap",
        "href" => "#a-quick-recap"
      ],
      [
        "text" => "What is a Webpage?",
        "href" => "#what-is-a-webpage"
      ],
      [
        "text" => "What is a Website?",
        "href" => "#what-is-a-website"
      ],
      [
        "text" => "What is a Web Server?",
        "href" => "#what-is-a-web-server"
      ],
      [
        "text" => "What is a Web Browser?",
        "href" => "#what-is-a-web-browser"
      ],
      [
        "text" => "What is a Search Engine?",
        "href" => "#what-is-a-search-engine"
      ],
    ];
    require_once __DIR__ . "/../../../partials/tutorialNav.php";
    ?>
    <section>
      <h2 id="a-quick-recap">A Quick Recap</h2>
      <p>In the first tutorial I <a href="/tutorials/the-web/how-the-web-works#accessing-the-web">showed</a> how you can type out an IP address into your web browser's address bar and that if it corresponds to a web server, the web server might send back some data, typically a webpage. The same can also be done for a domain name if it has a DNS record with an associated IP address of a web server. We've also learnt that the <a href="/tutorials/the-web/how-the-web-works#what-is-the-web">Web</a> is a service built on top of the <a href="/tutorials/the-web/how-the-web-works#what-is-the-internet">internet</a> that allows a web browser to communicate with a web server and access its content.
      </p>
      <p>So I think now is an appropriate time to make clear some common technical jargon about those concepts and related ones when it comes to the Web.</p>
    </section>

    <section>
      <h2 id="what-is-a-webpage">What is a Webpage?</h2>
      <p>A webpage is essentially a document that can be understood by and displayed in a web browser. These are written in the <a href="https://developer.mozilla.org/en-US/docs/Glossary/HTML" target="_blank">HTML</a> language which we will learn more about later down the line. But to summarise, webpages/HTML documents are a multimedia document format which allow for text, images, video, audio, links, scripts, and other media to be embedded within them. This is why on the Web we can have simple websites like a blog site where you read text, or more complex websites like YouTube where you can watch videos.</p>
    </section>

    <section>
      <h2 id="what-is-a-website">What is a Website?</h2>
      <p>A website is a collection of webapges grouped into a single resource/entity (as well as the pages' associated resources like images and videos). A website is usually named after its domain name. So something like <em>youtube.com</em> is a website. The webpages that are part of a website often contain <strong>links</strong> connecting to each other that allow you to easily browse the site.</p>

      <p>When you type out a domain name or IP address into your web browser and press enter, typically if there is an associated web server, it will send back the home page of the website which provides you a starting point for your browsing. This is what we did with the <a href="/tutorials/the-web/how-the-web-works#accessing-the-web">Google example</a> in the first tutorial.</p>
    </section>

    <section>
      <h2 id="what-is-a-web-server">What is a Web Server?</h2>
      <p>We've already talked about what a <a href="/tutorials/the-web/how-the-web-works#clients-and-servers">web server</a> is but to reiterate, a web server is a computer on the internet who's job is to make available and provide the data that a <a href="/tutorials/the-web/how-the-web-works#clients-and-servers">client</a>/web browser is requesting. This data is often a webpage. But more specifically, someone who runs a web server typically wants to make available lots of webpages or data and so a web server is a computer that <strong>hosts a website</strong> (makes available the pages of that site on the Web). Web servers for that matter, can also host multiple websites.</p>

      <p>Two domain names can point to the same IP address of a web server which would indicate two websites, but if you've been noticing my language so far in these tutorials, it is the <strong>job of the server</strong> to make their resources available, and this can be done however the server chooses. Web servers being computers means they are complex machines with complex software and so hosting multiple distinct websites on one web server is a possibility as well hosting one website for multiple domain names (those domain names all have to point to the same IP address).</p>

      <p>Web servers and websites are not one-to-one so do not confuse them as such. Web servers are merely a means to host a website.</p>
    </section>

    <section>
      <h2 id="what-is-a-web-browser">What is a Web Browser?</h2>
      <p>A web browser is a piece of software on a personal computer that lets you access the Web, for example, Google Chrome, Microsoft Edge or Mozilla Firefox. It is the main example of what we've been referring to as a "client" on the web. And so, it is responsible for requesting and interpreting data received from a web server (i.e. webpages on a website).</p>
    </section>

    <section>
      <h2 id="what-is-a-search-engine">What is a Search Engine?</h2>
      <p>This is a term that we haven't mentioned yet but that is relevant and can often be confused with a web browser. A search engine is a <strong>website</strong> that provides functionality for you to search and look for other websites on the Web. The most famous of them being <a href="https://google.com">google.com</a>.</p>

      <p>We <em>can</em> go to a search engine's website in order to use it to the search the Web but nowadays, we can access a search engine's functionality directly through a web browser's address bar and search from there. Our web browser essentially shortens the process and sends us to a webpage that contains search results for our search query on the given search engine's website (assuming what we typed isn't a valid domain or IP address). This is merely done for a better use experience, but remember the primary function of a web browser is to let us access the Web by typing in a website's name into the address bar.</p>

      <p>So to make the distinction clear, a <em>web browser</em> is software lets you access the Web (websites). A <em>search engine</em> is a website that lets you search for other websites and webpages on the Web. But for convenience, web browsers will typically provide you an easy means to access a search engine through the address bar or on their home page.</p>
    </section>

    <?php
    $keyConcepts = [
      "A webpage is a multimedia document format (HTML) served from a web server and displayed in a web browser.",
      "A website is a collection of webpages that form a cohesive unit of resources and are typically connected together with links.",
      "A web server is a computer that hosts one or more websites.",
      "A <em>web browser</em> is a piece of software on a personal computer that lets you access websites and webpages on the Web.",
      "A <em>search engine</em> is a website that lets you search for other websites on the Web and is accessible via a web browser.",
    ];
    require_once __DIR__ . "/../../../partials/keyConcepts.php";
    ?>
  </article>

  <?php require_once __DIR__ . "/../../../partials/tutorialFooter.php"; ?>
</main>