import { useForm, usePage } from "@inertiajs/react";
import {
    ArrowRight,
    BookOpen,
    Briefcase,
    CheckCircle2,
    Compass,
    Hammer,
    HeartHandshake,
    Laptop,
    Rocket,
    ShieldCheck,
    Swords,
    UsersRound,
} from "lucide-react";
import { useCallback, useEffect, useRef, useState, type FormEvent } from "react";
import SiteLayout from "../Layouts/SiteLayout";

interface SharedProps {
    flash?: { message?: string };
}

const FOUNDATIONS = [
    {
        tone: "t-indigo",
        Icon: UsersRound,
        title: "Community",
        body: "A room of people moving in the same direction. Accountability, honest feedback, and momentum you can't manufacture alone.",
    },
    {
        tone: "t-sky",
        Icon: BookOpen,
        title: "Knowledge",
        body: "Mentorship and frameworks from people who've done it — so you spend your energy executing, not guessing.",
    },
    {
        tone: "t-emerald",
        Icon: Hammer,
        title: "Practical skills",
        body: "Hands-on work, not theory. You leave each block with something built, shipped, or earned.",
    },
];

const PILLARS = [
    {
        tone: "t-blue",
        Icon: Rocket,
        n: "01",
        title: "Entrepreneurship",
        body: "Turn an idea into something real — validation, first customers, and the discipline to keep going.",
    },
    {
        tone: "t-violet",
        Icon: Compass,
        n: "02",
        title: "Leadership",
        body: "Lead yourself first, then others. Decision-making, communication, and presence under pressure.",
    },
    {
        tone: "t-sky",
        Icon: Laptop,
        n: "03",
        title: "Digital skills",
        body: "The practical, modern toolkit — building, automating, and working alongside AI with confidence.",
    },
    {
        tone: "t-rose",
        Icon: Swords,
        n: "04",
        title: "Martial arts",
        body: "Discipline trained through the body. Focus, resilience, and respect that carry into everything else.",
    },
    {
        tone: "t-amber",
        Icon: Briefcase,
        n: "05",
        title: "Business development",
        body: "Growth that lasts — offers, relationships, and systems that compound past the first win.",
    },
    {
        tone: "t-emerald",
        Icon: HeartHandshake,
        n: "06",
        title: "Mentorship",
        body: "Guidance both ways. Learn from those ahead of you, then become the mentor for those behind.",
    },
];

interface NetNode {
    x: number;
    y: number;
    i: string;
    g: number;
    big?: boolean;
    count?: boolean;
}

const NET_NODES: NetNode[] = [
    { x: 50, y: 43, i: "YO", g: 0, big: true },
    { x: 30, y: 25, i: "AK", g: 1 },
    { x: 71, y: 24, i: "MR", g: 3 },
    { x: 16, y: 48, i: "JL", g: 2 },
    { x: 85, y: 45, i: "SD", g: 4 },
    { x: 37, y: 66, i: "TN", g: 5 },
    { x: 63, y: 67, i: "EP", g: 0 },
    { x: 80, y: 72, i: "RC", g: 3 },
    { x: 50, y: 18, i: "DV", g: 2 },
    { x: 90, y: 62, i: "+9", g: -1, count: true },
    { x: 24, y: 74, i: "LB", g: 6 },
];

const NET_EDGES: [number, number][] = [
    [0, 1], [0, 2], [0, 3], [0, 4], [0, 5], [0, 6], [0, 8],
    [1, 8], [2, 8], [1, 3], [2, 4], [5, 10], [6, 7], [3, 5],
    [4, 6], [5, 6], [4, 9], [7, 9], [3, 10],
];

const NET_GRADS: [string, string][] = [
    ["#818cf8", "#6366f1"],
    ["#60a5fa", "#3b82f6"],
    ["#38bdf8", "#0ea5e9"],
    ["#a78bfa", "#8b5cf6"],
    ["#34d399", "#10b981"],
    ["#fbbf24", "#f59e0b"],
    ["#fb7185", "#f43f5e"],
];

