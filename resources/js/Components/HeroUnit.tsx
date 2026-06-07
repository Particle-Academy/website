import { Badge, Action, Heading, Text } from "@particle-academy/react-fancy";

export default function HeroUnit() {
    return (
        <section className="relative bg-white border border-zinc-200 rounded-3xl shadow-sm overflow-hidden">
            <div className="absolute inset-x-0 top-0 h-72 bg-gradient-to-br from-cyan-100/60 via-violet-100/40 to-transparent pointer-events-none" />

            <div className="relative px-6 sm:px-12 lg:px-20 py-16 lg:py-20 text-center">
                <div className="flex justify-center mb-6">
                    <img
                        src="/images/particle1.png"
                        alt="Particle Academy"
                        className="h-32 md:h-40 lg:h-48"
                    />
                </div>

                <Badge color="violet" variant="soft" size="md" className="mb-6">
                    The Community Accelerator
                </Badge>

                <Heading
                    level={1}
                    size="xl"
                    className="mb-6 particle-text-gradient leading-tight"
                >
                    Empowering individuals to transform their lives.
                </Heading>

                <Text size="lg" className="max-w-2xl mx-auto text-zinc-600 mb-10">
                    Mentorship, mastery, and mindful growth — making Milwaukee a beacon for
                    exponential, community-driven innovation.
                </Text>

                <div className="flex flex-col sm:flex-row items-center justify-center gap-3 mb-6">
                    <Action href="#waiting-list" color="violet" size="lg">
                        Join the Waitlist
                    </Action>
                    <Action href="#programs" color="zinc" variant="ghost" size="lg">
                        Explore Programs
                    </Action>
                </div>

                <div className="mt-10 flex justify-center gap-1.5" aria-hidden="true">
                    <span className="w-2 h-2 rounded-full bg-cyan-400 animate-pulse" />
                    <span className="w-2 h-2 rounded-full bg-blue-400 animate-pulse delay-100" />
                    <span className="w-2 h-2 rounded-full bg-violet-400 animate-pulse delay-200" />
                </div>
            </div>
        </section>
    );
}
