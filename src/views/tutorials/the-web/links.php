<main>
  <article>
    <?php
    $breadcrumb = ["The Web", "Links"];
    require_once __DIR__ . "/../../../partials/breadcrumb.php";
    ?>

    <h1>Links</h1>

    <?php
    $tutorialNav = [
      [
        "href" => "#what-are-links",
        "text" => "What Are Links?"
      ],
      [
        "href" => "#the-importance-of-links",
        "text" => "The Importance of Links"
      ],
      [
        "href" => "#types-of-links",
        "text" => "Types of Links"
      ],
      [
        "href" => "#anchors",
        "text" => "Anchors"
      ],
      [
        "href" => "#links-and-search-engines",
        "text" => "Links and Search Engines"
      ]
    ];
    require_once __DIR__ . "/../../../partials/tutorialNav.php";
    ?>

    <section>
      <h2 id="what-are-links">What Are Links?</h2>
      <p>In this tutorial we will be talking about links. If you've managed to reach this tutorial, then you know all about links and it might seem like a trivial topic. However, we will go into some more specific/essential knowledge to know since we are discussing the Web in detail in this module.</p>

      <p>In the last tutorial we talked about URLs and their structure, and how URLs uniquely identify resources on the Web, for example webpages (HTML documents), images, and so on. We also mentioned a little bit about what links are. Links, short for <strong>hyperlinks</strong>, are simply just small navigation components on a webpage. Those components usually are made up of text and a URL (which we don't see and is usually hidden to us). The text might often be blue and underlined to indicate that it is a link, and it typically describes what the resource linked is. The URL in a link can be an absolute URL or one of the types of relative URLs.</p>

      <p>
        For example, this is a link: <a href="/tutorials">Tutorial Index</a>; the text is <em>Tutorial Index</em> and the URL (which we don't see) is <code>https://1x1.nicolldouglas.dev/tutorials</code>. The text describes that it is a link to the tutorial index of this website, and that is indeed what the URL points to. And so what happens when you click a link is that, the browser will use the hidden URL to request that new webpage or resource, and then display it to you in place of the current webpage that you are on.
      </p>
    </section>
    <section>
      <h2 id="the-importance-of-links">The Importance of Links</h2>

      <p>For a bit of history, the original purpose of the web was to make it easier to access, read, and navigate through text documents. And those were facilitated by the three pillars of the Web, spoken of in 1989 by Tim Berners-Lee, the creator of the Web. Those were:</p>

      <ol>
        <li><em>URL</em>, an address system that keeps track of Web documents (which we discussed in the last tutorial).</li>
        <li><em>HTTP</em>, a transfer protocol to retrieve documents when given their URLs.</li>
        <li><em>HTML</em>, a document format allowing for embedded hyperlinks.</li>
      </ol>

      <p>
        As you can see based on those three pillars, everything on the Web revolved and revolves around documents and how to access them. Since the early days of the Web, the Web has also evolved to provide access to images, videos, and other resource/file formats as we have mentioned.
      </p>

      <p>But as you can imagine, before the advent of the Web, accessing documents and moving them from one place to another was quite difficult. URLs made access a lot easier, but links and their ability to navigate so easily to new documents, was the key secret as to what made the Web so successful, and why they are a core topic in this module. Not only that, but being able to link from one webpage to another is also what made the Web, "the Web"—a network of interlinked resources, resembling a spider's web.</p>

      <figure>
        <img
          src="/assets/images/the-web/links/the-web.png"
          alt="A simple illustration of the web"
          style="max-width: 640px;"
          width="640"
          height="423">
        <figcaption>Figure 1 - A simple illustration of the web</figcaption>
      </figure>
    </section>

    <section>
      <h2 id="types-of-links">Types of Links</h2>
      <p>The same way there are different types of URLs, there are also different types of links. However, these are more semantic than they are technical:</p>

      <ul>
        <li><strong>Internal link</strong> — A link between two webpages or resources that belong to the same website. Without these links, the concept of a <a href="/tutorials/the-web/common-terms-on-the-web#what-is-a-website">website</a> would be hard to define because there would be no way to relate two resources available on the same web server other than the fact that they came from the same one.</li>
        <li><strong>External link</strong> — A link from your webpage to someone else's webpage (on a different website). Without external links, the concept of "the Web" would not exist.</li>
        <li><strong>Incoming link</strong> — A link from someone else's webpage (on a different website) to your webpage (the opposite of an external link). Note that you don't have to link back when someone links to your site in order for links to work.</li>
      </ul>
    </section>

    <section>
      <h2 id="anchors">Anchors</h2>
      <p>There is also a fourth kind of link called an anchor. We've mentioned anchors quite a lot already, but I shall explain them properly here.</p>

      <p>An <strong>anchor</strong> is essentially a link inside a document that links to another part of the same document. Instead of tieing two different documents together, it ties together two sections of the same document. As we mentioned in the last tutorial, when you click on an anchor link, the browser will add the anchor to the URL and then take you to that location in the document.</p>

      <p>
        Take for example this anchor link: <a href="#what-are-links">Go to "What Are Links?"</a>; it contains the relative URL <code>#what-are-links</code> and if you click on it, it takes you to one of the earlier sections of the document as well as add the anchor to the URL.
      </p>
    </section>

    <section>
      <h2 id="links-and-search-engines">Links and Search Engines</h2>
      <p>Links are not only important because they form the very fabric of the Web, but also because of search engines. As we mentioned in a <a href="/tutorials/the-web/common-terms-on-the-web#what-is-a-search-engine">previous tutorial</a>, a search engine is a website that provides functionality for you to search and look for other websites on the web. Links are important to search engines because in order for users to be able to find websites through a search engine, a search engine needs to be able to find those websites first.</p>

      <p>The way in which search engines find new websites and webpages is by visiting a webpage and recursively following the links that are contained within the loaded webpage. This allows them to discover the millions of webpages and websites out there on the web and index them in a convenient manner for us to search for. Links facilitate the very existence of search engines, which form a vital part of the Web and make it one level easier for us to find new websites and webpages above external links.</p>
    </section>

    <?php
    $keyConcepts = [
      "A <strong>hyperlink</strong>, commonly known as a link, is a small navigation component on a webpage that allows you to load a new webpage or resource in the web browser.",
      "A link is comprised of <strong>text</strong>, describing the link, and an absolute or relative <strong>URL</strong>, which the browser uses to request the new resource.",
      "Links are a key foundation of the Web because they allow you to link multiple webpages together in order to make them more discoverable, and form the very network of interlinked resources that we call the Web.",
      "There are several types of links including <strong>internal links</strong> (linking two resources on the same site) and <strong>external links</strong> (linking two resources on different sites).",
      'An <strong>anchor</strong> is a link inside a document that takes you to a different part of the same document when clicked.',
      "Links also facilitate the existence of search engines which allow us to easily browse the web and find new websites."
    ];
    require_once __DIR__ . "/../../../partials/keyConcepts.php";
    ?>

  </article>

  <?php require_once __DIR__ . "/../../../partials/tutorialFooter.php"; ?>
</main>