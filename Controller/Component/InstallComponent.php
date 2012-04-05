<?php
class InstallComponent extends Component {
    public function beforeInstall() {
        return true;
    }

    public function afterInstall() {
        // Create categories table
        $this->Installer->sql("
            CREATE TABLE IF NOT EXISTS `#__qc_categories` (
              `id` int(10) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Category name',
              `recipients` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Comma-separated list of recipient e-mail addresses.',
              `reply` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Text of the auto-reply message.',
              `selected` tinyint(4) NOT NULL COMMENT 'Flag to indicate whether or not category is selected by default. (1 = Yes, 0 = No)',
              `ordering` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;        
        ");

        // Add link in Navigation menu
        $this->Installer->menuLink(
            array(
            'title' => 'Contact',
            'url' => '/contact',
            'status' => 0
            ), 2);

        // Fix for outdated QACMS versions (https://github.com/QuickAppsCMS/QuickApps-CMS/commit/7b7bc196010b6e8cad2095bff35b177050a38914)
        ClassRegistry::init('Menu.MenuLink')->create();

        // Add link in Structure menu
        $this->Installer->menuLink(
            array(
                'title' => 'Contact form',
                'description' => 'Create a system contact form and set up categories for the form to use.',
                'url' => '/admin/quick_contact/contact/categories',
                'parent' => 2
            )
        );

        return true;
    }

    public function beforeUninstall() {
        return true;
    }

    public function afterUninstall() {
        // Remove DB table:
        $this->Installer->sql("DROP TABLE `#__qc_categories`;");

        // Remove link added in menus:
        /**
         * All links created by modules are automatically
         * deleted by QuickApps CMS on uninstallation,
         * so we have nothing to do here.
         */

        return true;
    }
}