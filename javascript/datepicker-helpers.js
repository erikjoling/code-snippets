'use strict';

/**
 * Make monthChangers tabbable 
 * - at init 
 * - the change of a month
 */
var makeDatepickerAccessible = function(datepicker) {

    makeMonthChangersTabbable();
    datepicker.addEventListener( 'click', function(event) {

        if ( isMonthChanger(event.target) ) {
            makeMonthChangersTabbable();
            setFocusOnMonthChangeTab(event.target);
        }

    }, false);
}

var makeMonthChangersTabbable = function() {

    var monthChangers = document.querySelectorAll('.ui-datepicker-header a[data-event=click]');

    if (monthChangers === undefined)
        return;

    for ( var i = 0; i < monthChangers.length; i++ ) {
        monthChangers[i].setAttribute( 'href', '#');
        monthChangers[i].addEventListener( 'click', function(event) {
            event.preventDefault();
        });
    }
}

var setFocusOnMonthChangeTab = function( elem ) {
    var prevMonthChanger = document.querySelector('.ui-datepicker-header .ui-datepicker-prev');
    var nextMonthChanger = document.querySelector('.ui-datepicker-header .ui-datepicker-next');

    // If one of both isn't available, select the other
    if (prevMonthChanger.classList.contains('ui-state-disabled')) {
        nextMonthChanger.focus();
        return;
    }
    
    if (nextMonthChanger.classList.contains('ui-state-disabled')) {
        prevMonthChanger.focus();
        return;
    }

    // If both are available, focus on the selected monthchanger
    if (prevMonthChanger.title == elem.title) {
        prevMonthChanger.focus();
        return;
    }

    if (nextMonthChanger.title == elem.title) {
        nextMonthChanger.focus();
        return;
    }
}

/**
 * Helper to check if link is monthChanger
 */
var isMonthChanger = function( elem ) {
    
    return ( elem.parentNode.classList.contains('ui-datepicker-header') && elem.tagName == 'A' && ! elem.classList.contains('ui-state-disabled') );
}

/**
 * Disable the refresh when selecting a date in the datepicker [jQuery]
 *
 * @param datepicker instance
 */
var disableRefreshOnSelect = function(inst) {

    // Prevent refresh on select
    inst.inline = false;

    // Reset the current current-day
    jQuery(".ui-datepicker-calendar .ui-datepicker-current-day").removeClass("ui-datepicker-current-day").children().removeClass("ui-state-active");

    // Set the new current-day
    jQuery(document.activeElement).addClass("ui-state-active");
    jQuery(document.activeElement).parent().addClass("ui-datepicker-current-day");
    
}