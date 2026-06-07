import { Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import Layout from "../Layout";

export default function Privacy() {
    const lastUpdated = new Date().toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });

    return (
        <Layout title="Privacy Policy">
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
                                    Privacy Policy
                                </Heading>
                                <Text size="sm" className="text-zinc-500">
                                    Last updated: {lastUpdated}
                                </Text>
                            </div>

                            <div className="prose prose-zinc max-w-none">
                                <Text className="text-zinc-700">
                                    At Particle Academy, we take your privacy seriously.
                                    This Privacy Policy explains how we collect, use, and
                                    protect your personal information.
                                </Text>

                                <Heading
                                    level={2}
                                    size="md"
                                    className="text-zinc-900 mt-8 mb-2"
                                >
                                    1. Information We Collect
                                </Heading>
                                <Text className="text-zinc-700">
                                    We may collect personal information such as your name,
                                    email address, and usage data when you interact with
                                    our services.
                                </Text>

                                <Heading
                                    level={2}
                                    size="md"
                                    className="text-zinc-900 mt-8 mb-2"
                                >
                                    2. How We Use Your Information
                                </Heading>
                                <Text className="text-zinc-700">
                                    We use your information to provide and improve our
                                    services, communicate with you, and ensure the security
                                    of our platform.
                                </Text>

                                <Heading
                                    level={2}
                                    size="md"
                                    className="text-zinc-900 mt-8 mb-2"
                                >
                                    3. Contact Us
                                </Heading>
                                <Text className="text-zinc-700">
                                    If you have any questions about this Privacy Policy,
                                    please contact us at{" "}
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
