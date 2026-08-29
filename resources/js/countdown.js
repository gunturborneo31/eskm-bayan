// Countdown + rolling participants + confetti
// Exposes window.startDrawOverlay(availableParticipants, options)
// and auto-attaches to button with id `drawButton` if present.

function createTicks(groupEl, total = 60) {
  if (!groupEl) return;
  groupEl.innerHTML = '';
  const radius = 96;
  for (let i = 0; i < total; i++) {
    const angle = (i / total) * Math.PI * 2;
    const inner = (i % 5 === 0) ? radius - 9 : radius - 5;
    const outer = radius;
    const x1 = Math.cos(angle) * inner;
    const y1 = Math.sin(angle) * inner;
    const x2 = Math.cos(angle) * outer;
    const y2 = Math.sin(angle) * outer;
    const line = document.createElementNS('http://www.w3.org/2000/svg','line');
    line.setAttribute('x1', x1);
    line.setAttribute('y1', y1);
    line.setAttribute('x2', x2);
    line.setAttribute('y2', y2);
    line.setAttribute('stroke', 'rgba(255,255,255,0.04)');
    line.setAttribute('stroke-width', i % 5 === 0 ? 2 : 1);
    groupEl.appendChild(line);
  }
}

function createRoller(nameEl) {
  let intervalId = null;
  function startShuffle(names, speedMs = 60) {
    stop();
    if (!Array.isArray(names) || names.length === 0) {
      nameEl.textContent = '—';
      return;
    }
    intervalId = setInterval(() => {
      const n = names[Math.floor(Math.random() * names.length)];
      nameEl.textContent = n.name || n;
      nameEl.style.color = '#fff';
    }, speedMs);
  }
  function stop() {
    if (intervalId) {
      clearInterval(intervalId);
      intervalId = null;
    }
  }
  function decelerateToWinner(names, winner, steps = 12, startDelay = 80, factor = 1.35) {
    stop();
    if (!Array.isArray(names) || names.length === 0) {
      nameEl.textContent = '—';
      return Promise.resolve();
    }
    const seq = [];
    for (let i = 0; i < Math.max(steps - 1, 3); i++) {
      let candidate = names[Math.floor(Math.random() * names.length)];
      if ((candidate.id && winner.id && candidate.id === winner.id) && names.length > 1) {
        const alt = names.filter(n => n.id !== winner.id);
        candidate = alt[Math.floor(Math.random() * alt.length)];
      }
      seq.push(candidate);
    }
    seq.push(winner);

    return new Promise((resolve) => {
      let idx = 0;
      let delay = startDelay;
      function step() {
        const item = seq[idx];
        nameEl.textContent = item.name || item;
        nameEl.style.transform = 'translateY(-4px)';
        setTimeout(()=> nameEl.style.transform = 'translateY(0)', Math.min(80, delay/2));
        idx++;
        if (idx < seq.length) {
          setTimeout(step, delay);
          delay = Math.min(1200, delay * factor);
        } else {
          nameEl.style.color = '#ffb000';
          resolve();
        }
      }
      step();
    });
  }
  return { startShuffle, stop, decelerateToWinner };
}

// simple canvas confetti implementation
function fireConfetti(duration = 3000, particleCount = 80) {
  const canvas = document.createElement('canvas');
  canvas.className = 'confetti-canvas';
  canvas.style.position = 'fixed';
  canvas.style.left = '0';
  canvas.style.top = '0';
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  document.body.appendChild(canvas);
  const ctx = canvas.getContext('2d');
  const colors = ['#ff5252','#ffb000','#7afcff','#7ee787','#ff7ab6','#ffd66b'];
  const particles = [];
  for (let i = 0; i < particleCount; i++) {
    particles.push({
      x: Math.random() * canvas.width,
      y: Math.random() * -canvas.height * 0.5,
      vx: (Math.random() - 0.5) * 6,
      vy: Math.random() * 4 + 2,
      size: Math.random() * 8 + 6,
      color: colors[Math.floor(Math.random() * colors.length)],
      rot: Math.random() * 360,
      vr: (Math.random() - 0.5) * 10
    });
  }

  const start = performance.now();
  let raf = null;
  function render(now) {
    const elapsed = now - start;
    ctx.clearRect(0,0,canvas.width,canvas.height);
    for (let p of particles) {
      p.x += p.vx;
      p.y += p.vy + 0.05 * (elapsed / 1000);
      p.vy += 0.02; // gravity
      p.rot += p.vr;
      ctx.save();
      ctx.translate(p.x, p.y);
      ctx.rotate((p.rot * Math.PI) / 180);
      ctx.fillStyle = p.color;
      ctx.fillRect(-p.size/2, -p.size/2, p.size, p.size * 0.6);
      ctx.restore();
    }
    if (elapsed < duration) {
      raf = requestAnimationFrame(render);
    } else {
      cancelAnimationFrame(raf);
      if (canvas.parentNode) canvas.parentNode.removeChild(canvas);
    }
  }
  raf = requestAnimationFrame(render);
}

