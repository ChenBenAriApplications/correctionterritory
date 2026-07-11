import { useEffect, useRef } from 'react'

type RadarSeries = {
  color: string
  values: number[]
  step?: number
}

function buildRadar(
  container: HTMLElement,
  axisLabels: string[],
  series: RadarSeries[],
) {
  const ns = 'http://www.w3.org/2000/svg'
  const size = 440
  const cx = size / 2
  const cy = size / 2
  const r = 155
  const n = axisLabels.length

  const pt = (i: number, val: number) => {
    const angle = ((Math.PI * 2 * i) / n) - Math.PI / 2
    return [cx + r * val * Math.cos(angle), cy + r * val * Math.sin(angle)]
  }

  const svg = document.createElementNS(ns, 'svg')
  svg.setAttribute('viewBox', `0 0 ${size} ${size}`)
  svg.setAttribute('width', '100%')
  svg.setAttribute('height', '100%')

  ;[0.25, 0.5, 0.75, 1].forEach((g) => {
    let d = ''
    for (let i = 0; i < n; i++) {
      const p = pt(i, g)
      d += `${i === 0 ? 'M' : 'L'}${p[0]},${p[1]} `
    }
    d += 'Z'
    const path = document.createElementNS(ns, 'path')
    path.setAttribute('d', d)
    path.setAttribute('fill', 'none')
    path.setAttribute('stroke', '#e4ddd1')
    path.setAttribute('stroke-width', '1')
    svg.appendChild(path)
  })

  for (let i = 0; i < n; i++) {
    const p = pt(i, 1)
    const line = document.createElementNS(ns, 'line')
    line.setAttribute('x1', String(cx))
    line.setAttribute('y1', String(cy))
    line.setAttribute('x2', String(p[0]))
    line.setAttribute('y2', String(p[1]))
    line.setAttribute('stroke', '#e4ddd1')
    svg.appendChild(line)

    const lp = pt(i, 1.2)
    const text = document.createElementNS(ns, 'text')
    text.setAttribute('x', String(lp[0]))
    text.setAttribute('y', String(lp[1]))
    text.setAttribute('fill', '#8a8378')
    text.setAttribute('font-size', '12')
    text.setAttribute('text-anchor', 'middle')
    text.setAttribute('dominant-baseline', 'middle')
    text.textContent = axisLabels[i]
    svg.appendChild(text)
  }

  series.forEach((s) => {
    let d = ''
    for (let i = 0; i < n; i++) {
      const p = pt(i, s.values[i])
      d += `${i === 0 ? 'M' : 'L'}${p[0]},${p[1]} `
    }
    d += 'Z'
    const poly = document.createElementNS(ns, 'path')
    poly.setAttribute('d', d)
    poly.setAttribute('fill', s.color)
    poly.setAttribute('fill-opacity', '0.16')
    poly.setAttribute('stroke', s.color)
    poly.setAttribute('stroke-width', '2.5')
    poly.classList.add('frag')
    if (s.step !== undefined) {
      poly.setAttribute('data-step', String(s.step))
    }
    svg.appendChild(poly)
  })

  container.appendChild(svg)
}

export default function RadarChart() {
  const containerRef = useRef<HTMLDivElement>(null)

  useEffect(() => {
    const container = containerRef.current
    if (!container) return

    buildRadar(
      container,
      ['Cardio', 'Stamina', 'Strength', 'Flex', 'Power', 'Speed', 'Coord', 'Agility', 'Balance', 'Accuracy'],
      [
        { color: '#6f93b3', values: [0.9, 0.85, 0.25, 0.35, 0.2, 0.55, 0.35, 0.4, 0.3, 0.2], step: 1 },
        { color: '#9b7bb0', values: [0.2, 0.3, 0.95, 0.3, 0.85, 0.35, 0.3, 0.2, 0.35, 0.25], step: 3 },
        { color: '#6a9c78', values: [0.35, 0.4, 0.4, 0.95, 0.2, 0.15, 0.55, 0.35, 0.85, 0.4], step: 5 },
        { color: '#c96a4e', values: [0.85, 0.85, 0.85, 0.7, 0.85, 0.75, 0.8, 0.8, 0.75, 0.75], step: 7 },
      ],
    )

    return () => {
      container.innerHTML = ''
    }
  }, [])

  return <div className="radar-box" ref={containerRef} />
}
