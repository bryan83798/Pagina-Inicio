<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bryan | Desenvolvedor Mobile & Web</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Fira+Code:wght@500&display=swap" rel="stylesheet">

</head>
<body>

<nav><div class="wrap">
  <span class="logo">&lt;bryan /&gt;</span>
  <div><a href="#sobre">Sobre</a><a href="#tech">Tecnologias</a><a href="#projetos">Projetos</a><a href="#contato">Contato</a></div>
</div></nav>

<header class="hero wrap">

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
