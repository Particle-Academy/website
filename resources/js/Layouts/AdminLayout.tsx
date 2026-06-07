import { Head, Link, router, usePage } from "@inertiajs/react";
import {
    Building2,
    Home,
    LayoutGrid,
    LogOut,
    Menu,
    Star,
    UserCog,
    Users,
    X,
} from "lucide-react";
import { useState, type ReactNode } from "react";

interface AdminLayoutProps {
    title?: string;
    heading?: string;
    children: ReactNode;
}

interface SharedProps {
    auth?: { user?: { name?: string } | null };
    flash?: { message?: string; error?: string };
}

interface NavItemConfig {
    href: string;
    label: string;
    icon: ReactNode;
    routeName: string;
}

const NAV: NavItemConfig[] = [
    {
        href: "/admin",
        label: "Dashboard",
        icon: <LayoutGrid className="w-5 h-5" />,
        routeName: "admin.dashboard",
    },
    {
        href: "/admin/waitinglist",
        label: "Waiting List",
        icon: <Users className="w-5 h-5" />,
        routeName: "admin.waitinglist",
    },
    {
        href: "/admin/stories",
        label: "Success Stories",
        icon: <Star className="w-5 h-5" />,
        routeName: "admin.stories",
    },
    {
        href: "/admin/partners",
        label: "Partners",
        icon: <Building2 className="w-5 h-5" />,
        routeName: "admin.partners",
    },
];

export default function AdminLayout({ title, heading, children }: AdminLayoutProps) {
    const { props, url } = usePage<SharedProps & Record<string, unknown>>();
    const flashMessage = props.flash?.message;
    const flashError = props.flash?.error;
    const userName = props.auth?.user?.name ?? "Admin";
    const [mobileOpen, setMobileOpen] = useState(false);

    function isActive(href: string) {
        if (href === "/admin") return url === "/admin" || url === "/admin/";
        return url.startsWith(href);
    }

    function handleLogout() {
        router.post("/logout");
    }

    const pageTitle = title ?? heading ?? "Admin Dashboard";

    return (
        <>
            <Head>
                <title>{`${pageTitle} | Particle Academy Admin`}</title>
            </Head>

            <div className="min-h-screen bg-gray-50 text-gray-900 font-sans antialiased">
                <header className="bg-gradient-to-r from-cyan-500 to-purple-600 border-b border-cyan-600 text-white">
                    <div className="container mx-auto px-4 py-3 flex items-center justify-between">
                        <button
                            type="button"
                            onClick={() => setMobileOpen((v) => !v)}
                            className="lg:hidden p-2"
                        >
                            {mobileOpen ? <X className="w-5 h-5" /> : <Menu className="w-5 h-5" />}
                        </button>

                        <Link
                            href="/admin"
                            className="flex items-center gap-2 font-semibold max-lg:hidden"
                        >
                            <img
                                src="/images/particle1.png"
                                alt="Particle Academy"
                                className="h-8 w-8"
                            />
                            <span>Particle Academy</span>
                        </Link>

                        <nav className="hidden lg:flex gap-1 -mb-px">
                            {NAV.map((item) => (
                                <Link
                                    key={item.href}
                                    href={item.href}
                                    className={`flex items-center gap-2 px-3 py-2 text-sm hover:text-cyan-100 ${
                                        isActive(item.href)
                                            ? "border-b-2 border-white text-white"
                                            : "text-white/90"
                                    }`}
                                >
                                    {item.icon}
                                    {item.label}
                                </Link>
                            ))}
                        </nav>

                        <div className="flex items-center gap-3">
                            <a
                                href="/"
                                className="hidden lg:flex items-center gap-1 px-2 py-1 text-sm hover:text-cyan-100"
                            >
                                <Home className="w-4 h-4" /> View Site
                            </a>
                            <span className="hidden sm:inline-flex items-center gap-2 px-2 py-1 text-sm">
                                <UserCog className="w-4 h-4" /> {userName}
                            </span>
                            <button
                                type="button"
                                onClick={handleLogout}
                                className="inline-flex items-center gap-2 px-3 py-1.5 text-sm bg-white/10 hover:bg-white/20 rounded-md"
                            >
                                <LogOut className="w-4 h-4" /> Logout
                            </button>
                        </div>
                    </div>
                </header>

                {mobileOpen && (
                    <nav className="lg:hidden bg-white border-b border-gray-200">
                        <div className="container mx-auto px-4 py-2 flex flex-col">
                            {NAV.map((item) => (
                                <Link
                                    key={item.href}
                                    href={item.href}
                                    onClick={() => setMobileOpen(false)}
                                    className={`flex items-center gap-2 px-3 py-2 rounded-md ${
                                        isActive(item.href)
                                            ? "bg-cyan-50 text-cyan-700 font-semibold"
                                            : "text-gray-700 hover:bg-gray-50"
                                    }`}
                                >
                                    {item.icon}
                                    {item.label}
                                </Link>
                            ))}
                        </div>
                    </nav>
                )}

                <main className="container mx-auto px-4 py-8">
                    <div className="mb-6">
                        <h1 className="text-3xl font-bold particle-text-gradient">
                            {heading ?? "Admin Dashboard"}
                        </h1>
                    </div>

                    {flashMessage && (
                        <div className="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                            {flashMessage}
                        </div>
                    )}
                    {flashError && (
                        <div className="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded">
                            {flashError}
                        </div>
                    )}

                    {children}
                </main>
            </div>
        </>
    );
}
