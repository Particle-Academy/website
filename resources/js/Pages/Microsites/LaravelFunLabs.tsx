import { Head, usePage } from "@inertiajs/react";
import { Action, Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import {
    BarChart3,
    Check,
    Clipboard,
    Puzzle,
    Terminal,
    Trophy,
} from "lucide-react";
import type { ReactNode } from "react";

interface SharedProps {
    appUrl: string;
}

interface FeatureProps {
    icon: ReactNode;
    bg: string;
    color: string;
    title: string;
    body: string;
}

function Feature({ icon, bg, color, title, body }: FeatureProps) {
    return (
        <Card>
            <Card.Body className="p-8">
                <div className={`w-12 h-12 ${bg} ${color} rounded-xl flex items-center justify-center mb-5`}>
                    {icon}
                </div>
                <Heading level={3} size="md" className="text-slate-900 mb-2">
                    {title}
                </Heading>
                <Text size="sm" className="text-slate-600 leading-relaxed">
                    {body}
                </Text>
            </Card.Body>
        </Card>
    );
}

export default function LaravelFunLabs() {
    const { appUrl } = usePage<SharedProps & Record<string, unknown>>().props;

    return (
        <>
            <Head>
                <title>Laravel Fun Lab</title>
            </Head>

            <style>{`.lab-grid{background-image:radial-gradient(#cbd5e1 1px, transparent 1px);background-size:20px 20px;}`}</style>

            <div className="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen lab-grid">
                <header className="bg-white/90 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
                    <div className="container mx-auto px-4 py-3 flex justify-between items-center max-w-7xl">
                        <a href="#" className="font-mono font-bold text-xl text-indigo-600 flex items-center gap-2">
                            <Trophy className="w-6 h-6" /> Laravel Fun Lab
                        </a>
                        <nav className="hidden md:flex gap-1 text-sm">
                            <a href="#features" className="text-slate-600 hover:text-indigo-600 px-3 py-2 rounded-lg hover:bg-slate-50 font-medium">Features</a>
                            <a href="#install" className="text-slate-600 hover:text-indigo-600 px-3 py-2 rounded-lg hover:bg-slate-50 font-medium">Installation</a>
                            <a href="https://github.com/Particle-Academy/laravel-fun-labs" className="text-slate-600 hover:text-indigo-600 px-3 py-2 rounded-lg hover:bg-slate-50 font-medium">GitHub</a>
                        </nav>
                        <Action color="indigo" size="sm" href="https://github.com/Particle-Academy/laravel-fun-labs">Get Started</Action>
                    </div>
                </header>

                <main className="container mx-auto px-4 py-12 space-y-20 max-w-7xl">
                    <section className="text-center py-12 relative">
                        <div className="absolute top-0 right-0 -mt-12 -mr-12 w-72 h-72 bg-violet-200/40 rounded-full blur-3xl pointer-events-none" />
                        <div className="absolute bottom-0 left-0 -mb-12 -ml-12 w-72 h-72 bg-rose-200/40 rounded-full blur-3xl pointer-events-none" />

                        <div className="relative">
                            <Badge color="violet" variant="soft" className="mb-6">
                                <Trophy className="w-3.5 h-3.5 mr-1 inline" /> Gamification for Laravel
                            </Badge>
                            <Heading level={1} size="xl" className="text-slate-900 mb-6 leading-tight">
                                Laravel <span className="text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-rose-600">Fun Lab</span>
                            </Heading>
                            <Text size="lg" className="max-w-2xl mx-auto text-slate-600 mb-10">
                                Analytics disguised as gamification. Turn user activity into meaningful engagement insights with a complete award system.
                            </Text>
                            <div className="flex flex-col sm:flex-row justify-center gap-3">
                                <Action href="https://github.com/Particle-Academy/laravel-fun-labs" color="indigo" size="lg">Get Started</Action>
                                <Action color="zinc" variant="ghost" size="lg" disabled>Live Demos</Action>
                            </div>
                        </div>
                    </section>

                    <section id="features" className="space-y-8">
                        <div className="text-center">
                            <Badge color="violet" variant="soft" className="mb-4">Features</Badge>
                            <Heading level={2} size="lg" className="text-slate-900 mb-2">Engage users. Capture data.</Heading>
                            <Text className="text-slate-600 max-w-2xl mx-auto">
                                Developers get engagement data for free; users feel recognized and motivated.
                            </Text>
                        </div>
                        <div className="grid md:grid-cols-3 gap-5">
                            <Feature icon={<Trophy className="w-6 h-6" />} bg="bg-violet-100" color="text-violet-700" title="Flexible Awards" body="Grant points, achievements, badges, and prizes based on any user action or system event." />
                            <Feature icon={<BarChart3 className="w-6 h-6" />} bg="bg-rose-100" color="text-rose-700" title="Built-in Analytics" body="Query aggregate engagement data to understand what drives long-term adoption and user behavior." />
                            <Feature icon={<Puzzle className="w-6 h-6" />} bg="bg-indigo-100" color="text-indigo-700" title="Drop-in UI" body="Includes optional Blade/Livewire components for leaderboards, profiles, and notifications." />
                        </div>
                    </section>

                    <section className="rounded-3xl bg-slate-900 text-white p-12">
                        <div className="grid md:grid-cols-2 gap-12 items-center">
                            <div>
                                <Badge color="violet" variant="soft" className="mb-4">API</Badge>
                                <Heading level={2} size="lg" className="text-white mb-4">Simple, fluent API.</Heading>
                                <Text className="text-slate-300 mb-6">
                                    Designed to be readable and expressive. Awarding points or unlocking achievements takes just a few lines of code.
                                </Text>
                                <ul className="space-y-3">
                                    {["Event-driven architecture", "Extensible via macros and hooks", "Database-agnostic analytics"].map((line) => (
                                        <li key={line} className="flex items-center gap-2 text-slate-300">
                                            <Check className="text-green-400 w-5 h-5" />
                                            <span>{line}</span>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                            <div className="bg-slate-800 rounded-xl p-6 border border-slate-700 shadow-2xl font-mono text-sm overflow-x-auto">
                                <div className="flex gap-2 mb-4">
                                    <div className="w-3 h-3 rounded-full bg-rose-500" />
                                    <div className="w-3 h-3 rounded-full bg-amber-500" />
                                    <div className="w-3 h-3 rounded-full bg-emerald-500" />
                                </div>
                                <pre className="text-violet-300 leading-relaxed">{`use `}<span className="text-white">LaravelFunLab\\Facades\\LFL;</span>{`

`}<span className="text-slate-400">{`// Award points with context`}</span>{`
`}<span className="text-white">LFL</span>{`::`}<span className="text-blue-400">award</span>{`(`}<span className="text-emerald-400">'points'</span>{`)
    ->`}<span className="text-blue-400">to</span>{`(`}<span className="text-white">$user</span>{`)
    ->`}<span className="text-blue-400">for</span>{`(`}<span className="text-emerald-400">'completed task'</span>{`)
    ->`}<span className="text-blue-400">amount</span>{`(`}<span className="text-orange-400">50</span>{`)
    ->`}<span className="text-blue-400">grant</span>{`();`}</pre>
                            </div>
                        </div>
                    </section>

                    <section id="install" className="text-center max-w-3xl mx-auto">
                        <div className="w-14 h-14 mx-auto rounded-2xl bg-slate-100 text-slate-700 flex items-center justify-center mb-4">
                            <Terminal className="w-6 h-6" />
                        </div>
                        <Heading level={2} size="lg" className="text-slate-900 mb-2">Ready to gamify your app?</Heading>
                        <Text className="text-slate-600 mb-6">
                            Install via Composer and start tracking engagement in minutes.
                        </Text>
                        <Card>
                            <Card.Body className="p-4 flex items-center justify-between gap-4">
                                <code className="font-mono text-sm text-slate-700">composer require particleacademy/laravel-fun-lab</code>
                                <button type="button" className="text-slate-400 hover:text-slate-600">
                                    <Clipboard className="w-5 h-5" />
                                </button>
                            </Card.Body>
                        </Card>
                        <div className="mt-6">
                            <Action href="https://github.com/Particle-Academy/laravel-fun-labs" color="zinc" size="md" className="!bg-slate-900 !text-white hover:!bg-slate-800">
                                View on GitHub
                            </Action>
                        </div>
                    </section>
                </main>

                <footer className="bg-slate-900 text-slate-400 py-12 border-t border-slate-800 mt-12">
                    <div className="container mx-auto px-4 max-w-7xl">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-6">
                            <div className="font-mono font-bold text-lg text-white flex items-center gap-2">
                                <Trophy className="w-5 h-5 text-violet-400" /> Laravel Fun Lab
                            </div>
                            <div className="flex gap-6 text-sm">
                                <a href={`${appUrl}/privacy`} className="hover:text-violet-400 transition-colors">Privacy</a>
                                <a href={`${appUrl}/terms`} className="hover:text-violet-400 transition-colors">Terms</a>
                            </div>
                        </div>
                        <div className="border-t border-slate-800 pt-6 flex flex-col md:flex-row justify-between items-center text-sm gap-3">
                            <div>&copy; {new Date().getFullYear()} Laravel Fun Lab. Open Source.</div>
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
