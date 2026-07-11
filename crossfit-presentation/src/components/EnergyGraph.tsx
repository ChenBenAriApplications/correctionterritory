import { useEffect, useRef } from 'react'

function catmullRomPath(points: number[][]) {
  if (points.length < 2) return ''
  let d = `M${points[0][0]},${points[0][1]} `
  for (let i = 0; i < points.length - 1; i++) {
    const p0 = points[i - 1] || points[i]
    const p1 = points[i]
    const p2 = points[i + 1]
    const p3 = points[i + 2] || p2
    const c1x = p1[0] + (p2[0] - p0[0]) / 6
    const c1y = p1[1] + (p2[1] - p0[1]) / 6
    const c2x = p2[0] - (p3[0] - p1[0]) / 6
    const c2y = p2[1] - (p3[1] - p1[1]) / 6
    d += `C${c1x},${c1y} ${c2x},${c2y} ${p2[0]},${p2[1]} `
  }
  return d
}

export default function EnergyGraph() {
  const containerRef = useRef<HTMLDivElement>(null)

  useEffect(() => {
    const container = containerRef.current
    if (!container) return

    const ns = 'http://www.w3.org/2000/svg'
    const w = 640
    const h = 340
    const padL = 54
    const padR = 16
    const padT = 16
    const padB = 44
    const plotW = w - padL - padR
    const plotH = h - padT - padB

    const X = (tFrac: number) => padL + tFrac * plotW
    const Y = (val: number) => padT + (1 - val / 100) * plotH

    const svg = document.createElementNS(ns, 'svg')
    svg.setAttribute('viewBox', `0 0 ${w} ${h}`)
    svg.setAttribute('width', '100%')
    svg.setAttribute('height', '100%')

    ;[0, 25, 50, 75, 100].forEach((v) => {
      const y = Y(v)
      const line = document.createElementNS(ns, 'line')
      line.setAttribute('x1', String(padL))
      line.setAttribute('y1', String(y))
      line.setAttribute('x2', String(w - padR))
      line.setAttribute('y2', String(y))
      line.setAttribute('stroke', '#e4ddd1')
      line.setAttribute('stroke-width', '1')
      svg.appendChild(line)

      const label = document.createElementNS(ns, 'text')
      label.setAttribute('x', String(padL - 10))
      label.setAttribute('y', String(y + 4))
      label.setAttribute('text-anchor', 'end')
      label.setAttribute('font-size', '12')
      label.setAttribute('fill', '#8a8378')
      label.textContent = String(v)
      svg.appendChild(label)
    })

    ;[
      [0, '0s'],
      [0.5, '60s'],
      [1, '120s'],
    ].forEach(([x, text]) => {
      const label = document.createElementNS(ns, 'text')
      label.setAttribute('x', String(X(x as number)))
      label.setAttribute('y', String(h - padB + 22))
      label.setAttribute('text-anchor', 'middle')
      label.setAttribute('font-size', '12')
      label.setAttribute('fill', '#8a8378')
      label.textContent = text as string
      svg.appendChild(label)
    })

    const axisX = document.createElementNS(ns, 'line')
    axisX.setAttribute('x1', String(padL))
    axisX.setAttribute('y1', String(h - padB))
    axisX.setAttribute('x2', String(w - padR))
    axisX.setAttribute('y2', String(h - padB))
    axisX.setAttribute('stroke', '#8a8378')
    axisX.setAttribute('stroke-width', '1.5')
    svg.appendChild(axisX)

    const curves = [
      {
        color: '#c96a4e',
        pts: [
          [0, 2],
          [0.05, 60],
          [0.08, 98],
          [0.12, 70],
          [0.18, 25],
          [0.25, 8],
          [0.4, 3],
          [0.6, 2],
          [1, 2],
        ],
      },
      {
        color: '#6a9c78',
        pts: [
          [0, 2],
          [0.15, 20],
          [0.3, 55],
          [0.4, 72],
          [0.48, 78],
          [0.55, 74],
          [0.7, 55],
          [0.85, 35],
          [1, 20],
        ],
      },
      {
        color: '#6f93b3',
        pts: [
          [0, 2],
          [0.15, 5],
          [0.3, 12],
          [0.45, 30],
          [0.55, 45],
          [0.65, 60],
          [0.75, 72],
          [0.85, 80],
          [0.95, 86],
          [1, 88],
        ],
      },
    ]

    const wrap = document.createElementNS(ns, 'g')
    curves.forEach((c) => {
      const pixelPts = c.pts.map((p) => [X(p[0]), Y(p[1])])
      const path = document.createElementNS(ns, 'path')
      path.setAttribute('d', catmullRomPath(pixelPts))
      path.setAttribute('fill', 'none')
      path.setAttribute('stroke', c.color)
      path.setAttribute('stroke-width', '3.5')
      path.setAttribute('stroke-linecap', 'round')
      path.classList.add('drawline')
      wrap.appendChild(path)
    })
    svg.appendChild(wrap)
    container.appendChild(svg)

    wrap.querySelectorAll('.drawline').forEach((p) => {
      const path = p as SVGPathElement
      const len = path.getTotalLength()
      path.style.strokeDasharray = String(len)
      path.style.strokeDashoffset = String(len)
      path.style.transition = 'stroke-dashoffset 1.6s ease'
    })

    return () => {
      container.innerHTML = ''
    }
  }, [])

  return <div className="energy-graph-box" ref={containerRef} />
}
