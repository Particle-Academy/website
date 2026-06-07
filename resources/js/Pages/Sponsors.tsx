import { Action, Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import { Heart } from "lucide-react";
import Layout from "../Layout";

export default function Sponsors() {
    return (
        <Layout title="Sponsors">
            <div className="min-h-screen bg-zinc-50">
                <div className="container mx-auto px-4 py-16 max-w-3xl">
                    <Card>
                        <Card.Body className="p-12 text-center space-y-6">
                            <div className="w-14 h-14 mx-auto rounded-2xl bg-violet-100 text-violet-700 flex items-center justify-center">
                                <Heart className="w-7 h-7" />
                            </div>
                            <Badge color="violet" variant="soft">
                                Sponsors
                            </Badge>
                            <Heading
                                level={1}
                                size="xl"
                                className="particle-text-gradient"
                            >
                                Become a Founding Sponsor
                            </Heading>
                            <Text className="text-zinc-600 max-w-md mx-auto">
                                We're lining up the founding sponsors who'll help us
                                accelerate Milwaukee's next wave of community-driven
                                innovation. Reach out if your organization wants in.
                            </Text>
                            <div className="pt-2">
                                <Action
                                    href="mailto:info@particle.academy"
                                    color="violet"
                                    size="md"
                                >
                                    Get in Touch
                                </Action>
                            </div>
                        </Card.Body>
                    </Card>
                </div>
            </div>
        </Layout>
    );
}
