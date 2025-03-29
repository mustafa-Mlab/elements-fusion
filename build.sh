#!/bin/bash

# Copy common files
cp -r ./admin ./assets ./includes ./vendor ./elements-fusion.php ./composer.json ./composer.lock ./README.md ./filename.txt ./build/

# For the pro version, copy the pro folder
cp -r ./pro ./build/pro

# Remove unnecessary files from the build folder (e.g., README, docs, etc. for pro)
rm -rf ./build/pro/docs

# Compress or package the build folder for deployment
zip -r ./build/elementor-plugin-free.zip ./build/
zip -r ./build/elementor-plugin-pro.zip ./build/
