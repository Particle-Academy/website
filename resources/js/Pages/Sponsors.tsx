import { ArrowRight, Heart } from "lucide-react";
import SiteLayout from "../Layouts/SiteLayout";

export default function Sponsors() {
    return (
        <SiteLayout
            title="Sponsors"
            description="Become a founding sponsor of Particle Academy."
        >
            <section className="page-hero">
                <div
                    className="ic t-rose"
                    style={{
                        width: 56,
                        height: 56,
                        borderRadius: "var(--radius-xl)",
                        display: "inline-flex",
                        alignItems: "center",
                        justifyContent: "center",
                        marginBottom: 8,
                    }}
                >
                    <Heart />
                </div>
                <span className="eyebrow">
                    <span className="pip" />
                    Founding sponsors
                </span>
                <h1>
                    Become a <span className="grad">founding sponsor</span>.
                </h1>
                <p>
                    We're lining up the organizations that will help us accelerate Milwaukee's
                    next wave of community-driven innovation. Reach out if your organization
                    wants in.
                </p>
                <div style={{ marginTop: 24 }}>
                    <a className="btn btn-primary btn-lg" href="mailto:info@particle.academy">
                        Get in touch
                        <ArrowRight />
                    </a>
                </div>
            </section>
        </SiteLayout>
    );
}
