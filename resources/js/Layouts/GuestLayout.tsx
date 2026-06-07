import { Head, Link } from "@inertiajs/react";
import type { ReactNode } from "react";

interface GuestLayoutProps {
    title?: string;
    children: ReactNode;
}

export default function GuestLayout({ title, children }: GuestLayoutProps) {
    return (
        <>
            {title && (
                <Head>
                    <title>{`${title} | Particle Academy`}</title>
                </Head>
            )}
            <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-cyan-100 to-purple-100">
                <div className="mb-6">
                    <Link href="/" className="flex items-center">
                        <span className="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 to-purple-600">
                            Particle Academy
                        </span>
                    </Link>
                </div>

                <div className="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {children}
                </div>
            </div>
        </>
    );
}
