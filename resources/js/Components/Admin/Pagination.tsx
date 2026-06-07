import { Link } from "@inertiajs/react";

export interface PaginatedLink {
    url: string | null;
    label: string;
    active: boolean;
}

export interface Paginator<T> {
    data: T[];
    links: PaginatedLink[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number | null;
    to: number | null;
}

interface PaginationProps {
    meta: Pick<Paginator<unknown>, "links" | "from" | "to" | "total">;
}

export default function Pagination({ meta }: PaginationProps) {
    if (meta.links.length <= 3) return null;

    return (
        <div className="mt-4 flex items-center justify-between text-sm text-gray-600">
            <div>
                Showing {meta.from ?? 0}–{meta.to ?? 0} of {meta.total}
            </div>
            <div className="flex gap-1">
                {meta.links.map((link, i) => {
                    const className = `px-3 py-1 rounded-md border ${
                        link.active
                            ? "bg-cyan-500 text-white border-cyan-500"
                            : link.url
                              ? "border-gray-300 hover:bg-gray-50"
                              : "border-gray-200 text-gray-400 cursor-not-allowed"
                    }`;

                    return link.url ? (
                        <Link
                            key={i}
                            href={link.url}
                            className={className}
                            dangerouslySetInnerHTML={{ __html: link.label }}
                            preserveScroll
                        />
                    ) : (
                        <span
                            key={i}
                            className={className}
                            dangerouslySetInnerHTML={{ __html: link.label }}
                        />
                    );
                })}
            </div>
        </div>
    );
}
