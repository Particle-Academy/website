# Flux Chart Component

A lightweight, zero-dependency chart component for visualizing data. This is a Pro component in Flux UI.

## Basic Usage

```blade
<flux:chart 
    :data="$chartData"
    type="line"
/>
```

## Chart Types

### Line Chart

```blade
<flux:chart
    type="line"
    :data="[
        ['January', 65],
        ['February', 59],
        ['March', 80],
        ['April', 81],
        ['May', 56],
        ['June', 55],
    ]"
/>
```

### Bar Chart

```blade
<flux:chart
    type="bar"
    :data="[
        ['Q1', 450],
        ['Q2', 560],
        ['Q3', 320],
        ['Q4', 610],
    ]"
/>
```

### Area Chart

```blade
<flux:chart
    type="area"
    :data="[
        ['Week 1', 30],
        ['Week 2', 45],
        ['Week 3', 42],
        ['Week 4', 50],
    ]"
/>
```

## Features

### Multiple Series

```blade
<flux:chart
    type="line"
    :data="[
        [
            'name' => 'Revenue',
            'data' => [100, 200, 150, 300],
        ],
        [
            'name' => 'Expenses',
            'data' => [50, 100, 75, 125],
        ],
    ]"
    :labels="['Q1', 'Q2', 'Q3', 'Q4']"
/>
```

### Customization

```blade
<flux:chart
    type="line"
    :data="$chartData"
    :options="[
        'colors' => ['#4F46E5', '#10B981'],
        'grid' => true,
        'legend' => true,
        'animations' => true,
    ]"
/>
```

### Responsive

```blade
<flux:chart
    type="bar"
    :data="$chartData"
    responsive
/>
```

## Example Use Cases

### Analytics Dashboard

```blade
<flux:card>
    <flux:heading>Monthly Visitors</flux:heading>
    <flux:chart
        type="area"
        :data="$visitorData"
        :options="[
            'grid' => true,
            'animations' => true,
            'colors' => ['#818CF8'],
        ]"
    />
</flux:card>
```

### Sales Report

```blade
<flux:chart
    type="bar"
    :data="[
        [
            'name' => 'Direct Sales',
            'data' => $directSales,
        ],
        [
            'name' => 'Online Sales',
            'data' => $onlineSales,
        ],
    ]"
    :labels="$months"
    :options="[
        'stacked' => true,
        'legend' => true,
    ]"
/>
```

## Reference

### flux:chart

| Prop | Description |
|------|-------------|
| type | Chart type: "line", "bar", "area" |
| data | Array of data points or series |
| labels | Array of labels for the X-axis |
| options | Configuration options for the chart |
| responsive | Whether the chart should resize with its container |
| height | Fixed height for the chart |
| width | Fixed width for the chart |

### Options

| Option | Description |
|--------|-------------|
| colors | Array of colors for the series |
| grid | Show/hide grid lines |
| legend | Show/hide legend |
| animations | Enable/disable animations |
| stacked | Enable stacked mode for bar/area charts |
| xAxis | X-axis configuration |
| yAxis | Y-axis configuration |
| tooltip | Tooltip configuration |

### Events

| Event | Description |
|-------|-------------|
| point:click | Fired when a data point is clicked |
| series:click | Fired when a series legend item is clicked |
| hover | Fired when hovering over data points | 