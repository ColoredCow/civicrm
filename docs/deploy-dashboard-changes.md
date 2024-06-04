# Deploy Dashboard Changes

This guide list steps to deploy changes/setup you have done from the CiviCRM dashboard locally to the UAT server.

## Syncing your local CiviCRM setup

First make sure your local CiviCRM setup has the latest changes – the current state of UAT.

1. Checkout to `main` branch and pull the latest changes
   ```sh
   git checkout main

   git pull
   ```

2. Import the latest CiviCRM export in the `main` branch 
   ```
   ./bin/import_civicrm.sh
   ```

3. If need arises, run the [post-import steps](#post-import-steps)

## Export and import CiviCRM Setting 

#### Export Instructions

1. Navigate to the project root directory in your terminal.
2. Execute the following command to export the current CiviCRM settings: 
   ```
   ./bin/export_civicrm.sh
   ```
2. A new ZIP file will be generated, for example: `wp-content/civi-exports/1717416031-export.zip`.
3. Push the generated ZIP file to GitHub.

## Post-import steps

Due to some WordPress-level difference between the developer's local environment and UAT, sometime CiviCRM dashboard does not load properly after the import. In that case, the following steps should be taken:

1. From the WordPress Admin, go to **CiviCRM ▶ Settings**
2. In the **WordPress Base Page** box, select a page and click on **Update** button
   <img width="100%" alt="civicrm-base-page" src="https://github.com/ColoredCow/civicrm/assets/11808845/ac461be9-0d66-4ba9-a545-2a14396f8d79">
3. Below in the same page, in the **Useful Links** box, click on **Rebuild the CiviCRM menu**
   <img width="100%" alt="civicrm-rebuild-page" src="https://github.com/ColoredCow/civicrm/assets/11808845/7119bff1-3e9a-42e5-9e9f-e44d651c9ebb">
