import { Icon } from "@particle-academy/react-fancy";
import SiteLayout from "../Layouts/SiteLayout";

interface Benefit {
    tone: string;
    icon: string;
    title: string;
    body: string;
}

const BENEFITS: Benefit[] = [
    {
        tone: "t-indigo",
        icon: "sparkles",
        title: "Community Impact",
        body: "Help us expand access to life-changing programs and resources for youth and adults.",
    },
    {
        tone: "t-sky",
        icon: "eye",
        title: "Brand Visibility",
        body: "Showcase your brand to a growing, engaged audience through events, media, and more.",
    },
    {
        tone: "t-emerald",
        icon: "award",
        title: "Legacy Making",
        body: "Be part of the legacy in Milwaukee's next generation of leaders and creators.",
    },
];

export default function Partners() {
    return (
        <SiteLayout
            title="Become a Partner"
            description="Partner with us to help Milwaukee lead a new era of exponential, community-driven growth in digital and physical goods and services."
        >
            <section className="page-hero">
                <span className="eyebrow">
                    <span className="pip" />
                    Partnership
                </span>
                <h1>
                    Become a <span className="grad">partner</span>.
                </h1>
                <p>
                    Partner with us to help Milwaukee lead a new era of exponential,
                    community-driven growth — in digital and physical goods and services.
                </p>
            </section>

            <div className="page-grid">
                {BENEFITS.map((b) => (
                    <div className="benefit-card" key={b.title}>
                        <div className={`ic ${b.tone}`}><Icon name={b.icon} /></div>
                        <h3>{b.title}</h3>
                        <p>{b.body}</p>
                    </div>
                ))}
            </div>
        </SiteLayout>
    );
}
