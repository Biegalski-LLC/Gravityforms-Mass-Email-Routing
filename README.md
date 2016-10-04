# Gravity Forms Mass Email Routing
Email routing in gravity forms is great, unless you have hundreds of different routes all based on the value of a specific field. This plugin will hopefully solve this issue by checking a database table and sending notifications based on form ID number, field ID number, field value, email address and notification name.

This table can quick and easily be populated in a spreadsheet which can then be imported using popular database management tools such as phpMyAdmin or MySQL Workbench.

Future releases of this plugin will include a more seamless way to integrate this data. I just needed a barebones functional plugin that works.

## Installation
1. Upload the `gravityforms-email-routing` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Import email routes with a database management tool such as phpMyAdmin or MySQL Workbench.

## Importing Data
When importing the data into the table, all columns are required for proper routing. For each entry, you will need to define the form ID number, field ID number, field value, email address and which notifications to send.