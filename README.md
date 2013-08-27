Quick Contact
=============

[![QuickApps CMS](https://raw.github.com/QuickAppsCMS/QuickApps-CMS-Docs/1.x/img/logo.png)](http://www.quickappscms.org)

The QuickContact module allows visitors to contact site administrators and other users.  
Users specify a subject, write their message, and can have a copy of their message sent to their own e-mail address.

***

Usage
-----

##### User contact forms

Site users can be contacted with a user contact form that keeps their e-mail address private.
Users may enable or disable their personal contact forms by editing their `My account page`.
If enabled, a Contact tab leads to a personal contact form displayed on their user profile.
Site administrators are still able to use the contact form, even if has been disabled.
The Contact tab is not shown when you view your own profile.


##### Site-wide contact forms

The `Contact page` provides a simple form for users with the `Use the site contact` form permission to send comments, feedback, or other requests.
You can create categories for directing the contact form messages to a set of defined recipients.
Common categories for a business site, for example, might include "Website feedback" (messages are forwarded to website administrators)
and "Product information" (messages are forwarded to members of the sales department). E-mail addresses defined within a category
are not displayed publicly.


##### Navigation

When Contact module is installed, a link in the main Navigation menu is created, but the link is disabled by default.
This menu link can be enabled on the `Menus administration page`.


##### Customization using Hooktags

If you would like additional text to appear on the site contact page, you can place the form as part of any
content-type by using two special hooktags:

    [site_contact_form /]
    [user_contact_form user=USER/]

Where USER must be a valid user's ID (numeric, eg. 3), or user's username (string, e.g "peter_70")