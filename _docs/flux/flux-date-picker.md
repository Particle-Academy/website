# Flux Date Picker Component

Allow users to select dates or date ranges via a calendar overlay. Perfect for filtering data or scheduling events. This is a Pro component in Flux UI.

> Note: Use date inputs instead of date pickers for far-future or past events such as birthdates.

## Basic Usage

Set the initial selected date using the `value` prop:

```blade
<flux:date-picker value="2025-02-28" />
```

Bind the selection to a Livewire property:

```blade
<flux:date-picker wire:model="date" />
```

Access the selected date from your Livewire component:

```php
use Illuminate\Support\Carbon;
use App\Models\Post;

class CreatePost extends \Livewire\Component
{
    public ?Carbon $date;

    public function save()
    {
        Post::create([
            'published_at' => $this->date,
        ]);
    }
}
```

## Features

### Input Trigger

Attach the date picker to a date input for more precise date selection control:

```blade
<flux:date-picker wire:model="date">
    <x-slot name="trigger">
        <flux:date-picker.input label="Select date" />
    </x-slot>
</flux:date-picker>
```

### Range Selection

Enable date range selection:

```blade
<flux:date-picker 
    mode="range" 
    wire:model="dateRange"
    months="2"
/>
```

### Range with Inputs

Use separate inputs for start and end dates:

```blade
<flux:date-picker mode="range">
    <x-slot name="trigger">
        <div class="flex flex-col sm:flex-row gap-6 sm:gap-4">
            <flux:date-picker.input label="Start" />
            <flux:date-picker.input label="End" />
        </div>
    </x-slot>
</flux:date-picker>
```

### Range Limits

Control the allowed range of dates:

```blade
<!-- Minimum range of 3 days -->
<flux:date-picker mode="range" min-range="3" />

<!-- Maximum range of 10 days -->
<flux:date-picker mode="range" max-range="10" />
```

### With Presets

Add predefined date range options:

```blade
<flux:date-picker 
    mode="range" 
    with-presets
/>
```

Customize available presets:

```blade
<flux:date-picker 
    mode="range" 
    presets="today yesterday thisWeek last7Days thisMonth yearToDate allTime" 
/>
```

### Calendar Features

#### Selectable Header

Enable quick navigation through month/year selection:

```blade
<flux:date-picker selectable-header />
```

#### Fixed Weeks

Display consistent number of weeks per month:

```blade
<flux:date-picker fixed-weeks />
```

#### Custom Start Day

Override the default first day of the week:

```blade
<flux:date-picker start-day="1" /> <!-- Start with Monday -->
```

#### Initial View

Set the initial month to display:

```blade
<flux:date-picker open-to="2026-03-01" />
```

#### Week Numbers

Display week numbers:

```blade
<flux:date-picker week-numbers />
```

## Example Use Cases

### Event Scheduling

```blade
<flux:date-picker>
    <x-slot name="trigger">
        <flux:date-picker.input 
            label="Event Date" 
            description="Select when the event will take place"
        />
    </x-slot>
</flux:date-picker>
```

### Date Range Filter

```blade
<flux:date-picker 
    mode="range" 
    with-presets
    months="2"
>
    <x-slot name="trigger">
        <div class="flex flex-col sm:flex-row gap-4">
            <flux:date-picker.input label="From" />
            <flux:date-picker.input label="To" />
        </div>
    </x-slot>
</flux:date-picker>
```

## Reference

### flux:date-picker

| Prop | Description |
|------|-------------|
| value | Initial selected date (Y-m-d format) |
| wire:model | Livewire model binding |
| mode | Selection mode: "single" (default) or "range" |
| months | Number of months to display |
| min-range | Minimum days for range selection |
| max-range | Maximum days for range selection |
| with-presets | Show predefined range options |
| presets | Customize available presets |
| selectable-header | Enable month/year selection in header |
| fixed-weeks | Show consistent number of weeks |
| week-numbers | Show week numbers |
| start-day | First day of week (0-6, 0 = Sunday) |
| open-to | Initial month to display (Y-m-d format) |

### flux:date-picker.input

| Prop | Description |
|------|-------------|
| label | Input label text |
| description | Additional descriptive text |
| placeholder | Placeholder text |
| disabled | Whether the input is disabled |

### Events

| Event | Description |
|-------|-------------|
| change | Fired when the selected date changes |
| open | Fired when the date picker opens |
| close | Fired when the date picker closes |

### Accessibility

- Fully keyboard navigable
- Screen reader support for date selection
- ARIA labels and roles
- Localized date formats
- Mobile-friendly interface 