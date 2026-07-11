import { chromium } from 'playwright';
import { createServer } from 'http';
import { readFileSync } from 'fs';
import { join, extname, dirname } from 'path';
import { fileURLToPath } from 'url';

const __dirname = dirname(fileURLToPath(import.meta.url));
const ROOT = join(__dirname);
const MIME = { '.html': 'text/html', '.mp3': 'audio/mpeg', '.js': 'application/javascript' };

const server = createServer((req, res) => {
  let p = join(ROOT, req.url === '/' ? 'index.html' : decodeURIComponent(req.url));
  try {
    const data = readFileSync(p);
    res.writeHead(200, { 'Content-Type': MIME[extname(p)] || 'application/octet-stream' });
    res.end(data);
  } catch {
    res.writeHead(404).end('not found');
  }
});

server.listen(8765, async () => {
  const browser = await chromium.launch({ headless: true });
  const page = await browser.newPage();
  const logs = [];
  page.on('console', m => logs.push(m.text()));

  await page.goto('http://127.0.0.1:8765/');
  await page.click('#startBtn', { force: true });
  await page.waitForTimeout(2000);

  const state = await page.evaluate(() => ({
    fieldActive: document.getElementById('crowdField').classList.contains('active'),
    overlayHidden: document.getElementById('startOverlay').classList.contains('hidden'),
    fans: document.querySelectorAll('.minion').length,
    buffers: window.__goriBuffersCount || 0,
    fallback: window.__useFallbackAudio || false,
    ctxState: window.__audioCtxState || 'none'
  }));

  // Test actual audio playback via Web Audio in page
  const played = await page.evaluate(async () => {
    const ctx = new AudioContext();
    await ctx.resume();
    const res = await fetch('audio/gori-play-1.mp3');
    const buf = await ctx.decodeAudioData(await res.arrayBuffer());
    const src = ctx.createBufferSource();
    src.buffer = buf;
    const g = ctx.createGain();
    g.gain.value = 1;
    src.connect(g).connect(ctx.destination);
    src.start();
    await new Promise(r => setTimeout(r, 600));
    return buf.duration > 0;
  });

  console.log(JSON.stringify({ state, played, logs }, null, 2));
  const pass = state.fieldActive && state.overlayHidden && state.fans > 0 && played && (state.buffers >= 1 || state.fallback);
  console.log(pass ? 'TEST PASSED' : 'TEST FAILED');
  await browser.close();
  server.close();
  process.exit(pass ? 0 : 1);
});
