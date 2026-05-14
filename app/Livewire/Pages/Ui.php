<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Ui extends Component
{
    /**
     * Fancy UI Kit — public landing page introducing the Particle Academy
     * UI ecosystem (react-fancy + nine sibling packages). Built from the
     * Claude Design handoff bundle; visuals follow the kit's own tokens
     * (zinc neutrals, sky→indigo→violet brand gradient, Lucide icons).
     */
    public function render()
    {
        return view('livewire.pages.ui', [
            'packages' => $this->packages(),
            'componentGroups' => $this->componentGroups(),
        ]);
    }

    /**
     * The ten packages that make up the Fancy UI kit. Sourced from the
     * design system's project/README.md.
     *
     * @return array<int, array{name: string, tagline: string, repo: string, npm: ?string, version: string, accent: string, icon: string, flagship?: bool, demo?: ?string}>
     */
    private function packages(): array
    {
        return [
            [
                'name' => 'react-fancy',
                'tagline' => 'The flagship Tailwind v4 + React component library. ~50 components from Action through Kanban.',
                'repo' => 'https://github.com/Particle-Academy/react-fancy',
                'npm' => '@particle-academy/react-fancy',
                'version' => '3.2.1',
                'accent' => 'violet',
                'icon' => 'layout-grid',
                'flagship' => true,
                'demo' => null,
            ],
            [
                'name' => 'fancy-3d',
                'tagline' => 'Engine-pluggable bridge — Canvas, Stage, Monitor, Card3D. Puts react-fancy components inside 3D + MR scenes.',
                'repo' => 'https://github.com/Particle-Academy/fancy-3d',
                'npm' => '@particle-academy/fancy-3d',
                'version' => '0.3.1',
                'accent' => 'indigo',
                'icon' => 'box',
                'demo' => null,
            ],
            [
                'name' => 'fancy-echarts',
                'tagline' => 'Typed React wrapper around Apache ECharts plus four schema-driven diagram presets on a shared routing engine.',
                'repo' => 'https://github.com/Particle-Academy/fancy-echarts',
                'npm' => '@particle-academy/fancy-echarts',
                'version' => '3.0.2',
                'accent' => 'sky',
                'icon' => 'bar-chart-3',
                'demo' => null,
            ],
            [
                'name' => 'fancy-code',
                'tagline' => 'Lightweight embedded code editor — custom engine, no Monaco / CodeMirror / Shiki. Pairs with TreeNav for IDE layouts.',
                'repo' => 'https://github.com/Particle-Academy/fancy-code',
                'npm' => '@particle-academy/fancy-code',
                'version' => '0.4.6',
                'accent' => 'emerald',
                'icon' => 'code-2',
                'demo' => null,
            ],
            [
                'name' => 'fancy-sheets',
                'tagline' => 'Full spreadsheet with formulas, multi-sheet workbooks, clipboard, CSV import/export. Zero third-party deps.',
                'repo' => 'https://github.com/Particle-Academy/fancy-sheets',
                'npm' => '@particle-academy/fancy-sheets',
                'version' => '0.7.4',
                'accent' => 'amber',
                'icon' => 'table-2',
                'demo' => null,
            ],
            [
                'name' => 'fancy-whiteboard',
                'tagline' => 'Transport-agnostic collaborative board — sticky notes, freeform pen, connectors, presence cursors.',
                'repo' => 'https://github.com/Particle-Academy/fancy-whiteboard',
                'npm' => '@particle-academy/fancy-whiteboard',
                'version' => '0.1.9',
                'accent' => 'rose',
                'icon' => 'pen-tool',
                'demo' => null,
            ],
            [
                'name' => 'fancy-flow',
                'tagline' => 'Workflow editor on top of React Flow — six node kits, tokenized theme, topological executor with per-node status events.',
                'repo' => 'https://github.com/Particle-Academy/fancy-flow',
                'npm' => '@particle-academy/fancy-flow',
                'version' => '0.2.2',
                'accent' => 'orange',
                'icon' => 'workflow',
                'demo' => null,
            ],
            [
                'name' => 'holy-sheet',
                'tagline' => 'Framework-agnostic PHP 8.2+ xlsx writer for agentic document creation. Optional Laravel adapter.',
                'repo' => 'https://github.com/Particle-Academy/holy-sheet',
                'npm' => null,
                'version' => 'v0.1',
                'accent' => 'red',
                'icon' => 'file-spreadsheet',
                'demo' => null,
            ],
            [
                'name' => 'fancy-inertia',
                'tagline' => 'Inertia.js bridge — one FancyAppRoot, schema-driven pages, useFancyForm(), SSR boundaries.',
                'repo' => 'https://github.com/Particle-Academy/fancy-inertia',
                'npm' => '@particle-academy/fancy-inertia',
                'version' => '0.1.3',
                'accent' => 'blue',
                'icon' => 'plug',
                'demo' => null,
            ],
            [
                'name' => 'agent-integrations',
                'tagline' => 'MCP-driven agent presence — per-session micro-MCP server, bridges to fancy-* packages, agent panel + on-canvas cursor.',
                'repo' => 'https://github.com/Particle-Academy/agent-integrations',
                'npm' => '@particle-academy/agent-integrations',
                'version' => '0.5.0',
                'accent' => 'violet',
                'icon' => 'sparkles',
                'flagship' => true,
                'demo' => null,
            ],
        ];
    }

    /**
     * Featured react-fancy components organised by category. Each row is
     * a quick visual taste of what ships in the library.
     *
     * @return array<int, array{title: string, blurb: string, components: array<int, string>}>
     */
    private function componentGroups(): array
    {
        return [
            [
                'title' => 'Inputs',
                'blurb' => 'Controlled inputs with consistent label / help / error stacks. Every input ships dark-mode parity.',
                'components' => ['Action', 'Field', 'Input', 'Textarea', 'Select', 'Autocomplete', 'OtpInput', 'ColorPicker', 'TimePicker', 'EmojiSelect', 'FileUpload', 'PromptInput', 'InputTag'],
            ],
            [
                'title' => 'Display',
                'blurb' => 'Surfaces, signals, identity. Borders over shadows; soft xl radius; semantic colour usage.',
                'components' => ['Card', 'Badge', 'Callout', 'Avatar', 'Brand', 'ReasonTag', 'MoodMeter', 'MagicWand', 'Pillbox', 'Separator', 'Text', 'Heading'],
            ],
            [
                'title' => 'Layout',
                'blurb' => 'Navigation chrome and structural shells. Tabs, trees, sidebars, breadcrumbs, accordions.',
                'components' => ['Navbar', 'Sidebar', 'MobileMenu', 'Breadcrumbs', 'Tabs', 'TreeNav', 'Accordion', 'AccordionPanel', 'ChatDrawer'],
            ],
            [
                'title' => 'Feedback',
                'blurb' => 'Out-of-flow surfaces — modals, dropdowns, tooltips, toasts, command palette, skeletons.',
                'components' => ['Modal', 'Dropdown', 'Menu', 'Popover', 'Portal', 'Tooltip', 'Toast', 'ContextMenu', 'Command', 'Skeleton', 'Progress'],
            ],
            [
                'title' => 'Data',
                'blurb' => 'Lists, tables, calendars, charts. Tools an agent and a human can both drive in the same surface.',
                'components' => ['Table', 'Kanban', 'Pagination', 'Calendar', 'Timeline', 'Chart', 'ContentRenderer', 'Profile', 'Composer', 'Editor'],
            ],
        ];
    }
}
