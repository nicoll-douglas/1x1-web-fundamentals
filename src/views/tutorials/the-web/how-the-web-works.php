<main>
  <article>
    <?php
    $breadcrumb = ["The Web", "How The Web Works"];
    require_once __DIR__ . "/../../../partials/breadcrumb.php";
    ?>
    <h1>How The Web Works</h1>
    <nav>
      <ul>
        <li>
          <a href="#what-is-the-internet">What is the Internet?</a>
        </li>
        <li>
          <a href="#what-is-the-web">What is The Web?</a>
        </li>
        <li>
          <a href="#clients-and-servers">Clients and Servers</a>
        </li>
        <li>
          <a href="#accessing-the-web">Accessing The Web</a>
        </li>
      </ul>
    </nav>
    <section>
      <h2 id="what-is-the-internet">What is the Internet?</h2>

      <p>Welcome to the first tutorial. Before we can start building on the web, we must first understand what exactly is the internet.</p>

      <p>The internet is essentially a big infrastructure of computers across the world that are able to communicate with each other and <strong>transfer data</strong>. But how did we get here?</p>

      <p>In order for computers to communicate they need to have a link between them, either physical (e.g Ethernet) or wireless (e.g Wi-Fi, Bluetooth, etc). Before the days of the internet, this would have typically been a series of network cables between computers which would establish a small local network. Think a local library that needs to transfer files from the users' computers to the librarian's computer to print like the figure below.</p>

      <figure>
        <img
          src="/assets/images/the-web/how-the-web-works/library-network.png"
          alt="An example of what a library network could look like"
          style="max-width: 350px;" />
        <figcaption>Figure 1 - An example of what a library network could look like</figcaption>
      </figure>

      <p> Then we developed the <em>router</em>, a small computer for "routing" other computer communications between each other. Routers meant that computers can connect to and send their communications to a centralised computer rather than each other. It would then act as a traffic controller to relay a communication to the target computer, making the network more efficient. Think, if you have 10 computers in a network, connecting each to 1 router is more efficient than connecting each to 9 other computers if need be.</p>

      <figure>
        <img
          src="/assets/images/the-web/how-the-web-works/network-with-router.png"
          style="max-width: 350px;"
          alt="An example of a network with a routers"
          loading="lazy" />
        <figcaption>Figure 2 - An example of a network with a router</figcaption>
      </figure>

      <p>Ok so we can have lots of these small computer networks with a router around the place but how do we connect these networks together?</p>

      <p>Since routers are also computers, we <em>could</em> connect two routers together to join networks together. But typically this is where an Internet Service Provider (ISP) comes in. An ISP manages several special routers in different locations that are all linked together and can access other ISPs' routers. Once we connect our network's router to an ISP, and other networks do the same, we can communicate with computers on those networks. In the 90s this was established in dial-up internet which used telephone lines to transfer information from network to ISP and ISP to ISP. But nowadays the standard is subterranean fibre-optic cables which allow for high-speed, low-latency internet communication across the world.</p>

      <p>This infrastructure is essentially what the internet is.</p>

      <figure>
        <img
          src="/assets/images/the-web/how-the-web-works/modern-internet.png"
          alt="Modern Internet Infrastructure"
          style="max-width: 768px;"
          loading="lazy" />
        <figcaption>Figure 3 - Modern Internet Infrastructure</figcaption>
      </figure>

    </section>
    <section>
      <h2 id="what-is-the-web">What is The Web?</h2>

      <p>Although used interchangeably, the web and the internet are slightly different. The <em>internet</em> is the infrastructure that enables communication between computers. But the <em>web</em> is a special service built on top of the internet that uses a certain protocol where some computers (web servers; I'll explain these in the next section) can send special kinds of data to be requested and understood by web browsers. These specials kinds of data are often webpages. Keep this distinction in your mind from now on; when I say "internet" I will refer to the physical infrastructure, when I say "web" I will refer to the service.</p>

      <p>Anyway, other internet services like the web also exist, for example email. A computer on the internet designed to receive emails may not be able to receive data from a <em>web</em> server on the internet, but both the web and email are services that use <em>internet</em> infrastructure to facilitate their communications.</p>

      <p>So when we access a webpage or a resource through a web browser, we are communicating with a web server and this dynamic is what forms the web.</p>
    </section>
    <section>
      <h2 id="clients-and-servers">Clients and Servers</h2>

      <p>Computers and entities that form the web follow a very basic pattern.</p>

      <p>Firstly, you have what is known as a <strong>client</strong>. A client is something or someone that is able to <strong>request and interpret</strong> data from a web server. Typically this is a <strong>web browser</strong> on someone's personal computer (e.g Google Chrome, Microsoft Edge etc), which is specifically designed for the job and ease of use.</p>

      <p>Secondly, you have what are known as <strong>servers</strong> or web servers. Servers are a special kind of computer (remember the internet is just computers talking to other computers). The main job of a web server is to make available, and <strong>provide</strong> the data that a client is requesting (e.g a webpage).</p>

      <p>So when clients and servers on the web are communicating, typically a client will request some data from a web server and the web server will send the data back if it is available. This is part of what's called the <em>request-response cycle</em> and we will look at it more in depth in a future tutorial.</p>
    </section>
    <section>
      <h2 id="accessing-the-web">Accessing The Web</h2>
      <p>Ok so on the web we have clients and web servers, but if I'm sitting here with my web browser (client) open, how do I request data from a web server?</p>

      <p>Well, every computer on the internet has a unique address that identifies it called an <em>Internet Protocol address</em> (IP Address), kind of like a house address. It is an address typically made of four numbers separated by dots, for example: "142.250.190.78". We can type these addresses into our web browser and press enter, and if the address corresponds to a <em>web server</em>, it may send some data back that it has for the browser to interpret. So imagine, this process is kind of like opening Google Maps and navigating to a house address we want to visit, and then knocking on the door to see who opens up.</p>

      <p>But speaking of Google, for example, if we type the example IP address into our web browser's address bar:</p>

      <figure>
        <img
          src="/assets/images/the-web/how-the-web-works/ip-address.png"
          style="max-width: 185px;"
          loading="lazy"
          alt="An IP address typed into a web browser" />
        <figcaption>Figure 4 - The IP address typed into a web browser</figcaption>
      </figure>

      <p>The data that gets returned is Google's home webpage (at the time of writing; IP addresses can change) because that IP address corresponds to Google's web server, and they have made a homepage for themselves available on the web. Not only that, but they are able to respond to our request since we are making it through a web browser and the web browser follows protocols necessary for web communication:</p>

      <figure>
        <img
          src="/assets/images/the-web/how-the-web-works/google-page.png"
          style="max-width: 768px;"
          alt="Google's home webpage"
          loading="lazy" />
        <figcaption>Figure 5 - Google's home webpage</figcaption>
      </figure>

      <p>Now, you might be thinking, but what about domain names? I usually type "google.com" to access Google or any other website on the web instead of these random numbers. Well, understanding the internet, the web and IP addresses is the first step to getting there. We'll look at domain names in the next tutorial.</p>

    </section>

    <section>
      <h3>Key Concepts Learnt</h3>
      <ul>
        <li>The <em>internet</em> is an architecture that allows computers to communicate with each other.</li>
        <li>Every computer on the internet has a unique identifier called an <strong>IP address</strong>.</li>
        <li>The <em>web</em> is a service built on top of the internet that allows a web browser to request and interpret data from web servers.</li>
        <li>The web consists of <strong>clients</strong> (responsible for making data requests) and <strong>web servers</strong> (reponsible for responding to data requests).</li>
      </ul>
    </section>
  </article>
  <?php require_once __DIR__ . "/../../../partials/tutorialFooter.php"; ?>
</main>