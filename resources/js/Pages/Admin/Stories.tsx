import { router, useForm } from "@inertiajs/react";
import {
    Action,
    Badge,
    Card,
    Field,
    Input,
    Select,
    Switch,
    Text,
    Textarea,
} from "@particle-academy/react-fancy";
import { Pencil, Plus, Star, Trash2 } from "lucide-react";
import { useState, type FormEvent } from "react";
import Modal from "../../Components/Admin/Modal";
import Pagination, { type Paginator } from "../../Components/Admin/Pagination";
import AdminLayout from "../../Layouts/AdminLayout";

interface Story {
    id: number;
    name: string;
    role: string;
    quote: string;
    achievement: string;
    image_path: string | null;
    rating: number;
    is_featured: boolean;
    is_published: boolean;
}

interface StoriesProps {
    stories: Paginator<Story>;
}

export default function Stories({ stories }: StoriesProps) {
    const [editingId, setEditingId] = useState<number | null>(null);
    const [creating, setCreating] = useState(false);
    const [deletingId, setDeletingId] = useState<number | null>(null);

    const form = useForm({
        name: "",
        role: "",
        quote: "",
        achievement: "",
        image_path: "",
        rating: 5,
        is_featured: false,
        is_published: true,
    });

    function startCreate() {
        form.reset();
        form.clearErrors();
        setCreating(true);
    }

    function startEdit(story: Story) {
        form.setData({
            name: story.name,
            role: story.role,
            quote: story.quote,
            achievement: story.achievement,
            image_path: story.image_path ?? "",
            rating: story.rating,
            is_featured: story.is_featured,
            is_published: story.is_published,
        });
        setEditingId(story.id);
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
            form.put(`/admin/stories/${editingId}`, { preserveScroll: true, onSuccess: close });
        } else if (creating) {
            form.post("/admin/stories", { preserveScroll: true, onSuccess: close });
        }
    }

    function confirmDelete() {
        if (!deletingId) return;
        router.delete(`/admin/stories/${deletingId}`, {
            preserveScroll: true,
            onFinish: () => setDeletingId(null),
        });
    }

    const modalOpen = editingId !== null || creating;
    const modalTitle = editingId !== null ? "Edit Story" : "New Story";

    return (
        <AdminLayout heading="Success Stories">
            <div className="flex justify-end mb-4">
                <Action type="button" color="violet" onClick={startCreate}>
                    <Plus className="w-4 h-4 mr-1 inline" /> New Story
                </Action>
            </div>

            <Card>
                <Card.Body className="p-0">
                    <div className="overflow-x-auto">
                        <table className="w-full text-sm">
                            <thead className="bg-zinc-50 text-zinc-600 uppercase text-xs">
                                <tr>
                                    <th className="px-4 py-3 text-left font-semibold">Name</th>
                                    <th className="px-4 py-3 text-left font-semibold">Role</th>
                                    <th className="px-4 py-3 text-left font-semibold">Rating</th>
                                    <th className="px-4 py-3 text-left font-semibold">Status</th>
                                    <th className="px-4 py-3 text-right font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-zinc-100">
                                {stories.data.length === 0 ? (
                                    <tr>
                                        <td colSpan={5} className="px-4 py-16 text-center">
                                            <Text className="text-zinc-500">No stories yet.</Text>
                                        </td>
                                    </tr>
                                ) : (
                                    stories.data.map((story) => (
                                        <tr key={story.id} className="hover:bg-zinc-50">
                                            <td className="px-4 py-3 font-medium text-zinc-900">{story.name}</td>
                                            <td className="px-4 py-3 text-zinc-600">{story.role}</td>
                                            <td className="px-4 py-3">
                                                <span className="inline-flex text-amber-400">
                                                    {Array.from({ length: story.rating }).map((_, i) => (
                                                        <Star key={i} className="w-4 h-4 fill-current" />
                                                    ))}
                                                </span>
                                            </td>
                                            <td className="px-4 py-3">
                                                <div className="flex gap-1">
                                                    {story.is_featured && (
                                                        <Badge color="amber" variant="soft" size="sm">Featured</Badge>
                                                    )}
                                                    <Badge
                                                        color={story.is_published ? "green" : "zinc"}
                                                        variant="soft"
                                                        size="sm"
                                                    >
                                                        {story.is_published ? "Published" : "Draft"}
                                                    </Badge>
                                                </div>
                                            </td>
                                            <td className="px-4 py-3 text-right">
                                                <div className="inline-flex gap-1">
                                                    <button
                                                        type="button"
                                                        onClick={() => startEdit(story)}
                                                        className="p-1.5 text-violet-600 hover:bg-violet-50 rounded"
                                                        title="Edit"
                                                    >
                                                        <Pencil className="w-4 h-4" />
                                                    </button>
                                                    <button
                                                        type="button"
                                                        onClick={() => setDeletingId(story.id)}
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
                        <Pagination meta={stories} />
                    </div>
                </Card.Body>
            </Card>

            <Modal open={modalOpen} onClose={close} title={modalTitle} maxWidth="max-w-2xl">
                <form onSubmit={submit} className="space-y-4">
                    <div className="grid grid-cols-2 gap-4">
                        <Field label="Name" error={form.errors.name}>
                            <Input
                                type="text"
                                value={form.data.name}
                                onChange={(e) => form.setData("name", e.target.value)}
                                required
                            />
                        </Field>
                        <Field label="Role" error={form.errors.role}>
                            <Input
                                type="text"
                                value={form.data.role}
                                onChange={(e) => form.setData("role", e.target.value)}
                                required
                            />
                        </Field>
                    </div>
                    <Field label="Quote" error={form.errors.quote}>
                        <Textarea
                            value={form.data.quote}
                            onChange={(e) => form.setData("quote", e.target.value)}
                            rows={3}
                            required
                        />
                    </Field>
                    <Field label="Achievement" error={form.errors.achievement}>
                        <Input
                            type="text"
                            value={form.data.achievement}
                            onChange={(e) => form.setData("achievement", e.target.value)}
                            required
                        />
                    </Field>
                    <div className="grid grid-cols-2 gap-4">
                        <Field label="Image path" error={form.errors.image_path}>
                            <Input
                                type="text"
                                value={form.data.image_path}
                                onChange={(e) => form.setData("image_path", e.target.value)}
                            />
                        </Field>
                        <Field label="Rating">
                            <Select
                                value={String(form.data.rating)}
                                onChange={(e) =>
                                    form.setData("rating", parseInt(e.target.value, 10))
                                }
                            >
                                {[1, 2, 3, 4, 5].map((n) => (
                                    <option key={n} value={n}>
                                        {n} Star{n === 1 ? "" : "s"}
                                    </option>
                                ))}
                            </Select>
                        </Field>
                    </div>
                    <div className="flex gap-6">
                        <div className="flex items-center gap-2">
                            <Switch
                                checked={form.data.is_featured}
                                onChange={(e) =>
                                    form.setData("is_featured", e.target.checked)
                                }
                            />
                            <Text size="sm" className="text-zinc-700">Featured</Text>
                        </div>
                        <div className="flex items-center gap-2">
                            <Switch
                                checked={form.data.is_published}
                                onChange={(e) =>
                                    form.setData("is_published", e.target.checked)
                                }
                            />
                            <Text size="sm" className="text-zinc-700">Published</Text>
                        </div>
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
                    Are you sure you want to delete this story? This action cannot be undone.
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
