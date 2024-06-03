# CiviCRM

## Preparing development environment

### Pre-requisite

1. PHP 8.x
2. WP-CLI
   1. [Installing via Homebrew](https://make.wordpress.org/cli/handbook/guides/installing/#installing-via-homebrew) would be the easiest option for macOS users.
   2. If not, all other installation options can be found in the same page.
3. MySQL 5.7.5+ or MariaDB 10.2+


### Steps (from this repository)

#### WordPress site setup

First we will setup a WordPress site on top of which we will setup CiviCRM. For creating the WordPress site we will require a database.

1. Login to the MySQL terminal
   ```sh
   mysql -u root -p
   ```

1. From the MySQL terminal, create a database
   ```sql
   create database civicrm;
   exit
   ```

1. Clone this repository
   ```sh
   git clone https://github.com/coloredcow/civicrm.git
   ```

1. Change to project root directory
   ```sh
   cd civicrm
   ```

1. Create the WordPress config file (**specify the correct database credentials**)
   ```sh
   wp config create --dbname=civicrm --dbuser=root --dbpass=
   ```

1. Install WordPress and create admin
   ```sh
   wp core install --url=civicrm.test --title="CiviCRM" --admin_user=admin --admin_password=admin --admin_email=admin@example.com
   ```

1. Create a virtual host
   ```sh
   valet link civicrm
   ```

1. Secure the virtual host
   ```sh
   valet secure civicrm
   ```

#### Setup CiviCRM

1. Activate the plugin
   ```sh
   wp plugin activate civicrm
   ```

2. Go to `https://civicrm.test/wp-admin` and configure CiviCRM.
   1. Check all the Components
   2. And click on `Install CiviCRM`

### Steps (from scratch)

> _You probably don't need to do it. @pokhiii has already done these and pushed it in this repository._
#### WordPress site setup

First we will setup a WordPress site on top of which we will setup CiviCRM. For creating the WordPress site we will require a database.

1. Login to the MySQL terminal
   ```sh
   mysql -u root -p
   ```

1. From the MySQL terminal, create a database
   ```sql
   create database civicrm;
   exit
   ```

1. Make project directory
   ```sh
   mkdir civicrm
   ```

1. Change to the project diretory
   ```sh
   cd civicrm
   ```

1. Download the WordPress core files in the current diretory
   ```sh
   wp core download
   ```

1. Create the WordPress config file (**specify the correct database credentials**)
   ```sh
   wp config create --dbname=civicrm --dbuser=root --dbpass=
   ```

1. Install WordPress and create admin
   ```sh
   wp core install --url=civicrm.test --title="CiviCRM" --admin_user=admin --admin_password=admin --admin_email=admin@example.com
   ```

1. Create a virtual host
   ```sh
   valet link civicrm
   ```

1. Secure the virtual host
   ```sh
   valet secure civicrm
   ```

1. Go to `https://civicrm.test/wp-admin` and login using the admin credentials step 7.

#### Setup CiviCRM

1. In the project directory, run the following command to download the CiviCRM plugin
   ```sh
   wp plugin install https://download.civicrm.org/civicrm-5.73.2-wordpress.zip
   ```

1. Activate the plugin
   ```sh
   wp plugin activate civicrm
   ```

1. Go to `https://civicrm.test/wp-admin` and configure CiviCRM.
   1. Check all the Components
   2. And click on `Install CiviCRM`


## Export and import CiviCRM Setting 

#### Export Instructions

1. Navigate to the project directory in your terminal.
2. Execute the following command to export the current CiviCRM settings: 
   ```
   ./bin/export_civicrm.sh
   ```
2. A new ZIP file will be generated, for example: `wp-content/civi-exports/1717416031-export.zip`.
3. Push the generated ZIP file to GitHub.

#### Import Instructions

1. Pull the latest changes from GitHub.
2. Execute the following command to import the CiviCRM settings: 
   ```
   ./bin/import_civicrm.sh
   ```
3. Go to the CiviCRM settings, choose "Sample page" under "WordPress Base page" and then click the "Update" button.
4. Click on the "Rebuild the CiviCRM menu" link under the "Useful Links" section (also within the CiviCRM settings).
