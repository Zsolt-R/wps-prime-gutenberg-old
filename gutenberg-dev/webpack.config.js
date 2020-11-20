const defaultConfig = require("@wordpress/scripts/config/webpack.config"),
    path = require('path');

module.exports = [
    {
        ...defaultConfig,
        entry: {
            'wps-prime-theme-post-meta':'./src/post-meta/components/page-spacing-settings.js',
            'wps-prime-theme-editor-style':'./src/scss/theme-editor-style.scss'
        },
        output: {
            path: path.join(process.cwd(), '../assets/gutenberg/')   
        }   
    },
]
