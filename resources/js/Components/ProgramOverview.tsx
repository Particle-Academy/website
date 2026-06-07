import {
    Action,
    Badge,
    Card,
    Heading,
    Text,
} from "@particle-academy/react-fancy";
import {
    Briefcase,
    Dumbbell,
    Heart,
    Lightbulb,
    Monitor,
    Rocket,
    Users,
} from "lucide-react";
import type { ReactNode } from "react";

interface ProgramCardProps {
    icon: ReactNode;
    accent: "cyan" | "blue" | "violet";
    title: string;
    body: string;
}

const ACCENT_BG: Record<ProgramCardProps["accent"], string> = {
    cyan: "bg-cyan-50 text-cyan-700 border-cyan-100",
    blue: "bg-blue-50 text-blue-700 border-blue-100",
    violet: "bg-violet-50 text-violet-700 border-violet-100",
};

function ProgramCard({ icon, accent, title, body }: ProgramCardProps) {
    return (
        <Card>
            <Card.Body className="p-6">
                <div
                    className={`w-12 h-12 rounded-xl border flex items-center justify-center mb-4 ${ACCENT_BG[accent]}`}
                >
                    {icon}
                </div>
                <Heading level={3} size="md" className="text-zinc-900 mb-2">
                    {title}
                </Heading>
                <Text size="sm" className="text-zinc-600 leading-relaxed">
                    {body}
                </Text>
            </Card.Body>
        </Card>
    );
}

interface CriterionProps {
    number: number;
    title: string;
    body: string;
}

function Criterion({ number, title, body }: CriterionProps) {
    return (
        <div className="flex gap-4">
            <div className="flex-shrink-0 w-9 h-9 rounded-full bg-violet-600 text-white font-semibold flex items-center justify-center text-sm">
                {number}
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

interface PillarSummaryProps {
    icon: ReactNode;
    label: string;
}

function PillarSummary({ icon, label }: PillarSummaryProps) {
    return (
        <div className="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/15 text-white text-sm">
            {icon} {label}
        </div>
    );
}

export default function ProgramOverview() {
    return (
        <div id="programs" className="space-y-8">
            <div className="text-center" data-aos="fade-up" data-aos-duration="800">
                <Badge color="violet" variant="soft" className="mb-4">
                    Pathways to Growth
                </Badge>
                <Heading level={2} size="lg" className="text-zinc-900 mb-2">
                    Holistic programs for innovators, entrepreneurs, and changemakers.
                </Heading>
                <Text className="text-zinc-600 max-w-3xl mx-auto">
                    The Particle Academy Community Accelerator empowers individuals through a
                    comprehensive approach to personal and professional development.
                </Text>
            </div>

            <div className="grid md:grid-cols-3 gap-5">
                <ProgramCard
                    icon={<Rocket className="w-6 h-6" />}
                    accent="cyan"
                    title="Accelerator Program"
                    body="Flagship program providing comprehensive support, mentorship, and resources to transform innovative ideas into successful ventures."
                />
                <ProgramCard
                    icon={<Briefcase className="w-6 h-6" />}
                    accent="blue"
                    title="Internship Pathways"
                    body="Structured opportunities connecting talented individuals with established businesses and mentors in their field of interest."
                />
                <ProgramCard
                    icon={<Users className="w-6 h-6" />}
                    accent="violet"
                    title="Community Growth"
                    body="Strong community connections through collaboration, networking events, and shared resources for sustainable growth."
                />
            </div>

            <Card>
                <Card.Body className="p-8">
                    <Heading level={3} size="md" className="text-zinc-900 mb-6">
                        Eligibility Criteria
                    </Heading>
                    <div className="grid md:grid-cols-2 gap-6">
                        <Criterion
                            number={1}
                            title="Innovation Potential"
                            body="Projects demonstrating innovative approaches to real-world problems."
                        />
                        <Criterion
                            number={2}
                            title="Community Impact"
                            body="Potential to create meaningful change in communities."
                        />
                        <Criterion
                            number={3}
                            title="Growth Mindset"
                            body="Committed to personal and professional growth, open to collaboration."
                        />
                        <Criterion
                            number={4}
                            title="Dedication"
                            body="Willing to commit time and effort to comprehensive development."
                        />
                    </div>
                </Card.Body>
            </Card>

            <div className="relative overflow-hidden rounded-3xl p-8 bg-gradient-to-r from-cyan-500 to-violet-600 text-white">
                <div className="md:flex items-center gap-8">
                    <div className="md:flex-1 mb-6 md:mb-0">
                        <Heading level={3} size="lg" className="text-white mb-3">
                            Ready to accelerate your growth?
                        </Heading>
                        <Text className="text-white/90 mb-5">
                            Martial arts, leadership, digital skills, and well-being — combined
                            into one holistic program.
                        </Text>
                        <div className="flex flex-wrap gap-2">
                            <PillarSummary
                                icon={<Dumbbell className="w-4 h-4" />}
                                label="Martial Arts"
                            />
                            <PillarSummary
                                icon={<Lightbulb className="w-4 h-4" />}
                                label="Leadership"
                            />
                            <PillarSummary
                                icon={<Monitor className="w-4 h-4" />}
                                label="Digital Skills"
                            />
                            <PillarSummary
                                icon={<Heart className="w-4 h-4" />}
                                label="Wellbeing"
                            />
                        </div>
                    </div>
                    <div>
                        <Action
                            href="#waiting-list"
                            color="zinc"
                            size="lg"
                            className="!bg-white !text-violet-700 hover:!bg-zinc-50 border-0"
                        >
                            Join Waitlist
                        </Action>
                    </div>
                </div>
            </div>
        </div>
    );
}
