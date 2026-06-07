import { Action, Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import { ArrowRight, Boxes, Layers, Sparkles, Wand2, Zap } from "lucide-react";
import type { ReactNode } from "react";

interface PillarProps {
    icon: ReactNode;
    title: string;
    body: string;
}

function Pillar({ icon, title, body }: PillarProps) {
    return (
        <Card className="bg-white/10 !border-white/20 backdrop-blur-sm">
            <Card.Body className="p-5">
                <div className="w-10 h-10 rounded-xl bg-white/15 text-white flex items-center justify-center mb-3">
                    {icon}
                </div>
                <Heading level={4} size="sm" className="text-white mb-1">
                    {title}
                </Heading>
                <Text size="sm" className="text-white/80 leading-relaxed">
                    {body}
                </Text>
            </Card.Body>
        </Card>
    );
}

const COMPONENT_PILLS = [
    "Card",
    "Carousel",
    "PromptInput",
    "MoodMeter",
    "Kanban",
    "ReasonTag",
    "Composer",
    "Timeline",
    "Editor",
    "DataDiagram",
    "Chart",
    "Sheets",
];

export default function FancyUiSpotlight() {
    return (
        <section className="relative overflow-hidden rounded-3xl bg-gradient-to-br from-violet-700 via-violet-600 to-indigo-700 text-white shadow-xl">
            {/* Decorative blobs */}
            <div className="absolute -top-24 -right-24 w-80 h-80 bg-fuchsia-400/30 rounded-full blur-3xl pointer-events-none" />
            <div className="absolute -bottom-24 -left-24 w-80 h-80 bg-cyan-300/20 rounded-full blur-3xl pointer-events-none" />

            <div className="relative px-6 sm:px-10 lg:px-14 py-14 lg:py-16">
                <div className="grid lg:grid-cols-5 gap-10 items-center">
                    <div className="lg:col-span-3 space-y-5">
                        <Badge
                            color="violet"
                            variant="soft"
                            className="!bg-white/15 !text-white !border-white/20"
                        >
                            <Sparkles className="w-3.5 h-3.5 mr-1 inline" /> Our flagship product
                        </Badge>

                        <Heading level={2} size="xl" className="text-white leading-tight">
                            Fancy UI — a kit where humans and agents share one surface.
                        </Heading>

                        <Text size="lg" className="text-white/90 leading-relaxed">
                            A Human+ component library that ships ~100 React + PHP primitives.
                            Every interactive component is controlled, bridgeable, and
                            agent-readable — built for the next wave of human-and-AI software.
                        </Text>

                        <div className="flex flex-wrap items-center gap-3 pt-2">
                            <Action
                                href="https://ui.particle.academy"
                                color="zinc"
                                size="lg"
                                className="!bg-white !text-violet-700 hover:!bg-white/90"
                            >
                                Explore the Kit <ArrowRight className="w-4 h-4 ml-2 inline" />
                            </Action>
                            <Action
                                href="https://github.com/Particle-Academy/react-fancy"
                                color="zinc"
                                variant="ghost"
                                size="lg"
                                className="!text-white border border-white/30 hover:!bg-white/10"
                            >
                                View on GitHub
                            </Action>
                        </div>

                        <div className="flex flex-wrap gap-2 pt-3">
                            {COMPONENT_PILLS.map((name) => (
                                <span
                                    key={name}
                                    className="text-xs font-mono px-2.5 py-1 rounded-full bg-white/10 border border-white/15 text-white/90"
                                >
                                    {name}
                                </span>
                            ))}
                        </div>
                    </div>

                    <div className="lg:col-span-2 grid grid-cols-2 gap-3">
                        <Pillar
                            icon={<Layers className="w-5 h-5" />}
                            title="React + PHP"
                            body="One design language, both runtimes."
                        />
                        <Pillar
                            icon={<Wand2 className="w-5 h-5" />}
                            title="Human+ primitives"
                            body="MagicWand, ReasonTag, MoodMeter."
                        />
                        <Pillar
                            icon={<Boxes className="w-5 h-5" />}
                            title="Headless companions"
                            body="holy-sheet, dark-slide, fancy-flow."
                        />
                        <Pillar
                            icon={<Zap className="w-5 h-5" />}
                            title="Agent-ready"
                            body="MCP bridges via agent-integrations."
                        />
                    </div>
                </div>
            </div>
        </section>
    );
}
