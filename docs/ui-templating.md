# UI Templating

CiviCRM default templates can be customized by editing the files inside `civicrm-templates/CRM` directory that is present in the theme's folder.

To know more about how CiviCRM handles the template customization, read the [official guide](https://docs.civicrm.org/sysadmin/en/latest/setup/directories/#custom-templates).

NOTE: Ensure that the `civicrm-templates/` directory path is added properly from CiviCRM settings dashboard. The page can be found at: WP Admin > CiviCRM > Administer > System Settings > Directories


### Template Engine
CiviCRM uses [Smarty Template Engine](https://www.smarty.net/) for handling the template files and the dynamic data. This boosts the development speed through easier syntax. Please ensure that you go understand the basics of this engine and standard syntaxing.

You can also install [VSCode Smarty Template Support](https://marketplace.visualstudio.com/items?itemName=aswinkumar863.smarty-template-support) extension for better syntax highlighting on your editor.
