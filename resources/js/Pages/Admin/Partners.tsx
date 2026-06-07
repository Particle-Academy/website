import { router, useForm } from "@inertiajs/react";
import {
    Action,
    Badge,
    Card,
    Field,
    Input,
    Switch,
    Text,
    Textarea,
} from "@particle-academy/react-fancy";
import { ExternalLink, Pencil, Plus, Trash2 } from "lucide-react";
import { useState, type FormEvent } from "react";
import Modal from "../../Components/Admin/Modal";
import Pagination, { type Paginator } from "../../Components/Admin/Pagination";
import AdminLayout from "../../Layouts/AdminLayout";

interface Partner {
    id: number;
    name: string;
    website: string | null;
    description: string | null;
    logo_path: string | null;
    display_order: number;
    is_published: boolean;
}

interface PartnersProps {
    partners: Paginator<Partner>;
}

export default function Partners({ partners }: PartnersProps) {
    const [editingId, setEditingId] = useState<number | null>(null);
    const [creating, setCreating] = useState(false);
    const [deletingId, setDeletingId] = useState<number | null>(null);

    const form = useForm({
        name: "",
        website: "",
        description: "",
        logo_path: "",
        display_order: 0,
        is_published: true,
    });

    function startCreate() {
        form.reset();
        form.clearErrors();
        setCreating(true);
    }

    function startEdit(partner: Partner) {
        form.setData({
            name: partner.name,
            website: partner.website ?? "",
            description: partner.description ?? "",
            logo_path: partner.logo_path ?? "",
            display_order: partner.display_order,
            is_published: partner.is_published,
        });
        setEditingId(partner.id);
    }

    function close() {
        setEditingId(null);
        setCreating(false);
        form.reset();
        form.clearErrors();
    }

    function submit(e: FormEvent) {
        e.preventDefault();
        if (editingId) {
            form.put(`/admin/partners/${editingId}`, { preserveScroll: true, onSuccess: close });
        } else if (creating) {
            form.post("/admin/partners", { preserveScroll: true, onSuccess: close });
        }
    }

    function confirmDelete() {
        if (!deletingId) return;
        router.delete(`/admin/partners/${deletingId}`, {
            preserveScroll: true,
            onFinish: () => setDeletingId(null),
        });
    }

    const modalOpen = editingId !== null || creating;
    const modalTitle = editingId !== null ? "Edit Partner" : "New Partner";

    return (
        <AdminLayout heading="Partners">
            <div className="flex justify-end mb-4">
                <Action type="button" color="violet" onClick={startCreate}>
                    <Plus className="w-4 h-4 mr-1 inline" /> New Partner
                </Action>
            </div>

            <Card>
                <Card.Body className="p-0">
                    <div className="overflow-x-auto">
                        <table className="w-full text-sm">
                            <thead className="bg-zinc-50 text-zinc-600 uppercase text-xs">
                                <tr>
                                    <th className="px-4 py-3 text-left font-semibold">Name</th>
                                    <th className="px-4 py-3 text-left font-semibold">Website</th>
                                    <th className="px-4 py-3 text-left font-semibold">Order</th>
                                    <th className="px-4 py-3 text-left font-semibold">Status</th>
                                    <th className="px-4 py-3 text-right font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-zinc-100">
                                {partners.data.length === 0 ? (
                                    <tr>
                                        <td colSpan={5} className="px-4 py-16 text-center">
                                            <Text className="text-zinc-500">No partners yet.</Text>
                                        </td>
                                    </tr>
                                ) : (
                                    partners.data.map((partner) => (
                                        <tr key={partner.id} className="hover:bg-zinc-50">
                                            <td className="px-4 py-3 font-medium text-zinc-900">{partner.name}</td>
                                            <td className="px-4 py-3">
                                                {partner.website ? (
                                                    <a
                                                        href={partner.website}
                                                        target="_blank"
                                                        rel="noreferrer"
                                                        className="inline-flex items-center gap-1 text-violet-700 hover:underline"
                                                    >
                                                        Visit <ExternalLink className="w-3 h-3" />
                                                    </a>
                                                ) : (
                                                    <Text size="sm" className="text-zinc-400">
                                                        —
                                                    </Text>
                                                )}
                                            </td>
                                            <td className="px-4 py-3 text-zinc-500">{partner.display_order}</td>
                                            <td className="px-4 py-3">
                                                <Badge
                                                    color={partner.is_published ? "green" : "zinc"}
                                                    variant="soft"
                                                    size="sm"
                                                >
                                                    {partner.is_published ? "Published" : "Draft"}
                                                </Badge>
                                            </td>
                                            <td className="px-4 py-3 text-right">
                                                <div className="inline-flex gap-1">
                                                    <button
                                                        type="button"
                                                        onClick={() => startEdit(partner)}
                                                        className="p-1.5 text-violet-600 hover:bg-violet-50 rounded"
                                                        title="Edit"
                                                    >
                                                        <Pencil className="w-4 h-4" />
                                                    </button>
                                                    <button
                                                        type="button"
                                                        onClick={() => setDeletingId(partner.id)}
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
                        <Pagination meta={partners} />
                    </div>
                </Card.Body>
            </Card>

            <Modal open={modalOpen} onClose={close} title={modalTitle}>
                <form onSubmit={submit} className="space-y-4">
                    <Field label="Name" error={form.errors.name}>
                        <Input
                            type="text"
                            value={form.data.name}
                            onChange={(e) => form.setData("name", e.target.value)}
                            required
                        />
                    </Field>
                    <Field label="Website" error={form.errors.website}>
                        <Input
                            type="url"
                            value={form.data.website}
                            onChange={(e) => form.setData("website", e.target.value)}
                            placeholder="https://example.com"
                        />
                    </Field>
                    <Field label="Description">
                        <Textarea
                            value={form.data.description}
                            onChange={(e) => form.setData("description", e.target.value)}
                            rows={3}
                        />
                    </Field>
                    <div className="grid grid-cols-2 gap-4">
                        <Field label="Logo path">
                            <Input
                                type="text"
                                value={form.data.logo_path}
                                onChange={(e) => form.setData("logo_path", e.target.value)}
                            />
                        </Field>
                        <Field label="Display order" error={form.errors.display_order}>
                            <Input
                                type="number"
                                min={0}
                                value={String(form.data.display_order)}
                                onChange={(e) =>
                                    form.setData("display_order", parseInt(e.target.value, 10) || 0)
                                }
                                required
                            />
                        </Field>
                    </div>
                    <div className="flex items-center gap-2">
                        <Switch
                            checked={form.data.is_published}
                            onChange={(e) => form.setData("is_published", e.target.checked)}
                        />
                        <Text size="sm" className="text-zinc-700">Published</Text>
                    </div>
                    <div className="flex justify-end gap-2 pt-2">
                        <Action type="button" color="zinc" variant="ghost" onClick={close}>
                            Cancel
                        </Action>
                        <Action type="submit" color="violet" loading={form.processing}>
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
                    Are you sure you want to delete this partner? This action cannot be undone.
                </Text>
                <div className="flex justify-end gap-2">
                    <Action type="button" color="zinc" variant="ghost" onClick={() => setDeletingId(null)}>
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
