const mix = require("laravel-mix");
require("dotenv").config();

mix.js("resources/js/app.js", "public/js")
    .sass("resources/scss/app.scss", "public/css")
    .setResourceRoot(process.env.MIX_RESOURCES_ROOT);
