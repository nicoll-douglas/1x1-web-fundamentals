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
    ];
    require_once __DIR__ . "/../../../partials/tutorialNav.php";
    ?>
    <section>
      <h2 id="what-are-urls">What Are URLs?</h2>
      <p>
        In this tutorial we will be talking about what URLs are. So in the context of the last tutorial, we can summarise that we have web browsers that let us access websites that are hosted on a web server (hopefully the jargon is making sense, otherwise read over the last tutorial).</p>

      <p>Websites consist of webpages and other resources (images etc.) that often have <strong>links</strong> to each other. Links are small elements of a webpage that will navigate us to a new webpage or resource when we click them (you have used them to navigate you to this page). But before we can talk about links in more detail (the next tutorial), we have to talk about <strong>URLs</strong> which is what allows links to function.
      </p>

      <p>URL stands for <strong>Uniform Resource Locator</strong> and it is what allows both us and web browsers to uniquely identify a resource on the web. When we are on a webpage, a URL is what we see in the address bar of our web browser. For example, the URL of this page is:</p>

      <p style="color: var(--color-accent-1-light); word-break: break-all;">https://jwf.nicolldouglas.dev/tutorials/the-web/urls</p>

      <p>This URL uniquely identifies this webpage as a resource on the web. So if you type this into the address bar of any web browser, it will know to request this webpage and it is what you will see. The structure of a URL consists of some of the components in the example URL as well as others. Let's try to unpack the structure of a URL below.</p>
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
      <p>The first part of a URL is the <strong>scheme</strong>. The scheme tells the browser which protocol to use in order to request the resource. you will commonly see these be either <em>HTTP</em> or <em>HTTPS</em> (HTTPS for this page, for example). We will go over these in more detail in a future tutorial but for now all you need to know is that HTTP and HTTPS are standard protocols/methods used on the web by browsers and servers in order to communicate and transfer data. Think about it as a language that browsers and servers use and agree to speak with.</p>

      <p>There are also other schemes that you might see in URLs on the web, for example the "mailto:" scheme which web browsers use to open your email client. These are less important, so just know the scheme is the protocol in which a web browser tries to do something.</p>

      <p>Another thing is, when we type out a domain name in our address bar like "youtube.com", we can typically omit the scheme because with HTTP and HTTPS, modern web browsers have features that lets them figure out what scheme to use based on interactions with the web server. But the scheme is always there (and it is usually separated with a "://" from the domain name when shown).</p>

      <h3 id="domain">Domain</h3>
      <p>We've already talked a lot about domains but this part of the URL can contain a domain name or an IP address as we have used previously, and it tells the browser which web server we are trying to get the resource from. In the figure, the domain name is "example.com".</p>

      <h3 id="port">Port</h3>
      <p>The next part of the URL is the <strong>port</strong> number which is separated by a colon after the domain name. You can think of the port as the "gateway" into the server. A server might be hosting web content as well as providing other services (like email for example), so the port indicates which "gate"/service to use. It also makes it easier for the server to distinguish their services and what request-makers want.</p>

      <p>In the figure example, the port number used is "80", which is the default/standard port used by servers for the HTTP protocol. The default/standard port number for HTTPS is 443. We often don't see port numbers in URLs when on the web and that is because, if a server is using the standard HTTP/HTTPS ports (which they usually are), then we can omit them and the browser can infer the port from the scheme. But these are the only exceptions, in other cases, the port number is mandatory.</p>

      <p>If you try adding port 443 to the URL of this page, you will see you get the exact same page since we are using HTTPS. If you try adding port 80, you might get an error since the request scheme (HTTPS protocol) is not compatible with the HTTP protocol used on port 80.</p>

      <h3 id="file-path">File Path</h3>
      <p>Next is the <strong>file path</strong>. In the figure, the file path is "/path/to/file.html". The same way we have files and folders on our personal computers, web servers also have files and folders that they make publicly available on the web. In this case, the file is "file.html" which lives in folder "/to" which lives in the top-level folder "/path". So a web server could potentially make available thousands of files if they have the infrastructure. These files are often HTML, images like PNGs and JPEGs, MP4 videos and lots of other file formats that are supported on the web.</p>

      <p>The file path for this webpage is "/tutorials/the-web/urls". You might notice that there is no file extension (like .html and so on). Web servers can make configurations to omit these file extensions but they still represent some kind of resource on the server like HTML or an image. And in this case, this is a HTML page stored inside the folder for all other tutorials in this module.</p>

      <h3 id="other-parts">Other Parts</h3>
      <p>The last two parts of a URL are the query parameters and anchor. These are not so important but I will give a brief explanation.</p>
      <p>Query parameters come after the file path and require a "?" before them. They are essentially key value pairs separated by an "=" that can provide extra data and information to the server, and the server can do what it wants with them. Each time a new query parameter is added, an "&" symbol must separate them. So the query parameter section in the example is "?key1=value1&key2=value2" which essentially says, key1 has value1 and key2 has value2.</p>

      <p>We also have anchors and these will be more relevant when we talk about links in the next tutorial. But if the resource we are requesting is a HTML page, the anchor acts as a kind of "bookmark" and tells us where exactly in the document we want to see when it loads.

      <p>So with this comprehensive structure, URLs allow us to identify any unique resource on the web which can be any of the many types supported on the web. In the next tutorial we will talk about what links are and how they tie into URLs.</p>
    </section>
    <?php
    $keyConcepts = [
      "URL stands for <strong>Uniform Resource Locator</strong> and it allows us and web browsers to uniquely identify a resource on the web.",
      "A URL contains a <strong>scheme</strong> which indicates what protocol to use to request the resource.",
      "A URL contains a <strong>domain name</strong> or IP address which tells what web server to make the request to.",
      "A URL contains a <strong>port number</strong> to indicate what \"gateway\" to use on the server.",
      "The default ports for HTTP and HTTPS are <strong>80</strong> and <strong>443</strong> respectively and can usually be omitted in a URL.",
      "A URL contains a <strong>file path</strong> which tells the location of the file or resource on the server.",
      "A URL can contain other parts such as <strong>query parameters</strong> and an <strong>anchor</strong>, which can provide extra information towards the resource we are requesting."
    ];
    require_once __DIR__ . "/../../../partials/keyConcepts.php";
    ?>
  </article>
  <?php require_once __DIR__ . "/../../../partials/tutorialFooter.php"; ?>
</main>