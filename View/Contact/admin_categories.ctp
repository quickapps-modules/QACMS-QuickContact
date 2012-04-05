<p><?php echo $this->Html->link('Add category', '/admin/quick_contact/contact/category_add'); ?></p>
<?php
    $table = array(
        'columns' => array(
            __d('quick_contact', 'Category') => array('value' => '{ContactCategory.name}'),
            __d('quick_contact', 'Recipients') => array('value' => '{php} return String::truncate("{ContactCategory.recipients}", 70); {/php}'),
            __d('quick_contact', 'Selected') => array('value' => '{php} return ("{ContactCategory.selected}" == "1") ? "' . __d('quick_contact', 'Yes') . '" : "' . __d('quick_contact', 'No') . '"; {/php}'),
            __d('quick_contact', 'Operations') => array(
                'value' => "
                    {link}" . __d('quick_contact', 'edit') . "|/admin/quick_contact/contact/category_edit/{ContactCategory.id}{/link} |
                    {link onclick='return confirm(\"" . __d('quick_contact', 'This action cannot be undone.') . "\");'}" . __d('quick_contact', 'delete') . "|/admin/quick_contact/contact/category_delete/{ContactCategory.id}{/link}
                "
            )
        ),
        'paginate' => false,
        'noItemsMessage' => __d('quick_contact', 'No categories available.'),
        'headerPosition' => 'top',
        'tableOptions' => array('width' => '100%')
    );

    echo $this->Html->table($results, $table);