import { Link } from "@inertiajs/react";
import {
    Action,
    Avatar,
    Badge,
    Card,
    Heading,
    Text,
} from "@particle-academy/react-fancy";
import { Sparkles } from "lucide-react";
import Layout from "../Layout";
import WaitingList from "../Components/WaitingList";

interface CoachStub {
    initials: string;
    specialty: string;
}

const COACHES: CoachStub[] = [
    { initials: "CN", specialty: "Specialty Area" },
    { initials: "CN", specialty: "Specialty Area" },
    { initials: "CN", specialty: "Specialty Area" },
];

export default function Coaches() {
    return (
        <Layout title="Coaches">
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
                            Coaching
                        </Badge>
                        <Heading
                            level={1}
                            size="xl"
                            className="mb-4 particle-text-gradient"
                        >
                            Meet Our Coaches
                        </Heading>
                        <Text size="lg" className="max-w-2xl mx-auto text-zinc-600">
                            Coaching Milwaukee to thrive in the age of exponential,
                            direct-to-consumer innovation.
                        </Text>
                    </section>

                    <section className="relative">
                        <div className="absolute inset-0 z-10 pointer-events-auto flex items-center justify-center">
                            <div className="bg-gradient-to-r from-cyan-500/90 to-violet-600/90 text-white px-6 py-3 rounded-full font-semibold shadow-lg backdrop-blur-sm flex items-center gap-2">
                                <Sparkles className="w-5 h-5" />
                                This could be you
                            </div>
                        </div>

                        <div className="opacity-40 grid md:grid-cols-3 gap-5">
                            {COACHES.map((coach, i) => (
                                <Card key={i}>
                                    <Card.Body className="p-8 text-center space-y-3">
                                        <div className="flex justify-center">
                                            <Avatar
                                                size="xl"
                                                fallback={coach.initials}
                                            />
                                        </div>
                                        <Heading
                                            level={3}
                                            size="md"
                                            className="text-zinc-900"
                                        >
                                            Coach Name
                                        </Heading>
                                        <Text size="sm" className="text-zinc-500">
                                            {coach.specialty}
                                        </Text>
                                        <Text size="sm" className="text-zinc-600">
                                            Short bio or inspirational quote from the coach
                                            goes here.
                                        </Text>
                                    </Card.Body>
                                </Card>
                            ))}
                        </div>
                    </section>

                    <section>
                        <WaitingList />
                    </section>
                </div>
            </div>
        </Layout>
    );
}
