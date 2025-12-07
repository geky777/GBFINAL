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
    <title>The Road Not Taken - Frost.OS</title>
    
    <!-- React & ReactDOM -->
    <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    
    <!-- Babel -->
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    
    <!-- Framer Motion -->
    <script src="https://unpkg.com/framer-motion@10.16.4/dist/framer-motion.js"></script>
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#050b14',
                        primary: '#bae6fd',
                        accent: '#f472b6',
                    },
                    fontFamily: {
                        heading: ['Cinzel', 'serif'],
                        body: ['Quicksand', 'sans-serif'],
                        ui: ['Exo 2', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Quicksand:wght@400;600;700&family=Exo+2:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body { margin: 0; background: #050b14; color: white; overflow-x: hidden; }
        .glass-panel {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(186, 230, 253, 0.3);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }
        .vn-box {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.95) 100%);
            border: 2px solid #bae6fd;
            box-shadow: 0 0 15px #bae6fd;
            border-radius: 12px;
            position: relative;
        }
        .vn-box::after {
            content: ''; position: absolute; bottom: 10px; right: 10px; width: 10px; height: 10px;
            background: #bae6fd; border-radius: 50%; animation: pulse 1s infinite;
        }
        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }
        .glow-text { text-shadow: 0 0 10px #bae6fd; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: rgba(0,0,0,0.3); }
        ::-webkit-scrollbar-thumb { background: #bae6fd; border-radius: 3px; }
    </style>
</head>
<body>
    <div id="root"></div>
    @verbatim
    <script type="text/babel">
        const { useState, useEffect, useRef } = React;
        const { motion, AnimatePresence, useScroll, useTransform } = window.Motion;

        // Images
        const frostPortrait = "https://images.unsplash.com/photo-1455582916367-25f75bfc5539?auto=format&fit=crop&q=80&w=200&h=200";
        const roadBg = "https://images.unsplash.com/photo-1440615496174-ee7ec28f0dd2?auto=format&fit=crop&q=80&w=2000";

        // Icons
        const Icons = {
            BookOpen: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>,
            Search: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>,
            Gamepad2: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><line x1="6" x2="10" y1="12" y2="12"/><line x1="8" x2="8" y1="10" y2="14"/><line x1="15" x2="15.01" y1="13" y2="13"/><line x1="18" x2="18.01" y1="11" y2="11"/><rect width="20" height="12" x="2" y="6" rx="2"/></svg>,
            X: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><path d="M18 6 6 18"/><path d="m6 6 18 18"/></svg>,
            User: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>,
            Lightbulb: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-1 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"/></svg>,
            Sparkles: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M9 3v4"/><path d="M3 5h4"/><path d="M3 9h4"/></svg>,
            ArrowRight: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>,
            RotateCcw: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>,
            Activity: (props) => <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...props}><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
        };

        // --- DATA ---
        const POEM = [
            ["Two roads diverged in a yellow wood,", "And sorry I could not travel both", "And be one traveler, long I stood", "And looked down one as far as I could", "To where it bent in the undergrowth;"],
            ["Then took the other, as just as fair,", "And having perhaps the better claim,", "Because it was grassy and wanted wear;", "Though as for that the passing there", "Had worn them really about the same,"],
            ["And both that morning equally lay", "In leaves no step had trodden black.", "Oh, I kept the first for another day!", "Yet knowing how way leads on to way,", "I doubted if I should ever come back."],
            ["I shall be telling this with a sigh", "Somewhere ages and ages hence:", "Two roads diverged in a wood, and I—", "I took the one less traveled by,", "And that has made all the difference."]
        ];

        const ANALYSIS = [
            { title: "Metaphor of Choice", val: "98%", content: "The 'two roads' represent life's choices. The fork in the road is a classic metaphor for a pivotal moment where a decision must be made that will alter the course of one's life." },
            { title: "The 'Sigh'", val: "Ambiguous", content: "Is it a sigh of relief or regret? The poem doesn't say. It suggests that looking back, we will assign meaning to our choices, perhaps claiming they made 'all the difference' even if the roads were really about the same." },
            { title: "Isolation", val: "100%", content: "The traveler is alone. 'And be one traveler, long I stood'. The solitude of decision making is emphasized. No one can make the choice for you." }
        ];

        const AUTHOR_INFO = {
            name: "Robert Frost",
            birth: "1874",
            death: "1963",
            style: "Rural, Realistic, Philosophical",
            bio: "Robert Frost was an American poet. His work was initially published in England before it was published in the United States. Known for his realistic depictions of rural life and his command of American colloquial speech, Frost frequently wrote about settings from rural life in New England in the early twentieth century, using them to examine complex social and philosophical themes."
        };

        // --- COMPONENTS ---

        function Snowfall() {
            const [flakes, setFlakes] = useState([]);
            useEffect(() => {
                setFlakes(Array.from({ length: 30 }).map((_, i) => ({
                    id: i,
                    left: Math.random() * 100,
                    duration: Math.random() * 10 + 10,
                    delay: Math.random() * 10,
                    size: Math.random() * 0.5 + 0.5,
                })));
            }, []);
            return (
                <div className="fixed inset-0 pointer-events-none z-10 overflow-hidden">
                    {flakes.map(f => (
                        <div key={f.id} className="absolute -top-4 text-white/40 select-none"
                            style={{ 
                                left: `${f.left}vw`, 
                                fontSize: `${f.size}em`, 
                                animation: `fall ${f.duration}s linear ${f.delay}s infinite forwards` 
                            }}>
                            ❄
                        </div>
                    ))}
                    <style>{`@keyframes fall { to { transform: translateY(110vh) rotate(360deg); } }`}</style>
                </div>
            );
        }

        function TreeMarker({ index, active, onClick }) {
            return (
                <motion.button
                    whileHover={{ scale: 1.1 }}
                    whileTap={{ scale: 0.9 }}
                    onClick={onClick}
                    className={`relative group flex flex-col items-center justify-end h-80 w-32 transition-all duration-500 cursor-pointer ${active ? 'z-20 scale-110' : 'z-0 grayscale hover:grayscale-0'}`}
                >
                    <div className={`w-4 h-48 bg-amber-950 rounded-full mx-auto relative ${active ? 'shadow-[0_0_30px_rgba(255,255,0,0.3)]' : ''}`}>
                        <div className="absolute bottom-full left-1/2 -translate-x-1/2 w-32 h-32 bg-[#2d4a22] rounded-full blur-[1px] shadow-lg border-b-4 border-black/20" />
                        <div className="absolute bottom-[90%] left-1/2 -translate-x-1/2 w-28 h-28 bg-[#3a5e2a] rounded-full blur-[1px]" />
                        <div className="absolute bottom-[80%] left-1/2 -translate-x-1/2 w-36 h-32 bg-[#1e3316] rounded-full blur-[1px] -z-10" />
                        {active && (
                            <motion.div 
                                animate={{ opacity: [0.4, 0.8, 0.4] }}
                                transition={{ duration: 2, repeat: Infinity }}
                                className="absolute -inset-20 bg-yellow-400/20 blur-xl rounded-full"
                            />
                        )}
                    </div>
                    <div className="mt-4 px-3 py-1 bg-black/60 backdrop-blur text-white text-xs font-heading border border-white/20 rounded-full shadow-lg group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                        Stanza {index + 1}
                    </div>
                </motion.button>
            );
        }

        function MiniGame() {
          const [gameState, setGameState] = useState('start');
          const [timeLeft, setTimeLeft] = useState(10);
          const [score, setScore] = useState(0);
          const [pathChoice, setPathChoice] = useState(null);
          
          useEffect(() => {
            if (gameState !== 'playing') return;
            const timer = setInterval(() => {
              setTimeLeft(t => {
                if (t <= 1) {
                  setGameState('end');
                  return 0;
                }
                return t - 1;
              });
            }, 1000);
            return () => clearInterval(timer);
          }, [gameState]);

          const choosePath = (type) => {
            setPathChoice(type);
            if (type === 'grassy') setScore(s => s + 100);
            else setScore(s => s + 20);
            
            setTimeout(() => {
                setGameState('end');
            }, 1500);
          };

          const startGame = () => {
            setScore(0);
            setPathChoice(null);
            setTimeLeft(10);
            setGameState('playing');
          };

          return (
            <div className="w-full h-full flex flex-col items-center justify-center relative overflow-hidden bg-[#0f172a] font-body p-6">
              
              <div className="absolute inset-0 flex items-center justify-center opacity-30">
                 <div className="w-[150%] h-[150%] bg-[radial-gradient(circle,rgba(56,189,248,0.2)_1px,transparent_1px)] bg-[length:20px_20px]" />
              </div>

              {gameState === 'start' && (
                <div className="z-20 text-center space-y-8 max-w-md animate-in fade-in zoom-in duration-500">
                  <h2 className="text-4xl font-heading text-primary glow-text">THE MOMENT OF TRUTH</h2>
                  <p className="text-white/80 text-xl leading-relaxed">
                    You have <span className="text-primary font-bold">10 seconds</span> to make a choice that defines your journey.
                  </p>
                  <motion.button
                    whileHover={{ scale: 1.05 }}
                    whileTap={{ scale: 0.95 }}
                    onClick={startGame}
                    className="px-10 py-4 bg-primary text-primary-foreground font-heading font-bold text-lg rounded-full shadow-[0_0_30px_rgba(186,230,253,0.5)]"
                  >
                    FACE THE FORK
                  </motion.button>
                </div>
              )}

              {gameState === 'playing' && !pathChoice && (
    <div className="z-20 w-full max-w-4xl flex flex-col items-center gap-10 animate-in fade-in duration-500">
        <div className="text-5xl font-heading text-white drop-shadow-lg">{timeLeft}</div>
        <h3 className="text-2xl text-white/90 font-heading text-center">Which way will you go?</h3>
        
        <div className="flex flex-col md:flex-row gap-8 w-full justify-center">

            {/* GRASSY PATH */}
            <motion.button
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
                onClick={() => choosePath('grassy')}
                className="p-6 w-full md:w-1/2 bg-green-700/40 border border-green-300/40 rounded-xl text-white font-heading shadow-lg hover:bg-green-600/40 transition-all"
            >
                🌿 Take the **Grassy Path**
                <div className="text-sm text-green-200">High reward • Less traveled</div>
            </motion.button>

            {/* WORN PATH */}
            <motion.button
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
                onClick={() => choosePath('worn')}
                className="p-6 w-full md:w-1/2 bg-gray-700/40 border border-gray-300/40 rounded-xl text-white font-heading shadow-lg hover:bg-gray-600/40 transition-all"
            >
                🛤️ Take the **Worn Path**
                <div className="text-sm text-gray-200">Safer • Familiar route</div>
            </motion.button>

        </div>
    </div>
)}


              {pathChoice && gameState !== 'end' && (
                  <div className="z-20 text-center animate-in fade-in zoom-in duration-700">
                      <h2 className="text-4xl font-heading text-white mb-4">You chose the {pathChoice} road...</h2>
                  </div>
              )}

              {gameState === 'end' && (
                <div className="z-20 text-center space-y-6 max-w-lg p-8 bg-black/60 backdrop-blur-xl rounded-2xl border border-white/10 animate-in fade-in zoom-in duration-500">
                  <h2 className="text-3xl font-heading text-white">THE OUTCOME</h2>
                  
                  <div className="p-6 bg-white/5 rounded-xl border border-white/10 italic text-primary/90 font-heading text-xl leading-relaxed">
                    {pathChoice === 'grassy' 
                      ? '"I took the one less traveled by,\nAnd that has made all the difference."'
                      : pathChoice === 'worn'
                      ? '"And both that morning equally lay\nIn leaves no step had trodden black."'
                      : '"Long I stood... and chose neither."'}
                  </div>

                  <div className="flex gap-4 justify-center pt-4">
                    <button onClick={startGame} className="flex items-center gap-2 px-8 py-3 rounded-full bg-white/10 hover:bg-white/20 transition-colors border border-white/10 text-white font-bold">
                      <Icons.RotateCcw className="w-5 h-5" /> CHOOSE AGAIN
                    </button>
                  </div>
                </div>
              )}
            </div>
          );
        }

        function App() {
            const scrollRef = useRef(null);
            const { scrollXProgress } = useScroll({ container: scrollRef });
            const [activeStanza, setActiveStanza] = useState(null);
            const [showAnalysis, setShowAnalysis] = useState(false);
            const [showAuthor, setShowAuthor] = useState(false);
            const [showGame, setShowGame] = useState(false);

            const backgroundX = useTransform(scrollXProgress, [0, 1], ["0%", "-50%"]);
            const characterX = useTransform(scrollXProgress, [0, 1], ["10%", "80%"]);

            return (
                <div className="h-screen w-screen bg-[#050b14] overflow-hidden relative font-body selection:bg-primary/30">
                    <Snowfall />
                    
                    {/* Background */}
                    <motion.div className="absolute inset-0 h-full w-[200vw] z-0" style={{ x: backgroundX }}>
                    <img 
  src="/images/road.png" 
  alt="road" 
  className="w-full h-full object-cover opacity-90"
/>


                        <div className="absolute inset-0 bg-gradient-to-t from-[#050b14]/80 via-transparent to-transparent" />
                    </motion.div>

                    {/* Scroll Container */}
                    <div ref={scrollRef} className="absolute inset-0 overflow-x-auto overflow-y-hidden flex items-end hide-scrollbar z-10 snap-x snap-mandatory">
                        <div className="flex h-full min-w-[300vw] items-end pb-24 pl-[20vw] pr-[50vw] relative">
                            <div className="absolute bottom-32 left-0 w-full h-2 border-t-4 border-dashed border-white/30 pointer-events-none" />
                            {POEM.map((_, i) => (
                                <div key={i} className="snap-center w-[60vw] h-full flex items-end justify-center relative pb-32">
                                    <TreeMarker index={i} active={activeStanza === i} onClick={() => setActiveStanza(i)} />
                                </div>
                            ))}
                            <div className="snap-center w-[80vw] h-full flex items-center justify-center pb-32">
                                <motion.button onClick={() => setShowGame(true)} whileHover={{ scale: 1.05 }} className="group relative px-8 py-4 bg-primary/10 border border-primary/30 rounded-full backdrop-blur-md overflow-hidden hover:bg-primary/20 transition-all">
                                    <span className="relative flex items-center gap-2 text-xl font-heading text-primary-foreground"><Icons.Gamepad2 className="w-6 h-6" /> Enter The Unknown</span>
                                </motion.button>
                            </div>
                        </div>
                    </div>

                    {/* Character */}
                    <motion.div className="fixed bottom-32 z-20 pointer-events-none" style={{ left: characterX }} animate={{ y: [0, -8, 0], rotate: [0, 1, -1, 0] }} transition={{ duration: 1.2, repeat: Infinity, ease: "linear" }}>
                        <div className="relative w-32 h-32 group">
                            <div className="absolute bottom-0 left-1/2 -translate-x-1/2 w-20 h-4 bg-black/60 blur-md rounded-full" />
                            <div className="relative w-24 h-24 rounded-full overflow-hidden border-2 border-white/20 shadow-[0_0_20px_rgba(0,0,0,0.5)] bg-black">
                                <img 
  src="/images/frost.png" 
  alt="Robert Frost" 
  className="w-full h-full object-cover" 
/>

                            </div>
                        </div>
                    </motion.div>

                    {/* UI */}
                    <div className="fixed top-0 left-0 w-full p-6 z-50 flex justify-between items-start pointer-events-none">
                        <div className="pointer-events-auto flex flex-col">
                            <h1 className="text-3xl font-heading text-white tracking-widest drop-shadow-[0_2px_10px_rgba(0,0,0,0.5)]">THE ROAD<span className="text-primary">NOT TAKEN</span></h1>
                            <div className="text-[10px] text-primary/80 font-ui uppercase tracking-[0.3em] pl-1">By Robert Frost</div>
                        </div>
                        <div className="pointer-events-auto flex gap-3">
    <button onClick={() => setShowAuthor(true)} className="h-10 px-4 rounded-full backdrop-blur border bg-black/40 hover:bg-black/60 border-white/10 text-white flex items-center gap-2">
        <Icons.User className="w-4 h-4" />
        <span className="hidden sm:inline font-ui text-sm font-bold">AUTHOR</span>
    </button>
    <button onClick={() => setShowAnalysis(!showAnalysis)} className={`h-10 px-4 rounded-full backdrop-blur border transition-all flex items-center gap-2 shadow-lg ${showAnalysis ? 'bg-primary text-primary-foreground border-primary' : 'bg-black/40 hover:bg-black/60 border-white/10 text-white'}`}>
        <Icons.Search className="w-4 h-4" />
        <span className="hidden sm:inline font-ui text-sm font-bold">ANALYSIS</span>
    </button>

    <button 
    onClick={() => window.location.href = window.homeUrl}
    className="px-4 py-2 bg-primary text-black rounded-full shadow-lg hover:opacity-80 transition"
>
    Back
</button>

</div>

                    </div>

                    {/* Visual Novel Box */}
                    <AnimatePresence mode='wait'>
                        {activeStanza !== null && !showGame && (
                            <motion.div initial={{ y: 100, opacity: 0 }} animate={{ y: 0, opacity: 1 }} exit={{ y: 100, opacity: 0 }} className="fixed bottom-6 left-1/2 -translate-x-1/2 w-[90vw] max-w-4xl z-40">
                                <div className="vn-box p-6 md:p-8 min-h-[160px] flex gap-6 items-start bg-slate-900/90 backdrop-blur-xl border border-primary/20 rounded-2xl shadow-2xl">
                                    <div className="hidden md:block shrink-0">
                                        <div className="w-20 h-20 rounded-full border-2 border-primary/30 p-1 relative">
                                        <img src="/images/frost.png" className="w-full h-full object-cover rounded-full" /></div>
                                        <div className="mt-2 text-center text-[10px] font-heading text-primary tracking-widest uppercase">R. Frost</div>
                                    </div>
                                    <div className="flex-1 space-y-2 pt-1">
                                        <AnimatePresence mode='wait'>
                                            <motion.div key={activeStanza} initial={{ opacity: 0, x: -10 }} animate={{ opacity: 1, x: 0 }} exit={{ opacity: 0, x: 10 }} className="text-lg md:text-xl leading-relaxed text-blue-50 font-body drop-shadow-md">
                                                {POEM[activeStanza].map((line, i) => <p key={i} className="mb-1">{line}</p>)}
                                            </motion.div>
                                        </AnimatePresence>
                                    </div>
                                    <div className="absolute bottom-4 right-6 text-[10px] text-primary/40 uppercase tracking-[0.2em] animate-pulse flex items-center gap-2">Scroll Right <Icons.ArrowRight className="w-3 h-3" /></div>
                                </div>
                            </motion.div>
                        )}
                    </AnimatePresence>

                    {/* Analysis Overlay */}
                    <AnimatePresence>
                        {showAnalysis && (
                            <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" onClick={() => setShowAnalysis(false)}>
                                <motion.div initial={{ scale: 0.9, y: 20 }} animate={{ scale: 1, y: 0 }} exit={{ scale: 0.9, y: 20 }} onClick={e => e.stopPropagation()} className="bg-[#0f172a] border border-primary/30 rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden">
                                    <div className="p-6 border-b border-white/10 flex justify-between items-center bg-white/5">
                                        <h2 className="text-xl font-heading text-primary flex items-center gap-2"><Icons.Lightbulb className="w-5 h-5" /> Literary Analysis</h2>
                                        <button onClick={() => setShowAnalysis(false)} className="text-white/50 hover:text-white"><Icons.X className="w-6 h-6" /></button>
                                    </div>
                                    <div className="p-6 grid gap-4 md:grid-cols-2">
                                        {ANALYSIS.map((item, i) => (
                                            <div key={i} className={`p-4 rounded-lg border border-white/5 bg-white/[0.02] hover:bg-white/[0.05] transition-colors ${i === 2 ? 'md:col-span-2' : ''}`}>
                                                <div className="flex justify-between items-start mb-2">
                                                    <h3 className="font-heading text-xs text-blue-200 uppercase tracking-wider">{item.title}</h3>
                                                    <span className="text-[10px] font-mono text-primary bg-primary/10 px-2 py-0.5 rounded border border-primary/20">{item.val}</span>
                                                </div>
                                                <p className="text-sm text-white/60 leading-relaxed font-body">{item.content}</p>
                                            </div>
                                        ))}
                                    </div>
                                </motion.div>
                            </motion.div>
                        )}
                    </AnimatePresence>

                    {/* Author Overlay */}
                    <AnimatePresence>
                        {showAuthor && (
                            <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" onClick={() => setShowAuthor(false)}>
                                <motion.div initial={{ scale: 0.9, y: 20 }} animate={{ scale: 1, y: 0 }} exit={{ scale: 0.9, y: 20 }} onClick={e => e.stopPropagation()} className="bg-[#0f172a] border border-primary/30 rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden">
                                    <div className="p-6 border-b border-white/10 flex justify-between items-center bg-white/5">
                                        <h2 className="text-xl font-heading text-primary flex items-center gap-2"><Icons.User className="w-5 h-5" /> About the Author</h2>
                                        <button onClick={() => setShowAuthor(false)} className="text-white/50 hover:text-white"><Icons.X className="w-6 h-6" /></button>
                                    </div>
                                    <div className="p-6 flex flex-col md:flex-row gap-6">
                                        <div className="shrink-0 flex flex-col items-center">
                                            <div className="w-32 h-32 rounded-lg border-2 border-primary/30 p-1 bg-black/50 overflow-hidden">
                                            <img src="/images/frost.jpg"  className="w-full h-full object-cover rounded-md" /></div>
                                            <div className="mt-3 text-center"><h3 className="font-heading text-lg text-white">{AUTHOR_INFO.name}</h3><span className="text-xs text-white/40 font-mono">{AUTHOR_INFO.birth} - {AUTHOR_INFO.death}</span></div>
                                        </div>
                                        <div className="space-y-4">
                                            <div><h4 className="text-xs text-primary uppercase tracking-widest mb-1">Style</h4><p className="text-sm text-white/80">{AUTHOR_INFO.style}</p></div>
                                            <div><h4 className="text-xs text-primary uppercase tracking-widest mb-1">Biography</h4><p className="text-sm text-white/60 leading-relaxed">{AUTHOR_INFO.bio}</p></div>
                                        </div>
                                    </div>
                                </motion.div>
                            </motion.div>
                        )}
                    </AnimatePresence>

                    {/* Game Overlay */}
                    <AnimatePresence>
                        {showGame && (
                            <motion.div initial={{ opacity: 0, scale: 1.1 }} animate={{ opacity: 1, scale: 1 }} exit={{ opacity: 0, scale: 1.1 }} className="fixed inset-0 z-50 bg-black/95 flex flex-col items-center justify-center">
                                <button onClick={() => setShowGame(false)} className="absolute top-6 right-6 p-4 text-white hover:text-primary z-50 transition-colors"><Icons.X className="w-8 h-8" /></button>
                                <MiniGame />
                            </motion.div>
                        )}
                    </AnimatePresence>
                </div>
            );
        }

        const root = ReactDOM.createRoot(document.getElementById('root'));
        root.render(<App />);
        
    </script>
    @endverbatim
</body>
</html>
