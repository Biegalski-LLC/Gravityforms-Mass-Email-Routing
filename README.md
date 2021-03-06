# Gravity Forms Mass Email Routing
Email routing in gravity forms is great, unless you have hundreds of different routes all based on the value of a specific field. It can take hours manually inputting all of these routes in the gravity forms admin dashboard.

This plugin aids you in mass email routing by checking a database table and sending notifications based on form ID number, field ID number, field value, email address and notification name.

The table can quick and easily be populated in a spreadsheet which can then be imported using popular database management tools such as phpMyAdmin or MySQL Workbench.

Future releases of this plugin will include a more seamless way to integrate this data. I just needed a barebones completely functional plugin that works. Why did I need this? A client has one form; 36,000 email addresses; which email address receives the notification all depended upon the value of the franchise ID field.

## Installation
1. Upload the `gravityforms-email-routing` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Import email routes with a database management tool such as phpMyAdmin or MySQL Workbench into the `{wp/prefix}_rg_email_routing` table.
4. Edit the form you plan on mass email routing and go to the `Gravity Forms Settings` and change the `Send To` to `Configure Routing` and input a dummy email address. This dummy address will be replaced at runtime.

## Importing Data
When importing the data into the table, all columns are required for proper routing. For each entry, you will need to define the form ID number, field ID number, field value, email address and which notification to send.

## Known Bugs
#### One Specific Field & Notification Per Form
The current verion (v0.0.1) will only route emails properly when one specific field and one specific notification is targeted per form. Multiple email addresses can be assigned to this field/notification combo though.

**Example:**
```
Database Entries
[1]
> form_id = 1
> field_id = 1.3
> field_value = John
> email_address = john.a@domain.com
> notification_name = Admin Notification
 
[2]
> form_id = 1
> field_id = 1.3
> field_value = Leroy
> email_address = leroy@domain.com
> notification_name = Admin Notification
 
[2]
> form_id = 1
> field_id = 1.3
> field_value = John
> email_address = john.b@domain.com
> notification_name = Admin Notification
```


In the above example, we are targeting Form ID #1 and Field #1.3 which we'll say is the First Name field. If the form submission first name is John, the *admin notification* will be sent to *john.a@domain.com* and *john.b@domain.com*. If the form submission first name is Leroy, the *admin notification* will only be sent to *leroy@domain.com*.
 
 I plan on implementing the ability to send out multiple notifications based on multiple fields in the future.
 
## Authors
 * Mike Biegalski - [Biegalski LLC](https://biegal.ski)
 
Happily accepting contributors and/or forks.
 
## License
This project is licensed under the GNU General Public License, version 2
 
## Acknowledgments
 * WordPress Plugin Boilerplate Generator - [wppb.me](http://wppb.me/)