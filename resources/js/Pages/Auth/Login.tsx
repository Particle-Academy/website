import { useForm } from "@inertiajs/react";
import { ArrowRight, Lock, Mail } from "lucide-react";
import type { FormEvent } from "react";
import SiteLayout from "../../Layouts/SiteLayout";

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
        <SiteLayout title="Admin Login">
            <div className="auth-shell">
                <div className="auth-card">
                    <h1>Sign in</h1>
                    <p className="sub">Authorized administrators only.</p>

                    <form onSubmit={submit}>
                        <div className="field">
                            <label className="field-label" htmlFor="email">
                                Email
                            </label>
                            <div className="input">
                                <Mail />
                                <input
                                    id="email"
                                    type="email"
                                    value={form.data.email}
                                    onChange={(e) => form.setData("email", e.target.value)}
                                    required
                                    autoFocus
                                    autoComplete="username"
                                    placeholder="admin@particle.academy"
                                />
                            </div>
                            {form.errors.email && (
                                <p className="err">{form.errors.email}</p>
                            )}
                        </div>

                        <div className="field">
                            <label className="field-label" htmlFor="password">
                                Password
                            </label>
                            <div className="input">
                                <Lock />
                                <input
                                    id="password"
                                    type="password"
                                    value={form.data.password}
                                    onChange={(e) => form.setData("password", e.target.value)}
                                    required
                                    autoComplete="current-password"
                                />
                            </div>
                            {form.errors.password && (
                                <p className="err">{form.errors.password}</p>
                            )}
                        </div>

                        <label className="check">
                            <input
                                type="checkbox"
                                checked={form.data.remember}
                                onChange={(e) => form.setData("remember", e.target.checked)}
                            />
                            Remember me
                        </label>

                        <button
                            type="submit"
                            className="btn btn-primary btn-lg"
                            style={{ width: "100%" }}
                            disabled={form.processing}
                        >
                            Log in
                            <ArrowRight />
                        </button>
                    </form>
                </div>
            </div>
        </SiteLayout>
    );
}
