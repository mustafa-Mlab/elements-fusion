#!/bin/bash

# Ensure the build folder is empty before starting a new build
rm -rf ./build/*

# Copy common files (free version)
cp -r ./admin ./assets ./includes ./vendor ./huge-addons.php ./composer.json ./composer.lock ./README.md ./build/

# For the pro version, copy the pro folder
cp -r ./pro ./build/pro

# Remove comments from the copied files before zipping
# Removing comments from PHP, JS, and CSS files
find ./build -type f \( -iname \*.php -o -iname \*.js -o -iname \*.css \) -exec sed -i '/^\s*#/d' {} \; # Remove all lines starting with "#"

# Optional: Remove documentation or other unnecessary files from the pro version
rm -rf ./build/pro/docs

# Remove pro folder for the free version
rm -rf ./build/pro

# Create the free version ZIP (don't include pro files)
zip -r ./build/huge-addons-free.zip ./build/ -x "*/pro/*"

# Create the pro version ZIP (including the pro files)
zip -r ./build/huge-addons-pro.zip ./build/

# Optional: Clean-up after build
rm -rf ./build/pro

echo "Build completed: huge-addons-free.zip and huge-addons-pro.zip created."
