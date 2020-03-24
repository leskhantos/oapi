const mix = require("laravel-mix");
require("dotenv").config();

console.log(process.env.MIX_RESOURCES_ROOT);

mix.js("resources/js/app.js", "public/js")
    .sass("resources/scss/app.scss", "public/css")
    .setResourceRoot(process.env.APP_RESOURCES_DIR);
