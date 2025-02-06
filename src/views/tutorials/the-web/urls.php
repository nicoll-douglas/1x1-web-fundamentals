<main>
  <article>
    <?php
    $breadcrumb = ["The Web", "URLs"];
    require_once __DIR__ . "/../../../partials/breadcrumb.php";
    ?>
    <h1>URLs</h1>
    <?php
    $tutorialNav = [
      [
        "href" => "#what-are-urls",
        "text" => "What Are URLs?"
      ],
      [
        "href" => "#structure-of-a-url",
        "text" => "Structure of a URL",
        "children" => [
          [
            "href" => "#scheme",
            "text" => "Scheme"
          ],
          [
            "href" => "#domain",
            "text" => "Domain"
          ],
          [
            "href" => "#port",
            "text" => "Port"
          ],
          [
            "href" => "#file-path",
            "text" => "File Path"
          ],
          [
            "href" => "#other-parts",
            "text" => "Other Parts"
          ]
        ]
      ],
      [
        "href" => "#absolute-urls-vs-relative-urls",
        "text" => "Absolute URLs vs. Relative URLs"
      ]
    ];
    require_once __DIR__ . "/../../../partials/tutorialNav.php";
    ?>
    <section>
      <h2 id="what-are-urls">What Are URLs?</h2>
      <p>
        In this tutorial we will be talking about what URLs are. So in the context of the last tutorial, we can summarise that we have web browsers that let us access websites that are hosted on a web server (hopefully the jargon is making sense, otherwise read over the last tutorial).</p>

      <p>Websites consist of webpages that often have <strong>links</strong> to each other and other resources on the website. Links are small elements of a webpage that will navigate us to a new webpage or resource when we click them (you have used them to navigate you to this page). But before we can talk about links in more detail (the next tutorial), we have to talk about <strong>URLs</strong> which is what allows links to function.
      </p>

      <p>URL stands for <strong>Uniform Resource Locator</strong> and it is what allows both us and web browsers to uniquely identify a resource on the Web. When we are on a webpage, a URL is what we see in the address bar of our web browser. For example, the URL of this page is: <code>https://jwf.nicolldouglas.dev/tutorials/the-web/urls</code>.</p>

      <p>This URL uniquely identifies this webpage as a resource on the Web. So if you type this into the address bar of any web browser, it will know to request this webpage and it is what you will see. The structure of a URL consists of some of the components in the example URL as well as others. Let's try to unpack the structure of a URL below.</p>
    </section>
    <section>
      <h2 id="structure-of-a-url">Structure of a URL</h2>
      <p>The figure below denotes the structure of a URL. It consists of 6 parts but you don't have to know exactly what each part means in detail right now; we shall go over it.</p>
      <figure>
        <img
          src="/assets/images/the-web/urls/url.png"
          alt="The stucture of a URL"
          style="max-width: 768px;"
          width="768"
          height="88">
        <figcaption>Figure 1 - The structure of a URL</figcaption>
      </figure>

      <h3 id="scheme">Scheme</h3>
      <p>The first part of a URL is the <strong>scheme</strong>. The scheme tells the browser which protocol to use in order to request the resource. you will commonly see these be either <em>HTTP</em> or <em>HTTPS</em> (HTTPS for this page, for example). We will go over these in more detail in a future tutorial but for now all you need to know is that HTTP and HTTPS are standard protocols/methods used on the Web by browsers and servers in order to communicate and transfer data. Think about it as a language that browsers and servers use to speak to each other and agree to speak with.</p>

      <p>There are also other schemes that you might see in URLs on the Web, for example the <code>mailto:</code> scheme which web browsers use to open your email client. These are less important, so just know the scheme is the protocol in which a web browser tries to get a resource or do something.</p>

      <p>Another thing is, when we type out a domain name in our address bar like <em>youtube.com</em>, we can typically omit the scheme because with HTTP and HTTPS, modern web browsers have features that lets them figure out what scheme to use based on interactions with the web server. But the scheme is always there (and it is usually separated with a <code>://</code> from the domain name when shown).</p>

      <h3 id="domain">Domain</h3>
      <p>We've already talked a lot about <a href="/tutorials/the-web/domains">domains</a> but this part of the URL can contain a domain name or an IP address as we have used previously, and it tells the browser which web server we are trying to get the resource from. In the figure, the domain name used is "example.com".</p>

      <h3 id="port">Port</h3>
      <p>The next part of the URL is the <strong>port</strong> number which is separated by a colon after the domain name. You can think of the port as the "gateway" into the server. A server might be hosting web content as well as providing other services (like email for example), so the port indicates which "gate"/service to use. It also makes it easier for the server to distinguish their services on the inernet and to distinguish what request-makers want.</p>

      <p>In the figure example, the port number used is <em>80</em>, which is the default/standard port used by servers for the HTTP protocol. The default/standard port number for HTTPS is 443. We often don't see port numbers in URLs when on the Web (like on this page) and that is because, if a server is using the standard HTTP/HTTPS ports (which they usually are), then we can omit them and the browser can infer the port from the scheme. But these are the only exceptions, in other cases, the port number is mandatory.</p>

      <p>If you try adding port 443 to the URL of this page, you will see you get the exact same page since we are using HTTPS. If you try adding port 80, you might get an error since the request scheme (HTTPS protocol) is not compatible with the HTTP protocol used on port 80.</p>

      <h3 id="file-path">File Path</h3>
      <p>Once we know the scheme, domain, and port that we will be using to request from the web server, next comes the <strong>file path</strong>. In the figure, the file path is <code>/path/to/file.html</code>. The same way we have files and folders on our personal computers, web servers also have files and folders that they make publicly available on the Web. In this case, the file is <code>file.html</code> which lives in folder <code>/to</code> which lives in the top-level folder <code>/path</code>. So a web server could potentially make available thousands of files if they have the infrastructure. These files are often HTML, images like PNGs and JPEGs, MP4 videos, and lots of other file formats that are supported on the Web. So with the file path in the URL, the web server knows which file that we want.</p>

      <p>The file path for this webpage is <code>/tutorials/the-web/urls</code>. You might notice that there is no file extension (like <code>.html</code> and so on). Web servers can make configurations to omit these file extensions but they still represent some kind of resource on the server like HTML or an image. And in this case, this is a HTML page stored inside the folder for all other tutorials in this module.</p>

      <h3 id="other-parts">Other Parts</h3>
      <p>The last two parts of a URL are the query parameters and anchor. These are not so important for now but I will give a brief explanation.</p>
      <p>Query parameters come after the file path and require a <code>?</code> before them. They are essentially key value pairs joined by an <code>=</code> that can provide extra data and information to the server, and the server can do what it wants with them. Each time a new query parameter is added, an <code>&</code> symbol must separate them. So the query parameter section in the example is <code>?key1=value1&key2=value2</code> which essentially says: "for this request, <code>key1</code> has <code>value1</code> and <code>key2</code> has <code>value2</code>".</p>

      <p>We also have anchors and these will be more relevant when we talk about links in the next tutorial. But if the resource we are requesting is a HTML page, the anchor acts as a kind of "bookmark" and tells us where exactly in the document we want to see when it loads.

      <p>So overall, URLs have this comprehensive structure that allow us to identify any unique resource on the Web which can be any of the many types supported on the Web. And with these unique identifiers, web servers and web browsers are able to easily communicate and retrieve the resources for a specific request.</p>
    </section>

    <section id="absolute-urls-vs-relative-urls">
      <h2>Absolute URLs vs. Relative URLs</h2>

      <p>The structure we were talking about above is what's known as an <strong>absolute URL</strong>. There is also another type of URL called a <em>relative URL</em> and we will discuss the differences below. But for context, the required parts of a URL depend on the context in which they are used. For example, inside the address bar of a browser, there is essentially no context, so all parts are required (although you can omit some like we discussed previously, but overall all parts will be needed by the browser).</p>

      <p>URLs can also be embedded inside a document (which is what forms links), and that has a context, which is the current document it is in. If that current document is being viewed in a web browser, the web browser will know its full URL. The key part here is, A URL inside a document that forms a link can omit certain parts and the web browser will infer those missing parts based on the URL of the page it is on (the existing context). Those are what as known as <strong>relative URLs</strong>.</p>

      <p>There are a few types of relative URLs, so I will go over the key ones below:</p>

      <ul>
        <li><strong>Scheme-relative URL</strong>: <code>//jwf.nicolldouglas.dev/tutorials</code> — only the scheme is missing, so the browser will use the same protocol used to load the document the URL is in.</li>

        <li><strong>Domain-relative URL</strong>: <code>/tutorials</code> — the scheme and the domain are missing, so the browser will use the same protocol and domain used to load the document the URL is in. So for example, any page on this website with a link containing URL <code>/tutorials</code>, would take you to the tutorials page.</li>

        <li><strong>Sub-resources</strong>: <code>the-web/urls</code> — the protocol and domain are missing, and the file path doesn't begin with <code>/</code>. The browser will try to find the resource in a <em>subfolder</em> of the one it is currently in. So imagine we are in the <code>/tutorials</code> document, and there is a link with a relative URL to <code>the-web/urls</code>. The document we will be getting is <code>/tutorials/the-web/urls</code> (<code>/the-web</code> being a subfolder). You may also have these types of relative URLs be in the form <code>./the-web/urls</code>. The <code>./</code> just means "the current folder", so the URLs are equivalent.</li>

        <li><strong>Going back in the folder tree</strong>: <code>../html/introduction</code> — the protocol and domain are missing, and the file path starts with <code>..</code>, which means go back up one folder. So consider this document (<code>/tutorials/the-web/urls</code>), we are currently in the folder <code>/the-web</code>. The URL would tell us to go back into the previous folder <code>/tutorials</code> and then into the folder <code>/html</code> and then the document <code>introduction</code>.</li>

        <li><strong>Anchor-only</strong>: <code>#absolute-urls-vs-relative-urls</code> — all parts of the URL are missing except the anchor. In a link, the browser will add the anchor to the current document's URL and take you to that location in the document (and that is what the navigation links at the beginning of these tutorials do). <a href="#absolute-urls-vs-relative-urls">Try it</a>.</li>
      </ul>

      <p>So overall these are the different kinds of relative URLs. You don't have to memorise them all now but it is important to know that there are different types of URLs that exist on the web that fall either into the category of absolute URLs (a full document identifier) or relative URLs (context dependent). In the next tutorial we will talk about what links are and how they tie into URLs.</p>
    </section>

    <?php
    $keyConcepts = [
      "URL stands for <strong>Uniform Resource Locator</strong> and it allows us and web browsers to uniquely identify a resource on the Web.",
      "A URL contains a <strong>scheme</strong> which indicates what protocol to use to request the resource.",
      "A URL contains a <strong>domain name</strong> or IP address which tells what web server to make the request to.",
      "A URL contains a <strong>port number</strong> to indicate what \"gateway\" to use on the server.",
      "The default ports for HTTP and HTTPS are <strong>80</strong> and <strong>443</strong> respectively and can usually be omitted in a URL.",
      "A URL contains a <strong>file path</strong> which tells the location of the file or resource on the server.",
      "A URL can contain other parts such as <strong>query parameters</strong> and an <strong>anchor</strong>, which can provide extra information towards the resource we are requesting.",
      "URLs can be either <strong>absolute URLs</strong> (the full identifier) or <strong>relative URLs</strong> (context dependent)."
    ];
    require_once __DIR__ . "/../../../partials/keyConcepts.php";
    ?>
  </article>
  <?php require_once __DIR__ . "/../../../partials/tutorialFooter.php"; ?>
</main>