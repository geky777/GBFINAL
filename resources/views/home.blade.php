<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Portfolio</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Spectral+SC:wght@500&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&display=swap" rel="stylesheet">

<style>
  html, body {
    margin: 0;
    background: #232430ff;
    color: #e6e4df;
    font-family: serif;
    scroll-behavior: smooth;

     /* ADD THESE TWO LINES */
     overflow-x: hidden;  /* prevent horizontal scrolling */
     width: 100vw;        /* fix width to viewport */
  }

  section {
    height: 100vh; 
    width: 100vw;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  /* Navbar */
  nav {
    position: fixed;
    top: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 28px;
    font-weight: 700;
    letter-spacing: 0.08em;
    z-index: 100;
  }
  nav a {
    color: #e6e4df;
    text-decoration: none;
    transition: color 0.18s ease;
  }
  nav a:hover { color: #d4af37; }

  /* ================= HOME ================= */
  #home {
  background: radial-gradient(circle at center, #1e1c15 0%, #141416 100%);
  background-image: url('images/paper-texture.png'); /* optional subtle texture */
  background-size: cover;
  background-blend-mode: multiply;
}

#home::after {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(white 1px, transparent 1px);
  background-size: 3px 3px;
  opacity: 0.06;
  animation: drift 15s infinite linear;
}

@keyframes drift {
  from { background-position: 0 0; }
  to { background-position: 100px 100px; }
}

h1 {
  

  letter-spacing: 3px;
}


  #home h1 {
    font-family: 'Cinzel Decorative', serif;
    color: #d4af37;
    text-shadow: 2px 2px 4px #000, 0 0 15px rgba(212,175,55,0.6);
    font-weight: 300;
    font-size: clamp(3rem, 8vw, 7rem);
    letter-spacing: 0.02em;
    text-align: left;
    position: absolute;
    top: 40%;
    left: 80px;
    margin-left: 20px;
    transform: translateY(-50%);
    user-select: none;
    pointer-events: none;
  }

  #home canvas {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    display: block;
    pointer-events: none;
    z-index: 2;
  }

  /* Home Card */
  .card {
    position: absolute;
    width: 280px;
    aspect-ratio: 2/3;
    border: 8px solid #f9efe0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0,0,0,0.65);
    cursor: grab;
    user-select: none;
    z-index: 5;
    transform-style: preserve-3d;
    transition: transform 0.9s cubic-bezier(0.68, -0.55, 0.27, 1.55), 
                box-shadow 0.4s ease;
    background: #fff;
  }
  .card::before {
    /* Slot at top like ID badge */
    content: "";
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 18px;
    background: #2a2a34;
    border-radius: 6px;
    z-index: 10;
  }
  .card.moving {
    box-shadow: 0 40px 100px rgba(212, 175, 55, 0.5),
                0 0 30px rgba(212, 175, 55, 0.8);
  }
  .card.flipped {
    transform: rotateY(180deg) scale(1.05) translateY(-10px) rotateZ(1deg);
  }
  @keyframes flipGlow {
    0%   { box-shadow: 0 0 0 rgba(212, 175, 55, 0); }
    40%  { box-shadow: 0 0 40px rgba(212, 175, 55, 0.9),
                     0 0 80px rgba(212, 175, 55, 0.6); }
    70%  { box-shadow: 0 0 25px rgba(212, 175, 55, 0.6),
                     0 0 50px rgba(212, 175, 55, 0.4); }
    100% { box-shadow: 0 30px 80px rgba(0,0,0,0.65); }
  }
  .flip-light {
    animation: flipGlow 0.8s ease;
  }
  .card-side {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
  }
  .card-side img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  .card-back {
    transform: rotateY(180deg);
  }

  /* ================= ABOUT ================= */
  #about {
    background: #20222b;
    margin-left:-3px;
    text-align: center;
    padding: 40px;
  }
  #about h2 {
    font-size: 3rem;
    margin-bottom: 20px;
    font-family: 'Cinzel Decorative', serif;
    color: #d4af37;
  }
  #about p {
    max-width: 800px;
    margin: auto;
    font-size: 1.3rem;
    line-height: 1.8;
    color: #e6e4df;
  }

  /* ================= PROJECTS ================= */
  #projects {
    background: #181921;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  #projects h2 {
    font-size: 3rem;
    font-family: 'Cinzel Decorative', serif;
    color: #d4af37;
    margin-bottom: 40px;
  }
  .project-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    perspective: 2000px;
  }
  .project-card {
    position: absolute;
    width: 340px;
    height: 460px;
    border-radius: 16px;
    overflow: hidden;
    border: 6px solid #f9efe0;
    background: #2a2a34;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    text-align: center;
    opacity: 0;
    transform: scale(0.7) translateY(50px) rotateY(10deg) rotateZ(-2deg);
    transition: transform 0.9s cubic-bezier(0.68,-0.55,0.27,1.55), 
                box-shadow 0.4s ease, 
                opacity 0.6s ease;
    box-shadow: 0 20px 60px rgba(0,0,0,0.6);
  }
  .project-card.show {
    opacity: 1;
    transform: scale(1) translateY(0) rotateY(0) rotateZ(0);
  }
  .project-card:hover {
    box-shadow: 0 30px 80px rgba(212, 175, 55, 0.5),
                0 0 40px rgba(212, 175, 55, 0.7);
    transform: scale(1.08) rotateY(0deg) rotateZ(0deg);
    z-index: 10;
  }
  .project-card img { width: 100%; height: 60%; object-fit: cover; }
  .project-card h3 { font-family: 'Cinzel Decorative', serif; font-size: 1.3rem; color: #d4af37; margin: 10px 0 4px; }
  .project-card h4 { font-size: 1rem; color: #e6e4df; margin: 0 0 8px; }
  .project-card p { font-size: 0.85rem; padding: 0 10px 10px; color: #cfcfcf; }

  .project-card.center { z-index: 5; }
  .project-card.side {
    opacity: 0;
    transform: scale(0.8);
    pointer-events: none;
  }
  .project-container.active .side.left1 {
    transform: translateX(-280px) scale(1) rotateY(20deg) rotateZ(-3deg);
    opacity: 1; pointer-events: auto;
  }
  .project-container.active .side.left2 {
    transform: translateX(-560px) scale(1) rotateY(25deg) rotateZ(-4deg);
    opacity: 1; pointer-events: auto;
  }
  .project-container.active .side.right1 {
    transform: translateX(280px) scale(1) rotateY(-20deg) rotateZ(3deg);
    opacity: 1; pointer-events: auto;
  }
  .project-container.active .side.right2 {
    transform: translateX(560px) scale(1) rotateY(-25deg) rotateZ(4deg);
    opacity: 1; pointer-events: auto;
  }
  /* ================= HOME ================= */

.title-block {
    position: absolute;
    top: 35%;
    left: 10px;
    transform: translateY(-30%);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: auto; /* allow text to stay on one line */
    white-space: nowrap; /* FORCE text to stay on single line */
    z-index: 10;
}

.main-title {
    font-family: 'Cinzel', serif;
    font-weight: 200;
    font-size: clamp(3rem, 9vw, 8rem);
    letter-spacing: 0.02em;
    margin: 0;
    padding: 0;
    color: #e6e4df;
    text-shadow: 0 6px 20px rgba(0,0,0,0.5);
    user-select: none;
    pointer-events: none;
}

.subtitle {
    font-size: 28px;
    font-family: 'Spectral SC', serif;
    font-weight: 300;
    color: #d1c5a2;
    margin-top: 110px;
    margin-left: 110px;
    letter-spacing: 3px;
    text-shadow: 0px 0px 6px rgba(255, 255, 200, 0.2);
    user-select: none;
    pointer-events: none;
}

.floating-shelf {
  color: #d4af37;
  margin-left: 50px;
  position: absolute;
  bottom: 120px;
  left: 80px;
  width: 240px;
  height: 8px;
  background: linear-gradient(to bottom, #b9935a, #6e5321);
  box-shadow: 0 6px 20px rgba(0,0,0,0.4);
  border-radius: 3px;
}

.quote {
  margin-left: 30px;
  margin-top: -30px;
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.2rem;
  color: #d4c6a0;
  position: absolute;
  bottom: 60px;
  left: 100px;
  opacity: 0.8;
  animation: fadeQuote 12s infinite;
}

@keyframes fadeQuote {
  0%, 100% { opacity: 0; transform: translateY(10px); }
  20%, 80% { opacity: 1; transform: translateY(0); }
}

/* ================= CONTACT ================= */
#contact {
  background: #20222b;
  padding: 60px 20px;
  display: flex;
  flex-direction: column;
  align-items: center; /* centers the title and cards horizontally */
  text-align: center;
}

#contact .contact-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center; /* centers all cards in one row */
  gap: 30px;
  margin-top: 30px; /* spacing below the title */
}

.contact-card {
  background: #2a2a34;
  padding: 20px;
  border-radius: 12px;
  width: 220px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.5);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.contact-img {
  width: 100px;
  height: 100px;
  border-radius: 50%; /* makes it circular */
  object-fit: cover;
  margin-bottom: 15px;
  border: 3px solid #d4af37; /* optional golden border */
}

.contact-card h3 {
  font-family: 'Cinzel', serif;
  color: #d4af37;
  margin-bottom: 8px;
}

.contact-card p {
  color: #e6e4df;
  margin: 0;
  font-size: 0.95rem;
}

.contact-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(212,175,55,0.6);
}

.contact-container {
  display: flex;
  justify-content: center; /* center cards horizontally */
  align-items: center;     /* center cards vertically */
  gap: 30px;               /* space between cards */
  flex-wrap: nowrap;       /* keep all cards in a single row */
  margin-top: 40px;
  overflow-x: auto;        /* optional: allow horizontal scroll on very small screens */
  padding: 0 20px;         /* optional: spacing on sides */
}

/* Contact Section Title */
#contact .section-title {
  text-align: center;
  margin-bottom: 40px;
}

