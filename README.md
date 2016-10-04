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

## Known Bugs
##### One Specific Field & Notification Per Form
The current verion (v0.0.1) will only route emails properly when one specific field on each form is targeted. Multiple email addresses can be assigned to this field.

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