function useParticleField(hostRef: React.RefObject<HTMLElement | null>) {
    const canvasRef = useRef<HTMLCanvasElement | null>(null);

    useEffect(() => {
        const canvas = canvasRef.current;
        const host = hostRef.current;
        if (!canvas || !host) return;
        const ctx = canvas.getContext("2d");
        if (!ctx) return;
        const DPR = Math.min(window.devicePixelRatio || 1, 2);
        const palette = ["#7dd3fc", "#818cf8", "#c4b5fd", "#a5b4fc", "#bae6fd"];
        let W = 0;
        let H = 0;
        let pts: {
            x: number;
            y: number;
            vx: number;
            vy: number;
            r: number;
            col: string;
            a: number;
        }[] = [];
        let raf = 0;

        function resize() {
            if (!canvas || !host || !ctx) return;
            W = host.clientWidth;
            H = host.clientHeight;
            canvas.width = W * DPR;
            canvas.height = H * DPR;
            canvas.style.width = W + "px";
            canvas.style.height = H + "px";
            ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
            const n = Math.round(Math.min(70, W / 20));
            pts = [];
            for (let i = 0; i < n; i++) {
                pts.push({
                    x: Math.random() * W,
                    y: Math.random() * H,
                    vx: (Math.random() - 0.5) * 0.2,
                    vy: (Math.random() - 0.5) * 0.2,
                    r: Math.random() * 2.2 + 1.2,
                    col: palette[i % palette.length],
                    a: Math.random() * 0.5 + 0.3,
                });
            }
        }

        function tick() {
            if (!ctx) return;
            const dark = document.documentElement.getAttribute("data-theme") === "dark";
            ctx.clearRect(0, 0, W, H);
            const link = 120;
            for (let i = 0; i < pts.length; i++) {
                for (let j = i + 1; j < pts.length; j++) {
                    const dx = pts[i].x - pts[j].x;
                    const dy = pts[i].y - pts[j].y;
                    const d = Math.hypot(dx, dy);
                    if (d < link) {
                        ctx.globalAlpha = (1 - d / link) * (dark ? 0.12 : 0.08);
                        ctx.strokeStyle = dark ? "#818cf8" : "#6366f1";
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(pts[i].x, pts[i].y);
                        ctx.lineTo(pts[j].x, pts[j].y);
                        ctx.stroke();
                    }
                }
            }
            for (const p of pts) {
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < -10) p.x = W + 10;
                if (p.x > W + 10) p.x = -10;
                if (p.y < -10) p.y = H + 10;
                if (p.y > H + 10) p.y = -10;
                ctx.globalAlpha = p.a * (dark ? 1 : 0.85);
                ctx.fillStyle = p.col;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, 6.2832);
                ctx.fill();
            }
            ctx.globalAlpha = 1;
            raf = requestAnimationFrame(tick);
        }

        resize();
        tick();
        let rt: ReturnType<typeof setTimeout>;
        const onResize = () => {
            clearTimeout(rt);
            rt = setTimeout(resize, 150);
        };
        window.addEventListener("resize", onResize);
        return () => {
            cancelAnimationFrame(raf);
            window.removeEventListener("resize", onResize);
            clearTimeout(rt);
        };
    }, [hostRef]);

    return canvasRef;
}

