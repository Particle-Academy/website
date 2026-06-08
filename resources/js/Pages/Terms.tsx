import SiteLayout from "../Layouts/SiteLayout";

export default function Terms() {
    const lastUpdated = new Date().toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });

    return (
        <SiteLayout title="Terms of Service">
            <section className="page-hero">
                <span className="eyebrow">
                    <span className="pip" />
                    Legal
                </span>
                <h1>
                    Terms of <span className="grad">Service</span>.
                </h1>
                <p>Last updated: {lastUpdated}</p>
            </section>

            <div className="prose-card">
                <div className="card">
                    <p>
                        Welcome to Particle Academy. By using our services, you agree to these
                        Terms of Service.
                    </p>

                    <h2>1. Acceptance of Terms</h2>
                    <p>
                        By accessing or using our website and services, you agree to be bound by
                        these Terms. If you do not agree, please do not use our services.
                    </p>

                    <h2>2. Use of Services</h2>
                    <p>
                        You agree to use our services only for lawful purposes and in accordance
                        with these Terms.
                    </p>

                    <h2>3. Intellectual Property</h2>
                    <p>
                        All content and materials available on Particle Academy are the property
                        of Particle Academy or its licensors.
                    </p>

                    <h2>4. Contact Us</h2>
                    <p>
                        If you have any questions about these Terms, please contact us at{" "}
                        <a href="mailto:support@particle.academy">support@particle.academy</a>.
                    </p>
                </div>
            </div>
        </SiteLayout>
    );
}
