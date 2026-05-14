<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class UiDemos extends Component
{
    /**
     * Fancy UI demos — index page. Curates the 23 preview HTMLs shipped
     * with the Claude Design handoff bundle into themed demo cards, each
     * deep-linking to a single-demo page that iframes the prototype.
     */
    public function render()
    {
        return view('livewire.pages.ui-demos', [
            'sections' => self::sections(),
        ]);
    }

    /**
     * Demo catalog. Each section groups related previews; each preview
     * lists the HTML file in `public/ui-previews/` that backs it.
     *
     * @return array<int, array{title: string, blurb: string, demos: array<int, array{slug: string, title: string, blurb: string, previews: array<int, string>, accent: string, icon: string, sandbox: ?string}>}>
     */
    public static function sections(): array
    {
        return [
            [
                'title' => 'Human+ surfaces',
                'blurb' => 'The Human+ thesis in practice — composers, agent presence, drawers, autocomplete pickers that adapt to any text surface.',
                'demos' => [
                    [
                        'slug' => 'composer',
                        'title' => 'PromptInput composer',
                        'blurb' => 'Auto-growing chat composer with slash commands, @-mentions, drop-to-attach, and a live token-budget meter.',
                        'previews' => ['21-composer.html'],
                        'accent' => 'violet',
                        'icon' => 'message-square',
                        'sandbox' => '/react-demos/prompt-input',
                    ],
                    [
                        'slug' => 'agent-presence',
                        'title' => 'Agent presence',
                        'blurb' => 'On-canvas cursor + live tool-call feed. Agents act as participants — humans see what they\'re doing in the same place they\'d see another teammate.',
                        'previews' => ['22-agent-presence.html'],
                        'accent' => 'indigo',
                        'icon' => 'mouse-pointer-2',
                        'sandbox' => '/react-demos/whiteboard-agent',
                    ],
                ],
            ],
            [
                'title' => 'Components',
                'blurb' => 'Interactive primitives from react-fancy. Each ships dark-mode parity, a tight prop surface, and controlled/uncontrolled APIs.',
                'demos' => [
                    [
                        'slug' => 'action-button',
                        'title' => 'Action button',
                        'blurb' => 'The Action button: 10 colors, 5 sizes, ghost / solid / circle variants, leading/trailing icons + emoji + avatars + badges + alert states.',
                        'previews' => ['14-action-button.html', '03-action-colors.html'],
                        'accent' => 'blue',
                        'icon' => 'mouse-pointer-click',
                        'sandbox' => '/react-demos/action',
                    ],
                    [
                        'slug' => 'field-input',
                        'title' => 'Field & Input',
                        'blurb' => 'Controlled inputs with consistent label / help / error stacks. Every input type rendered in light + dark, with focus rings and validation states.',
                        'previews' => ['15-field-input.html'],
                        'accent' => 'sky',
                        'icon' => 'text-cursor-input',
                        'sandbox' => '/react-demos/inputs',
                    ],
                    [
                        'slug' => 'badge-callout',
                        'title' => 'Badge & Callout',
                        'blurb' => 'Soft, solid, and outline badge variants plus inline callouts in success / warning / danger / info intents.',
                        'previews' => ['16-badge-callout.html'],
                        'accent' => 'emerald',
                        'icon' => 'tag',
                        'sandbox' => '/react-demos/badge',
                    ],
                    [
                        'slug' => 'card',
                        'title' => 'Card',
                        'blurb' => 'Border-and-flat-surface Card with Card.Header / Card.Body / Card.Footer compound slots. No shadow chrome — borders carry the surface separation.',
                        'previews' => ['17-card.html'],
                        'accent' => 'amber',
                        'icon' => 'square',
                        'sandbox' => '/react-demos/card',
                    ],
                    [
                        'slug' => 'modal-toast',
                        'title' => 'Modal & Toast',
                        'blurb' => 'Modal with scrim + scale-in. Toast region in fixed portal with slide-in. Both mount through the Portal component that propagates the dark class.',
                        'previews' => ['18-modal-toast.html'],
                        'accent' => 'rose',
                        'icon' => 'square-stack',
                        'sandbox' => '/react-demos/modal',
                    ],
                    [
                        'slug' => 'tabs-treenav',
                        'title' => 'Tabs & TreeNav',
                        'blurb' => 'Underline tabs with active blue accent. TreeNav with expand/collapse, file/folder icons, active-row highlight, badge slots.',
                        'previews' => ['19-tabs-tree.html'],
                        'accent' => 'indigo',
                        'icon' => 'list-tree',
                        'sandbox' => '/react-demos/tabs',
                    ],
                ],
            ],
            [
                'title' => 'Foundations',
                'blurb' => 'The design tokens themselves — color ramps, type scale, radius / shadow / spacing / motion. The fixed grammar every component pulls from.',
                'demos' => [
                    [
                        'slug' => 'brand-logo',
                        'title' => 'Brand & logo',
                        'blurb' => 'The pixelated F mark on light and dark plates, plus the sky → indigo → violet brand gradient that anchors brand surfaces.',
                        'previews' => ['01-logo.html', '02-brand-gradient.html'],
                        'accent' => 'violet',
                        'icon' => 'palette',
                        'sandbox' => null,
                    ],
                    [
                        'slug' => 'color',
                        'title' => 'Color',
                        'blurb' => 'The ten brand accents Action accepts, the zinc neutral spine, and the semantic intent colors (success / warning / danger / info).',
                        'previews' => ['04-neutral-ramp.html', '05-semantic-colors.html'],
                        'accent' => 'sky',
                        'icon' => 'paintbrush',
                        'sandbox' => null,
                    ],
                    [
                        'slug' => 'typography',
                        'title' => 'Typography',
                        'blurb' => 'Geist + Geist Mono pairing. Display, body, mono, and the full Tailwind text-xs → text-6xl scale.',
                        'previews' => ['06-display-type.html', '07-body-type.html', '08-mono-code.html', '09-type-scale.html'],
                        'accent' => 'zinc',
                        'icon' => 'type',
                        'sandbox' => null,
                    ],
                    [
                        'slug' => 'shape-and-elevation',
                        'title' => 'Shape & elevation',
                        'blurb' => 'Radius scale (md / lg / xl / 2xl / full), shadow scale (xs / sm / md / lg / xl), and the spacing grid every component snaps to.',
                        'previews' => ['10-radii.html', '11-shadows.html', '12-spacing.html'],
                        'accent' => 'indigo',
                        'icon' => 'box-select',
                        'sandbox' => null,
                    ],
                    [
                        'slug' => 'motion',
                        'title' => 'Motion',
                        'blurb' => 'The motion vocabulary — fade-in, scale-in, slide-up, toast-in, slide-in-left/right, collapse. Every state change rides an ease curve. No snapping.',
                        'previews' => ['13-motion.html'],
                        'accent' => 'orange',
                        'icon' => 'wind',
                        'sandbox' => null,
                    ],
                    [
                        'slug' => 'iconography',
                        'title' => 'Iconography',
                        'blurb' => 'Lucide — the hard external peer dependency. Line-only, currentColor, square caps. Sized via the Size scale (xs:12 sm:14 md:16 lg:20 xl:24).',
                        'previews' => ['20-iconography.html'],
                        'accent' => 'emerald',
                        'icon' => 'feather',
                        'sandbox' => null,
                    ],
                    [
                        'slug' => 'chart-styling',
                        'title' => 'Chart styling',
                        'blurb' => 'fancy-echarts visual grammar — axis lines, grid, default tooltip background, palette-by-series, and the diagram preset frame.',
                        'previews' => ['23-chart-styling.html'],
                        'accent' => 'sky',
                        'icon' => 'bar-chart-3',
                        'sandbox' => null,
                    ],
                ],
            ],
        ];
    }

    /**
     * Look up a single demo by slug across all sections. Returns null if
     * the slug doesn't match — callers should abort(404) in that case.
     *
     * @return array{slug: string, title: string, blurb: string, previews: array<int, string>, accent: string, icon: string, sandbox: ?string, section: string}|null
     */
    public static function findDemo(string $slug): ?array
    {
        foreach (self::sections() as $section) {
            foreach ($section['demos'] as $demo) {
                if ($demo['slug'] === $slug) {
                    return array_merge($demo, ['section' => $section['title']]);
                }
            }
        }

        return null;
    }
}