#contact h2 {
  font-size: 3rem;
  font-family: 'Cinzel Decorative', serif;
  color: #d4af37;
  margin: 0;
}


</style>
</head>
<body>
  <nav>
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#projects">Projects</a>
    <a href="#contact">Members</a>
  </nav>

  <!-- HOME SECTION -->
  <section id="home">
    <div class="title-block">
      <h1 class="main-title">GREAT BOOKS</h1>
      <h2 class="subtitle">Literature Chronicles</h2>
    </div>

    <p class="quote">“A room without books is like a body without a soul.” – Cicero</p>

    <div class="floating-shelf"></div>


    <canvas id="stringCanvas"></canvas>
    <div class="card" id="card">
      <div class="card-side card-front">
        <img src="images/card.jpg" alt="Front">
      </div>
      <div class="card-side card-back">
        <img src="images/card-back.jpg" alt="Back">
      </div>
    </div>
  </section>

  <!-- ABOUT SECTION -->
  <section id="about">
    <div>
      <h2>Literary Archives</h2>
          <p>
            Welcome to our Literature Database Project — a creative online collection of timeless literary works. 
            This website serves as an interactive archive showcasing great writings from different eras, 
            including <b><em style="color: #d4af37;">The Color Purple</em></b> by Alice Walker and Robert Frost’s classics such as <br>
            <b><em style="color: #d4af37;">The Road Not Taken</em></b> and <b><em style="color: #d4af37;">Stopping by Woods on a Snowy Evening</em></b>. 
            Designed like a digital library, it aims to engage readers, students, and literature enthusiasts 
            through concise analyses, author insights, and thematic explorations. 
            Our goal is to celebrate the beauty of language and the lasting impact of these masterpieces 
            on modern thought and storytelling.
          </p>

    </div>
  </section>

  <!-- PROJECTS SECTION -->
  <section id="projects">
    <h2 >Projects</h2>
    <p style="margin-top: -50px; font-size: 20px;"  >Click twice to know more!</p>
    <div class="project-container" id="projectContainer">
    <div class="project-card center" 
     style="background: linear-gradient(rgba(104, 77, 53, 1), rgba(43, 31, 21, 1));">   
     <img src="{{ asset('asset/images/iliad.png') }}" alt="Main Project">
        <h3>Classical Age</h3>
        <h4>The Illiad</h4>
        <p>An epic poem that chronicles the wrath of Achilles during the Trojan War, exploring themes of honor, fate, and the human cost of pride.</p>
      </div>
      <div class="project-card side left1" onclick="window.location.href='{{ url('/color_purple') }}'">
        <img src="images/color_purple.jpg" alt="Project 1">
        <h3>The Color Purple</h3>
        <h4>Author: Alice Walker</h4>
        <p>A young African-American woman overcomes abuse and oppression to find her voice and independence.</p>
      </div>
      <div class="project-card side right1" onclick="window.location.href='{{ url('/robert') }}'">
        <img src="images/road-not-taken.jpg" alt="Project 3">
        <h3>The Road Not Taken</h3>
        <h4>Made by Robert Sheet</h4>
        <p>A traveler reflects on how choosing a less conventional path shapes the course of his life.</p>
      </div>
    </div>
    
  </section>

  <!-- MEMBERS SECTION -->
   <section id="contact">
  <div class="section-title">
    <h2>Members:</h2>
  </div>

  <div class="contact-container">
    <div class="contact-card">
      <h3>Sarah C. Abane</h3>
    </div>
    <div class="contact-card">
      <h3>Elaine Mae A. Bertiz</h3>
    </div>
    <div class="contact-card">
      <h3>Richard D. Bilan</h3>
    </div>
    <div class="contact-card">
      <h3>Annika Gail Cipriano</h3>
    </div>
    <div class="contact-card">
      <h3>Lord Zaro Fiber A. Quintanilla</h3>
    </div>
  </div>
