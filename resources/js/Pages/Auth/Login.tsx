import { useForm } from "@inertiajs/react";
import {
    Action,
    Badge,
    Card,
    Field,
    Heading,
    Input,
    Switch,
    Text,
} from "@particle-academy/react-fancy";
import { Lock, Mail } from "lucide-react";
import type { FormEvent } from "react";
import GuestLayout from "../../Layouts/GuestLayout";

export default function Login() {
    const form = useForm({
        email: "",
        password: "",
        remember: false as boolean,
    });

    function submit(e: FormEvent) {
        e.preventDefault();
        form.post("/login", {
            onFinish: () => form.reset("password"),
        });
    }

    return (
        <GuestLayout title="Admin Login">
            <Card>
                <Card.Header className="px-8 pt-8 pb-4 text-center">
                    <Badge color="violet" variant="soft" className="mb-3">
                        Admin
                    </Badge>
                    <Heading
                        level={1}
                        size="lg"
                        className="particle-text-gradient"
                    >
                        Sign in
                    </Heading>
                    <Text size="sm" className="text-zinc-500 mt-2">
                        Authorized administrators only.
                    </Text>
                </Card.Header>

                <Card.Body className="px-8 pb-8">
                    <form onSubmit={submit} className="space-y-5">
                        <Field label="Email" error={form.errors.email}>
                            <Input
                                type="email"
                                value={form.data.email}
                                onChange={(e) =>
                                    form.setData("email", e.target.value)
                                }
                                prefix={<Mail className="w-4 h-4" />}
                                required
                                autoFocus
                                autoComplete="username"
                                placeholder="admin@particle.academy"
                            />
                        </Field>

                        <Field label="Password" error={form.errors.password}>
                            <Input
                                type="password"
                                value={form.data.password}
                                onChange={(e) =>
                                    form.setData("password", e.target.value)
                                }
                                prefix={<Lock className="w-4 h-4" />}
                                required
                                autoComplete="current-password"
                            />
                        </Field>

                        <div className="flex items-center gap-3">
                            <Switch
                                checked={form.data.remember}
                                onChange={(e) =>
                                    form.setData("remember", e.target.checked)
                                }
                            />
                            <Text size="sm" className="text-zinc-700">
                                Remember me
                            </Text>
                        </div>

                        <Action
                            type="submit"
                            color="violet"
                            size="md"
                            className="w-full"
                            loading={form.processing}
                        >
                            Log in
                        </Action>
                    </form>
                </Card.Body>
            </Card>
        </GuestLayout>
    );
}
