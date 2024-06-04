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

## Pushing changes to the UAT

To push local dashboard changes to UAT we will generate a complete export of the CiviCRM locally and push it GitHub in a branch:

1. After making the changes locally, we will generate an export
   ```sh
   ./bin/export_civicrm.sh
   ```
   This will save the export in a ZIP with the current timestamp (e.g., `wp-content/civi-exports/1717416031-export.zip`)

2. Create a branch and commit the generated export
   ```sh
   git checkout -b feat/created-event-types     # Use your branch name

   git commit -m 'create event types'     # Use your commit message
   ```

3. Push the branch to GitHub and create a PR
   ```sh
   git push --set-upstream origin feat/created-event-types     # Use your remote and branch name

   # Create the PR from GitHub or via GH-CLI
   # Don't forget to describe the changes and
   # link the targeted issue in the PR desription.
   ```

4. Once your PR is merged in `main`, the [Import CiviCRM - Staging](https://github.com/ColoredCow/civicrm/blob/main/.github/workflows/import-staging.yml) workflow will take care of deploying the changes to the UAT
5. Keep and eye on the [workflow run](https://github.com/ColoredCow/civicrm/actions/workflows/import-staging.yml) to see if the deployment succeeds
6. Once it succeeds, visit [the UAT](https://civicrm.coloredcow.com) to make sure the changes are reflecting there
7. If need arises, run the [post-import steps](#post-import-steps)
## Post-import steps

Due to some WordPress-level difference between the developer's local environment and UAT, sometime CiviCRM dashboard might not load properly after the import. In those cases, the following steps should be taken:

1. From the WordPress Admin, go to **CiviCRM ▶ Settings**
2. In the **WordPress Base Page** box, select a page and click on **Update** button
   <img width="100%" alt="civicrm-base-page" src="https://github.com/ColoredCow/civicrm/assets/11808845/ac461be9-0d66-4ba9-a545-2a14396f8d79">
3. Below in the same page, in the **Useful Links** box, click on **Rebuild the CiviCRM menu** link
   <img width="100%" alt="civicrm-rebuild-page" src="https://github.com/ColoredCow/civicrm/assets/11808845/7119bff1-3e9a-42e5-9e9f-e44d651c9ebb">
