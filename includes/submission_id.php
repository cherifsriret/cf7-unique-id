<?php
/**
 * Function add submission id field in wpcf7
 * @version 1.0
**/

function cf7_submission_id_uid_form_tag_handler ($tag){
    if ( empty( $tag->name ) ) {
        return '';
    }
   
    $atts = array();

    $atts['class'] = "";
    $atts['id'] = $tag->get_id_option();
    $atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );
    $atts['readonly'] = 'readonly';

    if ( $tag->is_required() ) {
        $atts['aria-required'] = 'true';
    }

    $value = (string) reset( $tag->values );

	$value = apply_filters( 'cf7_submission_id_filter',  date("Y-m-d").'-'.uniqid());

    $atts['value'] = $value;

    $atts['name'] = $tag->name;

    $atts['type'] = 'hidden';

    $atts = wpcf7_format_atts( $atts );

    $html = sprintf(
        '<input %2$s />',
        sanitize_html_class( $tag->name ), $atts );

    return $html;
}


function cf7_submission_id_tag_uid_field( $contact_form, $args = '' ) {
    $args = wp_parse_args( $args, array() );
    $type = 'submission_id';

    $description = __( "Generate a form-tag for a hidden field where the submisison id will be stored.", 'cf7-mollie' );
?>
<div class="control-box">
<fieldset>
<legend><?php echo esc_html( $description ); ?></legend>

<table class="form-table">
<tbody>
    <tr>
    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label></th>
    <td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
    </tr>

</tbody>
</table>
</fieldset>
</div>

<div class="insert-box">
    <input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />

    <div class="submitbox">
    <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
    </div>

    <br class="clear" />

    <p class="description mail-tag"><label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'contact-form-7' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" /></label></p>
</div>
<?php
}