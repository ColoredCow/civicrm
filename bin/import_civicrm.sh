#!/bin/bash
set -e

EXPORT_DIR_NAME="exports"

cd $EXPORT_DIR_NAME

# Get the latest zip file by timestamp
ZIP_FILE=$(ls -t *-export.zip 2>/dev/null | head -n 1)


# Check if there is any zip file
if [ -z "$ZIP_FILE" ]; then
  echo "No export zip files found in ${EXPORT_DIR_NAME}."
  exit 0
fi

# Unzip the latest zip file
unzip -o $ZIP_FILE

cd ..

# Use yes to automate the confirmation prompt
yes y | wp civicrm core restore --backup-dir=$EXPORT_DIR_PATH/civicrm-backup --yes

echo "Imported ${ZIP_FILE} successfully"
