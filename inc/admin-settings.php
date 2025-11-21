<?php
/**
 * Theme Settings - admin page with tabs
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add Theme Settings under Appearance
function Nemove_add_theme_settings_page() {
    add_theme_page(
        __( 'تنظیمات قالب', 'Nemove' ),
        __( 'تنظیمات قالب', 'Nemove' ),
        'manage_options',
        'Nemove-settings',
        'Nemove_render_settings_page'
    );
}
add_action( 'admin_menu', 'Nemove_add_theme_settings_page' );

// Register settings and fields (single Festival Header tab)
function Nemove_register_settings() {
    register_setting( 'Nemove_settings', 'Nemove_options', 'Nemove_sanitize_options' );

    // Festival Header tab (single)
    add_settings_section( 'Nemove_section_festival', __( 'تنظیم جشنواره هدر', 'Nemove' ), '__return_false', 'Nemove_settings_festival' );

    // Updated fields per user request: header text, CTA text, CTA value (link or code)
    add_settings_field( 'header_text', __( 'متن', 'Nemove' ), 'Nemove_field_text', 'Nemove_settings_festival', 'Nemove_section_festival', array( 'key' => 'header_text' ) );
    add_settings_field( 'cta_text', __( 'متن call to action', 'Nemove' ), 'Nemove_field_text', 'Nemove_settings_festival', 'Nemove_section_festival', array( 'key' => 'cta_text' ) );
    add_settings_field( 'cta_value', __( 'مقدار call to action (لینک یا کد تخفیف)', 'Nemove' ), 'Nemove_field_text', 'Nemove_settings_festival', 'Nemove_section_festival', array( 'key' => 'cta_value' ) );
}
add_action( 'admin_init', 'Nemove_register_settings' );

// Sanitize all options
function Nemove_sanitize_options( $input ) {
    $out = array();
    // sanitize header text
    if ( isset( $input['header_text'] ) ) {
        $out['header_text'] = sanitize_text_field( $input['header_text'] );
    }

    // sanitize cta text
    if ( isset( $input['cta_text'] ) ) {
        $out['cta_text'] = sanitize_text_field( $input['cta_text'] );
    }

    // sanitize cta value: if it's a valid URL store as URL, otherwise store as plain text (e.g., discount code)
    if ( isset( $input['cta_value'] ) ) {
        $raw = trim( $input['cta_value'] );
        if ( filter_var( $raw, FILTER_VALIDATE_URL ) ) {
            $out['cta_value'] = esc_url_raw( $raw );
        } else {
            $out['cta_value'] = sanitize_text_field( $raw );
        }
    }
    return $out;
}

// Field callbacks
function Nemove_field_text( $args ) {
    $opts = get_option( 'Nemove_options', array() );
    $key  = $args['key'];
    $val  = isset( $opts[ $key ] ) ? esc_attr( $opts[ $key ] ) : '';
    printf( '<input type="text" name="Nemove_options[%1$s]" value="%2$s" class="regular-text" />', esc_attr( $key ), $val );
}

function Nemove_field_textarea( $args ) {
    $opts = get_option( 'Nemove_options', array() );
    $key  = $args['key'];
    $val  = isset( $opts[ $key ] ) ? esc_textarea( $opts[ $key ] ) : '';
    printf( '<textarea name="Nemove_options[%1$s]" rows="4" cols="50" class="large-text">%2$s</textarea>', esc_attr( $key ), $val );
}

function Nemove_field_color( $args ) {
    $opts = get_option( 'Nemove_options', array() );
    $key  = $args['key'];
    $val  = isset( $opts[ $key ] ) ? esc_attr( $opts[ $key ] ) : '#0073aa';
    printf( '<input type="text" name="Nemove_options[%1$s]" value="%2$s" class="pharmacy-color-field" data-default-color="#0073aa" />', esc_attr( $key ), $val );
}

function Nemove_field_checkbox( $args ) {
    $opts = get_option( 'Nemove_options', array() );
    $key  = $args['key'];
    $val  = ! empty( $opts[ $key ] ) ? $opts[ $key ] : '';
    printf( '<label><input type="checkbox" name="Nemove_options[%1$s]" value="1" %2$s /> %3$s</label>', esc_attr( $key ), checked( 1, $val, false ), '' );
}

function Nemove_field_media( $args ) {
    $opts = get_option( 'Nemove_options', array() );
    $key  = $args['key'];
    $val  = isset( $opts[ $key ] ) ? esc_attr( $opts[ $key ] ) : '';
    ?>
    <div class="pharmacy-media-control">
        <input type="text" name="Nemove_options[<?php echo esc_attr( $key ); ?>]" value="<?php echo $val; ?>" class="regular-text pharmacy-media-url" />
        <button type="button" class="button pharmacy-media-button" data-target="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'انتخاب تصویر', 'Nemove' ); ?></button>
        <button type="button" class="button pharmacy-media-remove" data-target="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'حذف', 'Nemove' ); ?></button>
    </div>
    <?php
}

function Nemove_field_date( $args ) {
    $opts = get_option( 'Nemove_options', array() );
    $key  = $args['key'];
    $val  = isset( $opts[ $key ] ) ? esc_attr( $opts[ $key ] ) : '';
    printf( '<input type="date" name="Nemove_options[%1$s]" value="%2$s" />', esc_attr( $key ), $val );
}

// Render the settings page with tabs
function Nemove_render_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $tabs = array(
        'festival' => __( 'تنظیم جشنواره هدر', 'Nemove' ),
    );

    $current_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'festival';
    if ( ! array_key_exists( $current_tab, $tabs ) ) {
        $current_tab = 'festival';
    }

    // Enqueue WP color picker and media uploader for fields
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_media();
    // enqueue simple admin css from theme assets (file may be missing, but safe)
    wp_enqueue_style( 'Nemove-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), Nemove_VERSION );

    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Theme Settings', 'Nemove' ); ?></h1>

        <h2 class="nav-tab-wrapper">
            <?php foreach ( $tabs as $slug => $label ) :
                $class = ( $slug === $current_tab ) ? ' nav-tab-active' : '';
                $url   = add_query_arg( array( 'page' => 'Nemove-settings', 'tab' => $slug ), admin_url( 'themes.php' ) );
                ?>
                <a class="nav-tab<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a>
            <?php endforeach; ?>
        </h2>

        <form method="post" action="options.php">
            <?php settings_fields( 'Nemove_settings' ); ?>
            <div class="pharmacy-settings-panel">
                <?php
                // Render only the section associated with current tab (festival)
                do_settings_sections( 'Nemove_settings_' . $current_tab );
                submit_button();
                ?>
            </div>
        </form>
    </div>

    <script>
    (function($){
        $(function(){
            if ( $('.pharmacy-color-field').length ) {
                $('.pharmacy-color-field').wpColorPicker();
            }

            // Media uploader
            var frame;
            $(document).on('click', '.pharmacy-media-button', function(e){
                e.preventDefault();
                var $btn = $(this);
                var target = $btn.data('target');

                if ( frame ) { frame.open(); return; }
                frame = wp.media({
                    title: '<?php echo esc_js( __( 'Select or Upload Banner Image', 'Nemove' ) ); ?>',
                    button: { text: '<?php echo esc_js( __( 'Use this image', 'Nemove' ) ); ?>' },
                    multiple: false
                });

                frame.on('select', function(){
                    var attachment = frame.state().get('selection').first().toJSON();
                    $('input[name="Nemove_options['+target+']"]').val(attachment.url);
                });

                frame.open();
            });

            // Remove media
            $(document).on('click', '.pharmacy-media-remove', function(e){
                e.preventDefault();
                var target = $(this).data('target');
                $('input[name="Nemove_options['+target+']"]').val('');
            });
        });
    })(jQuery);
    </script>

    <?php
}

?>
