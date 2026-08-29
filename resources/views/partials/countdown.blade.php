<!-- Partial: Countdown overlay with rolling names -->
<style>
    /* countdown overlay styles (kept local to partial) */
    #draw-countdown-overlay.overlay{
      position:fixed;inset:0;display:none;align-items:center;justify-content:center;
      background: linear-gradient(0deg, rgba(255,255,255,0.01) 1px, transparent 1px) 0 0 / 36px 36px,
                  linear-gradient(90deg, rgba(255,255,255,0.01) 1px, transparent 1px) 0 0 / 36px 36px,
                  #0d1114;
      z-index:9999;
    }
    .countdown-center{display:flex;flex-direction:column;align-items:center;justify-content:center;color:#fff}
    .countdown-seconds{font-weight:800;color:#fff;font-size:4rem;margin:0}
    .roller-window{height:56px;width:420px;overflow:hidden;display:flex;align-items:center;justify-content:center}
    .roller-name{font-weight:700;color:#fff;font-size:1.8rem;transition:transform .15s linear,color .2s}
    .confetti-canvas{position:fixed;inset:0;pointer-events:none;z-index:10010}
    @media (max-width:480px){
        .roller-window{width:260px;height:48px}
        .countdown-seconds{font-size:3rem}
    }
</style>

<div id="draw-countdown-overlay" class="overlay" aria-hidden="true">
  <div class="countdown-center">
    <svg viewBox="0 0 220 220" width="280" height="280" aria-hidden="true">
      <g id="draw-ticks" transform="translate(110,110)"></g>
      <circle cx="110" cy="110" r="90" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="3"/>
      <circle id="draw-progress" cx="110" cy="110" r="82" fill="none" stroke="#ffb000" stroke-width="6" stroke-linecap="round" transform="rotate(-90 110 110)" style="stroke-dasharray:0 9999"/>
    </svg>
    <div id="draw-overlay-seconds" class="countdown-seconds">8</div>
    <div class="roller-window"><div id="draw-roller-name" class="roller-name">—</div></div>
    <div style="margin-top:6px;color:#9aa6b2;letter-spacing:4px;font-size:12px">T-MINUS DETIK</div>
  </div>
</div>

<!-- confetti canvas will be created by JS when needed -->
