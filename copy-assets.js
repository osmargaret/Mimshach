import fs from 'fs';

fs.mkdirSync('public/css', { recursive: true });
fs.mkdirSync('public/js', { recursive: true });

if (fs.existsSync('public/build/assets/app.css')) {
    fs.copyFileSync('public/build/assets/app.css', 'public/css/app.css');
}
if (fs.existsSync('public/build/assets/app.js')) {
    fs.copyFileSync('public/build/assets/app.js', 'public/js/app.js');
}

console.log('✓ Successfully copied assets to public/css/app.css and public/js/app.js');

