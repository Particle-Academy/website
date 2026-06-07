import { Link } from "@inertiajs/react";
import { Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import { Award, Eye, Sparkles } from "lucide-react";
import type { ReactNode } from "react";
import Layout from "../Layout";
import WaitingList from "../Components/WaitingList";

interface BenefitProps {
    icon: ReactNode;
    title: string;
    body: string;
}

const BENEFITS: BenefitProps[] = [
    {
        icon: <Sparkles className="w-6 h-6" />,
        title: "Community Impact",
        body: "Help us expand access to life-changing programs and resources for youth and adults.",
    },
    {
        icon: <Eye className="w-6 h-6" />,
        title: "Brand Visibility",
        body: "Showcase your brand to a growing, engaged audience through events, media, and more.",
    },
    {
        icon: <Award className="w-6 h-6" />,
        title: "Legacy Making",
        body: "Be part of the legacy in Milwaukee's next generation of leaders and creators.",
    },
];

export default function Partners() {
    return (
        <Layout title="Become a Partner">
            <div className="min-h-screen bg-zinc-50">
                <div className="container mx-auto px-4 py-12 space-y-16 max-w-7xl">
                    <section className="text-center">
                        <Link href="/" className="inline-block mb-8">
                            <img
                                src="/images/particle1.png"
                                alt="Particle Academy"
                                className="h-20 md:h-28 mx-auto"
                            />
                        </Link>
                        <Badge color="violet" variant="soft" className="mb-4">
                            Partnership
                        </Badge>
                        <Heading
                            level={1}
                            size="xl"
                            className="mb-4 particle-text-gradient"
                        >
                            Become a Partner
                        </Heading>
                        <Text size="lg" className="max-w-2xl mx-auto text-zinc-600">
                            Partner with us to help Milwaukee lead a new era of
                            exponential, community-driven growth in digital and physical
                            goods and services.
                        </Text>
                    </section>

                    <section className="grid md:grid-cols-3 gap-5">
                        {BENEFITS.map((b) => (
                            <Card key={b.title}>
                                <Card.Body className="p-8 text-center space-y-4">
                                    <div className="w-14 h-14 mx-auto rounded-2xl bg-violet-100 text-violet-700 flex items-center justify-center">
                                        {b.icon}
                                    </div>
                                    <Heading
                                        level={3}
                                        size="md"
                                        className="text-zinc-900"
                                    >
                                        {b.title}
                                    </Heading>
                                    <Text size="sm" className="text-zinc-600">
                                        {b.body}
                                    </Text>
                                </Card.Body>
                            </Card>
                        ))}
                    </section>

                    <section>
                        <WaitingList />
                    </section>
                </div>
            </div>
        </Layout>
    );
}
