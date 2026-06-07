import { router, useForm } from "@inertiajs/react";
import {
    Action,
    Badge,
    Card,
    Field,
    Heading,
    Input,
    Switch,
    Text,
    Textarea,
} from "@particle-academy/react-fancy";
import { Pencil, Trash2 } from "lucide-react";
import { useState, type FormEvent } from "react";
import Modal from "../../Components/Admin/Modal";
import Pagination, { type Paginator } from "../../Components/Admin/Pagination";
import AdminLayout from "../../Layouts/AdminLayout";

const INTEREST_OPTIONS = [
    "The Accelerator Program",
    "Internship Opportunity",
    "Learn Martial Arts (Adults/Kids)",
    "Starting a Business",
    "Learning Digital Trades",
    "Mindset Mastery",
    "Supporting our Mission",
];

interface WaitingListEntry {
    id: number;
    name: string;
    email: string;
    interest: string[] | null;
    contacted: boolean;
    notes: string | null;
    created_at: string;
}

interface WaitingListProps {
    waitingLists: Paginator<WaitingListEntry>;
}

export default function WaitingList({ waitingLists }: WaitingListProps) {
    const [editingId, setEditingId] = useState<number | null>(null);
    const [deletingId, setDeletingId] = useState<number | null>(null);

    const form = useForm<{
        name: string;
        email: string;
        interest: string[];
        contacted: boolean;
        notes: string;
    }>({
        name: "",
        email: "",
        interest: [],
        contacted: false,
        notes: "",
    });

    function startEdit(entry: WaitingListEntry) {
        form.setData({
            name: entry.name,
            email: entry.email,
            interest: entry.interest ?? [],
            contacted: entry.contacted,
            notes: entry.notes ?? "",
        });
        setEditingId(entry.id);
    }

    function cancelEdit() {
        setEditingId(null);
        form.reset();
        form.clearErrors();
    }

    function submit(e: FormEvent) {
        e.preventDefault();
        if (!editingId) return;
        form.put(`/admin/waitinglist/${editingId}`, {
            preserveScroll: true,
            onSuccess: cancelEdit,
        });
    }

    function confirmDelete() {
        if (!deletingId) return;
        router.delete(`/admin/waitinglist/${deletingId}`, {
            preserveScroll: true,
            onFinish: () => setDeletingId(null),
        });
    }

    return (
        <AdminLayout heading="Waiting List">
            <Card>
                <Card.Body className="p-0">
                    <div className="overflow-x-auto">
                        <table className="w-full text-sm">
                            <thead className="bg-zinc-50 text-zinc-600 uppercase text-xs">
                                <tr>
                                    <th className="px-4 py-3 text-left font-semibold">Name</th>
                                    <th className="px-4 py-3 text-left font-semibold">Email</th>
                                    <th className="px-4 py-3 text-left font-semibold">Interests</th>
                                    <th className="px-4 py-3 text-left font-semibold">Status</th>
                                    <th className="px-4 py-3 text-left font-semibold">Created</th>
                                    <th className="px-4 py-3 text-right font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-zinc-100">
                                {waitingLists.data.length === 0 ? (
                                    <tr>
                                        <td colSpan={6} className="px-4 py-16 text-center">
                                            <Text className="text-zinc-500">
                                                No waiting list entries yet.
                                            </Text>
                                        </td>
                                    </tr>
                                ) : (
                                    waitingLists.data.map((entry) => (
                                        <tr key={entry.id} className="hover:bg-zinc-50">
                                            <td className="px-4 py-3 font-medium text-zinc-900">{entry.name}</td>
                                            <td className="px-4 py-3 text-zinc-600">{entry.email}</td>
                                            <td className="px-4 py-3">
                                                <div className="flex flex-wrap gap-1">
                                                    {entry.interest?.slice(0, 2).map((i) => (
                                                        <Badge key={i} color="violet" variant="soft" size="sm">
                                                            {i}
                                                        </Badge>
                                                    ))}
                                                    {(entry.interest?.length ?? 0) > 2 && (
                                                        <Badge color="zinc" variant="soft" size="sm">
                                                            +{(entry.interest?.length ?? 0) - 2}
                                                        </Badge>
                                                    )}
                                                </div>
                                            </td>
                                            <td className="px-4 py-3">
                                                <Badge
                                                    color={entry.contacted ? "green" : "zinc"}
                                                    variant="soft"
                                                    size="sm"
                                                >
                                                    {entry.contacted ? "Contacted" : "Pending"}
                                                </Badge>
                                            </td>
                                            <td className="px-4 py-3 text-zinc-500">
                                                {new Date(entry.created_at).toLocaleDateString()}
                                            </td>
                                            <td className="px-4 py-3 text-right">
                                                <div className="inline-flex gap-1">
                                                    <button
                                                        type="button"
                                                        onClick={() => startEdit(entry)}
                                                        className="p-1.5 text-violet-600 hover:bg-violet-50 rounded"
                                                        title="Edit"
                                                    >
                                                        <Pencil className="w-4 h-4" />
                                                    </button>
                                                    <button
                                                        type="button"
                                                        onClick={() => setDeletingId(entry.id)}
                                                        className="p-1.5 text-red-600 hover:bg-red-50 rounded"
                                                        title="Delete"
                                                    >
                                                        <Trash2 className="w-4 h-4" />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                    <div className="px-4 py-3 border-t border-zinc-100">
                        <Pagination meta={waitingLists} />
                    </div>
                </Card.Body>
            </Card>

            <Modal open={editingId !== null} onClose={cancelEdit} title="Edit Waiting List Entry">
                <form onSubmit={submit} className="space-y-4">
                    <Field label="Name" error={form.errors.name}>
                        <Input
                            type="text"
                            value={form.data.name}
                            onChange={(e) => form.setData("name", e.target.value)}
                            required
                        />
                    </Field>
                    <Field label="Email" error={form.errors.email}>
                        <Input
                            type="email"
                            value={form.data.email}
                            onChange={(e) => form.setData("email", e.target.value)}
                            required
                        />
                    </Field>
                    <Field label="Interests" description="Click a tag to toggle">
                        <div className="flex flex-wrap gap-2 pt-1">
                            {INTEREST_OPTIONS.map((option) => {
                                const active = form.data.interest.includes(option);
                                return (
                                    <Action
                                        key={option}
                                        type="button"
                                        size="sm"
                                        color={active ? "violet" : "zinc"}
                                        variant={active ? undefined : "ghost"}
                                        className={active ? "" : "border border-zinc-300 hover:bg-zinc-50"}
                                        onClick={() => {
                                            if (active) {
                                                form.setData(
                                                    "interest",
                                                    form.data.interest.filter((o) => o !== option)
                                                );
                                            } else {
                                                form.setData("interest", [
                                                    ...form.data.interest,
                                                    option,
                                                ]);
                                            }
                                        }}
                                    >
                                        {option}
                                    </Action>
                                );
                            })}
                        </div>
                    </Field>
                    <div className="flex items-center gap-3">
                        <Switch
                            checked={form.data.contacted}
                            onChange={(e) => form.setData("contacted", e.target.checked)}
                        />
                        <Text size="sm" className="text-zinc-700">
                            Contacted
                        </Text>
                    </div>
                    <Field label="Notes">
                        <Textarea
                            value={form.data.notes}
                            onChange={(e) => form.setData("notes", e.target.value)}
                            rows={3}
                        />
                    </Field>
                    <div className="flex justify-end gap-2 pt-2">
                        <Action type="button" color="zinc" variant="ghost" onClick={cancelEdit}>
                            Cancel
                        </Action>
                        <Action
                            type="submit"
                            color="violet"
                            loading={form.processing}
                        >
                            Save
                        </Action>
                    </div>
                </form>
            </Modal>

            <Modal
                open={deletingId !== null}
                onClose={() => setDeletingId(null)}
                title="Confirm Delete"
            >
                <Text className="text-zinc-700 mb-6">
                    Are you sure you want to delete this entry? This action cannot be undone.
                </Text>
                <div className="flex justify-end gap-2">
                    <Action
                        type="button"
                        color="zinc"
                        variant="ghost"
                        onClick={() => setDeletingId(null)}
                    >
                        Cancel
                    </Action>
                    <Action type="button" color="red" onClick={confirmDelete}>
                        Delete
                    </Action>
                </div>
            </Modal>
        </AdminLayout>
    );
}
