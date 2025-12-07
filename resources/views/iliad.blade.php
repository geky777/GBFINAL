<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The Iliad - Interactive Archive</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Cormorant+Garamond:wght@300;400&display=swap" rel="stylesheet">

<style>
/* GENERAL STYLING */
* { margin:0; padding:0; box-sizing:border-box; }
body {
  font-family: 'Cormorant Garamond', serif;
  background: linear-gradient(to bottom, #1b1a27, #232430);
  color: #e6e4df;
  overflow-x: hidden;
}
a { text-decoration:none; color:#d4af37; }
a:hover { color:#fff; }

h1,h2,h3,h4 { font-family:'Cinzel Decorative', serif; color:#d4af37; }
header { text-align:center; padding:50px 20px; }
h1 { font-size:clamp(3rem,6vw,5rem); }
h2 { font-size:2.5rem; margin-top:10px; }

.content-container { max-width:1000px; margin:auto; padding:100px 20px 20px; }

/* TIMELINE */
.timeline { display:flex; justify-content:space-between; margin-top: -80px; margin-bottom: 40px; position:relative; }
.timeline::before { content:''; position:absolute; top:50%; left:5%; right:5%; height:4px; background:#d4af37; z-index:0; border-radius:2px; }
.timeline-point { z-index:1; text-align:center; cursor:pointer; }
.timeline-point:hover h4 { color:#fff; transform:scale(1.1); }
.timeline-point h4 { transition:0.3s; }

/* CHARACTER CARDS */
.character-container { display:flex; flex-wrap:wrap; gap:20px; justify-content:center; }
.character-card { background:#2a2a34; padding:20px; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.5); width:200px; transition:transform 0.3s; cursor:pointer; }
.character-card:hover { transform:translateY(-10px) scale(1.05); }
.character-card img { width:100%; border-radius:10px; margin-bottom:10px; }
.character-card p { font-size:0.9rem; }

/* QUOTES */
.quote { background: rgba(212,175,55,0.1); border-left:4px solid #d4af37; margin:20px 0; padding:15px 20px; font-style:italic; }
.quote:hover { background: rgba(212,175,55,0.3); transform:scale(1.02); transition:0.3s; }

/* BACK BUTTON */
.back-btn { position: fixed; top:20px; left:20px; padding:10px 20px; border:2px solid #d4af37; border-radius:6px; color:#d4af37; background:transparent; z-index:1000; transition:0.3s; }
.back-btn:hover { background:#d4af37; color:#232430; }

/* ANALYSIS CONTAINER */
.analysis-container { background:#2a2a34; padding:20px; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.5); text-align:justify; }
.analysis-container .analysis-text { font-size:1rem; line-height:1.6; }

/* AUTHOR CARD */
.author-card {
  background:#2a2a34;
  padding:15px;
  border-radius:15px;
  box-shadow:0 10px 25px rgba(0,0,0,0.5);
  text-align:center;
  width:250px;
  margin:30px auto;
}
.author-card h4 {
  color:#d4af37;
  margin-bottom:10px;
}

/* PLAY GAME SECTION */
#play-game { margin-top:30px; padding:20px; background:#2a2a34; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.5); }
#play-game h3 { margin-bottom:15px; text-align:center; }
#play-game button { margin:5px; padding:10px 15px; border:2px solid #d4af37; background:transparent; color:#d4af37; border-radius:5px; cursor:pointer; transition:0.3s; }
#play-game button:hover { background:#d4af37; color:#232430; }

/* MODAL */
.modal { 
  display:none; 
  position:fixed; 
  z-index:2000; 
  left:0; top:0; 
  width:100%; height:100%; 
  background-color:rgba(0,0,0,0.7); 
  align-items:center; 
  justify-content:center;
}
.modal.show { display:flex; }
.modal-content { 
  background-color:#2a2a34; 
  padding:20px; 
  border:2px solid #d4af37; 
  width:90%; max-width:600px; 
  border-radius:15px; 
  box-shadow:0 10px 25px rgba(0,0,0,0.5); 
  text-align:center;
}
.modal-content button { margin:5px; padding:10px 15px; border:2px solid #d4af37; background:transparent; color:#d4af37; border-radius:5px; cursor:pointer; transition:0.3s; }
.modal-content button:hover { background:#d4af37; color:#232430; }
.modal-close { float:right; font-size:1.5rem; cursor:pointer; color:#d4af37; }

section { opacity:0; transform:translateY(30px); transition: all 0.8s ease-in-out; margin-bottom:50px; }
section.visible { opacity:1; transform:translateY(0); }
</style>
</head>
<body>
<a href="{{ url('/#projects') }}" class="back-btn">← Back</a>

<header><h1>The Iliad</h1></header>

<div class="content-container">

  <div class="timeline">
    <div class="timeline-point" onclick="showTimelineEvent('Heroic Age')"><h4>Heroic Age</h4></div>
    <div class="timeline-point" onclick="showTimelineEvent('Greek Era')"><h4>Greek Era</h4></div>
    <div class="timeline-point" onclick="showTimelineEvent('Roman Era')"><h4>Roman Era</h4></div>
    <div class="timeline-point" onclick="showTimelineEvent('Patristic')"><h4>Patristic</h4></div>
  </div>

  <section>
    <h3>Summary</h3>
    <p>The Iliad tells the story of Achilles’ wrath during the Trojan War, exploring themes of honor, fate, and mortality.</p>
    <div class="quote">“Sing, O goddess, the anger of Achilles son of Peleus…”</div>
  </section>

  <section>
    <h3>Main Characters</h3>
    <div class="character-container">
      <div class="character-card">
        <img src="{{ asset('images/achilles.jpg') }}" alt="Achilles">
        <p><strong>Achilles:</strong> Greek warrior, prideful and unstoppable in battle.</p>
      </div>
      <div class="character-card">
        <img src="{{ asset('images/hector.jpg') }}" alt="Hector">
        <p><strong>Hector:</strong> Trojan prince and hero, defender of Troy.</p>
      </div>
      <div class="character-card">
        <img src="{{ asset('images/agamemnon.jpg') }}" alt="Agamemnon">
        <p><strong>Agamemnon:</strong> King of Mycenae and leader of the Achaean army.</p>
      </div>
    </div>
  </section>

  <section>
    <h3>Literary Analysis</h3>
    <div class="analysis-container">
      <div class="analysis-text">
        <p>The Iliad is written in <strong>dactylic hexameter</strong> and uses vivid Homeric similes. 
        It examines human pride, wrath, and fate—offering timeless reflections on the cost of glory.</p>
        <p><strong>Lesson:</strong> Pride and anger can lead to suffering, but honor and compassion can redeem even the fiercest warriors.</p>
      </div>
    </div>
  </section>
  
  <section>
    <h3>About the Author</h3>
    <div class="author-card">
      <h4>Homer</h4>
      <p>Homer is the legendary ancient Greek poet credited with composing <em>The Iliad</em> and <em>The Odyssey</em>. 
      His works shaped Western literature and storytelling traditions.</p>
    </div>
  </section>

  <section id="play-game">
    <h3>Do you want to play a game?</h3>
    <div style="text-align:center;">
      <button id="playYes">Yes</button>
      <button id="playNo">No</button>
    </div>
  </section>
</div>

<!-- MODAL -->
<div id="gameModal" class="modal" aria-hidden="true">
  <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="gameTitle">
    <div id="gameContent"></div>
  </div>
</div>

<script>
// Scroll animation
const sections = document.querySelectorAll('section');
function revealSections() {
  sections.forEach(sec => {
    const top = sec.getBoundingClientRect().top;
    if(top < window.innerHeight - 100) sec.classList.add('visible');
  });
}
revealSections();
window.addEventListener('scroll', revealSections);

// Modal setup
const modal = document.getElementById('gameModal');
const gameContent = document.getElementById('gameContent');
document.getElementById('playYes').onclick = openGameOptions;
document.getElementById('playNo').onclick = () => {
  gameContent.innerHTML = `<p style="text-align:center;">You can play anytime!</p>`;
  modal.classList.add('show');
  modal.setAttribute('aria-hidden', 'false');
};
modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

function openGameOptions() {
  modal.classList.add('show');
  modal.setAttribute('aria-hidden', 'false');
  showActivityOptions();
}
function closeModal() {
  modal.classList.remove('show');
  modal.setAttribute('aria-hidden', 'true');
}

function showActivityOptions() {
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Select an Activity</h3>
    <div>
      <button id="voteBtn">Vote for Your Hero</button>
      <button id="quizBtn">Iliad Trivia</button>
      <button id="quoteBtn">⚔️ Match the Quote</button>
    </div>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
  document.getElementById('voteBtn').onclick = startVote;
  document.getElementById('quizBtn').onclick = startQuiz;
  document.getElementById('quoteBtn').onclick = startQuoteGame;
}

function startVote() {
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Vote for Your Hero</h3>
    <p>Which Iliad hero inspires you most?</p>
    <div>
      <button onclick="voteHero('Achilles')">Achilles</button>
      <button onclick="voteHero('Hector')">Hector</button>
      <button onclick="voteHero('Agamemnon')">Agamemnon</button>
    </div>
    <p id="vote-result"></p>
    <button onclick="showActivityOptions()">Pick Another Activity</button>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
}
function voteHero(hero) {
  document.getElementById('vote-result').innerText = "You voted for " + hero + "! Thank you!";
}

// Trivia questions (with choices)
const trivia = [
  {q:"Who killed Hector?", a:"Achilles", choices:["Achilles","Priam","Agamemnon","Paris"]},
  {q:"Who is the king of Troy?", a:"Priam", choices:["Achilles","Priam","Agamemnon","Paris"]},
  {q:"Who took Briseis from Achilles?", a:"Agamemnon", choices:["Achilles","Hector","Agamemnon","Paris"]},
  {q:"Who shot Achilles' heel?", a:"Paris", choices:["Paris","Hector","Achilles","Zeus"]},
  {q:"What is the name of Achilles' close companion?", a:"Patroclus", choices:["Patroclus","Paris","Hector","Priam"]},
  {q:"Who wrote the Iliad?", a:"Homer", choices:["Homer","Zeus","Athena","Priam"]},
  {q:"Who was the goddess of wisdom aiding Greeks?", a:"Athena", choices:["Athena","Hera","Aphrodite","Hestia"]},
  {q:"Who is the wife of Hector?", a:"Andromache", choices:["Andromache","Helen","Cassandra","Briseis"]}
];
let currentIndex = 0;
let currentSet = [];
let triviaScore = 0;

function startQuiz() {
  currentSet = trivia.sort(()=>0.5-Math.random()).slice(0,5);
  currentIndex = 0;
  triviaScore = 0;
  showQuestion();
}

function showQuestion() {
  const q = currentSet[currentIndex];
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Iliad Trivia</h3>
    <p>${q.q}</p>
    <div id="choices"></div>
    <p id="quiz-feedback"></p>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;

  const choicesDiv = document.getElementById('choices');
  q.choices.sort(()=>0.5-Math.random()).forEach(choice => {
    const btn = document.createElement('button');
    btn.innerText = choice;
    btn.onclick = () => checkTrivia(choice);
    choicesDiv.appendChild(btn);
  });
}

function checkTrivia(answer) {
  const correct = currentSet[currentIndex].a;
  const feedback = document.getElementById('quiz-feedback');
  if(answer === correct){
    feedback.innerText = "✅ Correct!";
    triviaScore++;
  } else {
    feedback.innerText = "❌ The correct answer was " + correct;
  }
  currentIndex++;
  if(currentIndex < currentSet.length){
    setTimeout(showQuestion, 1000);
  } else {
    setTimeout(showQuizScore, 1000);
  }
}

function showQuizScore() {
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Quiz Completed!</h3>
    <p>Your score: ${triviaScore} / ${currentSet.length}</p>
    <button onclick="startQuiz()">Continue Playing</button>
    <button onclick="showActivityOptions()">Pick Another Activity</button>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
}

// Match the Quote
const quotes = [
  {q:"'Let me not then die ingloriously and without a struggle.'", a:"Hector"},
  {q:"'Sing, O goddess, the anger of Achilles son of Peleus.'", a:"Homer"},
  {q:"'The gods envy us because we’re mortal.'", a:"Achilles"},
  {q:"'Even the bravest cannot fight beyond his strength.'", a:"Homer"},
  {q:"'There is nothing alive more agonized than man.'", a:"Zeus"},
  {q:"'May the dogs devour you by our ships!'", a:"Achilles"},
  {q:"'I wish I had never been born to hear the wailing of my son.'", a:"Priam"}
];
let quoteIndex = 0;
let quoteSet = [];
let quoteScore = 0;

function startQuoteGame() {
  quoteSet = quotes.sort(()=>0.5-Math.random()).slice(0,5);
  quoteIndex = 0;
  quoteScore = 0;
  showQuote();
}

function showQuote() {
  const q = quoteSet[quoteIndex];
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>⚔️ Match the Quote!</h3>
    <p style="font-style:italic;">${q.q}</p>
    <div>
      <button onclick="matchQuote('Achilles')">Achilles</button>
      <button onclick="matchQuote('Hector')">Hector</button>
      <button onclick="matchQuote('Homer')">Homer</button>
      <button onclick="matchQuote('Priam')">Priam</button>
      <button onclick="matchQuote('Zeus')">Zeus</button>
    </div>
    <p id="quote-feedback"></p>
  `;
  
  document.getElementById('closeModalBtn').onclick = closeModal;
}

function matchQuote(ans) {
  const correct = quoteSet[quoteIndex].a;
  const feedback = document.getElementById('quote-feedback');
  if(ans===correct){
    feedback.innerText = "✅ Correct!";
    quoteScore++;
  } else {
    feedback.innerText = "❌ It was " + correct;
  }
  quoteIndex++;
  if(quoteIndex < quoteSet.length){
    setTimeout(showQuote, 1000);
  } else {
    setTimeout(showQuoteScore, 1000);
  }
}

function showQuoteScore() {
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Game Completed!</h3>
    <p>Your score: ${quoteScore} / ${quoteSet.length}</p>
    <button onclick="startQuoteGame()">Continue Playing</button>
    <button onclick="showActivityOptions()">Pick Another Activity</button>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
}

function showTimelineEvent(period){
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Period: ${period}</h3>
    <p>Learn more about events, battles, and heroes here!</p>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
}
</script>

</body>
</html>
