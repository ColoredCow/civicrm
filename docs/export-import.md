# Export Import

For the sake of understanding this guide, assume two users:

1. **Exporter**: The user who has introduced some changes from CiviCRM dashboard.
   - Project (WordPress with CiviCRM) is installed at: `/Users/exporter/civicrm`
2. **Importer**: The user who wants the changes done by _Exporter_ in her CiviCRM environment.
   - Project is installed at: `/Users/importer/civicrm`


## Steps

### Exporter

1. Move to the project root directory
   ```sh
   cd /Users/exporter/civicrm
   ```

1. Generate a CiviCRM backup
   ```sh
   wp civicrm core backup
   ```
   This will generate the backup files and will put them in a directory which is one level above project's root directory, i.e., in our case, `/Users/exporter/`. Hence, the path to the generated backup will be `/Users/exporter/civicrm-backup`.

2. Move to one level up directory
   ```sh
   cd ..
   ```

3. Create a ZIP of the backup directory `civicrm-backup`
   ```sh
   zip -r civicrm-backup.zip civicrm-backup
   ```
   This will create a zip archive `civicrm-backup.zip` which can be shared with the _Importer_.


### Importer

1. After receiving the ZIP archive `civicrm-backup.zip` from _Exporter_, move it to the directory one level up the project root directory
   ```sh
   mv civicrm-backup.zip /Users/importer/
   ```

1. Unzip the archive
   ```sh
   unzip civicrm-backup.zip
   ```

1. Move inside the project root directory
   ```sh
   cd civicrm
   ```

1. Restore from the backup
   ```sh
   wp civicrm core restore
   ```
   This command will give prompt a couple of times: `Do you want to continue?` and `Are you sure you want to all CiviCRM entities from the database?` which needs to be answered yes (`y`).