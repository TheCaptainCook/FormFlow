3. Protecting paid logic from unauthorized use

If your plugin has multiple plans offering different features, you can protect these features using is_plan():

<?php
    if ( for_fsrealfree()->can_use_premium_code__premium_only() ) {
        if ( for_fsrealfree()->is_plan( 'pro' ) ) {

            // ... logic related to the 'pro' plan and higher ...

        }

        if ( for_fsrealfree()->is_plan( 'business' ) ) {

            // ... logic related to the 'business' plan and higher ...

        }
    }
?>


4. Adding contextual marketing and upsells
One effective technique to educate users about your paid features and increase conversion rates is to include contextual upsells. For example, you can add a setting for a paid feature (without implementing it), label it "Pro", and when the user interacts with it, inform them that it's a paid option and encourage them to upgrade.

To add logic that will execute only in the free codebase:

    echo '<label><input type="checkbox" name="pro-feature-1" />Pro Feature 1';
    if ( ! for_fsrealfree()->is_premium() ) {
        // Adds a direct checkout link in the free version.
        echo sprintf( '<a href="%s"><small>Unlock Pro</small></a>', for_fsrealfree()->checkout_url() );
    }
    echo '</label>';

To add logic that will execute only for non-paying users, even when running from the premium codebase:

<?php
    if ( for_fsrealfree()->is_not_paying() ) {
        // Adds a marketing sections with a link to in-dashboard pricing page.
        echo '<section><h1>Awesome Features</h1>';
        echo sprintf( '<a href="%s">Upgrade Now!</a>', for_fsrealfree()->get_upgrade_url() );
        echo '</section>';
    }
?>

5. Excluding premium-only CSS & JS from the free version

You can exclude premium-only code from *.css and *.js files by wrapping the relevant code with the following meta comments:

(function($){
    /* <fs_premium_only> */

    // ... my premium only code ...

    /* </fs_premium_only> */
})(jQuery);

7. WordPress.org Compliance

According to WordPress.org guidelines, all code hosted on WordPress.org must be free and fully functional. Code with paid features cannot be served from WordPress.org.

Therefore, to deploy your free plugin's version to WordPress.org, ensure you wrap all premium code with if ( for_fsrealfree()->is__premium_only() ) or the other methods  provided to exclude premium features and files from the free version.