</section>



<script>
/* === HOME Card Physics (with lanyard style) === */
const canvas = document.getElementById("stringCanvas");
const ctx = canvas.getContext("2d");
const card = document.getElementById("card");

let W = window.innerWidth;
let H = window.innerHeight;
canvas.width = W;
canvas.height = H;

const anchorOffsetX = 300;
const anchorOffsetY = 0;
let anchor = { x: W - anchorOffsetX, y: anchorOffsetY };

let cardPos = { x: anchor.x, y: -200 }; 
let cardVel = { x: 0, y: 0 };
let gravity = 0.4;
let stiffness = 0.02;
let damping = 0.98;

let dragging = false;
let dragOffset = { x: 0, y: 0 };
let hasLanded = false;

card.addEventListener("mousedown", e => {
  dragging = true;
  card.style.cursor = "grabbing";
  dragOffset.x = e.clientX - cardPos.x;
  dragOffset.y = e.clientY - cardPos.y;
});
document.addEventListener("mouseup", () => {
  dragging = false;
  card.style.cursor = "grab";
});
document.addEventListener("mousemove", e => {
  if (dragging) {
    cardPos.x = e.clientX - dragOffset.x;
    cardPos.y = e.clientY - dragOffset.y;
    cardVel.x = 0;
    cardVel.y = 0;
  }
});

