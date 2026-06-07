import {
    Avatar,
    Badge,
    Card,
    Carousel,
    Heading,
    Text,
} from "@particle-academy/react-fancy";
import { Quote, Sparkles, Star } from "lucide-react";

interface Story {
    name: string;
    role: string;
    roleColor: "blue" | "violet" | "rose";
    quote: string;
    achievement: string;
    initials: string;
}

const STORIES: Story[] = [
    {
        name: "Sarah Johnson",
        role: "Digital Entrepreneur",
        roleColor: "blue",
        quote: "The mentorship and comprehensive support at Particle Academy transformed my app idea into a thriving business that now serves thousands. The focus on both business skills and personal growth was exactly what I needed.",
        achievement: "Launched mobile app with 20,000+ users",
        initials: "SJ",
    },
    {
        name: "Marcus Chen",
        role: "Martial Arts Instructor",
        roleColor: "violet",
        quote: "The holistic approach of combining physical training, leadership skills, and business acumen helped me build a successful martial arts program that now serves both adults and children in our community.",
        achievement: "Opened community dojo serving 150+ students",
        initials: "MC",
    },
    {
        name: "Aisha Rodriguez",
        role: "Community Organizer",
        roleColor: "rose",
        quote: "I came to Particle Academy with a vision for creating positive change in my neighborhood. Through their mentorship and resources, I've been able to launch initiatives that have made a tangible difference in people's lives.",
        achievement: "Created youth empowerment program reaching 200+ teens",
        initials: "AR",
    },
];

function StoryCard({ story }: { story: Story }) {
    return (
        <Card className="h-full">
            <Card.Body className="p-8 h-full flex flex-col">
                <div className="flex items-center justify-between mb-5">
                    <div className="flex items-center gap-3">
                        <Avatar size="md" fallback={story.initials} />
                        <div>
                            <Heading level={4} size="sm" className="text-zinc-900 leading-tight">
                                {story.name}
                            </Heading>
                            <Badge
                                color={story.roleColor}
                                variant="soft"
                                size="sm"
                                className="mt-1"
                            >
                                {story.role}
                            </Badge>
                        </div>
                    </div>
                    <div className="flex text-amber-400">
                        {Array.from({ length: 5 }).map((_, i) => (
                            <Star
                                key={i}
                                className="w-4 h-4 fill-current"
                            />
                        ))}
                    </div>
                </div>

                <div className="relative flex-1">
                    <Quote className="absolute -top-1 -left-1 w-6 h-6 text-zinc-200" />
                    <Text className="pl-7 text-zinc-700 italic leading-relaxed">
                        {story.quote}
                    </Text>
                </div>

                <div className="mt-6 pt-4 border-t border-zinc-100">
                    <Text size="sm" className="text-zinc-500">
                        <span className="font-semibold text-violet-700">Achievement:</span>{" "}
                        {story.achievement}
                    </Text>
                </div>
            </Card.Body>
        </Card>
    );
}

interface StatProps {
    value: string;
    label: string;
}

function Stat({ value, label }: StatProps) {
    return (
        <div className="text-center">
            <Heading level={3} size="xl" className="particle-text-gradient mb-1">
                {value}
            </Heading>
            <Text size="sm" className="text-zinc-600">
                {label}
            </Text>
        </div>
    );
}

export default function SuccessStories() {
    return (
        <div className="space-y-12">
            <div className="text-center" data-aos="fade-up" data-aos-duration="800">
                <Badge color="violet" variant="soft" className="mb-4">
                    Milwaukee's Stories of Transformation
                </Badge>
                <Heading level={2} size="lg" className="text-zinc-900 mb-2">
                    Real people. Real change.
                </Heading>
                <Text className="text-zinc-600 max-w-3xl mx-auto">
                    See how community members have transformed their lives and created meaningful
                    impact.
                </Text>
            </div>

            <div className="relative">
                <div className="absolute inset-0 z-10 pointer-events-none flex items-center justify-center">
                    <div className="bg-gradient-to-r from-cyan-500/90 to-violet-600/90 text-white px-6 py-3 rounded-full font-semibold shadow-lg backdrop-blur-sm flex items-center gap-2">
                        <Sparkles className="w-5 h-5" /> This could be you
                    </div>
                </div>

                <div className="opacity-60">
                    <Carousel>
                        <Carousel.Panels>
                            {STORIES.map((story) => (
                                <Carousel.Slide key={story.name}>
                                    <div className="px-2">
                                        <StoryCard story={story} />
                                    </div>
                                </Carousel.Slide>
                            ))}
                        </Carousel.Panels>
                        <div className="flex justify-center mt-6">
                            <Carousel.Steps />
                        </div>
                    </Carousel>
                </div>
            </div>

            <Card>
                <Card.Body className="p-8">
                    <div className="text-center mb-8">
                        <Heading level={3} size="md" className="text-zinc-900">
                            Our Impact
                        </Heading>
                        <Text size="sm" className="text-zinc-500 mt-1">
                            Measuring forward, not back.
                        </Text>
                    </div>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <Stat value="50+" label="Successful Ventures" />
                        <Stat value="200+" label="Program Graduates" />
                        <Stat value="75%" label="Community Retention" />
                        <Stat value="$2M+" label="Community Investment" />
                    </div>
                </Card.Body>
            </Card>
        </div>
    );
}
