import { Head, Link } from "@inertiajs/react";
import { ArrowUpRight, Moon, Sun } from "lucide-react";
import { useEffect, useMemo, useState, type ReactNode } from "react";
import "../../css/home.css";

interface SiteLayoutProps {
    title?: string;
    description?: string;
    /** When false, the inner `<main>` won't add the standard `.wrap` padding. Useful for
     * pages whose top section is full-bleed (e.g. the home hero). */
    contained?: boolean;
    children: ReactNode;
}

function ThemeToggle() {
    const [theme, setTheme] = useState<"light" | "dark">("light");

    useEffect(() => {
        const saved =
            (typeof window !== "undefined" &&
                (localStorage.getItem("pa-theme") as "light" | "dark" | null)) ||
            null;
        const initial: "light" | "dark" =
            saved ??
            (typeof window !== "undefined" &&
            window.matchMedia?.("(prefers-color-scheme: dark)").matches
                ? "dark"
                : "light");
        setTheme(initial);
        applyTheme(initial);
    }, []);

    function applyTheme(t: "light" | "dark") {
        document.documentElement.setAttribute("data-theme", t);
        if (t === "dark") document.documentElement.classList.add("dark");
        else document.documentElement.classList.remove("dark");
    }

    function toggle() {
        const next: "light" | "dark" = theme === "dark" ? "light" : "dark";
        setTheme(next);
        applyTheme(next);
        try {
            localStorage.setItem("pa-theme", next);
        } catch {
            /* ignore */
        }
    }

    return (
        <button type="button" className="icon-btn" onClick={toggle} aria-label="Toggle theme">
            <Sun className="sun" />
            <Moon className="moon" />
        </button>
    );
}

export default function SiteLayout({
    title,
    description,
    contained = false,
    children,
}: SiteLayoutProps) {
    const year = useMemo(() => new Date().getFullYear(), []);
    const fullTitle = title
        ? `${title} | Particle Academy`
        : "Particle Academy — The Community Accelerator";

    return (
        <div className="pa-home">
            <Head>
                <title>{fullTitle}</title>
                {description && <meta name="description" content={description} />}
            </Head>

            <header className="nav">
                <div className="wrap nav-inner">
                    <Link className="brand" href="/">
                        <img
                            className="mark"
                            src="/images/particle-mark.png"
                            alt="Particle Academy"
                        />
                        <span className="brand-txt">
                            Particle&nbsp;Academy
                            <span className="brand-sub">A Civicognita Initiative</span>
                        </span>
                    </Link>
                    <nav className="nav-links">
                        <Link href="/#foundations">The accelerator</Link>
                        <Link href="/#pillars">What you'll build</Link>
                        <Link href="/#community">Community</Link>
                        <Link href="/#join">Waiting list</Link>
                    </nav>
                    <div className="nav-right">
                        <ThemeToggle />
                        <Link className="btn btn-primary" href="/#join">
                            Join the waiting list
                        </Link>
                    </div>
                </div>
            </header>

            {contained ? <main className="wrap">{children}</main> : <main>{children}</main>}

            <footer className="pa-footer">
                <div className="wrap">
                    <div className="foot-grid">
                        <div className="foot-brand">
                            <Link className="brand" href="/">
                                <img
                                    className="mark foot"
                                    src="/images/particle-mark.png"
                                    alt="Particle Academy"
                                />
                                Particle&nbsp;Academy
                            </Link>
                            <p>
                                The community accelerator — transforming lives through
                                community, knowledge, and practical skills.
                            </p>
                            <a
                                className="civ"
                                href="https://civicognita.com"
                                target="_blank"
                                rel="noreferrer"
                            >
                                A <strong>Civicognita</strong> Initiative
                                <ArrowUpRight />
                            </a>
                        </div>
                        <div className="foot-col">
                            <h5>Explore</h5>
                            <Link href="/#foundations">The accelerator</Link>
                            <Link href="/#pillars">Skills tracks</Link>
                            <Link href="/#community">Community</Link>
                            <Link href="/coaches">Coaches</Link>
                        </div>
                        <div className="foot-col">
                            <h5>Join</h5>
                            <Link href="/#join">Waiting list</Link>
                            <Link href="/partners">Partner with us</Link>
                            <Link href="/sponsors">Sponsors</Link>
                        </div>
                        <div className="foot-col">
                            <h5>Legal</h5>
                            <Link href="/privacy">Privacy</Link>
                            <Link href="/terms">Terms</Link>
                        </div>
                    </div>
                    <div className="foot-bottom">
                        <span>© {year} Particle Academy</span>
                        <span className="sp">
                            Empowering individuals · building community
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    );
}
