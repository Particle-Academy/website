# Editor Component

A powerful WYSIWYG (What You See Is What You Get) rich text editor component that provides a comprehensive set of text formatting and editing capabilities.

## Basic Usage

```blade
<flux:editor wire:model="content">
    <p>Initial content goes here...</p>
</flux:editor>
```

## Features

### Basic Formatting

The editor provides common text formatting options:

```blade
<flux:editor
    wire:model="content"
    :toolbar="['bold', 'italic', 'underline', 'strike']"
/>
```

### Advanced Formatting

Enable advanced formatting options for more complex content:

```blade
<flux:editor
    wire:model="content"
    :toolbar="[
        'bold',
        'italic',
        'underline',
        'strike',
        'separator',
        'heading',
        'bullet-list',
        'ordered-list',
        'separator',
        'code',
        'blockquote',
        'separator',
        'link',
        'image'
    ]"
/>
```

### Custom Toolbar

Create a custom toolbar with specific formatting options:

```blade
<flux:editor
    wire:model="content"
    :toolbar="[
        ['bold', 'italic', 'underline'],
        ['heading-1', 'heading-2', 'heading-3'],
        ['bullet-list', 'ordered-list'],
        ['link', 'image'],
        ['undo', 'redo']
    ]"
/>
```

### With Placeholder

Add a placeholder text when the editor is empty:

```blade
<flux:editor
    wire:model="content"
    placeholder="Start typing your content..."
/>
```

### Read-Only Mode

Display content in read-only mode:

```blade
<flux:editor
    wire:model="content"
    :read-only="true"
/>
```

### Character Count

Enable character counting with optional limits:

```blade
<flux:editor
    wire:model="content"
    :show-character-count="true"
    :max-characters="1000"
/>
```

## Component Reference

### flux:editor

The main editor component.

#### Props
| Prop                 | Type    | Default | Description                                   |
| -------------------- | ------- | ------- | --------------------------------------------- |
| wire:model           | string  | -       | Livewire model binding for the editor content |
| toolbar              | array   | []      | Array of toolbar items to display             |
| placeholder          | string  | ''      | Placeholder text when editor is empty         |
| read-only            | boolean | false   | Whether the editor is in read-only mode       |
| show-character-count | boolean | false   | Display character count                       |
| max-characters       | number  | null    | Maximum number of characters allowed          |
| min-height           | string  | '200px' | Minimum height of the editor                  |
| max-height           | string  | null    | Maximum height of the editor                  |
| autofocus            | boolean | false   | Whether to focus the editor on mount          |

#### Events
| Event          | Description                                |
| -------------- | ------------------------------------------ |
| update         | Fired when the editor content changes      |
| focus          | Fired when the editor receives focus       |
| blur           | Fired when the editor loses focus          |
| ready          | Fired when the editor is fully initialized |
| characterLimit | Fired when the character limit is reached  |

#### Slots
| Slot    | Description                            |
| ------- | -------------------------------------- |
| toolbar | Custom toolbar content                 |
| footer  | Custom footer content below the editor |

## Toolbar Items

Available toolbar items that can be included:

- Text Formatting: `bold`, `italic`, `underline`, `strike`, `code`
- Headings: `heading-1`, `heading-2`, `heading-3`
- Lists: `bullet-list`, `ordered-list`
- Alignment: `align-left`, `align-center`, `align-right`, `align-justify`
- Links & Media: `link`, `image`
- Quotes: `blockquote`
- History: `undo`, `redo`
- Special: `separator` (adds a vertical separator in the toolbar)

## Accessibility

1. **Keyboard Navigation**
   - Full keyboard support for all editor functions
   - Shortcuts for common formatting actions
   - ARIA labels for all toolbar buttons

2. **Screen Reader Support**
   - Semantic markup for content structure
   - Descriptive announcements for toolbar actions
   - Clear focus management

## Best Practices

1. **Content Management**
   - Implement content validation before saving
   - Consider implementing auto-save functionality
   - Provide clear feedback for user actions

2. **Performance**
   - Lazy load the editor for better initial page load
   - Consider debouncing content updates
   - Optimize image handling for large documents

3. **User Experience**
   - Provide clear formatting feedback
   - Maintain consistent toolbar organization
   - Include appropriate keyboard shortcuts

## CSS Customization

The editor can be styled using Tailwind CSS classes:

```blade
<flux:editor
    class="editor-container"
    content-class="editor-content"
    toolbar-class="editor-toolbar"
>
    <!-- Editor content -->
</flux:editor>
```

### Custom Styling Examples

```blade
<!-- Custom editor container -->
<flux:editor class="rounded-lg border-2 border-blue-500">
    <!-- Editor content -->
</flux:editor>

<!-- Custom toolbar styling -->
<flux:editor toolbar-class="bg-gray-100 border-b p-2">
    <!-- Editor content -->
</flux:editor>

<!-- Custom content area -->
<flux:editor content-class="prose prose-sm max-w-none">
    <!-- Editor content -->
</flux:editor>
```

## Browser Support

The Editor component is supported across all modern browsers. For optimal performance, we recommend using the latest versions of Chrome, Firefox, Safari, or Edge. 