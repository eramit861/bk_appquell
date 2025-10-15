# 🎨 Color Theme Documentation

## Current Active Theme: Clean Indigo/Cyan

### How to Change the Color Theme

1. Open `tailwind.config.js`
2. Locate the `colors:` section in `theme.extend`
3. Comment out the current theme
4. Uncomment your preferred theme (or create a custom one)
5. Run `npm run dev` to rebuild

---

## Available Color Themes

### Option 1: Modern Blue/Purple Theme
**Best for:** Contemporary, tech-forward brands
**Mood:** Innovative, trustworthy, creative

```javascript
Primary: Blue (#3b82f6)
Secondary: Purple (#8b5cf6)
Accent: Green (#10b981)
```

**Preview:**
- Primary 500: ![#3b82f6](https://via.placeholder.com/100x30/3b82f6/ffffff?text=Primary)
- Secondary 500: ![#8b5cf6](https://via.placeholder.com/100x30/8b5cf6/ffffff?text=Secondary)
- Accent 500: ![#10b981](https://via.placeholder.com/100x30/10b981/ffffff?text=Accent)

---

### Option 2: Professional Navy/Teal Theme
**Best for:** Legal, financial, corporate brands
**Mood:** Professional, reliable, established

```javascript
Primary: Navy (#1e40af)
Secondary: Teal (#0891b2)
Accent: Amber (#f59e0b)
```

**Preview:**
- Primary 500: ![#1e40af](https://via.placeholder.com/100x30/1e40af/ffffff?text=Primary)
- Secondary 500: ![#0891b2](https://via.placeholder.com/100x30/0891b2/ffffff?text=Secondary)
- Accent 500: ![#f59e0b](https://via.placeholder.com/100x30/f59e0b/ffffff?text=Accent)

---

### Option 3: Clean Indigo/Cyan Theme ⭐ (Current)
**Best for:** Modern, clean, user-friendly brands
**Mood:** Fresh, approachable, modern

```javascript
Primary: Indigo (#6366f1)
Secondary: Cyan (#06b6d4)
Accent: Pink (#ec4899)
```

**Preview:**
- Primary 500: ![#6366f1](https://via.placeholder.com/100x30/6366f1/ffffff?text=Primary)
- Secondary 500: ![#06b6d4](https://via.placeholder.com/100x30/06b6d4/ffffff?text=Secondary)
- Accent 500: ![#ec4899](https://via.placeholder.com/100x30/ec4899/ffffff?text=Accent)

---

## Color Usage Guide

### Primary Color
**Use for:**
- Main CTA buttons
- Primary navigation
- Links
- Important headings
- Brand elements

**Example:**
```html
<button class="bg-primary-500 hover:bg-primary-600 text-white">
  Submit
</button>
```

### Secondary Color
**Use for:**
- Secondary buttons
- Accents
- Highlights
- Icons
- Supporting elements

**Example:**
```html
<div class="bg-secondary-100 border-l-4 border-secondary-500">
  Information box
</div>
```

### Accent Color
**Use for:**
- Call-out elements
- Special offers
- Badges
- Notifications
- Emphasis

**Example:**
```html
<span class="bg-accent-500 text-white px-2 py-1 rounded">
  New
</span>
```

### Status Colors
Always use semantic colors for status indicators:

**Success** (Green) - Positive actions, confirmations
```html
<div class="bg-success-100 text-success-800">
  ✓ Successfully saved!
</div>
```

**Warning** (Amber) - Warnings, cautions
```html
<div class="bg-warning-100 text-warning-800">
  ⚠ Please review before continuing
</div>
```

**Danger** (Red) - Errors, destructive actions
```html
<div class="bg-danger-100 text-danger-800">
  ✗ An error occurred
</div>
```

**Info** (Blue) - Informational messages
```html
<div class="bg-info-100 text-info-800">
  ℹ Did you know...
</div>
```

---

## Color Shades Guide

Each color comes with 11 shades (50-950):

- **50-100**: Very light backgrounds
- **200-300**: Light backgrounds, borders
- **400-500**: Main color (buttons, links)
- **600-700**: Hover states, dark text
- **800-900**: Very dark text, headers
- **950**: Darkest shade

### Examples:

#### Light Background with Dark Text
```html
<div class="bg-primary-50 text-primary-900">
  Light content box
</div>
```

#### Button with Hover State
```html
<button class="bg-primary-500 hover:bg-primary-600 active:bg-primary-700">
  Click me
</button>
```

#### Border Accent
```html
<div class="border-l-4 border-secondary-500 pl-4">
  Accented content
</div>
```

---

## Comparison with Old Project

### Old Color (bkassistant_web)
```css
Primary Blue: #012cae
```

### New Colors (bk_appquell)
```css
Primary Indigo: #6366f1 (lighter, more modern)
Secondary Cyan: #06b6d4 (new, adds variety)
Accent Pink: #ec4899 (new, adds vibrancy)
```

### Migration Notes:
- Old `#012cae` is quite dark
- New colors are brighter and more accessible
- Better contrast ratios for WCAG compliance
- More color variety for better UI hierarchy

---

## Creating a Custom Color Theme

Want to create your own color scheme? Here's how:

### Step 1: Choose Your Colors
Use tools like:
- [Coolors.co](https://coolors.co/) - Color palette generator
- [Adobe Color](https://color.adobe.com/) - Professional color tool
- [TailwindCSS Color Generator](https://uicolors.app/create) - Generate Tailwind shades

### Step 2: Generate Shades
You need 11 shades (50-950) for each color. Use:
- [TailwindShades](https://www.tailwindshades.com/)
- [UIColors](https://uicolors.app/create)

### Step 3: Add to Config
```javascript
// tailwind.config.js
colors: {
  primary: {
    50: '#your-color',
    100: '#your-color',
    // ... through 950
  }
}
```

### Step 4: Test
```bash
npm run dev
```

---

## Accessibility Guidelines

### Contrast Ratios (WCAG AA)
- **Normal text:** 4.5:1 minimum
- **Large text:** 3:1 minimum
- **UI components:** 3:1 minimum

### Recommended Combinations:

✅ **Good Contrast:**
- `text-primary-900` on `bg-white`
- `text-white` on `bg-primary-500`
- `text-primary-700` on `bg-primary-100`

❌ **Poor Contrast:**
- `text-primary-300` on `bg-white`
- `text-primary-100` on `bg-primary-200`

### Test Your Colors:
- [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/)
- Chrome DevTools (Lighthouse audit)

---

## Dark Mode Support (Future)

To add dark mode support later:

```javascript
// tailwind.config.js
export default {
  darkMode: 'class', // or 'media'
  // ...
}
```

```html
<!-- Light mode -->
<div class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white">
  Content
</div>
```

---

## Common Color Patterns

### Card with Colored Border
```html
<div class="bg-white border-l-4 border-primary-500 shadow-card p-6">
  <h3 class="text-primary-900 font-bold">Title</h3>
  <p class="text-gray-600">Content</p>
</div>
```

### Gradient Background
```html
<div class="bg-gradient-to-r from-primary-500 to-secondary-500">
  <h1 class="text-white">Hero Section</h1>
</div>
```

### Status Badge
```html
<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-success-100 text-success-800">
  Active
</span>
```

### Icon with Colored Background
```html
<div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-100">
  <svg class="w-6 h-6 text-primary-600">...</svg>
</div>
```

---

## Quick Reference

### Primary Actions
```
bg-primary-500 hover:bg-primary-600 text-white
```

### Secondary Actions
```
bg-secondary-100 hover:bg-secondary-200 text-secondary-800
```

### Danger Actions
```
bg-danger-500 hover:bg-danger-600 text-white
```

### Outline Buttons
```
border-2 border-primary-500 text-primary-600 hover:bg-primary-50
```

### Links
```
text-primary-600 hover:text-primary-800 underline
```

### Disabled State
```
bg-gray-200 text-gray-400 cursor-not-allowed
```

---

## Tips for Consistent Color Usage

1. **Use semantic naming** - Don't use `bg-blue-500`, use `bg-primary-500`
2. **Stick to the palette** - Don't introduce random colors
3. **Use status colors semantically** - Green for success, Red for errors
4. **Test accessibility** - Always check contrast ratios
5. **Be consistent** - Use the same shade for similar elements

---

**Last Updated:** October 13, 2025
**Active Theme:** Clean Indigo/Cyan
**Version:** 1.0

