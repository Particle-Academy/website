import { Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import Layout from "../Layout";

export default function Terms() {
    const lastUpdated = new Date().toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });

    return (
        <Layout title="Terms of Service">
            <div className="min-h-screen bg-zinc-50">
                <div className="container mx-auto px-4 py-12 max-w-3xl">
                    <Card>
                        <Card.Body className="p-10 space-y-6">
                            <div className="text-center">
                                <Badge color="violet" variant="soft" className="mb-4">
                                    Legal
                                </Badge>
                                <Heading
                                    level={1}
                                    size="xl"
                                    className="particle-text-gradient mb-2"
                                >
                                    Terms of Service
                                </Heading>
                                <Text size="sm" className="text-zinc-500">
                                    Last updated: {lastUpdated}
                                </Text>
                            </div>

                            <div className="prose prose-zinc max-w-none">
                                <Text className="text-zinc-700">
                                    Welcome to Particle Academy. By using our services, you
                                    agree to these Terms of Service.
                                </Text>

                                <Heading
                                    level={2}
                                    size="md"
                                    className="text-zinc-900 mt-8 mb-2"
                                >
                                    1. Acceptance of Terms
                                </Heading>
                                <Text className="text-zinc-700">
                                    By accessing or using our website and services, you
                                    agree to be bound by these Terms. If you do not agree,
                                    please do not use our services.
                                </Text>

                                <Heading
                                    level={2}
                                    size="md"
                                    className="text-zinc-900 mt-8 mb-2"
                                >
                                    2. Use of Services
                                </Heading>
                                <Text className="text-zinc-700">
                                    You agree to use our services only for lawful purposes
                                    and in accordance with these Terms.
                                </Text>

                                <Heading
                                    level={2}
                                    size="md"
                                    className="text-zinc-900 mt-8 mb-2"
                                >
                                    3. Intellectual Property
                                </Heading>
                                <Text className="text-zinc-700">
                                    All content and materials available on Particle Academy
                                    are the property of Particle Academy or its licensors.
                                </Text>

                                <Heading
                                    level={2}
                                    size="md"
                                    className="text-zinc-900 mt-8 mb-2"
                                >
                                    4. Contact Us
                                </Heading>
                                <Text className="text-zinc-700">
                                    If you have any questions about these Terms, please
                                    contact us at{" "}
                                    <a
                                        href="mailto:support@particle.academy"
                                        className="text-violet-700 hover:underline"
                                    >
                                        support@particle.academy
                                    </a>
                                    .
                                </Text>
                            </div>
                        </Card.Body>
                    </Card>
                </div>
            </div>
        </Layout>
    );
}
