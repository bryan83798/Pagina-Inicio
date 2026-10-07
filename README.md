<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bryan | Desenvolvedor Mobile & Web</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Fira+Code:wght@500&display=swap" rel="stylesheet">
<style>
:root{--bg:#0d1117;--card:rgba(255,255,255,.05);--line:rgba(255,255,255,.1);--a:#00c6ff;--b:#7b2ff7;--txt:#e6edf3;--mut:#8b98a9}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:Inter,system-ui,sans-serif;background:var(--bg);color:var(--txt);line-height:1.6;overflow-x:hidden}
body::before,body::after{content:"";position:fixed;width:480px;height:480px;border-radius:50%;filter:blur(120px);opacity:.25;z-index:-1}
body::before{background:var(--b);top:-120px;left:-120px}
body::after{background:var(--a);bottom:-120px;right:-120px}
.wrap{max-width:1000px;margin:0 auto;padding:0 24px}
nav{position:sticky;top:0;backdrop-filter:blur(12px);background:rgba(13,17,23,.7);border-bottom:1px solid var(--line);z-index:10}
nav .wrap{display:flex;justify-content:space-between;align-items:center;height:60px}
.logo{font-weight:800;background:linear-gradient(90deg,var(--a),var(--b));-webkit-background-clip:text;background-clip:text;color:transparent}
nav a{color:var(--mut);text-decoration:none;margin-left:20px;font-size:.9rem;transition:.2s}
nav a:hover{color:var(--a)}
.hero{text-align:center;padding:110px 0 80px}
.hero .tag{display:inline-block;padding:6px 16px;border:1px solid var(--line);border-radius:99px;color:var(--a);font-size:.85rem;background:var(--card)}
.hero h1{font-size:clamp(2.6rem,8vw,5rem);font-weight:800;margin:20px 0 10px;line-height:1.1}
.grad{background:linear-gradient(90deg,var(--a),var(--b));-webkit-background-clip:text;background-clip:text;color:transparent}
.typing{font-family:"Fira Code",monospace;font-size:clamp(1rem,3vw,1.4rem);color:var(--a);min-height:2em}
.typing::after{content:"|";animation:blink 1s steps(1) infinite}
@keyframes blink{50%{opacity:0}}
.btns{margin-top:30px;display:flex;gap:14px;justify-content:center;flex-wrap:wrap}
.btn{padding:12px 28px;border-radius:12px;text-decoration:none;font-weight:600;transition:.25s}
.btn.p{background:linear-gradient(90deg,var(--a),var(--b));color:#fff;box-shadow:0 8px 30px rgba(123,47,247,.35)}
.btn.s{border:1px solid var(--line);color:var(--txt);background:var(--card)}
.btn:hover{transform:translateY(-3px)}
section{padding:70px 0}
h2{font-size:1.8rem;margin-bottom:28px}
h2 span{color:var(--a)}
.glass{background:var(--card);border:1px solid var(--line);border-radius:18px;padding:26px;backdrop-filter:blur(8px)}
.about{display:grid;grid-template-columns:1.3fr 1fr;gap:24px}
pre{font-family:"Fira Code",monospace;font-size:.85rem;color:#c9d1d9;overflow-x:auto}
.k{color:#ff7b72}.s2{color:#a5d6ff}.c{color:#7ee787}
.stats{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
.stat{text-align:center}
.stat b{display:block;font-size:2rem}
.stat small{color:var(--mut)}
.chips{display:flex;flex-wrap:wrap;gap:12px}
.chip{padding:10px 20px;border-radius:12px;background:var(--card);border:1px solid var(--line);font-weight:600;transition:.25s}
.chip:hover{border-color:var(--a);transform:translateY(-4px);box-shadow:0 8px 24px rgba(0,198,255,.15)}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px}
.proj{transition:.3s;display:block;color:inherit;text-decoration:none}
.proj:hover{transform:translateY(-6px);border-color:var(--b)}
.proj h3{margin-bottom:8px}
.proj p{color:var(--mut);font-size:.95rem;margin-bottom:14px}
.proj em{font-style:normal;font-size:.75rem;padding:3px 10px;border-radius:99px;background:rgba(123,47,247,.2);color:#c4a5ff;margin-right:6px}
.contact{text-align:center}
.contact .btns{margin-top:20px}
footer{text-align:center;color:var(--mut);padding:40px 0;font-size:.85rem;border-top:1px solid var(--line)}
.reveal{opacity:0;transform:translateY(24px);transition:.7s}
.reveal.on{opacity:1;transform:none}
@media(max-width:700px){.about{grid-template-columns:1fr}nav a{margin-left:12px}}
</style>
</head>
<body>

<nav><div class="wrap">
  <span class="logo">&lt;bryan /&gt;</span>
  <div><a href="#sobre">Sobre</a><a href="#tech">Tecnologias</a><a href="#projetos">Projetos</a><a href="#contato">Contato</a></div>
</div></nav>

<header class="hero wrap">
  <span class="tag">👋 Bem-vindo ao meu espaço</span>
  <h1>Olá, eu sou o <span class="grad">Bryan</span></h1>
  <div class="typing" id="typing"></div>
  <div class="btns">
    <a class="btn p" href="#projetos">Ver projetos</a>
    <a class="btn s" href="https://github.com/bryan83798" target="_blank" rel="noopener">GitHub</a>
  </div>
</header>

<section id="sobre" class="wrap reveal">
  <h2>👨‍💻 Sobre <span>mim</span></h2>
  <div class="about">
    <div class="glass"><pre><span class="k">const</span> bryan = {
  perfil: <span class="s2">"Desenvolvedor Mobile &amp; Web"</span>,
  focoAtual: [<span class="s2">"Flutter"</span>, <span class="s2">"Dart"</span>, <span class="s2">"Firebase"</span>],
  estudando: <span class="s2">"Arquitetura de apps e UI/UX"</span>,
  objetivo: <span class="s2">"Transformar ideias em produtos"</span>,
  curiosidade: <span class="s2">"Café ☕ + código"</span>
};
<span class="c">// sempre aprendendo algo novo 🚀</span></pre></div>
    <div class="stats">
      <div class="glass stat"><b class="grad">3+</b><small>Projetos</small></div>
      <div class="glass stat"><b class="grad">6+</b><small>Tecnologias</small></div>
      <div class="glass stat"><b class="grad">100%</b><small>Dedicação</small></div>
      <div class="glass stat"><b class="grad">∞</b><small>Curiosidade</small></div>
    </div>
  </div>
</section>

<section id="tech" class="wrap reveal">
  <h2>🛠️ <span>Tecnologias</span></h2>
  <div class="chips">
    <div class="chip">Flutter</div><div class="chip">Dart</div><div class="chip">Firebase</div>
    <div class="chip">Android Studio</div><div class="chip">PHP</div><div class="chip">MySQL</div>
    <div class="chip">JavaScript</div><div class="chip">HTML</div><div class="chip">CSS</div>
    <div class="chip">Git &amp; GitHub</div>
  </div>
</section>

<section id="projetos" class="wrap reveal">
  <h2>📌 Projetos em <span>destaque</span></h2>
  <div class="grid">
    <a class="glass proj" href="https://github.com/bryan83798/Pagina-Inicio" target="_blank" rel="noopener">
      <h3>meu_plantao_tranquilo</h3><p>App mobile desenvolvido em Flutter.</p><em>Flutter</em><em>Dart</em>
    </a>
    <a class="glass proj" href="#">
      <h3>SISTEMA</h3><p>Criaçâo de um App.</p><em>PHP</em><em>MySQL</em>
    </a>
    <a class="glass proj" href="#">
      <h3>Seu projeto 3</h3><p>TCC TETRIS.</p><em>Flutter Dart</em><em>CSS</em>
    </a>
  </div>
</section>

<section id="contato" class="wrap contact reveal">
  <h2>🤝 Vamos <span>conversar?</span></h2>
  <div class="glass">
    <p style="color:var(--mut)">Tem uma ideia ou proposta? Me chama por um dos canais abaixo.</p>
    <div class="btns">
      <a class="btn p" href="mailto:contatrabalho9807@gmail.com">E-mail</a>
    

      <a class="btn s" href="https://wa.me/55SEUNUMERO" target="_blank" rel="noopener">WhatsApp</a>
    </div>
  </div>
</section>

<footer>Feito com 💜 por Bryan · <span id="ano"></span></footer>

<script>
const frases=["Desenvolvedor Mobile & Web 📱","Apaixonado por Flutter & Dart 💙","Criando apps e sistemas 🚀","Sempre aprendendo algo novo 💡"];
const el=document.getElementById("typing");let f=0,c=0,del=false;
function tick(){
  const t=frases[f];
  el.textContent=t.slice(0,c);
  if(!del&&c<t.length){c++;setTimeout(tick,70)}
  else if(!del){del=true;setTimeout(tick,1400)}
  else if(c>0){c--;setTimeout(tick,35)}
  else{del=false;f=(f+1)%frases.length;setTimeout(tick,300)}
}
tick();
document.getElementById("ano").textContent=new Date().getFullYear();
const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting)e.target.classList.add("on")}),{threshold:.15});
document.querySelectorAll(".reveal").forEach(s=>io.observe(s));
</script>
</body>
</html>
