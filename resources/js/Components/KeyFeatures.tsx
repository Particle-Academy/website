import { Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import {
    Check,
    GraduationCap,
    Rocket,
    Search,
    Sparkles,
    TrendingUp,
    Users,
    Wrench,
    Zap,
} from "lucide-react";
import type { ReactNode } from "react";

interface FeatureProps {
    icon: ReactNode;
    title: string;
    body: string;
    bullets: string[];
}

function Feature({ icon, title, body, bullets }: FeatureProps) {
    return (
        <Card>
            <Card.Body className="p-6">
                <div className="flex items-start gap-4">
                    <div className="flex-shrink-0 w-12 h-12 rounded-xl bg-violet-100 text-violet-700 flex items-center justify-center">
                        {icon}
                    </div>
                    <div className="flex-1">
                        <Heading level={3} size="md" className="text-zinc-900 mb-1">
                            {title}
                        </Heading>
                        <Text size="sm" className="text-zinc-600 leading-relaxed mb-3">
                            {body}
                        </Text>
                        <ul className="space-y-1.5">
                            {bullets.map((b) => (
                                <li key={b} className="flex items-center gap-2">
                                    <Check className="w-4 h-4 text-violet-600" />
                                    <Text size="sm" className="text-zinc-700">
                                        {b}
                                    </Text>
                                </li>
                            ))}
                        </ul>
                    </div>
                </div>
            </Card.Body>
        </Card>
    );
}

interface JourneyStepProps {
    number: number;
    icon: ReactNode;
    title: string;
    body: string;
}

function JourneyStep({ number, icon, title, body }: JourneyStepProps) {
    return (
        <div className="relative flex flex-col items-center text-center">
            <div className="w-14 h-14 rounded-2xl bg-white border-2 border-violet-200 text-violet-700 flex items-center justify-center mb-3 shadow-sm">
                {icon}
            </div>
            <Badge color="violet" variant="soft" size="sm" className="mb-2">
                Step {number}
            </Badge>
            <Heading level={4} size="sm" className="text-zinc-900">
                {title}
            </Heading>
            <Text size="sm" className="text-zinc-600 mt-1">
                {body}
            </Text>
        </div>
    );
}

export default function KeyFeatures() {
    return (
        <div className="space-y-12">
            <div className="text-center" data-aos="fade-up" data-aos-duration="800">
                <Badge color="violet" variant="soft" className="mb-4">
                    What Sets Us Apart
                </Badge>
                <Heading level={2} size="lg" className="text-zinc-900 mb-2">
                    A comprehensive approach to your transformation.
                </Heading>
                <Text className="text-zinc-600 max-w-3xl mx-auto">
                    Mentorship, leadership, and tools that turn potential into reality.
                </Text>
            </div>

            <div
                className="grid md:grid-cols-2 gap-5"
                data-aos="fade-up"
                data-aos-delay="200"
                data-aos-duration="900"
            >
                <Feature
                    icon={<Users className="w-6 h-6" />}
                    title="Extensive Support Network"
                    body="A robust network of mentors, peers, and industry experts to guide you."
                    bullets={[
                        "One-on-one mentorship",
                        "Community collaboration",
                        "Expert guidance and feedback",
                    ]}
                />
                <Feature
                    icon={<Sparkles className="w-6 h-6" />}
                    title="Leadership Development"
                    body="Build essential leadership skills through targeted training and growth opportunities."
                    bullets={[
                        "Decision-making framework",
                        "Team management skills",
                        "Public speaking & communication",
                    ]}
                />
                <Feature
                    icon={<GraduationCap className="w-6 h-6" />}
                    title="Expert Mentorship"
                    body="Tailored guidance and insights from accomplished professionals in your field."
                    bullets={[
                        "Industry-specific guidance",
                        "Personalized growth plan",
                        "Real-world problem solving",
                    ]}
                />
                <Feature
                    icon={<Wrench className="w-6 h-6" />}
                    title="Business Success Tools"
                    body="Resources, tools, and frameworks to build and scale your venture."
                    bullets={[
                        "Business model development",
                        "Marketing and growth strategies",
                        "Funding and financial planning",
                    ]}
                />
            </div>

            <Card>
                <Card.Body className="p-10 bg-gradient-to-br from-violet-50 via-cyan-50 to-violet-50 rounded-2xl">
                    <div className="text-center mb-10">
                        <Heading level={3} size="md" className="text-zinc-900">
                            Your Transformation Journey
                        </Heading>
                    </div>

                    <div className="relative">
                        <div
                            className="hidden md:block absolute top-7 left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-violet-300 via-cyan-300 to-violet-300"
                            aria-hidden="true"
                        />
                        <div className="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                            <JourneyStep
                                number={1}
                                icon={<Search className="w-6 h-6" />}
                                title="Application"
                                body="Apply with your innovative idea or project."
                            />
                            <JourneyStep
                                number={2}
                                icon={<Zap className="w-6 h-6" />}
                                title="Discovery"
                                body="Identify strengths and areas for growth."
                            />
                            <JourneyStep
                                number={3}
                                icon={<TrendingUp className="w-6 h-6" />}
                                title="Development"
                                body="Acquire skills and build your project."
                            />
                            <JourneyStep
                                number={4}
                                icon={<Rocket className="w-6 h-6" />}
                                title="Launch"
                                body="Bring your vision to life in the market."
                            />
                        </div>
                    </div>
                </Card.Body>
            </Card>
        </div>
    );
}
