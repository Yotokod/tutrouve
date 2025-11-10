# Frontend Pages Refactoring Documentation

## Overview
The main frontend pages (home, about, services, contact) have been refactored from a database-driven PageBuilder system to static Blade templates. This provides:
- **Better Performance**: Direct Blade rendering instead of PageBuilder plugin processing
- **Easier Maintenance**: Direct code control and version control
- **Modern Design**: Neo-glassmorphism aesthetic with smooth animations
- **Developer Control**: Easy to customize and extend

## Architecture

### File Structure
```
resources/views/frontend/pages/
├── home.blade.php                 # Home page (main entry point)
├── about.blade.php                # About page
├── services.blade.php             # Services/Pricing page
├── contact.blade.php              # Contact page
└── sections/
    ├── hero.blade.php             # Hero section (used on home)
    ├── top-listings.blade.php     # Featured listings section
    ├── browse-categories.blade.php # Category cards section
    ├── recent-listings.blade.php  # Recent listings section
    └── cta.blade.php              # Call-to-action section

resources/views/components/
├── listings/
│   └── card-modern.blade.php      # Reusable listing card component
├── categories/
│   └── card-modern.blade.php      # Reusable category card component
└── sections/
    └── header.blade.php           # Reusable section header component
```

### Controllers
- **File**: `app/Http/Controllers/Frontend/FrontendPagesController.php`
- **Methods**:
  - `home()` - Returns home page with topListings, categories, recentListings
  - `about()` - Returns about page
  - `services()` - Returns services page
  - `contact()` - Returns contact page

### Routes
All routes defined in `routes/web.php`:
```php
Route::controller(FrontendPagesController::class)->group(function(){
    Route::get('/', 'home')->name('homepage');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/contact', 'contact')->name('contact');
});
```

## Design System

### Color Palette
```css
--primary-color: #1F3E39;      /* Dark green */
--secondary-color: #93bd93;    /* Light green */
--accent-color: #93bd93;
--text-dark: #2c3e50;
--text-light: #6c757d;
--bg-light: #f8f9fa;
--bg-dark-1: #0f172a;          /* Dark blue */
--bg-dark-2: #1a1f3a;          /* Dark blue gradient */
```

### Typography
- **Headings**: Roboto, 700 weight, -0.5px letter-spacing
- **Body**: Roboto, 400 weight
- **Sizes**: 
  - Main heading: 3rem (home page)
  - Section titles: 2.5rem
  - Subsections: 1.3rem - 1.1rem

### Components

#### 1. Listing Card (`x-listings.card-modern`)
**Usage**:
```blade
<x-listings.card-modern :listing="$listing" />
```

**Props**:
- `listing` (required) - Listing model instance
- `badge` (optional) - Show custom badge instead of featured
- `badgeIcon` (optional) - Icon for badge (default: 'la-star')
- `badgeText` (optional) - Text for badge
- `badgeGradient` (optional) - Gradient for badge

**Features**:
- Neo-glassmorphism design
- Price and date display
- Location with icon
- Favorite button
- Smooth hover animations

#### 2. Category Card (`x-categories.card-modern`)
**Usage**:
```blade
<x-categories.card-modern :category="$category" />
```

**Props**:
- `category` (required) - Category model instance

**Features**:
- Icon display
- Listing count
- Animated background
- Floating animation

#### 3. Section Header (`x-sections.header`)
**Usage**:
```blade
<x-sections.header 
    title="Section Title"
    subtitle="Optional subtitle"
    showExploreButton="true"
    exploreText="View All"
    exploreUrl="{{ route('route.name') }}"
/>
```

**Props**:
- `title` (required) - Section title
- `subtitle` (optional) - Subtitle text
- `sectionBg` (optional) - Background style
- `showExploreButton` (optional) - Show explore button
- `exploreText` (optional) - Button text
- `exploreUrl` (optional) - Button URL

## How to Extend

### Add a New Static Page

1. **Create the Blade template** (`resources/views/frontend/pages/new-page.blade.php`):
```blade
@extends('frontend.layout.master')

@section('content')
    <div style="padding: 80px 0; background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 100%);">
        <div class="container-1440">
            <h1 style="color: #ffffff; font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">
                {{ __('Page Title') }}
            </h1>
        </div>
    </div>
@endsection
```

2. **Add a controller method** (`FrontendPagesController.php`):
```php
public function newPage()
{
    return view('frontend.pages.new-page');
}
```

3. **Add the route** (`routes/web.php`):
```php
Route::get('/new-page', [FrontendPagesController::class, 'newPage'])->name('new.page');
```

### Modify Existing Sections

Each section is a reusable partial. To modify:
1. Edit the section file in `resources/views/frontend/pages/sections/`
2. Changes apply immediately
3. Use components for consistency: `<x-listings.card-modern />`

### Add New Data to Pages

Modify the controller method to pass new variables:
```php
public function home()
{
    $topListings = ...;
    $categories = ...;
    $newData = Model::get();  // Add new data
    
    return view('frontend.pages.home', compact('topListings', 'categories', 'newData'));
}
```

Then use in Blade:
```blade
@forelse($newData as $item)
    <!-- Display item -->
@endforeach
```

## Responsive Design

All components use Bootstrap's grid system with custom breakpoints:
- **Desktop** (lg): 1440px container
- **Tablet** (md): 768px
- **Mobile** (sm): 576px
- **Mobile S** (xs): Custom handling

## Animations

The system uses:
- **Fade In**: `fadeInUp`, `fadeInDown` (0.6s)
- **Float**: Floating animation (6s-10s infinite)
- **Pulse**: Badge pulsing (2s infinite)
- **Slide In**: Card entrance animation

All animations use `cubic-bezier(0.4, 0, 0.2, 1)` for smooth easing.

## Performance Considerations

1. **Images**: Use `render_image_markup_by_attachment_id()` helper for lazy loading
2. **Database Queries**: Controller limits queries with `take(8)` to prevent excessive data
3. **Blade Caching**: Blade templates are cached for performance
4. **CSS**: Inline styles for flexibility (can be extracted to CSS files if needed)

## Migration from PageBuilder

If you need to restore PageBuilder functionality:
1. The PageBuilder system is still available in `plugins/PageBuilder/`
2. Dynamic pages still work through `FrontendController@dynamic_single_page`
3. Admin routes for page building are intact in `routes/admin.php`

## Notes

- **Header & Navbar**: Not modified (kept from original design)
- **Footer**: Included from layout
- **Dark Mode**: Uses `get_static_option('site_frontend_dark_mode')` if needed
- **Multi-language**: All strings use `__()` helper for translation
- **SEO**: Uses title tags and proper semantic HTML

## Future Improvements

Potential enhancements:
1. Extract inline styles to dedicated CSS files
2. Add page analytics tracking
3. Implement page caching strategy
4. Add admin panel for static page editing
5. Create page builder UI for non-developers
6. Add schema.org structured data for SEO
