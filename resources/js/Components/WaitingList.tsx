import { useForm, usePage } from "@inertiajs/react";
import {
    Action,
    Badge,
    Callout,
    Card,
    Field,
    Heading,
    Input,
    Text,
} from "@particle-academy/react-fancy";
import { Mail, Sparkles } from "lucide-react";
import { useEffect, useState, type FormEvent } from "react";

interface SharedProps {
    flash?: { message?: string };
}

export default function WaitingList() {
    const { props } = usePage<SharedProps & Record<string, unknown>>();
    const flashMessage = props.flash?.message;

    const form = useForm({ email: "" });
    const [submitted, setSubmitted] = useState(false);

    useEffect(() => {
        if (flashMessage) setSubmitted(true);
    }, [flashMessage]);

    function submit(e: FormEvent) {
        e.preventDefault();
        form.post("/waiting-list", {
            preserveScroll: true,
            onSuccess: () => {
                setSubmitted(true);
                form.reset();
            },
        });
    }

    return (
        <Card className="max-w-2xl mx-auto">
            <Card.Header className="px-8 pt-8 pb-2 text-center">
                <Badge color="violet" variant="soft" className="mb-3">
                    <Sparkles className="w-3.5 h-3.5 mr-1 inline" /> Join the waitlist
                </Badge>
                <Heading level={2} size="lg" className="text-zinc-900">
                    Be first in line when we open.
                </Heading>
                <Text size="sm" className="text-zinc-500 mt-2">
                    Early members shape the first cohort. No spam — we'll only reach out when
                    there's something for you.
                </Text>
            </Card.Header>

            <Card.Body className="px-8 pb-8">
                {submitted ? (
                    <Callout color="green">
                        You're on the list — we'll be in touch.
                    </Callout>
                ) : (
                    <form onSubmit={submit} className="space-y-4">
                        <Field label="Your email" error={form.errors.email}>
                            <Input
                                type="email"
                                value={form.data.email}
                                onChange={(e) => form.setData("email", e.target.value)}
                                placeholder="you@email.com"
                                prefix={<Mail className="w-4 h-4" />}
                                required
                            />
                        </Field>
                        <div className="flex justify-end">
                            <Action
                                type="submit"
                                color="violet"
                                size="md"
                                loading={form.processing}
                            >
                                Reserve my spot
                            </Action>
                        </div>
                    </form>
                )}
            </Card.Body>
        </Card>
    );
}
