import {
    Action,
    Badge,
    Card,
    Field,
    Heading,
    Input,
    Text,
} from "@particle-academy/react-fancy";
import {
    Award,
    Facebook,
    Handshake,
    Instagram,
    Mail,
    MapPin,
    Twitter,
    Youtube,
} from "lucide-react";
import { useState, type ReactNode } from "react";

const AWARDS = [
    "Community Impact Award",
    "Innovation Excellence",
    "Entrepreneurship Catalyst",
];

interface SocialLinkProps {
    href: string;
    label: string;
    icon: ReactNode;
    colorClass: string;
}

function SocialLink({ href, label, icon, colorClass }: SocialLinkProps) {
    return (
        <a
            href={href}
            className="flex items-center gap-3 p-3 rounded-lg border border-zinc-200 hover:border-violet-300 hover:bg-violet-50/40 transition-colors"
        >
            <span
                className={`w-9 h-9 rounded-lg flex items-center justify-center text-white ${colorClass}`}
            >
                {icon}
            </span>
            <Text size="sm" className="text-zinc-800 font-medium">
                {label}
            </Text>
        </a>
    );
}

function NewsletterForm() {
    const [email, setEmail] = useState("");

    return (
        <form
            className="space-y-3"
            onSubmit={(e) => {
                e.preventDefault();
                /* hook up later */
            }}
        >
            <Field label="Newsletter">
                <Input
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    placeholder="your@email.com"
                    prefix={<Mail className="w-4 h-4" />}
                />
            </Field>
            <Action type="submit" color="violet" size="md" className="w-full">
                Subscribe
            </Action>
            <Text size="sm" className="text-zinc-500">
                By subscribing, you agree to our Privacy Policy.
            </Text>
        </form>
    );
}

