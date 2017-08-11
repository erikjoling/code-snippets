/** 
 * Simple Web Modal
 * - version   1.0.0
 * - author    Erik Joling <erik@ejoweb.nl>
 * - license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * 
 * Usage:
 * - Add `.modal` classname and `hidden` attribute to an element
 * - Style `.modal` and `.modal-inner` to your liking
 *
 * Example: 
 *   <section class="modal" hidden><p>This is a modal</p></section>
 * 
 * Accessibility:
 * - Seamless keyboard tab-flow 
 * - Screenreader support (untested)
 * - ESC to close modal
 * 
 * Other Features:
 * - Keep user input when closing and reopening the modal
 * - Lightweight and flexible (*sigh* ... don't we all claim that?)
 * 
 * Restrictions:
 * - Currently only one modal is supported on a page
 */ 

/* Keep track of last focussed element */
var lastFocus;

/* List all tabbable elements */
var tabElements = 'select, input, textarea, button, a, [tabindex]';

// Ready when you are
jQuery(document).ready(function($) {

    // Get the modal
    var $modal = $('.modal');

    // Add close button
    $modal.append('<button class="close" aria-label="close"></button>');

    // Create modal-inner
    $modal.wrapInner('<div class="modal-inner"></div>');

    /**
     * CLOSE MODAL
     * 1. On click on close button
     * 2. On click on the Modal Container (thus outside of modal)
     * 3. On pushing the ESC key
     */

    /* 1. Close on click on close button */
    $modal.on('click', '[aria-label=close]', function(){
        closeModal($modal);
    });

    /* 2. Close on click on the Modal (not on inner of modal) */
    $modal.on('click', function(event) {   
        if ( $(event.target).hasClass('modal') ) {
            closeModal($modal);
        }
    });

    /* 3. Close on pushing the ESC key */
    $(document).on('keydown', function (e) {

        if ((e.which === 27) && $modal.is(':visible')) {
            e.preventDefault();
            closeModal($modal);
        }
    });
});

// Show the *** Modal!
function showModal($modal) {

    // Fix horizontal flickering due to body scrollbar
    var scrollBarWidth = window.innerWidth - document.body.offsetWidth;
    jQuery('body')
        .css('margin-right', scrollBarWidth)
        .addClass('showing-modal');

    // Show Modal
    $modal.fadeIn(150, 'linear');
    $modal.removeAttr('hidden');

    // Set the tabbing and focus on modal
    setModalTabbing($modal);
}

// Close the ***
function closeModal($modal) {
    
    // Place focus on the saved element
    lastFocus.focus(); 

    // Hide modal
    $modal.fadeOut(300, 'linear', function(){
        jQuery('body')
            .css('margin-right', '')
            .removeClass('showing-modal');
    
        $modal.attr('hidden', 'true');
    });

}

// Set the tabbing and focus on modal
function setModalTabbing($modal) {

    // Store last focussed element
    lastFocus = document.activeElement;

    /* Get all tabbable elements */
    var $inputs = $modal.find(tabElements).filter(function(){

        // Tabbable elements are visible and don't have negative tabindex (maybe != null ??)
        return ( jQuery(this).is(':visible') || jQuery(this).attr('tabindex') != "-1" )
    });

    var $firstInput = $inputs.first();
    var $lastInput = $inputs.last();

    /* set focus on first input */
    $firstInput.focus();

    /* Set window to the top of the modal */
    $modal.scrollTop(0);

    /* redirect last tab to first input */
    $lastInput.on('keydown', function (e) {
       if ((e.which === 9 && !e.shiftKey)) {
           e.preventDefault();
           $firstInput.focus();
       }
    });

    /* redirect first shift+tab to last input */
    $firstInput.on('keydown', function (e) {
        if ((e.which === 9 && e.shiftKey)) {
            e.preventDefault();
            $lastInput.focus();
        }
    });
}
