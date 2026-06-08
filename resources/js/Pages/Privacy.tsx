import SiteLayout from "../Layouts/SiteLayout";

export default function Privacy() {
    const lastUpdated = new Date().toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });

    return (
        <SiteLayout title="Privacy Policy">
            <section className="page-hero">
                <span className="eyebrow">
                    <span className="pip" />
                    Legal
                </span>
                <h1>
                    Privacy <span className="grad">Policy</span>.
                </h1>
                <p>Last updated: {lastUpdated}</p>
            </section>

            <div className="prose-card">
                <div className="card">
                    <p>
                        At Particle Academy, we take your privacy seriously. This Privacy Policy
                        explains how we collect, use, and protect your personal information.
                    </p>

                    <h2>1. Information We Collect</h2>
                    <p>
                        We may collect personal information such as your name, email address, and
                        usage data when you interact with our services.
                    </p>

                    <h2>2. How We Use Your Information</h2>
                    <p>
                        We use your information to provide and improve our services, communicate
                        with you, and ensure the security of our platform.
                    </p>

                    <h2>3. Contact Us</h2>
                    <p>
                        If you have any questions about this Privacy Policy, please contact us at{" "}
                        <a href="mailto:support@particle.academy">support@particle.academy</a>.
                    </p>
                </div>
            </div>
        </SiteLayout>
    );
}
