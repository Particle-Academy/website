import { Head, usePage } from "@inertiajs/react";
import { Action, Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import {
    Building,
    Calendar,
    Camera,
    Church,
    CheckCircle2,
    Code,
    DollarSign,
    Globe,
    Home,
    Menu,
    Users,
    X,
} from "lucide-react";
import type { ReactNode } from "react";

interface SharedProps {
    appUrl: string;
}

interface PainProps {
    text: string;
}

function Pain({ text }: PainProps) {
    return (
        <div className="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm border border-stone-100">
            <div className="w-9 h-9 rounded-full bg-red-100 text-red-500 flex items-center justify-center flex-shrink-0">
                <X className="w-4 h-4" />
            </div>
            <Text size="sm" className="text-stone-700">
                {text}
            </Text>
        </div>
    );
}

interface FeatureProps {
    icon: ReactNode;
    title: string;
    body: string;
}

function Feature({ icon, title, body }: FeatureProps) {
    return (
        <Card>
            <Card.Body className="p-8">
                <div className="w-12 h-12 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center mb-5">
                    {icon}
                </div>
                <Heading level={3} size="md" className="text-stone-900 mb-2">
                    {title}
                </Heading>
                <Text size="sm" className="text-stone-600 leading-relaxed">
                    {body}
                </Text>
            </Card.Body>
        </Card>
    );
}

interface UseCaseProps {
    icon: ReactNode;
    title: string;
    body: string;
}

function UseCase({ icon, title, body }: UseCaseProps) {
    return (
        <Card>
            <Card.Body className="p-6 text-center">
                <div className="w-10 h-10 mx-auto rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center mb-3">
                    {icon}
                </div>
                <Heading level={4} size="sm" className="text-stone-900 mb-1">
                    {title}
                </Heading>
                <Text size="sm" className="text-stone-600">
                    {body}
                </Text>
            </Card.Body>
        </Card>
    );
}

export default function TribeTrip() {
    const { appUrl } = usePage<SharedProps & Record<string, unknown>>().props;

    return (
        <>
            <Head>
                <title>Tribe Trip</title>
            </Head>

            <div className="bg-stone-50 text-stone-900 font-sans antialiased min-h-screen">
                <header className="bg-white/95 backdrop-blur-sm border-b border-stone-200 sticky top-0 z-50">
                    <div className="container mx-auto px-4 py-3 flex justify-between items-center max-w-7xl">
                        <a
                            href="#"
                            className="font-bold text-xl tracking-tight text-amber-700 flex items-center gap-2"
                        >
                            <Globe className="w-6 h-6" /> Tribe Trip
                        </a>
                        <nav className="hidden md:flex gap-1">
                            <a href="#about" className="text-stone-600 hover:text-amber-700 px-3 py-2 rounded-lg hover:bg-stone-50 transition-colors text-sm">About</a>
                            <a href="#features" className="text-stone-600 hover:text-amber-700 px-3 py-2 rounded-lg hover:bg-stone-50 transition-colors text-sm">Features</a>
                            <a href="#contact" className="text-stone-600 hover:text-amber-700 px-3 py-2 rounded-lg hover:bg-stone-50 transition-colors text-sm">Contact</a>
                        </nav>
                        <Action color="amber" size="sm" href="https://github.com/Particle-Academy/tribe-trip">Get Started</Action>
                    </div>
                </header>

                <main className="container mx-auto px-4 py-12 space-y-20 max-w-7xl">
                    <section id="home" className="text-center py-12">
                        <Badge color="green" variant="soft" className="mb-4">
                            Community Resource Sharing
                        </Badge>
                        <Heading level={1} size="xl" className="text-stone-900 leading-tight mb-6">
                            Share smarter. <span className="text-teal-600">Live better.</span>
                        </Heading>
                        <Text size="lg" className="max-w-2xl mx-auto text-stone-600 mb-10">
                            The easy way for small communities to share vehicles, equipment, and spaces — with transparent tracking and fair billing.
                        </Text>
                        <div className="flex flex-col sm:flex-row justify-center gap-3">
                            <Action href="https://github.com/Particle-Academy/tribe-trip" color="amber" size="lg">Get Started</Action>
                            <Action color="zinc" variant="ghost" size="lg" disabled>Live Demo</Action>
                        </div>
                    </section>

                    <section id="about" className="grid md:grid-cols-2 gap-12 items-center">
                        <div className="space-y-3">
                            <Pain text="Scheduling conflicts" />
                            <Pain text="Unclear accountability" />
                            <Pain text="Unfair cost splitting" />
                        </div>
                        <div>
                            <Heading level={2} size="lg" className="text-stone-900 mb-4">
                                Stop managing resources with clipboards and text chains.
                            </Heading>
                            <Text className="text-stone-600 mb-6">
                                Small communities often share resources informally — leading to double-bookings, damage disputes, and administrative headaches. Tribe Trip is a complete platform to professionalize your sharing economy without losing the community feel.
                            </Text>
                            <ul className="space-y-2">
                                {["Visual calendar booking", "Photo-based check-in/out", "Automated usage invoicing"].map((line) => (
                                    <li key={line} className="flex items-center gap-2">
                                        <CheckCircle2 className="text-teal-600 w-5 h-5" />
                                        <Text size="sm" className="text-stone-700">{line}</Text>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </section>

                    <section id="features" className="space-y-8">
                        <div className="text-center">
                            <Badge color="green" variant="soft" className="mb-4">Features</Badge>
                            <Heading level={2} size="lg" className="text-stone-900 mb-2">
                                Everything you need to share.
                            </Heading>
                            <Text className="text-stone-600 max-w-2xl mx-auto">
                                From booking to billing, we handle the logistics so you can focus on the resource.
                            </Text>
                        </div>
                        <div className="grid md:grid-cols-3 gap-5">
                            <Feature icon={<Calendar className="w-6 h-6" />} title="Easy Reservations" body="Visual calendar shows real-time availability. Book vehicles, equipment, or spaces instantly from any device." />
                            <Feature icon={<Camera className="w-6 h-6" />} title="Mobile Check-out" body="Capture odometer readings and condition photos on your phone, before and after use, for full accountability." />
                            <Feature icon={<DollarSign className="w-6 h-6" />} title="Fair Billing" body="Track usage by mile, hour, or flat fee. Automatically generate itemized monthly invoices for every member." />
                        </div>
                    </section>

                    <section className="space-y-6">
                        <div className="text-center">
                            <Heading level={2} size="lg" className="text-stone-900">Perfect for…</Heading>
                        </div>
                        <div className="grid md:grid-cols-4 gap-4">
                            <UseCase icon={<Home className="w-5 h-5" />} title="HOAs" body="Share tools, clubhouses, and maintenance equipment." />
                            <UseCase icon={<Users className="w-5 h-5" />} title="Co-ops" body="Manage shared vehicles, cargo bikes, and guest rooms." />
                            <UseCase icon={<Church className="w-5 h-5" />} title="Churches" body="Coordinate van usage, AV equipment, and event spaces." />
                            <UseCase icon={<Building className="w-5 h-5" />} title="Clubs" body="Track specialized gear, boats, or recreational assets." />
                        </div>
                    </section>

                    <section id="contact" className="rounded-3xl overflow-hidden bg-gradient-to-br from-stone-900 to-teal-900 text-white p-12 text-center">
                        <Heading level={2} size="xl" className="text-white mb-4">Ready to organize your community?</Heading>
                        <Text size="lg" className="text-stone-300 mb-8 max-w-2xl mx-auto">
                            Tribe Trip is open source and available for self-hosting. A hosted version is in the works.
                        </Text>
                        <div className="flex flex-col sm:flex-row justify-center gap-3">
                            <Action href="https://github.com/Particle-Academy/tribe-trip" color="zinc" size="lg" className="!bg-white !text-stone-900">
                                <Code className="w-4 h-4 mr-2 inline" /> View on GitHub
                            </Action>
                            <Action color="zinc" variant="ghost" size="lg" className="!text-white">
                                Join Hosted Waitlist
                            </Action>
                        </div>
                    </section>
                </main>

                <footer className="bg-stone-900 text-stone-400 py-12 border-t border-stone-800 mt-12">
                    <div className="container mx-auto px-4 max-w-7xl">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                            <div className="flex items-center gap-2 text-white font-bold text-lg">
                                <Globe className="w-5 h-5 text-amber-500" /> Tribe Trip
                            </div>
                            <div className="flex gap-6 text-sm">
                                <a href={`${appUrl}/privacy`} className="hover:text-amber-500 transition-colors">Privacy</a>
                                <a href={`${appUrl}/terms`} className="hover:text-amber-500 transition-colors">Terms</a>
                            </div>
                        </div>
                        <div className="border-t border-stone-800 pt-6 flex flex-col md:flex-row justify-between items-center text-sm gap-3">
                            <div>&copy; {new Date().getFullYear()} Tribe Trip. All rights reserved.</div>
                            <a href={appUrl} className="flex items-center gap-2 hover:text-white transition-colors group">
                                <span>Built by</span>
                                <img src={`${appUrl}/images/particle1.png`} alt="Particle Academy" className="h-6 w-auto grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all" />
                                <span className="font-semibold">Particle Academy</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}
