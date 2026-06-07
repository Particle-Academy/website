import { Action, Card } from "@particle-academy/react-fancy";

export default function Test() {
    return (
        <div className="min-h-screen flex items-center justify-center bg-zinc-50 p-8">
            <Card>
                <div className="p-8 space-y-4">
                    <h1 className="text-2xl font-semibold tracking-tight">Inertia + Fancy UI plumbing ✓</h1>
                    <p className="text-zinc-600">
                        If you see this rendered with proper styling and the action below works,
                        the Inertia + Fancy UI pipeline is wired up correctly.
                    </p>
                    <Action color="violet" onClick={() => alert("Hello from react-fancy")}>
                        Click me
                    </Action>
                </div>
            </Card>
        </div>
    );
}
