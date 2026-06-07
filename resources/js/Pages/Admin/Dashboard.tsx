import { Link } from "@inertiajs/react";
import { Badge, Card, Heading, Text } from "@particle-academy/react-fancy";
import { Building2, Star, Users, type LucideIcon } from "lucide-react";
import AdminLayout from "../../Layouts/AdminLayout";

interface DashboardProps {
    counts: {
        waiting_list: number;
        stories: number;
        partners: number;
    };
}

interface StatCardProps {
    href: string;
    label: string;
    value: number;
    Icon: LucideIcon;
    accentBg: string;
    accentText: string;
    badge: string;
}

function StatCard({ href, label, value, Icon, accentBg, accentText, badge }: StatCardProps) {
    return (
        <Link
            href={href}
            className="block focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-500 rounded-2xl"
        >
            <Card className="h-full transition-shadow hover:shadow-md">
                <Card.Body className="p-6">
                    <div className="flex items-start justify-between mb-4">
                        <div
                            className={`w-12 h-12 rounded-xl ${accentBg} ${accentText} flex items-center justify-center`}
                        >
                            <Icon className="w-6 h-6" />
                        </div>
                        <Badge color="zinc" variant="soft" size="sm">
                            {badge}
                        </Badge>
                    </div>
                    <Heading level={3} size="xl" className="text-zinc-900 mb-1">
                        {value}
                    </Heading>
                    <Text size="sm" className="text-zinc-500">
                        {label}
                    </Text>
                </Card.Body>
            </Card>
        </Link>
    );
}

export default function Dashboard({ counts }: DashboardProps) {
    return (
        <AdminLayout heading="Dashboard">
            <div className="grid grid-cols-1 md:grid-cols-3 gap-5">
                <StatCard
                    href="/admin/waitinglist"
                    label="Waiting list entries"
                    value={counts.waiting_list}
                    Icon={Users}
                    accentBg="bg-cyan-100"
                    accentText="text-cyan-700"
                    badge="Live"
                />
                <StatCard
                    href="/admin/stories"
                    label="Success stories"
                    value={counts.stories}
                    Icon={Star}
                    accentBg="bg-amber-100"
                    accentText="text-amber-700"
                    badge="Curated"
                />
                <StatCard
                    href="/admin/partners"
                    label="Partners"
                    value={counts.partners}
                    Icon={Building2}
                    accentBg="bg-violet-100"
                    accentText="text-violet-700"
                    badge="Ordered"
                />
            </div>
        </AdminLayout>
    );
}
