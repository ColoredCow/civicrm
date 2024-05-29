#!/bin/bash
set -e

# Determine the script's directory and infer the project root directory
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"

# Define variables
BACKUP_ZIP_DIR="configurations"
MAIN_BRANCH="fix/civicrm/csv-export" # change after testing to "main"
TIMESTAMP=$(date +%s)
ZIP_FILE="civicrm-backup-${TIMESTAMP}.zip"

if [ -n "$(git status --porcelain)" ]; then
  echo "There are unstaged changes. Please commit or stash them before proceeding."
  exit 1
fi

# Pull the latest changes from main branch
git checkout $MAIN_BRANCH
git pull origin $MAIN_BRANCH

# Create a new branch
NEW_BRANCH="configuration-${TIMESTAMP}"
git checkout -b $NEW_BRANCH
echo "Switched to a new branch: ${NEW_BRANCH}"

# Generate CiviCRM backup
echo "Generating CiviCRM backup..."
wp civicrm core backup --yes
echo "CiviCRM backup generation complete."

# Move up one level and create the ZIP archive
cd ..
zip -r $ZIP_FILE civicrm-backup

# Create the backup versions directory if it doesn't exist
mkdir -p $PROJECT_ROOT/$BACKUP_ZIP_DIR

# Move the ZIP file to the backup versions directory
mv $ZIP_FILE $PROJECT_ROOT/$BACKUP_ZIP_DIR

# Commit and push the changes
cd $PROJECT_ROOT
git add $BACKUP_ZIP_DIR/$ZIP_FILE
git commit -m "Auto-generated backup: ${ZIP_FILE}"

echo "Backup created and commited to branch: ${NEW_BRANCH}"
echo "You can simply push the branch and create a PR."
