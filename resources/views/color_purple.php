<?php
$homeUrl = route('home');
?>
<script>
    window.homeUrl = "<?php echo $homeUrl; ?>";
</script>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The Color Purple - Alice Walker</title>

<!-- Fonts: Anime/Manga Style -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&family=Indie+Flower&family=Kosugi+Maru&display=swap" rel="stylesheet">

<style>
    /* VARIABLES */
    :root {
        --bg-color: #1a1025;
        --primary: #ff5eb4; /* Neon Pink */
        --secondary: #00e5ff; /* Cyan */
        --accent: #ffd700; /* Anime Gold */
        --card-bg: rgba(30, 20, 50, 0.85);
        --text-color: #f0f0f0;
        
        --font-heading: 'Kosugi Maru', sans-serif;
        --font-body: 'Fredoka', sans-serif;
        --font-hand: 'Indie Flower', cursive;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: var(--font-body);
        background-color: var(--bg-color);
        color: var(--text-color);
        overflow-x: hidden;
        /* Dot pattern */
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
    }

    /* SCREENS */
    .screen {
        display: none;
        width: 100%;
        min-height: 100vh;
        position: relative;
    }
    .screen.active { display: flex; flex-direction: column; }

    /* TITLE SCREEN */
    #title-screen {
        justify-content: center;
        align-items: center;
        text-align: center;
        background: linear-gradient(135deg, #2a0845 0%, #6441a5 100%);
    }

    h1 {
        font-family: var(--font-heading);
        font-size: 4rem;
        background: linear-gradient(to right, var(--primary), #fff, var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
        text-shadow: 0 0 20px rgba(255, 94, 180, 0.5);
    }

    .subtitle {
        font-family: var(--font-hand);
        font-size: 1.5rem;
        color: var(--accent);
        letter-spacing: 2px;
        margin-bottom: 50px;
    }

    .start-btn {
        padding: 20px 60px;
        font-size: 1.5rem;
        font-family: var(--font-heading);
        background: var(--primary);
        color: white;
        border: 4px solid rgba(255,255,255,0.3);
        border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 0 30px var(--primary);
        transition: 0.2s;
        text-transform: uppercase;
    }
    .start-btn:hover {
        transform: scale(1.05);
        background: #ff85c8;
    }

    /* VN SCREEN */
    #vn-screen {
        background-image: url('attached_assets/generated_images/anime_style_rural_landscape_at_sunset.png');
        background-size: cover;
        background-position: center;
        justify-content: flex-end;
        padding-bottom: 50px;
    }
    
    .character-sprite {
        position: absolute;
        bottom: 0;
        left: 5%;
        height: 70vh;
        z-index: 1;
        filter: drop-shadow(0 0 20px rgba(255,255,255,0.2));
        display: flex;
        align-items: flex-end;
    }
    
    .character-sprite img {
        height: 100%;
        width: auto;
    }

    .dialogue-box {
        position: relative;
        z-index: 10;
        width: 90%;
        max-width: 800px;
        margin: 0 auto;
        background: rgba(0, 0, 0, 0.85);
        border: 2px solid var(--primary);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 0 20px var(--primary);
        cursor: pointer;
    }

    .name-tag {
        position: absolute;
        top: -20px;
        left: 20px;
        background: var(--primary);
        color: white;
        padding: 5px 30px;
        font-family: var(--font-heading);
        font-size: 1.2rem;
        transform: skewX(-10deg);
        box-shadow: 5px 5px 0 rgba(0,0,0,0.5);
    }

    .dialogue-text {
        font-family: var(--font-hand);
        font-size: 1.8rem;
        color: white;
        line-height: 1.4;
    }

    .continue-indicator {
        position: absolute;
        bottom: 10px;
        right: 20px;
        color: var(--accent);
        animation: bounce 1s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    /* ARCHIVE SCREEN */
    #archive-screen {
        padding: 50px 20px;
        background: var(--bg-color);
        overflow-y: auto;
    }

    .archive-nav {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }
    .archive-nav button {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
        font-family: var(--font-heading);
    }
    .archive-nav button.active {
        background: var(--primary);
        border-color: var(--primary);
        box-shadow: 0 0 15px var(--primary);
    }

    .archive-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .anime-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        transition: 0.3s;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .anime-card:hover {
        transform: translateY(-10px) rotate(1deg);
        box-shadow: 10px 10px 0 var(--secondary);
        border-color: var(--secondary);
    }

    .card-top-bar { height: 8px; width: 100%; }
    .bg-primary { background-color: var(--primary); }
    .bg-secondary { background-color: var(--secondary); }
    .bg-accent { background-color: var(--accent); }

    .card-content { padding: 25px; }
    .card-content h3 { font-size: 1.8rem; margin-bottom: 10px; color: white; }
    
    /* GAME/QUIZ STYLES */
    .quiz-container {
        background: rgba(0,0,0,0.6);
        border: 2px solid var(--accent);
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        max-width: 600px;
        margin: 0 auto;
    }
    .quiz-question {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: var(--accent);
    }
    .quiz-options button {
        display: block;
        width: 100%;
        margin: 10px 0;
        padding: 15px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        border-radius: 8px;
        cursor: pointer;
        text-align: left;
        transition: 0.2s;
    }
    .quiz-options button:hover {
        background: var(--primary);
        color: black;
    }

    .tab-content { display: none; }
    .tab-content.active { display: grid; } /* Grid for card layout */
    .tab-content.active.block-layout { display: block; } /* Block for other layouts */

