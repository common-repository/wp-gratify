 var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType;

    /*
     * Gutenberg block for archive review card.
     *
    */ 
    registerBlockType( 'wpgrvgutenberg/wpgrvreviewarchivecard', {
        title: 'Gratify Review Archive Card',
        icon: 'id',
        category: 'common',
        edit: function( props ) {
            return el( 'p', { className: props.className }, 'Review Card' );
        },
        save: function() {
            return el( 'p', {}, '[wp_grv_review_card]' );
        }
    } );
    /*
     * Gutenberg block for review intake form.
     *
    */ 
    registerBlockType( 'wpgrvgutenberg/wpgrvreviewintakeform', {
        title: 'Gratify Review Intake Form',
        icon: 'feedback',
        category: 'common',
        edit: function( props ) {
            return el( 'p', { className: props.className }, 'Review Intake Form' );
        },
        save: function() {
            return el( 'p', {}, '[wp_grv_review_intake_form]' );
        }
    } );