export default function CommunityEngagement() {
    return (
        <div className="space-y-10">
            <div className="text-center" data-aos="fade-up" data-aos-duration="800">
                <Badge color="violet" variant="soft" className="mb-4">
                    Building a Connected Milwaukee
                </Badge>
                <Heading level={2} size="lg" className="text-zinc-900 mb-2">
                    Join the movement.
                </Heading>
                <Text className="text-zinc-600 max-w-3xl mx-auto">
                    A growing community transforming lives and creating positive change together.
                </Text>
            </div>

            {/* Partners + awards */}
            <Card>
                <Card.Body className="p-8 relative">
                    <div className="absolute inset-0 z-10 pointer-events-auto flex items-center justify-center">
                        <Action href="/partners" color="violet" size="md">
                            <Handshake className="w-4 h-4 mr-2 inline" /> Partner with Us
                        </Action>
                    </div>

                    <div className="opacity-30 pointer-events-none">
                        <div className="text-center mb-6">
                            <Heading level={3} size="md" className="text-zinc-900">
                                Our Partners & Accolades
                            </Heading>
                        </div>

                        <div className="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                            {[1, 2, 3, 4, 5].map((i) => (
                                <div
                                    key={i}
                                    className="bg-zinc-50 border border-zinc-200 rounded-lg h-24 flex items-center justify-center"
                                >
                                    <Text className="text-zinc-400 font-semibold text-sm">
                                        Partner {i}
                                    </Text>
                                </div>
                            ))}
                        </div>

                        <div className="flex flex-wrap justify-center gap-2">
                            {AWARDS.map((award) => (
                                <Badge
                                    key={award}
                                    color="amber"
                                    variant="soft"
                                >
                                    <Award className="w-3.5 h-3.5 mr-1.5 inline" />
                                    {award}
                                </Badge>
                            ))}
                        </div>
                    </div>
                </Card.Body>
            </Card>

            {/* Contact + Social + Newsletter */}
            <div className="grid md:grid-cols-3 gap-5">
                <Card>
                    <Card.Body className="p-6 space-y-4">
                        <Heading level={3} size="md" className="text-zinc-900">
                            Contact Us
                        </Heading>
                        <div className="space-y-3">
                            <div className="flex items-start gap-3">
                                <span className="w-9 h-9 rounded-lg bg-cyan-50 text-cyan-700 flex items-center justify-center">
                                    <Mail className="w-4 h-4" />
                                </span>
                                <div>
                                    <Text size="sm" className="text-zinc-500">
                                        Email
                                    </Text>
                                    <a
                                        href="mailto:info@particle.academy"
                                        className="text-violet-700 hover:underline text-sm font-medium"
                                    >
                                        info@particle.academy
                                    </a>
                                </div>
                            </div>
                            <div className="flex items-start gap-3">
                                <span className="w-9 h-9 rounded-lg bg-cyan-50 text-cyan-700 flex items-center justify-center">
                                    <MapPin className="w-4 h-4" />
                                </span>
                                <div>
                                    <Text size="sm" className="text-zinc-500">
                                        Address
                                    </Text>
                                    <address className="not-italic text-sm text-zinc-800">
                                        1345 N Jefferson St. #448
                                        <br />
                                        Milwaukee, WI 53202
                                    </address>
                                </div>
                            </div>
                        </div>
                    </Card.Body>
                </Card>

                <Card>
                    <Card.Body className="p-6 space-y-4">
                        <Heading level={3} size="md" className="text-zinc-900">
                            Connect With Us
                        </Heading>
                        <div className="grid grid-cols-2 gap-2">
                            <SocialLink
                                href="#"
                                label="Facebook"
                                icon={<Facebook className="w-4 h-4" />}
                                colorClass="bg-blue-600"
                            />
                            <SocialLink
                                href="#"
                                label="Twitter"
                                icon={<Twitter className="w-4 h-4" />}
                                colorClass="bg-sky-500"
                            />
                            <SocialLink
                                href="#"
                                label="YouTube"
                                icon={<Youtube className="w-4 h-4" />}
                                colorClass="bg-red-600"
                            />
                            <SocialLink
                                href="#"
                                label="Instagram"
                                icon={<Instagram className="w-4 h-4" />}
                                colorClass="bg-gradient-to-br from-violet-500 to-rose-500"
                            />
                        </div>
                    </Card.Body>
                </Card>

                <Card>
                    <Card.Body className="p-6">
                        <Heading level={3} size="md" className="text-zinc-900 mb-2">
                            Newsletter
                        </Heading>
                        <Text size="sm" className="text-zinc-600 mb-4">
                            Latest news, events, and opportunities — straight to your inbox.
                        </Text>
                        <NewsletterForm />
                    </Card.Body>
                </Card>
            </div>

            <div className="rounded-3xl overflow-hidden bg-gradient-to-r from-cyan-500 to-violet-600 text-white">
                <div className="p-10 grid md:grid-cols-3 gap-6 items-center">
                    <div className="md:col-span-2">
                        <Heading level={3} size="lg" className="text-white mb-3">
                            Diverse Community, United Vision
                        </Heading>
                        <Text className="text-white/90 mb-5">
                            Innovation flourishes when different perspectives come together. Our
                            community brings a wide range of backgrounds, experiences, and ideas to
                            a shared commitment.
                        </Text>
                        <div className="flex flex-wrap gap-2">
                            {[
                                "Inclusive Environment",
                                "Collaborative Learning",
                                "Supportive Network",
                                "Global Perspective",
                                "Community-Driven",
                            ].map((tag) => (
                                <span
                                    key={tag}
                                    className="px-3 py-1 rounded-full bg-white/15 text-sm"
                                >
                                    {tag}
                                </span>
                            ))}
                        </div>
                    </div>
                    <div className="flex justify-center md:justify-end">
                        <Action
                            href="#waiting-list"
                            color="zinc"
                            size="lg"
                            className="!bg-white !text-violet-700 hover:!bg-zinc-50 border-0"
                        >
                            Join the Waitlist
                        </Action>
                    </div>
                </div>
            </div>
        </div>
    );
}