function useNetworkVisual() {
    const hostRef = useRef<HTMLDivElement | null>(null);
    const svgRef = useRef<SVGSVGElement | null>(null);
    const nodesContainerRef = useRef<HTMLDivElement | null>(null);

    useEffect(() => {
        const host = hostRef.current;
        const svg = svgRef.current;
        const nodesEl = nodesContainerRef.current;
        if (!host || !svg || !nodesEl) return;
        const SVGNS = "http://www.w3.org/2000/svg";

        nodesEl.innerHTML = "";
        while (svg.firstChild) svg.removeChild(svg.firstChild);

        NET_NODES.forEach((n, idx) => {
            const d = document.createElement("div");
            d.className =
                "net-node" + (n.big ? " lg" : "") + (n.count ? " count" : "");
            d.style.left = n.x + "%";
            d.style.top = n.y + "%";
            const av = document.createElement("div");
            av.className = "net-av";
            if (!n.count) {
                const gr = NET_GRADS[n.g] || NET_GRADS[0];
                av.style.background = `linear-gradient(135deg, ${gr[0]}, ${gr[1]})`;
            }
            av.style.animationDelay = idx * 120 + "ms";
            av.textContent = n.i;
            d.appendChild(av);
            nodesEl.appendChild(d);
        });

        const lineEls = NET_EDGES.map(() => {
            const ln = document.createElementNS(SVGNS, "line");
            ln.setAttribute("class", "ln");
            svg.appendChild(ln);
            return ln;
        });

        const pulseEls: SVGCircleElement[] = [];
        for (let p = 0; p < 4; p++) {
            const pc = document.createElementNS(SVGNS, "circle");
            pc.setAttribute("class", "pulse");
            pc.setAttribute("r", "3");
            pc.style.opacity = "0";
            svg.appendChild(pc);
            pulseEls.push(pc);
        }

        let W = 0;
        let H = 0;
        const center = (n: NetNode) => ({ x: (n.x / 100) * W, y: (n.y / 100) * H });

        function layout() {
            if (!host || !svg) return;
            W = host.clientWidth;
            H = host.clientHeight;
            svg.setAttribute("viewBox", `0 0 ${W} ${H}`);
            NET_EDGES.forEach((e, idx) => {
                const a = center(NET_NODES[e[0]]);
                const b = center(NET_NODES[e[1]]);
                const ln = lineEls[idx];
                const len = Math.hypot(b.x - a.x, b.y - a.y);
                ln.setAttribute("x1", String(a.x));
                ln.setAttribute("y1", String(a.y));
                ln.setAttribute("x2", String(b.x));
                ln.setAttribute("y2", String(b.y));
                ln.style.setProperty("--len", len.toFixed(1));
            });
        }
        layout();

        let rt: ReturnType<typeof setTimeout>;
        const onResize = () => {
            clearTimeout(rt);
            rt = setTimeout(layout, 150);
        };
        window.addEventListener("resize", onResize);

        const drawTimers: ReturnType<typeof setTimeout>[] = [];
        const startTimer = setTimeout(() => {
            lineEls.forEach((ln, idx) => {
                drawTimers.push(setTimeout(() => ln.classList.add("in"), idx * 70));
            });
        }, 350);

        const pulses = pulseEls.map((el, k) => ({
            el,
            e: Math.floor(Math.random() * NET_EDGES.length),
            t: Math.random(),
            sp: 0.0016 + Math.random() * 0.0012,
            wait: k * 700,
        }));
        let last = performance.now();
        let raf = 0;
        function frame(now: number) {
            const dt = now - last;
            last = now;
            for (const pu of pulses) {
                if (pu.wait > 0) {
                    pu.wait -= dt;
                    pu.el.style.opacity = "0";
                    continue;
                }
                pu.t += pu.sp * dt;
                if (pu.t >= 1) {
                    pu.t = 0;
                    pu.e = Math.floor(Math.random() * NET_EDGES.length);
                    pu.wait = 300 + Math.random() * 900;
                }
                const e = NET_EDGES[pu.e];
                const a = center(NET_NODES[e[0]]);
                const b = center(NET_NODES[e[1]]);
                const x = a.x + (b.x - a.x) * pu.t;
                const y = a.y + (b.y - a.y) * pu.t;
                pu.el.setAttribute("cx", String(x));
                pu.el.setAttribute("cy", String(y));
                const fade = Math.sin(pu.t * Math.PI);
                pu.el.style.opacity = (fade * 0.9).toFixed(2);
            }
            raf = requestAnimationFrame(frame);
        }
        raf = requestAnimationFrame(frame);

        return () => {
            cancelAnimationFrame(raf);
            window.removeEventListener("resize", onResize);
            clearTimeout(rt);
            clearTimeout(startTimer);
            drawTimers.forEach((t) => clearTimeout(t));
        };
    }, []);

    return { hostRef, svgRef, nodesContainerRef };
}

interface WaitlistFormProps {
    submitLabel: string;
    submitted: boolean;
    onSubmitted: () => void;
}

function WaitlistForm({ submitLabel, submitted, onSubmitted }: WaitlistFormProps) {
    const form = useForm({ email: "" });

    function onSubmit(e: FormEvent) {
        e.preventDefault();
        form.post("/waiting-list", {
            preserveScroll: true,
            onSuccess: () => {
                onSubmitted();
                form.reset();
            },
        });
    }

    if (submitted) {
        return (
            <div className="wl-success">
                <CheckCircle2 />
                You're on the list — we'll be in touch.
            </div>
        );
    }

    return (
        <form className="waitlist" onSubmit={onSubmit} autoComplete="off">
            <input
                type="email"
                name="email"
                placeholder="you@email.com"
                aria-label="Email address"
                required
                value={form.data.email}
                onChange={(e) => form.setData("email", e.target.value)}
            />
            <button className="btn btn-primary" type="submit" disabled={form.processing}>
                {submitLabel}
                <ArrowRight />
            </button>
        </form>
    );
}

