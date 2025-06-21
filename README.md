# install filament
 - composer require filament/filament:"^3.3" -W
 - php artisan filament:install --panels 
# Create user
 - php artisan make:filament-user
# Create resource
 - php artisan make:filament-resource MedicalType --generate --view

# Install Inertia
 -  composer require inertiajs/inertia-laravel
 -  npm install @inertiajs/inertia-react @inertiajs/react @vitejs/plugin-react react react-dom

 # vite.config.js
 import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react(), // React plugin that we installed for vite.js
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],
            refresh: true,
        }),
    ],
});
# app.jsx
import React from 'react'
import {createRoot} from 'react-dom/client'
import {createInertiaApp } from '@inertiajs/inertia-react'
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers'

createInertiaApp({
    // Below you can see that we are going to get all React components from resources/js/Pages folder
    resolve: (name) => resolvePageComponent(`./Pages/${name}.jsx`,import.meta.glob('./Pages/**/*.jsx')),
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />)
    },
})
# RUN LOCAL
 - php artisan serve
 - npm run dev

## deploy references 
https://wpmethods.com/deploy-upload-laravel-vue-inertiajs-tailwind-project-in-cpanel/

# npm run build
 - build folder ထဲမှ compiled ဖိုင်များကို /publci_html/build ထဲမှာ ထည့်မယ် . 
 - public/build ထဲမှာ manifest.json ကို ထည့်ပေးရမယ် 
 - laravel/public folder ထဲမှ ဖိုင်တွေကို public_html ထည့်မယ်
 - public_html/index.php မှာ /storage/ path တွေကို ပြင်ပေးရမယ်
 - အပေါ် က wpmethods.com ကိုကြည့်ပီ ဆောင်ရွက်ပါ... 

# update လုပ်မယ် ဆို build file တွေကို manually upload လုပ်ပါမယ် / public_html/build ထဲ ထည့်ရမယ် // public/build/manifest.json  ထည့်ရမယ် 
# backend ကိုတော့ git pull နဲ့ update လုပ်ပါမယ်

- yanpaingphyo => 123Ypp45#%

