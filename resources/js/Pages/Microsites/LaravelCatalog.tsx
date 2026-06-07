import { Head, usePage } from "@inertiajs/react";
import { Action, Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import {
    BookOpen,
    Box,
    CheckCircle2,
    Clipboard,
    DollarSign,
    Puzzle,
    RefreshCw,
    ShoppingBag,
} from "lucide-react";
import type { ReactNode } from "react";

interface SharedProps {
    appUrl: string;
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
                <div className="w-12 h-12 rounded-xl bg-red-100 text-red-700 flex items-center justify-center mb-5">
                    {icon}
                </div>
                <Heading level={3} size="md" className="text-gray-900 mb-2">
                    {title}
                </Heading>
                <Text size="sm" className="text-gray-600 leading-relaxed">
                    {body}
                </Text>
            </Card.Body>
        </Card>
    );
}

export default function LaravelCatalog() {
    const { appUrl } = usePage<SharedProps & Record<string, unknown>>().props;

    return (
        <>
            <Head>
                <title>Laravel Catalog</title>
            </Head>

            <div className="bg-gray-50 text-gray-900 font-sans antialiased min-h-screen">
                <header className="bg-white border-b border-gray-200 sticky top-0 z-50">
                    <div className="container mx-auto px-4 py-3 flex justify-between items-center max-w-7xl">
                        <a href="#" className="font-bold text-xl text-red-600 flex items-center gap-2">
                            <BookOpen className="w-6 h-6" /> Laravel Catalog
                        </a>
                        <nav className="hidden md:flex gap-1 text-sm">
                            <a href="#features" className="text-gray-600 hover:text-red-600 px-3 py-2 font-medium">Features</a>
                            <a href="#install" className="text-gray-600 hover:text-red-600 px-3 py-2 font-medium">Installation</a>
                            <a href="https://github.com/Particle-Academy/laravel-catalog" className="text-gray-600 hover:text-red-600 px-3 py-2 font-medium">GitHub</a>
                        </nav>
                        <Action color="red" size="sm" href="https://github.com/Particle-Academy/laravel-catalog">Get Started</Action>
                    </div>
                </header>

                <main>
                    <section className="bg-red-600 text-white py-20 relative overflow-hidden">
                        <div className="absolute inset-0 bg-gradient-to-br from-red-600 to-red-800" />
                        <div className="container mx-auto px-4 relative z-10 text-center max-w-4xl">
                            <Badge color="red" variant="soft" className="mb-6 !bg-red-700/40 !text-white !border-red-400/50">
                                <ShoppingBag className="w-3.5 h-3.5 mr-1 inline" /> Commerce for Laravel
                            </Badge>
                            <Heading level={1} size="xl" className="text-white mb-4">Laravel Catalog</Heading>
                            <Text size="lg" className="text-red-100 max-w-2xl mx-auto mb-10">
                                Product and subscription management catalog with Stripe integration.
                            </Text>
                            <div className="flex flex-col sm:flex-row justify-center gap-3">
                                <Action href="https://github.com/Particle-Academy/laravel-catalog" color="zinc" size="lg" className="!bg-white !text-red-700 hover:!bg-gray-100">
                                    Get Started
                                </Action>
                                <Action color="zinc" variant="ghost" size="lg" className="!text-white" disabled>
                                    Live Demos
                                </Action>
                            </div>
                        </div>
                    </section>

                    <div className="container mx-auto px-4 py-20 space-y-20 max-w-7xl">
                        <section id="features" className="space-y-8">
                            <div className="text-center">
                                <Badge color="red" variant="soft" className="mb-4">Features</Badge>
                                <Heading level={2} size="lg" className="text-gray-900 mb-2">
                                    Manage your Stripe catalog with ease.
                                </Heading>
                                <Text className="text-gray-600 max-w-2xl mx-auto">
                                    Full CRUD for Products and Prices, automatic sync, and admin UI included.
                                </Text>
                            </div>

                            <div className="grid md:grid-cols-3 gap-5">
                                <Feature icon={<Box className="w-6 h-6" />} title="Product Management" body="Create, edit, and manage Stripe products with full CRUD operations directly from your app." />
                                <Feature icon={<DollarSign className="w-6 h-6" />} title="Flexible Pricing" body="Support for recurring subscriptions and one-time purchases with multiple intervals." />
                                <Feature icon={<RefreshCw className="w-6 h-6" />} title="Stripe Sync" body="Automatic or manual synchronization with Stripe's catalog to keep everything in sync." />
                            </div>
                        </section>

                        <section className="rounded-3xl bg-gray-900 text-white p-12">
                            <div className="grid md:grid-cols-2 gap-12 items-center">
                                <div>
                                    <Badge color="blue" variant="soft" className="mb-4">Powerful Integration</Badge>
                                    <Heading level={2} size="lg" className="text-white mb-4">Works with Laravel FMS.</Heading>
                                    <Text className="text-gray-300 mb-6">
                                        Combine Catalog with our{" "}
                                        <a href="https://github.com/Particle-Academy/laravel-feature-management-system" className="text-blue-400 hover:underline">Feature Management System</a>{" "}
                                        to create feature-rich subscription plans.
                                    </Text>
                                    <ul className="space-y-3">
                                        {[
                                            "Control feature access based on subscription plans",
                                            'Metered usage limits (e.g., "100 API calls/month")',
                                            "Toggle features on/off per plan",
                                        ].map((line) => (
                                            <li key={line} className="flex items-center gap-2">
                                                <CheckCircle2 className="text-green-500 w-5 h-5" />
                                                <span className="text-gray-200">{line}</span>
                                            </li>
                                        ))}
                                    </ul>
                                </div>
                                <div className="bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-2xl">
                                    <div className="flex items-center gap-2 mb-4 border-b border-gray-700 pb-4">
                                        <div className="w-3 h-3 rounded-full bg-red-500" />
                                        <div className="w-3 h-3 rounded-full bg-amber-500" />
                                        <div className="w-3 h-3 rounded-full bg-emerald-500" />
                                        <span className="ml-2 text-xs text-gray-500 font-mono">config/fms.php</span>
                                    </div>
                                    <pre className="font-mono text-sm text-blue-300 overflow-x-auto">{`'features' => [
    'advanced-reporting' => [
        'name' => 'Advanced Reporting',
        'type' => 'boolean',
    ],
    'api-calls' => [
        'name' => 'API Calls',
        'type' => 'resource',
        'limit' => 5000,
    ],
],`}</pre>
                                </div>
                            </div>
                        </section>

                        <section id="install" className="text-center max-w-3xl mx-auto">
                            <Heading level={2} size="lg" className="text-gray-900 mb-6">Ready to build your SaaS?</Heading>
                            <Card>
                                <Card.Body className="p-4 flex items-center justify-between gap-4">
                                    <code className="font-mono text-sm text-red-700">composer require particle-academy/laravel-catalog</code>
                                    <button type="button" className="text-gray-400 hover:text-gray-600">
                                        <Clipboard className="w-5 h-5" />
                                    </button>
                                </Card.Body>
                            </Card>
                            <div className="mt-6">
                                <Action href="https://github.com/Particle-Academy/laravel-catalog" color="zinc" size="md" className="!bg-gray-900 !text-white hover:!bg-gray-800">
                                    View on GitHub
                                </Action>
                            </div>
                        </section>
                    </div>
                </main>

                <footer className="bg-white border-t border-gray-200 py-12">
                    <div className="container mx-auto px-4 max-w-7xl">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-6">
                            <div className="font-bold text-lg text-gray-900 flex items-center gap-2">
                                <BookOpen className="w-5 h-5 text-red-500" /> Laravel Catalog
                            </div>
                            <div className="flex gap-6 text-sm">
                                <a href={`${appUrl}/privacy`} className="text-gray-600 hover:text-red-600">Privacy</a>
                                <a href={`${appUrl}/terms`} className="text-gray-600 hover:text-red-600">Terms</a>
                            </div>
                        </div>
                        <div className="border-t border-gray-100 pt-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 gap-3">
                            <div>&copy; {new Date().getFullYear()} Laravel Catalog. Open Source.</div>
                            <a href={appUrl} className="flex items-center gap-2 hover:text-gray-900 transition-colors group">
                                <span>Built by</span>
                                <img src={`${appUrl}/images/particle1.png`} alt="Particle Academy" className="h-6 w-auto opacity-70 group-hover:opacity-100 transition-all" />
                                <span className="font-semibold">Particle Academy</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}