card.addEventListener("click", () => {
  if (hasLanded) {
    card.classList.toggle("flipped");
    card.classList.add("flip-light");
    setTimeout(() => card.classList.remove("flip-light"), 800);
  }
});

function animate(){
  ctx.clearRect(0,0,W,H);

  let moving = false;

  if (!dragging) {
    cardVel.y += gravity;

    let dx = cardPos.x - anchor.x;
    let dy = cardPos.y - anchor.y;
    let dist = Math.sqrt(dx*dx + dy*dy);
    let ropeLength = H / 2;

    if (dist > ropeLength) {
      let diff = dist - ropeLength;
      let nx = dx / dist;
      let ny = dy / dist;
      cardVel.x -= nx * diff * stiffness;
      cardVel.y -= ny * diff * stiffness;
    }

    cardPos.x += cardVel.x;
    cardPos.y += cardVel.y;
    cardVel.x *= damping;
    cardVel.y *= damping;

    if (Math.abs(cardVel.x) > 0.5 || Math.abs(cardVel.y) > 0.5) {
      moving = true;
    }

    if (!hasLanded && Math.abs(cardVel.y) < 0.5 && cardPos.y > H/3) {
      hasLanded = true;
    }
  }

  // draw lanyard rope
  ctx.strokeStyle = "#f6e7c6";
  ctx.lineWidth = 6;
  ctx.beginPath();
  ctx.moveTo(anchor.x, anchor.y);
  // attach rope to slot position (top-center of card)
  ctx.lineTo(cardPos.x, cardPos.y - card.offsetHeight/2 - 8);
  ctx.stroke();

  card.style.left = (cardPos.x - card.offsetWidth / 2) + "px";
  card.style.top = (cardPos.y - card.offsetHeight / 2) + "px";

  if (moving) {
    card.classList.add("moving");
  } else {
    card.classList.remove("moving");
  }

  requestAnimationFrame(animate);
}
animate();

window.addEventListener("resize", () => {
  W = window.innerWidth;
  H = window.innerHeight;
  canvas.width = W;
  canvas.height = H;
  anchor.x = W - anchorOffsetX;
  anchor.y = anchorOffsetY;
});

/* === PROJECTS Cards Animation === */
window.addEventListener("load", () => {
  document.querySelectorAll(".project-card").forEach((card, i) => {
    setTimeout(() => card.classList.add("show"), i * 150);
  });
});

const projectContainer = document.getElementById("projectContainer");
const centerCard = projectContainer.querySelector(".center");
let clickTimer = null;

centerCard.addEventListener("click", (e) => {
  // Prevent single click if it was a double click
  if (clickTimer) return;

  clickTimer = setTimeout(() => {
    // Navigate to project1 route
    window.location.href = "{{ url('/opening-iliad') }}";
    clickTimer = null;
  }, 250); // 250ms delay to check for dblclick
});

centerCard.addEventListener("dblclick", (e) => {
  // Cancel single click navigation
  if (clickTimer) {
    clearTimeout(clickTimer);
    clickTimer = null;
  }
  // Toggle animation
  projectContainer.classList.toggle("active");
});

</script>
</body>
</html>
