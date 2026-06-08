import SiteLayout from "../Layouts/SiteLayout";

const COACH_STUBS = [
    { initials: "CN", specialty: "Specialty Area" },
    { initials: "CN", specialty: "Specialty Area" },
    { initials: "CN", specialty: "Specialty Area" },
];

export default function Coaches() {
    return (
        <SiteLayout
            title="Coaches"
            description="Coaching Milwaukee to thrive in the age of exponential, direct-to-consumer innovation."
        >
            <section className="page-hero">
                <span className="eyebrow">
                    <span className="pip" />
                    Coaching
                </span>
                <h1>
                    Meet our <span className="grad">coaches</span>.
                </h1>
                <p>
                    Coaching Milwaukee to thrive in the age of exponential, direct-to-consumer
                    innovation.
                </p>
            </section>

            <div className="page-grid">
                {COACH_STUBS.map((c, i) => (
                    <div className="coach-card" key={i}>
                        <div className="avatar">{c.initials}</div>
                        <h3>Coach Name</h3>
                        <span className="specialty">{c.specialty}</span>
                        <p>Short bio or inspirational quote from the coach goes here.</p>
                    </div>
                ))}
            </div>
        </SiteLayout>
    );
}