export default function Home() {
    const { props } = usePage<SharedProps & Record<string, unknown>>();
    const flashMessage = props.flash?.message;

    const heroRef = useRef<HTMLElement | null>(null);
    const canvasRef = useParticleField(heroRef);
    const { hostRef: netHostRef, svgRef: netSvgRef, nodesContainerRef: netNodesRef } =
        useNetworkVisual();

    const [submitted, setSubmitted] = useState(false);
    const handleSubmitted = useCallback(() => setSubmitted(true), []);

    useEffect(() => {
        if (flashMessage) setSubmitted(true);
    }, [flashMessage]);

    return (
        <SiteLayout
            title="The Community Accelerator"
            description="Particle Academy is a community accelerator that helps individuals transform their lives through community, knowledge, and practical skills."
        >
            <a id="top" />

            <section className="hero" ref={heroRef}>
                <canvas id="field" ref={canvasRef} />
                <div className="wrap">
                    <img
                        className="hero-logo"
                        src="/images/particle-mark.png"
                        alt="Particle Academy"
                    />
                    <span className="pill">
                        <span className="tag">Now forming</span>
                        Founding cohort · join the waiting list
                    </span>
                    <h1>
                        Become who you're capable of —
                        <br />
                        <span className="grad">together.</span>
                    </h1>
                    <p className="lede">
                        Particle Academy is a community accelerator that helps individuals
                        transform their lives through community, knowledge, and practical skills.
                    </p>

                    <WaitlistForm
                        submitLabel="Join the waiting list"
                        submitted={submitted}
                        onSubmitted={handleSubmitted}
                    />

                    {!submitted && (
                        <p className="wl-note">
                            <ShieldCheck />
                            No spam. Early members shape the first cohort.
                        </p>
                    )}
                </div>
            </section>

            <section id="foundations" className="wrap">
                <div className="sec-head">
                    <span className="eyebrow">
                        <span className="pip" />
                        Why an accelerator
                    </span>
                    <h2>Three things that actually change a life.</h2>
                    <p>
                        Most growth stalls in isolation. The accelerator is built on the three
                        forces that compound when you put them together.
                    </p>
                </div>
                <div className="found">
                    {FOUNDATIONS.map((f) => (
                        <div className="f" key={f.title}>
                            <div className={`ic ${f.tone}`}>
                                <f.Icon />
                            </div>
                            <h3>{f.title}</h3>
                            <p>{f.body}</p>
                        </div>
                    ))}
                </div>
            </section>

            <section id="pillars" className="wrap" style={{ paddingTop: 0 }}>
                <div className="sec-head">
                    <span className="eyebrow">
                        <span className="pip" />
                        What you'll build
                    </span>
                    <h2>Skills tracks for the whole person.</h2>
                    <p>
                        Sharpen the mind, the body, and the business. Move between tracks as your
                        goals change — and bring innovation to all of them.
                    </p>
                </div>
                <div className="pillars">
                    {PILLARS.map((p) => (
                        <div className="pillar" key={p.title}>
                            <div className="pillar-top">
                                <div className={`ic ${p.tone}`}>
                                    <p.Icon />
                                </div>
                                <span className="n">{p.n}</span>
                            </div>
                            <h4>{p.title}</h4>
                            <p>{p.body}</p>
                        </div>
                    ))}
                </div>
            </section>

            <section id="community" className="why">
                <div className="wrap">
                    <div className="why-grid">
                        <div>
                            <span className="eyebrow">
                                <span className="pip" />
                                The particle idea
                            </span>
                            <h2>On your own you're a point. Together you're a field.</h2>
                            <div className="why-body">
                                <p>
                                    A single particle doesn't do much. Put enough of them in the
                                    same space, moving with intent, and they form something with
                                    real force — a network that pulls each member further than
                                    they'd ever get alone.
                                </p>
                                <p>
                                    That's the whole model. We bring committed people into one
                                    room, connect them to mentors and to each other, and turn
                                    individual effort into collective momentum.
                                </p>
                            </div>
                            <div className="why-stats">
                                <div className="s">
                                    <div className="v">7</div>
                                    <div className="l">Skills tracks</div>
                                </div>
                                <div className="s">
                                    <div className="v">1</div>
                                    <div className="l">Founding cohort</div>
                                </div>
                                <div className="s">
                                    <div className="v">∞</div>
                                    <div className="l">Connections</div>
                                </div>
                            </div>
                        </div>
                        <div className="why-visual" ref={netHostRef}>
                            <svg className="net-svg" ref={netSvgRef} />
                            <div ref={netNodesRef} />
                            <span className="cap">one growing community</span>
                        </div>
                    </div>
                </div>
            </section>

            <section id="join" className="join">
                <div className="jbg" />
                <div className="wrap">
                    <span className="eyebrow">
                        <span className="pip" />
                        Limited founding spots
                    </span>
                    <h2>Join the waiting list.</h2>
                    <p>
                        Be first in line for the founding cohort. Early members help shape what
                        the accelerator becomes.
                    </p>

                    <WaitlistForm
                        submitLabel="Reserve my spot"
                        submitted={submitted}
                        onSubmitted={handleSubmitted}
                    />

                    {!submitted && (
                        <p className="wl-note">
                            It's free to join the list. No commitment until the cohort opens.
                        </p>
                    )}
                </div>
            </section>
        </SiteLayout>
    );
}