</style>
</head>
<body>

    <!-- TITLE SCREEN -->
    <div id="title-screen" class="screen active">
        <div>
            <h1>The Color Purple</h1>
            <p class="subtitle">Interactive Visual Novel</p>
            <button class="start-btn" onclick="switchScreen('vn')">Start Story</button>
        </div>
        <button 
    onclick="window.location.href = window.homeUrl;"
    style="padding:10px; background:var(--primary); border-radius:50%; cursor:pointer; box-shadow:0 0 10px var(--primary); border:none;"
    title="Back"
>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" viewBox="0 0 24 24">
        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
    </svg>
</button>

    </div>

    <!-- VN SCREEN -->
    <div id="vn-screen" class="screen">
        <button style="position:absolute; top:20px; right:20px; background:rgba(0,0,0,0.5); color:white; border:1px solid white; padding:10px;" onclick="switchScreen('archive')">SKIP >></button>
        
        <div class="character-sprite">
            <img src="/images/celie-art.png"  alt="Celie">
        </div>

        <div class="dialogue-box" onclick="advanceDialogue()">
            <div class="name-tag" id="speaker-name">Celie</div>
            <p class="dialogue-text" id="dialogue-text"></p>
            <div class="continue-indicator">▼</div>
        </div>
    </div>

    <!-- ARCHIVE SCREEN -->
    <div id="archive-screen" class="screen">
        <div class="archive-header">
            <h2 style="font-size:2rem; color:white;">/// The Color Purple Archives</h2>
        </div>

        <div class="archive-nav">
            <button class="active" onclick="switchTab('chars')">Characters</button>
            <button onclick="switchTab('themes')">Themes</button>
            <button onclick="switchTab('author')">Author</button>
            <button onclick="switchTab('games')">Games</button>
            <button onclick="location.reload()" style="border-color: #ff5eb4; color: #ff5eb4;">EXIT</button>
            
        </div>

        <!-- CHARACTERS TAB -->
        <div id="tab-chars" class="tab-content active grid">
            <div class="anime-card">
                <div class="card-top-bar bg-primary"></div>
                <div class="card-content">
                    <h3>Celie</h3>
                    <p>Protagonist. Transforms from victim to independent woman.</p>
                </div>
            </div>
            <div class="anime-card">
                <div class="card-top-bar bg-accent"></div>
                <div class="card-content">
                    <h3>Shug Avery</h3>
                    <p>Catalyst. Teaches Celie about love and confidence.</p>
                </div>
            </div>
             <div class="anime-card">
                <div class="card-top-bar bg-secondary"></div>
                <div class="card-content">
                    <h3>Nettie</h3>
                    <p>Observer. Missionary in Africa, keeper of history.</p>
                </div>
            </div>
             <div class="anime-card">
                <div class="card-top-bar bg-primary"></div>
                <div class="card-content">
                    <h3>Sofia</h3>
                    <p>Warrior. Fights oppression physically.</p>
                </div>
            </div>
        </div>

        <!-- THEMES TAB -->
        <div id="tab-themes" class="tab-content grid">
             <div class="anime-card">
                <div class="card-content">
                    <h3>Voice & Letters</h3>
                    <p>Writing is Celie's path to self-discovery and survival.</p>
                </div>
            </div>
            <div class="anime-card">
                <div class="card-content">
                    <h3>Sisterhood</h3>
                    <p>Quilting symbolizes women coming together.</p>
                </div>
            </div>
        </div>

        <!-- AUTHOR TAB -->
        <div id="tab-author" class="tab-content grid">
             <div class="anime-card">
                <div class="card-content">
                    <h3>Alice Walker</h3>
                    <p>Alice Walker (born 1944) is an American novelist, poet, and activist, best known for her Pulitzer Prize-winning novel *The Color Purple* (1982), which explores racism, sexism, and personal growth in the American South. She is also a prominent voice in civil rights and feminist movements.</p>
                    <img src="/images/alice.jpg" alt="alice" 
     style="width: 30%; height: auto; border-radius: 8px; margin: 10px auto 0 auto; display: block;" />

                </div>
            </div>
        </div> 

        <!-- GAMES TAB -->
        <div id="tab-games" class="tab-content block-layout">
            <div class="quiz-container">
                <div id="quiz-view">
                    <h3 style="color:white; margin-bottom:10px;">KNOWLEDGE CHECK</h3>
                    <p class="quiz-question" id="quiz-q">Who does Celie write to?</p>
                    <div class="quiz-options" id="quiz-opts">
                    </div>
                    <p id="quiz-score" style="margin-top:20px; color:var(--secondary);"></p>
                </div>
            </div>
        </div>

    </div>

