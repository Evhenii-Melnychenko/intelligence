# FutureTech WordPress Theme

This repository contains the Gulp/Webpack build system for the FutureTech
WordPress theme and the theme itself.

- Build project: `client-dev/`
- WordPress theme: `wp-content/themes/futuretech/`
- Compiled assets: `wp-content/themes/futuretech/assets/`

## Project Structure

```text
client-dev/
├── app/
│   └── src/
│       ├── css/
│       │   ├── basik/                 # Reset, variables, typography, mixins
│       │   ├── pages/                 # Page and section SCSS partials
│       │   ├── components.scss        # Shared components and global styles
│       │   ├── main.scss              # Shared stylesheet entry
│       │   ├── home.scss              # Front page stylesheet entry
│       │   ├── ai-intro.scss          # Front page AI intro stylesheet entry
│       │   ├── news.scss              # Posts, archives, and search
│       │   ├── podcasts.scss          # Podcasts page
│       │   ├── resources.scss         # Resources page
│       │   └── contact.scss           # Contact and standard pages
│       ├── fonts/                     # Source fonts
│       ├── images/                    # Source images and SVGs
│       └── js/                        # JavaScript entry and modules
├── gulp/
│   ├── config/                        # Build paths and shared plugins
│   └── tasks/                         # Gulp tasks
├── gulpfile.js
└── package.json

wp-content/themes/futuretech/
├── assets/                            # Compiled CSS, JS, fonts, and images
├── template-parts/                    # Reusable post and page fragments
├── templates/                         # Podcasts, Resources, Contact page templates
├── functions.php                      # Theme setup, assets, menus, and metadata
├── header.php
├── footer.php
├── front-page.php
├── archive.php
├── single.php
└── ...
```

## Requirements

- Node.js 18 or newer
- WordPress installation for running the theme

## Install

From `client-dev/`, install the build dependencies:

```bash
npm install
```

## Build Commands

### Development

```bash
npm run dev
```

Starts Gulp in development mode:

- Watches source SCSS, JavaScript, images, and HTML files.
- Generates sourcemaps.
- Starts BrowserSync using the `futuretech.local` proxy on port `3000`.
- Does not minify CSS or HTML.

Change the proxy in `gulp/tasks/server.js` if your local WordPress domain is
different.

### Production build

```bash
npm run build
```

Builds the theme assets with CSS/HTML minification, CSS prefixing, merged media
queries, WebP support, and production image optimization. The build resets the
generated asset directories before compiling.

## Build Configuration

Paths are configured in `gulp/config/path.js`:

- Source: `app/src/`
- Theme output: `../wp-content/themes/futuretech/assets/`

The SCSS entry points are listed in `gulp/tasks/scss.js`. JavaScript is bundled
from `app/src/js/main.js` by Webpack and written to
`wp-content/themes/futuretech/assets/js/main.js`.

The theme loads `main.css` globally and page-specific stylesheets as needed:

- `home.css` and `ai-intro.css` on the front page
- `news.css` on post archives, search, and single posts
- `podcasts.css`, `resources.css`, and `contact.css` on their page templates

## WordPress Setup

1. Install/activate the `futuretech` theme.
2. Create the pages `Podcasts`, `Resources`, and `Contact`, and assign each page
   its matching template in the page editor.
3. Go to **Appearance → Menus**, create a menu, and assign it to the
   **Primary navigation** theme location.
4. Add posts, categories, and featured images through the WordPress admin.

### Podcast shows and episodes

The Podcasts page uses standard WordPress posts and categories; no custom post
type or ACF plugin is required.

1. Create a parent category named `Podcasts` with the slug `podcasts` (the
   existing `podcast` slug is also supported).
2. Create a child category under `Podcasts` for each show, for example
   `AI Revolution` and `AI Conversations`.
3. Edit each show category and fill in its host, rating, listening URL, average
   episode length, and release frequency.
4. Publish each episode as a regular post. Assign it to its show's child
   category and add a featured image, title, and excerpt/content.

Each show displays its newest post as its featured episode. The total episode
count comes from the number of published posts assigned to that show's category.
The latest episodes grid lists other recent posts from the Podcasts category.

### Other post content

Story and resource cards are generated from regular WordPress posts. Categories,
featured images, excerpts, and authors provide the content shown by the theme.

## Notes

- This build system and theme are specific to FutureTech.
- WordPress templates and template parts render the site's content; the build
  system compiles the front-end assets consumed by those templates.
