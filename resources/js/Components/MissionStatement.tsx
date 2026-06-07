import { Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import { GraduationCap, Heart, ShoppingBag } from "lucide-react";
import type { ReactNode } from "react";

interface PillarProps {
    icon: ReactNode;
    title: string;
    body: string;
}

function Pillar({ icon, title, body }: PillarProps) {
    return (
        <div className="flex gap-4">
            <div className="flex-shrink-0 w-11 h-11 rounded-xl bg-violet-50 text-violet-700 flex items-center justify-center">
                {icon}
            </div>
            <div>
                <Heading level={4} size="sm" className="text-zinc-900">
                    {title}
                </Heading>
                <Text size="sm" className="text-zinc-600 mt-1">
                    {body}
                </Text>
            </div>
        </div>
    );
}

export default function MissionStatement() {
    return (
        <Card padding="lg" data-aos="fade-up" data-aos-duration="800">
            <Card.Body>
                <div className="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <Badge color="violet" variant="soft" className="mb-4">
                            Our Mission
                        </Badge>
                        <Heading level={2} size="lg" className="text-zinc-900 mb-4">
                            Dissolve barriers. Accelerate community-driven innovation.
                        </Heading>
                        <Text className="text-zinc-600 leading-relaxed">
                            Through mentorship and comprehensive support, we begin in Milwaukee —
                            setting a new standard for what communities can achieve together.
                        </Text>
                    </div>

                    <div className="space-y-6">
                        <Pillar
                            icon={<GraduationCap className="w-5 h-5" />}
                            title="Education & Talent Development"
                            body="Accessible education and hands-on learning that meets people where they are."
                        />
                        <Pillar
                            icon={<ShoppingBag className="w-5 h-5" />}
                            title="Market Access"
                            body="Pathways for innovators to reach markets and achieve sustainable growth."
                        />
                        <Pillar
                            icon={<Heart className="w-5 h-5" />}
                            title="Holistic Well-being"
                            body="Nurturing the complete individual through physical, mental, and emotional support."
                        />
                    </div>
                </div>
            </Card.Body>
        </Card>
    );
}
