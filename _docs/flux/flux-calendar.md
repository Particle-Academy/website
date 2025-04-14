# Flux Calendar Component

A flexible calendar component for date selection. Supports single dates, multiple dates, and date ranges. Perfect for scheduling and booking systems.

## Basic Usage

Set the initial selected date using the `value` prop:

```blade
<flux:calendar value="2025-02-28" />
```

Bind the selection to a Livewire property:

```blade
<flux:calendar wire:model="date" />
```

Access the selected date from your Livewire component:

```php
use Illuminate\Support\Carbon;

class BookAppointment extends \Livewire\Component
{
    public Carbon $date;

    public function mount()
    {
        $this->date = now();
    }
}
```

## Variants

### Range Selection

Enable and control range selection:

```blade
<!-- Enable range selection -->
<flux:calendar mode="range" />

<!-- Set minimum and maximum range limits -->
<flux:calendar mode="range" min-range="3" max-range="10" />

<!-- Show multiple months -->
<flux:calendar mode="range" months="2" />
```

### Sizes

Adjust the calendar's size:

```blade
<flux:calendar size="xs" />
<flux:calendar size="sm" />
<flux:calendar /> <!-- default -->
<flux:calendar size="lg" />
<flux:calendar size="xl" />
<flux:calendar size="2xl" />
```

### Static Calendar

Create a non-interactive calendar for display:

```blade
<flux:calendar 
    static 
    value="2025-02-28" 
    size="xs" 
    :navigation="false" 
/>
```

## Features

### Date Restrictions

Set minimum and maximum selectable dates:

```blade
<!-- Set specific dates -->
<flux:calendar min="2025-01-01" max="2025-12-31" />

<!-- Use "today" shorthand -->
<flux:calendar min="today" /> <!-- Prevent selection before today -->
<flux:calendar max="today" /> <!-- Prevent selection after today -->
```

### Unavailable Dates

Disable specific dates from selection:

```blade
<flux:calendar unavailable="2025-02-27,2025-03-01" />
```

### Today Shortcut

Add a button to quickly navigate to today's date:

```blade
<flux:calendar with-today />
```

### Selectable Header

Enable quick navigation through month/year selection:

```blade
<flux:calendar selectable-header />
```

### Fixed Weeks

Display consistent number of weeks per month:

```blade
<flux:calendar fixed-weeks />
```

### Week Numbers

Display week numbers:

```blade
<flux:calendar week-numbers />
```

### Custom Start Day

Override the default first day of the week:

```blade
<flux:calendar start-day="1" /> <!-- Start with Monday -->
```

### Initial View

Set the initial month to display:

```blade
<flux:calendar open-to="2026-03-01" />
```

## Localization

The calendar automatically uses the document's locale or browser's locale. Override with a specific locale:

```blade
<flux:calendar locale="ja-JP" />
```

## Reference

### flux:calendar

| Prop | Description |
|------|-------------|
| value | Initial selected date (Y-m-d format) |
| wire:model | Livewire model binding |
| mode | Selection mode: "single" (default) or "range" |
| min-range | Minimum days for range selection |
| max-range | Maximum days for range selection |
| months | Number of months to display |
| size | Calendar size: "xs", "sm", "lg", "xl", "2xl" |
| static | Make calendar non-interactive |
| navigation | Enable/disable month navigation |
| min | Minimum selectable date |
| max | Maximum selectable date |
| unavailable | Comma-separated list of unavailable dates |
| with-today | Show today shortcut button |
| selectable-header | Enable month/year selection in header |
| fixed-weeks | Show consistent number of weeks |
| week-numbers | Show week numbers |
| start-day | First day of week (0-6, 0 = Sunday) |
| open-to | Initial month to display (Y-m-d format) |
| locale | Override locale for dates and labels | 