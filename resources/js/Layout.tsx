import { Head, Link } from "@inertiajs/react";
import type { ReactNode } from "react";

interface LayoutProps {
    title?: string;
    description?: string;
    children: ReactNode;
}

export default function Layout({ title, description, children }: LayoutProps) {
    const fullTitle = title ? `${title} | Particle Academy` : undefined;

    return (
        <>
            {(fullTitle || description) && (
                <Head>
                    {fullTitle && <title>{fullTitle}</title>}
                    {description && <meta name="description" content={description} />}
                </Head>
            )}

            {children}

            <footer className="mt-8 mb-16 text-center text-gray-500 text-sm">
                <p>
                    <span className="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-purple-600">
                        ©
                    </span>{" "}
                    {new Date().getFullYear()} Particle Academy - The Community Accelerator
                </p>
                <nav className="mt-4 flex justify-center space-x-8">
                    <Link
                        href="/coaches"
                        className="text-cyan-600 hover:text-purple-600 font-semibold transition-colors"
                    >
                        Coaches
                    </Link>
                    <Link
                        href="/partners"
                        className="text-cyan-600 hover:text-purple-600 font-semibold transition-colors"
                    >
                        Partners
                    </Link>
                </nav>
            </footer>
        </>
    );
}
