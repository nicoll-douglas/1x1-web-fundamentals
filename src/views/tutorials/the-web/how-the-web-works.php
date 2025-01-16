<main>
  <article>
    <?php
    $breadcrumb = ["The Web", "How The Web Works"];
    require_once __DIR__ . "/../../../templates/breadcrumb.php";
    ?>
    <h1>How The Web Works</h1>
    <section>
      <h2>What is the Internet?</h2>

      <p>The internet is essentially a big infrastructure of computers across the world that are able to communicate with each other and <strong>transfer data</strong>. But how did we get here?</p>

      <p>In order for computers to communicate they need to have a link between them, either physical (e.g Ethernet) or wirelss (e.g Wi-Fi, Bluetooth, etc). Before the days of the internet, this would have typically been a series of network cables between computers which would establish a small local network. Think a local library that needs to transfer files from the users' computers to the librarian's computer to print like the figure below.</p>

      <figure>
        <img src="/assets/images/the-web/how-the-web-works/library-network.png" style="max-width: 450px;" />
        <figcaption>Figure 1 - An example of what a library network could look like</figcaption>
      </figure>

      <p> Then we developed the <em>router</em>, a small computer for "routing" other computer communications between each other. Routers meant that computers can connect to and send their communications to a centralised computer rather than each other. It would then act as a traffic controller to relay a communication to the target computer, making the network more efficient. Think, if you have 10 computers in a network, connecting each to a router is more efficient than connecting each to the 9 other computers.</p>

      <figure>
        <img src="/assets/images/the-web/how-the-web-works/network-with-router.png" style="max-width: 320px;" />
        <figcaption>Figure 2 - An example of a network with a router</figcaption>
      </figure>

      <p>Ok so we can have lots of these small computer networks with a router around the place but how do we connect these networks together?</p>

      <p>Since routers are also computers, we <em>could</em> connect two routers together to join networks together. But typically this is where an Internet Service Provider (ISP) comes in. An ISP manages several special routers in different locations that are all linked together and can access other ISPs' routers. Once we connect our network's router to an ISP, and other networks do the same, we can communicate with computers on those networks. In the 90s this was established in dial-up internet which used telephone lines to transfer information from network to ISP and ISP to ISP. But nowadays the standard is subterranean fibre-optic cables which allow for high-speed, low-latency internet communication across the world.</p>
      <p>This infrastructure is essentially what the internet is and it facilitates computer communication and data transfer across the world.</p>
      <figure>
        <img src="/assets/images/the-web/how-the-web-works/modern-internet.png" alt="Modern Internet Infrastructure" style="max-width: 768px;" />
        <figcaption>Figure 3 - Modern Internet Infrastructure</figcaption>
      </figure>
    </section>
    <section>
      <h2>What is The Web?</h2>
      <p>Although used interchangeably, the web and the internet are slightly different. The <em>internet</em> is the infrastructure that enables communication between computers. But the <em>web</em> is a special service built on top of the internet that uses a certain protocol where some computers (web servers) can send special kinds of data to be requested and understood by web browsers. These specials kinds of data are often webpages.</p>

      <p>Other internet services like this also exist, for example email. A computer on the internet designed to receive emails may not be able to receive data from a <em>web</em> server on the internet, but both are services that use <em>internet</em> infrastructure to facilitate their communications.</p>
    </section>
    <section>
      <h2>Clients and Servers</h2>

      <p>Computers and entities that form the web follow a very basic pattern.</p>

      <p>Firstly, you have what is known as a <strong>client</strong>. A client is something or someone that is able to <strong>request</strong> and interpret data from a web server. Typically this is a <strong>web browser</strong> on someone's personal computer (e.g Google Chrome, Microsoft Edge etc), which is specifically designed for the job and ease of use.</p>

      <p>Secondly, you have what are known as <strong>servers</strong> or web servers. Servers are a special kind of computer (remember the internet is just computers talking to other computers). The main job of a web server is to make available, or <strong>provide/send</strong> the data that a <strong>client</strong> is requesting (e.g a webpage).</p>
    </section>
  </article>
</main>