<?php
session_start();
require("db/connect.php");


?>
<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AE Portfolio</title>
  <meta name="description" content="Backend Developer — Elbek portfolio sahifasi">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --navy: #0c1526;
      --navy2: #152035;
      --accent: #e8c547;
      --accent2: #f0d56a;
      --text: #f0ede6;
      --muted: #9ba3b2;
      --card-bg: rgba(255,255,255,0.04);
      --border: rgba(255,255,255,0.08);
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--navy);
      color: var(--text);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ── NAV ── */
    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.2rem 2.5rem;
      border-bottom: 1px solid var(--border);
      position: sticky;
      top: 0;
      background: rgba(12,21,38,0.92);
      backdrop-filter: blur(12px);
      z-index: 100;
    }

    .logo {
      font-family: 'Syne', sans-serif;
      font-size: 20px;
      font-weight: 800;
      letter-spacing: -0.5px;
      color: var(--accent);
      text-decoration: none;
    }

    .nav-links {
      display: flex;
      gap: 2.2rem;
      list-style: none;
    }

    .nav-links a {
      color: var(--muted);
      text-decoration: none;
      font-size: 14px;
      font-weight: 400;
      transition: color 0.2s;
    }

    .nav-links a:hover { color: var(--text); }

    .btn-primary {
      background: var(--accent);
      color: var(--navy);
      border: none;
      padding: 10px 22px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      transition: background 0.2s, transform 0.15s;
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary:hover { background: var(--accent2); transform: translateY(-1px); }

    .btn-outline {
      background: transparent;
      color: var(--text);
      border: 1px solid rgba(255,255,255,0.25);
      padding: 10px 22px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 400;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      transition: border-color 0.2s, transform 0.15s;
      text-decoration: none;
      display: inline-block;
    }

    .btn-outline:hover { border-color: rgba(255,255,255,0.5); transform: translateY(-1px); }

    /* ── HERO ── */
    #home {
      position: relative;
      min-height: 92vh;
      display: flex;
      align-items: center;
      overflow: hidden;
    }

    #hero-bg {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      opacity: 0;
      transition: opacity 0.7s ease;
    }

    #hero-bg.active { opacity: 1; }

    /* Gradient overlay */
    #home::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(
        to right,
        rgba(12,21,38,0.93) 0%,
        rgba(12,21,38,0.72) 55%,
        rgba(12,21,38,0.42) 100%
      );
      z-index: 1;
    }

    .hero-inner {
      position: relative;
      z-index: 2;
      max-width: 1200px;
      width: 100%;
      margin: 0 auto;
      padding: 5rem 2.5rem;
      display: grid;
      grid-template-columns: 1fr 360px;
      gap: 3rem;
      align-items: center;
    }

    /* Fon yuklash tugmasi */
    .upload-bg-btn {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      z-index: 10;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(12,21,38,0.7);
      border: 1px solid rgba(232,197,71,0.35);
      color: var(--accent);
      padding: 9px 18px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 500;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      transition: background 0.2s, border-color 0.2s;
      backdrop-filter: blur(10px);
      letter-spacing: 0.3px;
    }

    .upload-bg-btn:hover {
      background: rgba(232,197,71,0.1);
      border-color: rgba(232,197,71,0.6);
    }

    .upload-bg-btn input { display: none; }

    .badge {
      display: inline-block;
      background: rgba(232,197,71,0.12);
      color: var(--accent);
      border: 1px solid rgba(232,197,71,0.3);
      padding: 5px 16px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
      letter-spacing: 0.5px;
      margin-bottom: 1.4rem;
    }

    .hero-left h1 {
      font-family: 'Syne', sans-serif;
      font-size: clamp(1.9rem, 3.2vw, 2.6rem);
      font-weight: 700;
      line-height: 1.18;
      letter-spacing: -0.5px;
      margin-bottom: 1.2rem;
    }

    .hero-left h1 span { color: var(--accent); }

    .hero-left p {
      color: var(--muted);
      font-size: 15px;
      line-height: 1.8;
      max-width: 460px;
      margin-bottom: 2rem;
    }

    .btn-row { display: flex; gap: 12px; flex-wrap: wrap; }

    /* ── STAT PANEL ── */
    .stat-panel {
      background: rgba(12,21,38,0.6);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 20px;
      padding: 1.8rem;
      backdrop-filter: blur(16px);
    }

    .stat-panel h6 {
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: var(--muted);
      margin-bottom: 1.1rem;
      font-weight: 500;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    .stat-box {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 14px;
      padding: 1.2rem 1rem;
      text-align: center;
    }

    .stat-box strong {
      display: block;
      font-family: 'Syne', sans-serif;
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--accent);
      line-height: 1;
      margin-bottom: 6px;
    }

    .stat-box span {
      font-size: 11px;
      color: var(--muted);
      font-weight: 300;
      line-height: 1.4;
    }

    /* ── DIVIDER ── */
    .divider {
      height: 1px;
      background: var(--border);
      max-width: 1200px;
      margin: 0 auto;
    }

    /* ── SECTION ── */
    .section-wrap {
      max-width: 1200px;
      margin: 0 auto;
      padding: 5rem 2.5rem;
    }

    .sec-label {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: var(--accent);
      font-weight: 500;
      margin-bottom: 0.35rem;
    }

    .sec-title {
      font-family: 'Syne', sans-serif;
      font-size: clamp(1.35rem, 2.2vw, 1.7rem);
      font-weight: 700;
      letter-spacing: -0.3px;
      margin-bottom: 0.6rem;
    }

    .sec-sub {
      color: var(--muted);
      font-size: 13.5px;
      margin-bottom: 2.2rem;
      max-width: 460px;
      line-height: 1.7;
    }

    /* ── ABOUT ── */
    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: start;
    }

    .about-text p {
      color: var(--muted);
      font-size: 14.5px;
      line-height: 1.9;
      margin-bottom: 1.1rem;
    }

    .skills-col { display: flex; flex-direction: column; gap: 1.3rem; }

    .skill-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
    }

    .skill-name { font-size: 13px; font-weight: 500; }
    .skill-pct { font-size: 12px; color: var(--accent); font-weight: 600; }

    .progress-track {
      height: 3px;
      background: rgba(255,255,255,0.06);
      border-radius: 2px;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: var(--accent);
      border-radius: 2px;
      width: 0;
      transition: width 1.4s cubic-bezier(0.25, 1, 0.5, 1);
    }

    /* ── SERVICES ── */
    .services-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }

    .service-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 1.8rem 1.6rem;
      transition: border-color 0.25s, transform 0.25s;
    }

    .service-card:hover {
      border-color: rgba(232,197,71,0.3);
      transform: translateY(-5px);
    }

    .service-icon {
      width: 44px;
      height: 44px;
      background: rgba(232,197,71,0.08);
      border: 1px solid rgba(232,197,71,0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.2rem;
      font-size: 20px;
    }

    .service-card h5 {
      font-family: 'Syne', sans-serif;
      font-size: 15px;
      font-weight: 600;
      margin-bottom: 0.6rem;
    }

    .service-card p {
      color: var(--muted);
      font-size: 13px;
      line-height: 1.7;
    }

    /* ── PORTFOLIO ── */
    .portfolio-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }

    .port-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 18px;
      overflow: hidden;
      transition: border-color 0.25s, transform 0.25s;
    }

    .port-card:hover {
      border-color: rgba(232,197,71,0.3);
      transform: translateY(-5px);
    }

    .port-thumb {
      height: 160px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .port-thumb-1 { background: linear-gradient(135deg, rgba(100,160,220,0.2), rgba(12,21,38,0.9)); }
    .port-thumb-2 { background: linear-gradient(135deg, rgba(232,197,71,0.2), rgba(12,21,38,0.9)); }
    .port-thumb-3 { background: linear-gradient(135deg, rgba(180,100,220,0.2), rgba(12,21,38,0.9)); }

    .port-thumb-icon {
      width: 56px;
      height: 56px;
      border: 1px solid var(--border);
      border-radius: 16px;
      background: rgba(255,255,255,0.05);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 26px;
    }

    .port-info { padding: 1.2rem 1.4rem; }

    .port-tag {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: var(--accent);
      font-weight: 500;
      margin-bottom: 5px;
    }

    .port-info h5 {
      font-family: 'Syne', sans-serif;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .port-info p {
      color: var(--muted);
      font-size: 12.5px;
      line-height: 1.6;
    }

    /* ── CONTACT ── */
    #contact {
      background: rgba(255,255,255,0.015);
      border-top: 1px solid var(--border);
    }

    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1.4fr;
      gap: 4rem;
      align-items: start;
    }

    .contact-info p {
      color: var(--muted);
      font-size: 14.5px;
      line-height: 1.8;
      margin-bottom: 2rem;
    }

    .contact-items { display: flex; flex-direction: column; gap: 14px; }

    .c-item {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 13.5px;
      color: var(--muted);
    }

    .c-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: var(--accent);
      flex-shrink: 0;
    }

    .c-item strong { color: var(--text); font-weight: 500; margin-right: 4px; }

    .form-group { margin-bottom: 14px; }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 12px 16px;
      color: var(--text);
      font-size: 13.5px;
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: border-color 0.2s;
      resize: none;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    textarea:focus {
      border-color: rgba(232,197,71,0.45);
    }

    input::placeholder,
    textarea::placeholder { color: var(--muted); }

    textarea { height: 120px; }

    /* ── FOOTER ── */
    footer {
      padding: 1.6rem 2.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top: 1px solid var(--border);
    }

    footer p { font-size: 12px; color: var(--muted); }
    footer span { font-size: 12px; color: var(--accent); }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
      .hero-inner {
        grid-template-columns: 1fr;
        padding: 3.5rem 1.5rem;
      }
      .stat-panel { max-width: 420px; }
      .about-grid,
      .contact-grid { grid-template-columns: 1fr; gap: 2.5rem; }
      .services-grid,
      .portfolio-grid { grid-template-columns: repeat(2, 1fr); }
      .nav-links { display: none; }
      .section-wrap { padding: 3.5rem 1.5rem; }
    }
    .sidebar img{
    width:120px;
    height:120px;
    border-radius:50%;
    display:block;
    margin:auto;
    border:3px solid white;
    background-color: black;
}


    @media (max-width: 560px) {
      .services-grid,
      .portfolio-grid { grid-template-columns: 1fr; }
      .form-row { grid-template-columns: 1fr; }
      nav { padding: 1rem 1.2rem; }
      footer { flex-direction: column; gap: 6px; text-align: center; }
      #home { min-height: 100vh; }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  <nav>
    <a class="logo" href="#home">AE.dev</a>
    <ul class="nav-links">
      <li><a href="#home">Bosh sahifa</a></li>
      <li><a href="#about">Men haqimda</a></li>
      <li><a href="#services">Xizmatlar</a></li>
      <li><a href="#portfolio">Ishlarim</a></li>
      <li><a href="#contact">Bog'lanish</a></li>
    </ul>
    <a class="btn-primary" href="#contact">Bog'lanish</a>
  </nav>

  <!-- HERO -->
  <section id="home">

    <!-- Orqa fon rasmi -->
    <div id="hero-bg"></div>

    <!-- Fon yuklash tugmasi -->
    <img src="" alt="">
    <div class="hero-inner">
      <div class="hero-left">
        <div class="badge">&#9632; Backend Developer</div>
        <h1>Portfolio sahifamga<br><span>xush kelibsiz</span></h1>
        <p>Men zamonaviy, tezkor va mobilga mos web ilovalar yarataman. Toza kod, qulay interfeys va yuqori ishlash tezligi — mening asosiy ustuvorligim.</p>
        <div class="btn-row">
          <a class="btn-primary" href="#portfolio">Ishlarimni ko'rish</a>
          <a class="btn-outline" href="#contact">Bog'lanish</a>
        </div>
      </div>

      <div class="stat-panel">
        
        <h6>Ko'rsatkichlar</h6>
       
        <div class="stats-grid">
          <div class="stat-box">
            <strong>1+</strong>
            <span>Yillik tajriba</span>
          </div>
          <div class="stat-box">
            <strong>1+</strong>
            <span>Tugallangan loyiha</span>
          </div>
          <div class="stat-box">
            <strong>4</strong>
            <span>Dasturlash tili</span>
          </div>
          <div class="stat-box">
            <strong>100%</strong>
            <span>Responsive dastur</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="divider"></div>

  <!-- ABOUT -->
  <section id="about">
    <div class="section-wrap">
      <div class="sec-label">Biografiya</div>
      <div class="sec-title">Men haqimda</div>
      <div class="about-grid">
        <div class="about-text">
          <p>Men foydalanuvchi tajribasiga e'tibor beradigan web dasturchiman. Har bir loyihada toza kod, qulay interfeys va yuqori ishlash tezligini birinchi o'ringa qo'yaman.</p>
          <p>Asosan landing page, portfolio, korporativ sayt va admin panel interfeyslarini zamonaviy uslubda ishlab chiqaman. Har bir loyihaga individual yondashuv bilan harakat qilaman.</p>
        </div>
        <div class="skills-col">
          <div class="skill-item">
            <div class="skill-header">
              <span class="skill-name">HTML / CSS</span>
              <span class="skill-pct">95%</span>
            </div>
            <div class="progress-track">
              <div class="progress-fill" data-width="95"></div>
            </div>
          </div>
          <div class="skill-item">
            <div class="skill-header">
              <span class="skill-name">Bootstrap</span>
              <span class="skill-pct">92%</span>
            </div>
            <div class="progress-track">
              <div class="progress-fill" data-width="92"></div>
            </div>
          </div>
          <div class="skill-item">
            <div class="skill-header">
              <span class="skill-name">C++</span>
              <span class="skill-pct">80%</span>
            </div>
            <div class="progress-track">
              <div class="progress-fill" data-width="80"></div>
            </div>
          </div>
          <div class="skill-item">
            <div class="skill-header">
              <span class="skill-name">Backend Development</span>
              <span class="skill-pct">88%</span>
            </div>
            <div class="progress-track">
              <div class="progress-fill" data-width="88"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="divider"></div>

  <!-- SERVICES -->
  <section id="services">
    <div class="section-wrap">
      <div class="sec-label">Nima taklif etaman</div>
      <div class="sec-title">Xizmatlar</div>
      <p class="sec-sub">Har bir loyiha uchun individual va sifatli yondashuv</p>
      <div class="services-grid">
        <div class="service-card">
          <div class="service-icon">&#9707;</div>
          <h5>Landing Page</h5>
          <p>Mahsulot yoki xizmatlaringiz uchun konversiyaga yo'naltirilgan, zamonaviy landing sahifa yaratish.</p>
        </div>
        <div class="service-card">
          <div class="service-icon">&#9670;</div>
          <h5>Portfolio Sayt</h5>
          <p>Shaxsiy brendingizni kuchaytiruvchi, ishlaringizni professional tarzda namoyish etuvchi sayt.</p>
        </div>
        <div class="service-card">
          <div class="service-icon">&#9632;</div>
          <h5>UI/UX Dasturlash</h5>
          <p>Figma asosida sodda, chiroyli va foydalanuvchiga qulay interfeys va dasturlar tayyorlash.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="divider"></div>

  <!-- PORTFOLIO -->
  <section id="portfolio">
    <div class="section-wrap">
      <div class="sec-label">Ishlarim</div>
      <div class="sec-title">So'nggi loyihalar</div>
      <p class="sec-sub">Quyida bir nechta namunaviy ishlarim keltirilgan</p>
      <div class="portfolio-grid">
        <div class="port-card">
          <div class="port-thumb port-thumb-1">
            <div class="port-thumb-icon">&#128218;</div>
          </div>
          <div class="port-info">
            <div class="port-tag">Web App</div>
            <h5>E-o'quv markaz</h5>
            <p>O'quv markazlar uchun online davomat va boshqaruv tizimi.</p>
          </div>
        </div>
        <div class="port-card">
          <div class="port-thumb port-thumb-2">
            <div class="port-thumb-icon">&#127970;</div>
          </div>
          <div class="port-info">
            <div class="port-tag">Korporativ</div>
            <h5>Korporativ Vebsayt</h5>
            <p>Kompaniya xizmatlari va jamoasini tanishtiruvchi korporativ sayt.</p>
          </div>
        </div>
        <div class="port-card">
          <div class="port-thumb port-thumb-3">
            <div class="port-thumb-icon">&#9881;</div>
          </div>
          <div class="port-info">
            <div class="port-tag">Portfolio</div>
            <h5>Shaxsiy Portfolio</h5>
            <p>Freelancer va dasturchilar uchun zamonaviy one-page portfolio yechimi.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="divider"></div>

  <!-- CONTACT -->
  <section id="contact">
    <div class="section-wrap">
      <div class="sec-label">Aloqa</div>
      <div class="sec-title">Bog'lanish</div>
      <p class="sec-sub">Yangi loyiha yoki hamkorlik bo'yicha bog'laning.</p>
      <div class="contact-grid">
        <div class="contact-info">
          <p>Yangi g'oyangiz bormi yoki hamkorlik qilmoqchimisiz? Menga yozing — qisqa vaqt ichida javob beraman.</p>
          <div class="contact-items">
            <div class="c-item">
              <div class="c-dot"></div>
              <span><strong>Telefon:</strong> +998 95 073 81 41</span>
            </div>
            <div class="c-item">
              <div class="c-dot"></div>
              <span><strong>Email:</strong> elbek8029@gmail.com</span>
            </div>
            <div class="c-item">
              <div class="c-dot"></div>
              <span><strong>Manzil:</strong> Xorazm, O'zbekiston</span>
            </div>
          </div>
        </div>
        <form action="add.php" method="POST">
          <div class="form-group form-row">
            <input type="text" name="name" placeholder="Ismingiz" required>
            <input type="email" name="email" placeholder="Email manzilingiz" required>
          </div>
          <div class="form-group">
            <input type="text" name="mavzu" placeholder="Xabar mavzusi">
          </div>
          <div class="form-group">
            <textarea name="xabar" placeholder="Xabaringizni yozing..."></textarea>
          </div>
          <button type="submit" class="btn-primary">Xabar yuborish</button>
        </form>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <p>&copy; 2026 AE Portfolio. Barcha huquqlar himoyalangan.</p>
    <span>Xorazm, O'zbekiston</span>
  </footer>

  <script>
    /* ── Orqa fon rasmi yuklash ── */
    function loadBg(event) {
      const file = event.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = function(e) {
        const bg = document.getElementById('hero-bg');
        bg.style.backgroundImage = 'url(' + e.target.result + ')';
        bg.classList.add('active');
      };
      reader.readAsDataURL(file);
    }

    /* ── Skill progress bar animatsiyasi ── */
    const fills = document.querySelectorAll('.progress-fill');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.width = entry.target.dataset.width + '%';
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 });

    fills.forEach(f => observer.observe(f));

    /* ── Faol nav havolasi ── */
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-links a');

    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(sec => {
        if (window.scrollY >= sec.offsetTop - 120) current = sec.id;
      });
      navLinks.forEach(a => {
        a.style.color = a.getAttribute('href') === '#' + current ? '#f0ede6' : '';
      });
    });
  </script>
</body>
</html>