// startDrawOverlay: main entry. options: seconds, onFinish(winner)
function startDrawOverlay(availableParticipants = [], options = {}) {
  const seconds = options.seconds || 8;
  const overlay = document.getElementById('draw-countdown-overlay');
  const overlaySeconds = document.getElementById('draw-overlay-seconds');
  const rollerName = document.getElementById('draw-roller-name');
  const progress = document.getElementById('draw-progress');
  const ticks = document.getElementById('draw-ticks');
  if (!overlay || !overlaySeconds || !rollerName || !progress) {
    // missing DOM -> fallback resolve with random winner immediately
    const winner = availableParticipants.length ? availableParticipants[Math.floor(Math.random()*availableParticipants.length)] : null;
    if (options.onFinish) options.onFinish(winner);
    return Promise.resolve(winner);
  }

  if (!ticks.hasChildNodes()) createTicks(ticks, 60);
  const radius = 82;
  const circumference = 2 * Math.PI * radius;
  progress.style.strokeDasharray = `${circumference} ${circumference}`;
  progress.style.strokeDashoffset = `${circumference}`;

  overlay.style.display = 'flex';
  overlay.setAttribute('aria-hidden','false');

  const roller = createRoller(rollerName);
  roller.startShuffle(availableParticipants, 60);

  overlaySeconds.textContent = String(seconds);
  const start = performance.now();

  function setProgress(ft) {
    const offset = circumference * (1 - ft);
    progress.style.transition = 'stroke-dashoffset 0.25s linear';
    progress.style.strokeDashoffset = offset;
  }
  setProgress(1);

  return new Promise((resolve) => {
    function tick(now) {
      const elapsed = (now - start) / 1000;
      const t = Math.min(1, elapsed / seconds);
      const current = Math.ceil(seconds * (1 - t));
      overlaySeconds.textContent = current >= 0 ? current : 0;
      setProgress(1 - t);
      if (elapsed < seconds) {
        requestAnimationFrame(tick);
      } else {
        // choose winner
        const winner = availableParticipants.length ? availableParticipants[Math.floor(Math.random()*availableParticipants.length)] : null;
        // decelerate to that winner then fire confetti and resolve
        roller.decelerateToWinner(availableParticipants, winner, 12, 80, 1.35).then(() => {
          // confetti
          try { fireConfetti(3500, 110); } catch (e) { /* ignore */ }
          setTimeout(() => {
            overlay.style.display = 'none';
            overlay.setAttribute('aria-hidden','true');
            resolve(winner);
            if (options.onFinish) options.onFinish(winner);
          }, 300);
        });
      }
    }
    requestAnimationFrame(tick);
  });
}

// expose globally
window.startDrawOverlay = startDrawOverlay;

// auto-attach if page defines window.drawParticipants and button exists
document.addEventListener('DOMContentLoaded', () => {
  const drawBtn = document.getElementById('drawButton');
  if (drawBtn && window.drawParticipants) {
    drawBtn.addEventListener('click', () => {
      const availableParticipants = window.drawParticipants.filter(p => !(window.__drawnIds && window.__drawnIds.has(p.id)));
      if (!availableParticipants.length) {
        // nothing
        return;
      }
      drawBtn.disabled = true;
      startDrawOverlay(availableParticipants, { seconds: 8, onFinish: (winner) => {
        // record drawn ids globally so page script can use
        window.__drawnIds = window.__drawnIds || new Set();
        if (winner && winner.id) window.__drawnIds.add(winner.id);
        // trigger custom event so page can react (e.g., renderResult)
        const ev = new CustomEvent('drawOverlayFinished', { detail: { winner } });
        document.dispatchEvent(ev);
        drawBtn.disabled = false;
      }});
    });
  }
});

export {};
