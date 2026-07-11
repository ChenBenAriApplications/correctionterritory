import { useEffect, useRef } from 'react'
import EnergyGraph from './EnergyGraph'
import RadarChart from './RadarChart'

function getFrags(slide: Element) {
  const list = Array.from(slide.querySelectorAll('.frag'))
  list.forEach((el, i) => {
    if (el.getAttribute('data-step') === null) {
      el.setAttribute('data-step', String(i * 100))
    }
  })
  list.sort(
    (a, b) =>
      Number(a.getAttribute('data-step')) - Number(b.getAttribute('data-step')),
  )
  return list
}

function triggerDrawlines(el: Element) {
  el.querySelectorAll('.drawline').forEach((p) => {
    ;(p as SVGPathElement).style.strokeDashoffset = '0'
  })
}

export default function CrossFitDeck() {
  const deckRef = useRef<HTMLDivElement>(null)
  const barRef = useRef<HTMLDivElement>(null)
  const counterRef = useRef<HTMLDivElement>(null)
  const idxRef = useRef(0)

  useEffect(() => {
    const deck = deckRef.current
    const bar = barRef.current
    const counter = counterRef.current
    if (!deck || !bar || !counter) return

    const slides = Array.from(deck.querySelectorAll('.slide'))

    const showSlide = (i: number, revealAll: boolean) => {
      slides.forEach((s, j) => s.classList.toggle('active', j === i))
      getFrags(slides[i]).forEach((f) => {
        f.classList.toggle('shown', revealAll)
        if (revealAll) triggerDrawlines(f)
      })
      counter.textContent = `${i + 1} / ${slides.length}`
      bar.style.width = `${((i + 1) / slides.length) * 100}%`
    }

    const nextStep = () => {
      const cur = slides[idxRef.current]
      const fs = getFrags(cur)
      const hidden = fs.filter((f) => !f.classList.contains('shown'))
      if (hidden.length) {
        const targetStep = hidden[0].getAttribute('data-step')
        hidden.forEach((f) => {
          if (f.getAttribute('data-step') === targetStep) {
            f.classList.add('shown')
            triggerDrawlines(f)
          }
        })
        return
      }
      if (idxRef.current < slides.length - 1) {
        idxRef.current += 1
        showSlide(idxRef.current, false)
      }
    }

    const prevStep = () => {
      if (idxRef.current > 0) {
        idxRef.current -= 1
        showSlide(idxRef.current, true)
      }
    }

    const onKeyDown = (e: KeyboardEvent) => {
      if (['ArrowRight', 'ArrowDown', ' ', 'PageDown'].includes(e.key)) {
        e.preventDefault()
        nextStep()
      } else if (['ArrowLeft', 'ArrowUp', 'PageUp'].includes(e.key)) {
        e.preventDefault()
        prevStep()
      }
    }

    deck.addEventListener('click', nextStep)
    document.addEventListener('keydown', onKeyDown)
    showSlide(0, false)

    return () => {
      deck.removeEventListener('click', nextStep)
      document.removeEventListener('keydown', onKeyDown)
    }
  }, [])

  return (
    <>
      <div className="deck" id="deck" ref={deckRef}>
        <section className="slide center active">
          <div className="eyebrow">A case for the most complete training system</div>
          <h1>
            Crossfit<span className="accent">.</span>
          </h1>
          <p className="lead frag">One hour a day. Ten physical skills. Every age, every body.</p>
        </section>

        <section className="slide">
          <div className="eyebrow">Let&apos;s start with a question</div>
          <h2>What does &quot;fit&quot; actually mean?</h2>
          <div className="frag">
            <div className="linelist">
              <div className="lineitem">
                <span className="sq" />
                Runner <span className="arrow">→</span> distance
              </div>
              <div className="lineitem">
                <span className="sq" />
                Powerlifter <span className="arrow">→</span> load
              </div>
              <div className="lineitem">
                <span className="sq" />
                Yogi <span className="arrow">→</span> range of motion
              </div>
            </div>
            <p className="lead accent2 lead-tight">Each — one slice of fitness. Not all of it.</p>
          </div>
        </section>

        <section className="slide">
          <div className="eyebrow">The actual definition</div>
          <h2>Constantly varied. Functional. Intense.</h2>
          <div className="cards">
            <div className="card frag" data-step="1">
              <div className="num">01</div>
              <h4>Constantly Varied</h4>
              <p>
                The workout is never the same twice, so the body never fully adapts to one
                pattern.
              </p>
            </div>
            <div className="card frag" data-step="2">
              <div className="num">02</div>
              <h4>Functional Movements</h4>
              <p>
                Multi-joint, natural movements the body actually uses — squat, push, pull,
                carry.
              </p>
            </div>
            <div className="card frag" data-step="3">
              <div className="num">03</div>
              <h4>High Intensity</h4>
              <p>
                Maximum work in minimum time — the dial that turns exercise into real
                adaptation.
              </p>
            </div>
          </div>
          <p className="sub frag sub-cite" data-step="3">
            — CrossFit Journal, 2004
          </p>
        </section>

        <section className="slide">
          <div className="eyebrow">Under the hood</div>
          <h2>Your body runs on three engines</h2>
          <div className="frag">
            <EnergyGraph />
            <div className="legend-row">
              <div className="legend-item">
                <span className="legend-swatch" style={{ background: 'var(--accent)' }} />
                ATP-PCr <small style={{ color: 'var(--muted)' }}>(0–10s, max effort)</small>
              </div>
              <div className="legend-item">
                <span className="legend-swatch" style={{ background: 'var(--good)' }} />
                Glycolytic <small style={{ color: 'var(--muted)' }}>(~30s–2min)</small>
              </div>
              <div className="legend-item">
                <span className="legend-swatch" style={{ background: '#6f93b3' }} />
                Oxidative <small style={{ color: 'var(--muted)' }}>(minutes+)</small>
              </div>
            </div>
          </div>
          <p className="lead frag lead-energy">
            Most training locks into <em>one</em> engine. Crossfit is built to rotate through
            all three.
          </p>
        </section>

        <section className="slide">
          <div className="eyebrow">Greg Glassman, &quot;What is Fitness?&quot; — 2002</div>
          <h2>Ten general physical skills</h2>
          <div className="skillgroups frag">
            <div className="skillgroup">
              <div className="grouplabel" style={{ color: 'var(--accent)' }}>
                Hardware
              </div>
              <div className="groupgrid">
                <div className="skill">
                  <span className="idx">01</span>Cardio
                </div>
                <div className="skill">
                  <span className="idx">02</span>Stamina
                </div>
                <div className="skill">
                  <span className="idx">03</span>Strength
                </div>
                <div className="skill">
                  <span className="idx">04</span>Flexibility
                </div>
              </div>
            </div>
            <div className="skillgroup">
              <div className="grouplabel" style={{ color: 'var(--accent2)' }}>
                Output
              </div>
              <div className="groupgrid output-grid">
                <div className="skill">
                  <span className="idx">05</span>Power
                </div>
                <div className="skill">
                  <span className="idx">06</span>Speed
                </div>
              </div>
            </div>
            <div className="skillgroup">
              <div className="grouplabel" style={{ color: 'var(--good)' }}>
                Software
              </div>
              <div className="groupgrid">
                <div className="skill">
                  <span className="idx">07</span>Coordination
                </div>
                <div className="skill">
                  <span className="idx">08</span>Agility
                </div>
                <div className="skill">
                  <span className="idx">09</span>Balance
                </div>
                <div className="skill">
                  <span className="idx">10</span>Accuracy
                </div>
              </div>
            </div>
            <p className="lead lead-skills">Fit means all ten. Not just one.</p>
          </div>
        </section>

        <section className="slide">
          <div className="eyebrow">So who actually covers all ten?</div>
          <h2>Coverage, by discipline</h2>
          <div className="radar-wrap">
            <RadarChart />
            <div className="col">
              <div className="legend-item frag" data-step="1">
                <span className="legend-swatch" style={{ background: '#6f93b3' }} /> Distance
                running
              </div>
              <div className="legend-item frag" data-step="3">
                <span className="legend-swatch" style={{ background: '#9b7bb0' }} /> Powerlifting
              </div>
              <div className="legend-item frag" data-step="5">
                <span className="legend-swatch" style={{ background: '#6a9c78' }} /> Yoga
              </div>
              <div className="legend-item frag" data-step="7">
                <span className="legend-swatch" style={{ background: '#c96a4e' }} />{' '}
                <b>CrossFit</b>
              </div>
            </div>
          </div>
        </section>

        <section className="slide center">
          <div className="eyebrow">Then why the reputation?</div>
          <h2 className="danger-title">&quot;Is CrossFit... dangerous?&quot;</h2>
        </section>

        <section className="slide">
          <div className="eyebrow">Myth 01</div>
          <div className="myth-box">
            <div className="myth-label">Claim</div>
            <div className="myth-text">CrossFit injures people at an alarming rate.</div>
            <div className="fact-label frag" data-step="1">
              Reality
            </div>
            <div className="fact-text frag" data-step="2">
              Pooled meta-analysis:{' '}
              <b className="accent2">~3.1 injuries per 1,000 training hours</b> — lower than
              recreational soccer (4.2–5.2) and basketball (4.8–7.3).
            </div>
            <div className="cite frag" data-step="2">
              German Journal of Sports Medicine, 2021, meta-analysis; soccer &amp; basketball
              athlete-exposure injury surveillance data (NCAA / high school).
            </div>
          </div>
        </section>

        <section className="slide">
          <div className="eyebrow">Myth 02</div>
          <div className="myth-box">
            <div className="myth-label">Claim</div>
            <div className="myth-text">
              It&apos;s just chaotic workouts — not real fitness gains.
            </div>
            <div className="fact-label frag" data-step="1">
              Reality
            </div>
            <div className="fact-text frag" data-step="2">
              A 10-week study measured real change: VO2max rose from{' '}
              <b className="accent2">43 → 49</b> in men and <b className="accent2">36 → 40</b>{' '}
              in women — plus a meaningful drop in body fat.
            </div>
            <div className="cite frag" data-step="2">
              Journal of Strength and Conditioning Research, 2013, &quot;CrossFit-Based
              High-Intensity Power Training Improves Maximal Aerobic Fitness and Body
              Composition.&quot;
            </div>
          </div>
        </section>

        <section className="slide">
          <div className="eyebrow">Myth 03</div>
          <div className="myth-box">
            <div className="myth-label">Claim</div>
            <div className="myth-text">The workouts themselves are dangerous.</div>
            <div className="fact-label frag" data-step="1">
              Reality
            </div>
            <div className="fact-text frag" data-step="2">
              Experienced athletes almost never get hurt — it&apos;s mostly{' '}
              <b className="accent2">beginners</b>, roughly 3x more often. Because CrossFit is
              coached, small-group training, that&apos;s usually just ego pushing past what
              you&apos;re ready for — not the workout&apos;s fault.
            </div>
            <div className="cite frag" data-step="2">
              Prospective cohort data on novice CrossFit participants, PMC.
            </div>
          </div>
        </section>

        <section className="slide center">
          <div className="eyebrow">Back to the question</div>
          <h2>What does &quot;fit&quot; actually mean?</h2>
          <p className="lead frag close-lead">
            It means being broad enough for all ten skills, adaptable enough for every energy
            system, and scalable enough for any age or body.
          </p>
          <p className="lead frag accent2 close-tagline">
            That&apos;s fitness. That&apos;s CrossFit.
          </p>
        </section>

        <section className="slide center">
          <div className="eyebrow frag">Thank you</div>
          <h1>
            Questions<span className="accent">?</span>
          </h1>
        </section>
      </div>

      <div className="hud">
        <div className="progresswrap">
          <div className="bar" ref={barRef} />
        </div>
        <div className="counter" ref={counterRef}>
          1 / 13
        </div>
      </div>
    </>
  )
}
