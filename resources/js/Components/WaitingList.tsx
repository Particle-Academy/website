import { useForm, usePage } from "@inertiajs/react";
import {
    Badge,
    Action,
    Callout,
    Card,
    Field,
    Heading,
    Input,
    Text,
} from "@particle-academy/react-fancy";
import { Mail, Sparkles, User } from "lucide-react";
import type { FormEvent } from "react";

const INTEREST_OPTIONS = [
    "The Accelerator Program",
    "Internship Opportunity",
    "Learn Martial Arts (Adults/Kids)",
    "Starting a Business",
    "Learning Digital Trades",
    "Mindset Mastery",
    "Supporting our Mission",
];

interface SharedProps {
    flash?: { message?: string };
}

export default function WaitingList() {
    const { props } = usePage<SharedProps & Record<string, unknown>>();
    const flashMessage = props.flash?.message;

    const form = useForm<{ name: string; email: string; interest: string[] }>({
        name: "",
        email: "",
        interest: [],
    });

    function toggleInterest(option: string) {
        if (form.data.interest.includes(option)) {
            form.setData(
                "interest",
                form.data.interest.filter((o) => o !== option)
            );
        } else {
            form.setData("interest", [...form.data.interest, option]);
        }
    }

    function submit(e: FormEvent) {
        e.preventDefault();
        form.post("/waiting-list", {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        });
    }

    return (
        <Card className="max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="900">
            <Card.Header className="px-8 pt-8 pb-4">
                <div className="flex items-center gap-3 mb-2">
                    <div className="w-10 h-10 rounded-xl bg-violet-100 text-violet-700 flex items-center justify-center">
                        <Sparkles className="w-5 h-5" />
                    </div>
                    <Badge color="violet" variant="soft">
                        Join the waitlist
                    </Badge>
                </div>
                <Heading level={2} size="lg" className="text-zinc-900">
                    Be first in line when we open.
                </Heading>
                <Text className="text-zinc-600 mt-2">
                    Tell us who you are and what you're here for — we'll reach out as cohorts
                    fill.
                </Text>
            </Card.Header>

            <Card.Body className="px-8 pb-8">
                {flashMessage && (
                    <Callout color="green" className="mb-6">
                        {flashMessage}
                    </Callout>
                )}

                <form onSubmit={submit} className="space-y-5">
                    <div className="grid sm:grid-cols-2 gap-4">
                        <Field label="Your name" error={form.errors.name}>
                            <Input
                                type="text"
                                value={form.data.name}
                                onChange={(e) => form.setData("name", e.target.value)}
                                placeholder="Jane Doe"
                                prefix={<User className="w-4 h-4" />}
                                required
                            />
                        </Field>
                        <Field label="Email" error={form.errors.email}>
                            <Input
                                type="email"
                                value={form.data.email}
                                onChange={(e) => form.setData("email", e.target.value)}
                                placeholder="jane@example.com"
                                prefix={<Mail className="w-4 h-4" />}
                                required
                            />
                        </Field>
                    </div>

                    <Field
                        label="I'm interested in"
                        description="Select all that apply"
                        error={form.errors.interest}
                    >
                        <div className="flex flex-wrap gap-2 pt-1">
                            {INTEREST_OPTIONS.map((option) => {
                                const active = form.data.interest.includes(option);
                                return (
                                    <Action
                                        key={option}
                                        type="button"
                                        size="sm"
                                        color={active ? "violet" : "zinc"}
                                        variant={active ? undefined : "ghost"}
                                        className={
                                            active
                                                ? ""
                                                : "border border-zinc-300 hover:bg-zinc-50"
                                        }
                                        onClick={() => toggleInterest(option)}
                                    >
                                        {option}
                                    </Action>
                                );
                            })}
                        </div>
                    </Field>

                    <div className="pt-2 flex items-center justify-between gap-3">
                        <Text size="sm" className="text-zinc-500">
                            We'll never share your email.
                        </Text>
                        <Action
                            type="submit"
                            color="violet"
                            size="md"
                            loading={form.processing}
                        >
                            Join Waitlist
                        </Action>
                    </div>
                </form>
            </Card.Body>
        </Card>
    );
}
