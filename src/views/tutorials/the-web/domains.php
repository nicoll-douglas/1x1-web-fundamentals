<main>
  <article>
    <?php
    $breadcrumb = ["The Web", "Domains"];
    require_once __DIR__ . "/../../../partials/breadcrumb.php";
    ?>
    <h1>Domains</h1>
    <?php
    $tutorialNav = [
      ["text" => "What is a Domain?", "href" =>  "#what-is-a-domain"],
      ["text" => "Who Owns a Domain?", "href" => "#who-owns-a-domain"],
      ["text" => "What is DNS?", "href" => "#what-is-dns"]
    ];
    require_once __DIR__ . "/../../../partials/tutorialNav.php";
    ?>
    <section>
      <h2 id="what-is-a-domain">What is a Domain?</h2>

      <p>In the last tutorial we learnt that each computer on the internet has a unique identifier called an IP address. And that if that computer is a web server, we can type out its IP address into a web browser's address bar and request some data that it might have available. If we wanted to host content on the Web, we could just give out the IP address of our web server, however, we don't usually use IP addresses to access content on the Web do we?</p>

      <p>That is where <strong>domain names</strong> come in. Domain names provide a human-readable address that corresponds to a server on the internet for users to easily access its content. IP addresses are hard to remember and can change over time, so domain names act as an <strong>alias</strong> for a server which saves us a lot of trouble.</p>

      <p>Domain names have a simple structure made up of several parts separated by dots. In the context of regular web browsing we may naturally read them left to right, but in the context of domains, they are read <strong>right to left</strong>.</p>

      <figure>
        <img
          src="/assets/images/the-web/domains/domain.png"
          style="max-width: 280px;"
          alt="An example of a domain name structure" />
        <figcaption>Figure 1 - An example of a domain name structure</figcaption>
      </figure>

      <p>A domain name consists of several components (like the one above) but generally these fall into one of two categories:</p>

      <ol>
        <li>A <strong>TLD</strong> (top-level domain)</li>
        <li>A <strong>label</strong></li>
      </ol>

      <p><strong>TLD</strong> stands for <em>top-level domain</em> and it tells users the general purpose of the service behind the domain name. Some generic TLDs don't require a web server's content to meet a specific criteria (e.g .com, .net, .org). But more specialised TLDs have special requirements; ".gov" for example, is only allowed to be used by governments.</p>

      <p><strong>Labels</strong> are components of the domain name that come after the TLD. Domain names can have multiple labels, for example, <a href="https://informatics.ed.ac.uk/" target="_blank">informatics.ed.ac.uk</a> is a valid domain name. A label located directly after the TLD is also called a <em>secondary-level domain</em> (SLD).</p>

      <p>So for example, Google controls the <em>google.com</em> domain. The TLD in this case is ".com" and it contains a label "google" which is also the secondary-level domain. Someone who controls a domain can also create "subdomains" that add more labels after the secondary-level domain. This is typically done to host different kinds of content located at each (e.g books.google.com, images.google.com) and these subdomains can have many labels.</p>
    </section>

    <section>
      <h2 id="who-owns-a-domain">Who Owns a Domain?</h2>

      <p>Domain names cannot be strictly <em>owned</em> because otherwise you would quickly end up with a few big companies buying up and hoarding all the domains. Instead, you pay for the <em>right</em> to use a domain name for a set period of time (usually 1 or more years), and can renew your right which has priority over other people's applications for a domain. But you never <em>own</em> it, this is so in time the domain may become available again for other people to use.</p>

      <p>What if <em>I</em> want a domain? Anybody can obtain the right to a domain, typically through a <strong>registrar</strong>. A registrar is essentially a company that keeps information about domain names and other technical things like who registered it and so on. If you wanted to get a domain, you would typically go to a registrar's website and use their "whois" service to see whether a domain is available. <a href="https://www.whois.com/whois/" target="_blank">Try it here</a>!</p>

      <p>Then, if a domain is available and you want it, you can typically fill out a form on a registrar's website to get the domain. Once all the details have been filled out and the domain paid for, the registrar will let you know when the domain is properly registered and accessible on the Web. Typically within a few hours it will be available (all DNS servers will have received the DNS record; I'll explain what this means in the next section).</p>

      <p>If you have a web server that you want to serve content to the Web from, you can also configure your domain to point to that server's IP in your registrar's dashboard.</p>
    </section>

    <section>

      <h2 id="what-is-dns">What is DNS?</h2>
      <p><strong>DNS</strong> stands for <em>Domain Name System</em> and is essentially what we've been talking about up until now in this tutorial. But domain names and registering them form part of a much larger ecosystem.</p>

      <p>On the internet you have <strong>DNS servers</strong>, which are special servers around the world that contain a large database of domain names and associated information about them, also known as a <strong>DNS record</strong> (if you have a domain, you can update your DNS records in your registrar's dashboard). These records are held for a certain amount of time before they are automatically invalidated and then refreshed from <a href="https://www.dnssystem.org/authoritative-dns-server-everything-you-need-to-know/" target="_blank">top-level DNS servers</a>, also known as <em>authorative name servers</em> (essentially big boss servers that manage the system). When you get a domain or make changes to your domain's DNS records, these top-level servers receive your new information. The process of DNS servers refreshing records from top-level DNS servers is known as <em>DNS refreshing</em> and is what allows a domain name registration to get out there on the Web as previously mentioned.</p>

      <p>Ok, so let's say there is a web server with an associated domain name that you type into your address bar. How does your web browser/computer know how to get that web server's content if you are only giving it the domain name and not the exact identifier of the server (the IP address)?</p>

      <p>Well, your web browser will first check the <strong>cache</strong> (locally stored values) on your local computer and ask it to see if the IP address is stored there from a previous time you visited the domain. If not, it will make a request to one or more DNS servers to see if they have the <strong>DNS record</strong>. If they do (which they usually should because of DNS refreshing), then the request can proceed to get the content from the web server with the associated IP address in the record. Your computer will then store these values in the cache for a certain amount of time for future use like we initially described to improve efficiency.

      <figure>
        <img
          src="/assets/images/the-web/domains/dns.png"
          style="max-width: 768px;"
          loading="lazy"
          alt="An overview of a network request with DNS"
          height="436"
          width="768" />
        <figcaption>Figure 2 - An overview of a network request to google.com</figcaption>
      </figure>

      <p>This process of registering domains, them being sent out to DNS servers via DNS refreshing, your web browser being able to query those servers and then cache those values, is what allows the Web to work with domain names as seamlessly as it does; and provide us with easy to remember names for lots of different websites.</p>

    </section>
    <?php
    $keyConcepts = [
      "Domain names provide a human-readable address that corresponds to a web server.",
      "Domain names consist of a few parts to identify the content on a web server in a basic manner.",
      '"Ownership" of a domain can be checked and changed through a <strong>registrar</strong>.',
      "The internet contains <strong>DNS servers</strong> which hold <strong>DNS records</strong>.",
      "DNS servers allow clients on the web to look up the IP address associated with a domain in the DNS record.",
      "DNS servers regularly refresh their records from authoritative name servers to keep the web up to date.",
    ];
    require_once __DIR__ . "/../../../partials/keyConcepts.php";
    ?>
  </article>

  <?php require_once __DIR__ . "/../../../partials/tutorialFooter.php"; ?>
</main>