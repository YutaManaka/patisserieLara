import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

import '../css/app.css'
import './bootstrap'

createInertiaApp({
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, app, props, plugin }) {
    createApp({ render: () => h(app, props) })
      .mixin({ methods: { route } })
      .use(plugin)
      .component('InertiaHead', Head)
      .component('InertiaLink', Link)
      .mount(el)
  },
})

InertiaProgress.init({ color: '#4B5563' })
