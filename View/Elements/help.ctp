<h3>About</h3>
<p>
    The Contact module allows visitors to contact site administrators and other users.
    Users specify a subject, write their message, and can have a copy of their message sent to their own e-mail address.
</p>

<h3>Uses</h3>
<dl>
    <dt>Site contact form</dt>
    <dd>
        The <?php echo $this->Html->link('Contact page', '/contact'); ?> provides a simple form for users with the 
        <em>Use the site contact form</em> permission to send comments, feedback, or other requests.
        You can create categories for directing the contact form messages to a set of defined recipients.
        Common categories for a business site, for example, might include "Website feedback" 
        (messages are forwarded to website administrators) and "Product information" 
        (messages are forwarded to members of the sales department). E-mail addresses defined within a category
        are not displayed publicly.
    </dd>
    
    <dt>Navigation</dt>
    <dd>
        When Contact module is installed,
        a link in the main <em>Navigation</em> menu is created, but the link is disabled by default.
        This menu link can be enabled on the <?php echo $this->Html->link('Menus administration page', '/admin/menu/manage'); ?>.
    </dd>

    <dt>Customization</dt>
    <dd>
        If you would like additional text to appear on the site contact page, use a block.
        You can create and edit blocks on the <?php echo $this->Html->link('Blocks administration page', '/admin/block/manage'); ?>.
    </dd>
</dl>

<h3>Contact administration pages</h3>
<?php
    echo $this->Html->nestedList(
        array(
            $this->Html->link('Contact form categories', '/admin/quick_contact/contact/categories'),
            $this->Html->link('Configure Contact permissions', '/admin/user/permissions')
        )
    );
?>