<main>
  <article>
    <?php
    $breadcrumb = ["The Web", "Domains"];
    require_once __DIR__ . "/../../../templates/breadcrumb.php";
    ?>
    <h1>Domains</h1>
    <nav>
      <li>
        <a href="#what-is-a-domain">What is a Domain?</a>
      </li>
      <li>
        <a href="#who-owns-a-domain">Who Owns a Domain?</a>
      </li>
      <li>
        <a href="#what-is-dns">What is DNS?</a>
      </li>
    </nav>
    <section>
      <h2 id="what-is-a-domain">What is a Domain?</h2>

      <p>In the last tutorial we learnt that each computer on the internet has a unique identifier called an IP address. And that if that computer is a web server, we can type out its IP address into a web browser's address bar and request the data that it has available. If we wanted to host content on the web, we could just give out the IP address of our web server, however, we don't usually use IP addresses to access content on the web do we?</p>

      <p>That is where <strong>domain names</strong> come in. Domain names provide a human-readable address that corresponds to a web server on the internet for users to easily access its content. IP addresses are hard to remember and can change over time, so domain names act as an alias for a server which saves us a lot of trouble.</p>

      <p>Domain names have a simple structure made up of several parts separated by dots. In the context of regular web browsing we may naturally read them left to right, but in the context of domains, they are read <strong>right to left</strong>.</p>

      <figure>
        <img
          src="/assets/images/the-web/domains/domain.png"
          style="max-width: 280px;"
          alt="An example of a domain name"
          loading="lazy" />
        <figcaption>Figure 1 - An example of a domain name</figcaption>
      </figure>

      <p>A domain name consists of several components (like the one above) but generally these fall into one of two categories:</p>

      <ol>
        <li>A <strong>TLD</strong> (top-level domain)</li>
        <li>A <strong>label</strong></li>
      </ol>

      <p><strong>TLD</strong> stands for <em>top-level domain</em> and it tells users the general purpose of the service behind the domain name. Some generic TLDs don't require a web server's content to meet a specific criteria (e.g .com, .net, .org). But more specialised TLDs have special requirements. ".gov" for example, is only allowed to be used by governments.</p>

      <p><strong>Labels</strong> are components of the domain name that come after the TLD. Domain names can have multiple labels, for example, <a href="https://informatics.ed.ac.uk/" target="_blank">informatics.ed.ac.uk</a> is a valid domain name. A label located directly after the TLD is also called a <em>secondary-level domain</em> (SLD).</p>

      <p>So for example, Google controls the <em>google.com</em> domain. That means they can also create "subdomains" with different content located at each (e.g books.google.com, images.google.com) and have many labels in these subdomains.</p>
    </section>

    <section>
      <h2 id="who-owns-a-domain">Who Owns a Domain?</h2>

      <p>Domain names cannot be strictly <em>owned</em> because otherwise you would quickly end up with a few big companies buying up and hoarding all the domains. Instead, you pay for the <em>right</em> to use a domain name for a set period of time (usually 1 or more years), and can renew your right (which has priority over other people's applications for a domain). But you never <em>own</em> it, this is so in time the domain may become available again for other people to use.</p>

      <p>What if <em>I</em> want a domain? Anybody can obtain the right to a domain, typically through a <strong>registrar</strong>. A registrar is essentially a company that keeps information about domain names and other technical things like who registered it and so on. If you wanted to get a domain, you would typically go to a registrar's website and use their "whois" service to see whether a domain is available. <a href="https://www.whois.com/whois/" target="_blank">Try it here</a>!</p>

      <p>Then, if a domain is available and you want it, you can typically fill out a form on the registrar's website to get the domain. Once all the details have been filled out and the domain paid for, the registrar will let you know when the domain is properly registered and accessible on the web. Typically within a few hours, all DNS servers will have received the DNS record.</p>

      <p>If you have a web server that you want to serve content to the web from, you can also configure your domain to point to that server's IP in your registrar's dashboard.</p>
    </section>

    <section>

      <h2 id="what-is-dns">What is DNS?</h2>
      <p><strong>DNS</strong> stands for <em>Domain Name System</em> and is essentially what we've been talking about up until now in this tutorial. But domain names and registering them form part of a much larger ecosystem.</p>

      <p>On the internet you have <strong>DNS servers</strong>, which are special servers around the world that contain a large database of domain names and associated information about them, also known as a <strong>DNS record</strong>. These records are held for a certain amount of time before they are automatically invalidated and then refreshed from <a href="https://www.dnssystem.org/authoritative-dns-server-everything-you-need-to-know/" target="_blank">top-level DNS servers</a>, also known as <em>authorative name servers</em> (essentially big boss servers that manage the system). This process is also called <em>DNS refreshing</em> and is what allows a domain name registration to get out there on the web as previously mentioned.</p>

      <p>Ok, so let's say there is a web server with an associated domain name. How does your web browser/computer know how to get that web server's content if you are only giving it the domain name and not the exact identifier of the server (the IP address)?</p>

      <p>Well, your web browser will make a request to one or more DNS servers to see if they have the <strong>DNS record</strong>. If they do (which they usually should because of DNS refreshing), then the request can proceed to get the content from the web server with the associated IP address in the record. Your computer will then <strong>cache</strong> these values (store them locally) for a certain amount of time for future use. So instead, if you are visiting a domain in your web browser, your browser will first check the cache and ask your computer to see if it has the IP address. Then, if it does, it will use that value instead of checking DNS servers.

      <figure>
        <img src="/assets/images/the-web/domains/dns.png" style="max-width: 768px;" loading="lazy" alt="An overview of a network request with DNS" />
        <figcaption>Figure 2 - An overview of a network request to google.com</figcaption>
      </figure>

      <p>This process of registering domains, them being sent out to DNS servers via DNS refreshing, your web browser being able to query those servers and then cache those values, is what allows the web to work with domain names as seamlessly as it does; and provide us with easy to remember names for lots of different websites.</p>

    </section>
    <section>
      <h3>Key Concepts Learnt</h3>
      <ul>
        <li>Domain names provide a human-readable address that corresponds to a web server.</li>
        <li>Domains names consists of several parts to identify the content on a web server in a basic manner.</li>
        <li>"Ownership" of a domain can be checked and changed through a registrar.</li>
        <li>The internet contains DNS servers which hold DNS records.</li>
        <li>DNS servers allow clients on the web to look up the IP associated with a domain in the DNS record.</li>
        <li>DNS servers regularly refresh their records from authoritative name servers to keep the web up to date.</li>
      </ul>
    </section>
  </article>

  <?php
  $tutorial_id = 3;
  require_once __DIR__ . "/../../../templates/mark_complete_btn.php";

  $hot_links = ["/tutorials/the-web/how-the-web-works.php", null];
  require_once __DIR__ . "/../../../templates/hot_links.php"
  ?>
</main>