<script>
    // --- VN LOGIC ---
    const SCRIPT = [
        { speaker: "Celie", text: "Dear God... I am fourteen years old. I have always been a good girl." },
        { speaker: "Celie", text: "Maybe you can give me a sign letting me know what is happening to me." },
        { speaker: "Celie", text: "I don't know who else to tell. The world is so big, and I feel so small in this field." },
        { speaker: "System", text: "Welcome to the Interactive Archive. Accessing files..." }
    ];

    let currentLine = 0;
    let isTyping = false;
    let typeInterval;

    function switchScreen(screenId) {
        document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
        document.getElementById(screenId + '-screen').classList.add('active');
        if(screenId === 'vn') {
            currentLine = 0;
            showDialogue(0);
        }
    }

    function showDialogue(index) {
        if(index >= SCRIPT.length) {
            switchScreen('archive');
            return;
        }
        const line = SCRIPT[index];
        document.getElementById('speaker-name').innerText = line.speaker;
        const textEl = document.getElementById('dialogue-text');
        textEl.innerText = "";
        isTyping = true;
        let i = 0;
        clearInterval(typeInterval);
        typeInterval = setInterval(() => {
            textEl.innerText += line.text.charAt(i);
            i++;
            if(i >= line.text.length) {
                clearInterval(typeInterval);
                isTyping = false;
            }
        }, 30);
    }

    function advanceDialogue() {
        if(isTyping) {
            clearInterval(typeInterval);
            document.getElementById('dialogue-text').innerText = SCRIPT[currentLine].text;
            isTyping = false;
        } else {
            currentLine++;
            showDialogue(currentLine);
        }
    }

    // --- TAB LOGIC ---
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.archive-nav button').forEach(b => b.classList.remove('active'));
        
        const tab = document.getElementById('tab-' + tabId);
        tab.classList.add('active');
        // Add special class for layout if needed
        if(tabId === 'games') tab.classList.add('block-layout');
        
        event.target.classList.add('active');
    }

    // --- QUIZ LOGIC ---
    const QUESTIONS = [
        { q: "Who does Celie originally write her letters to?", opts: ["Her sister Nettie", "God", "Shug Avery", "Her mother"], a: 1 },
        { q: "What does the quilt symbolize?", opts: ["Poverty", "Sisterhood & Unity", "A simple blanket", "Old traditions"], a: 1 },
        { q: "What is the significance of the color purple?", opts: ["Royalty", "Sadness", "Appreciating life's beauty", "Anger"], a: 2 }
    ];
    let qIndex = 0;
    let score = 0;

    function loadQuiz() {
        if(qIndex >= QUESTIONS.length) {
            document.getElementById('quiz-view').innerHTML = `<h3>Quiz Complete!</h3><p style="font-size:2rem; color:var(--accent);">${score} / ${QUESTIONS.length}</p><button onclick="location.reload()" style="margin-top:20px; padding:10px; background:var(--primary); border:none; border-radius:5px; cursor:pointer;">Restart</button>`;
            return;
        }
        const q = QUESTIONS[qIndex];
        document.getElementById('quiz-q').innerText = q.q;
        const optsDiv = document.getElementById('quiz-opts');
        optsDiv.innerHTML = "";
        q.opts.forEach((opt, idx) => {
            const btn = document.createElement('button');
            btn.innerText = opt;
            btn.onclick = () => checkAnswer(idx);
            optsDiv.appendChild(btn);
        });
    }

    function checkAnswer(idx) {
        if(idx === QUESTIONS[qIndex].a) score++;
        qIndex++;
        loadQuiz();
    }
    
    // Init Quiz
    loadQuiz();

</script>

</body>
</html>
