#!/bin/bash
set -e

# Determine the script's directory and infer the project root directory
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"

EXPORT_DIR_NAME="wp-content/civi-exports"
EXPORT_DIR_PATH="$PROJECT_ROOT/$EXPORT_DIR_NAME"
TIMESTAMP=$(date +%s)
ZIP_FILE="${TIMESTAMP}-export.zip"

# Create the exports directory if it doesn't exist
mkdir -p $EXPORT_DIR_PATH

echo "Backing up..."
echo "wp civicrm core backup --backup-dir=$EXPORT_DIR_PATH/civicrm-backup --yes"
wp civicrm core backup --backup-dir=$EXPORT_DIR_PATH/civicrm-backup --yes
echo "Backup complete"

cd $EXPORT_DIR_PATH

cd civicrm-backup

rm civicrm.zip

cd ..

echo "zip -r $ZIP_FILE civicrm-backup"

zip -r $ZIP_FILE civicrm-backup

rm -rf civicrm-backup

cd $PROJECT_ROOT

echo "Export ${ZIP_FILE} saved successfully to ${EXPORT_DIR_PATH}"
