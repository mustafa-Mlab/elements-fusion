#!/bin/bash

# Copy common files
cp -r ./admin ./assets ./includes ./vendor ./huge-addons.php ./composer.json ./composer.lock ./README.md ./build/

# For the pro version, copy the pro folder
cp -r ./pro ./build/pro

# Remove unnecessary files from the build folder (e.g., README, docs, etc. for pro)
rm -rf ./build/pro/docs

# Compress or package the build folder for deployment
zip -r ./build/huge-addons-free.zip ./build/
zip -r ./build/huge-addons-pro.zip ./build/
