/* Matches polyfill */
if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector || 
                                Element.prototype.webkitMatchesSelector;
}

/* Closest polyfill (uses matches) */
if (!Element.prototype.closest) {
    Element.prototype.closest = function(s) {
        var el = this;
        var ancestor = this;
        if (!document.documentElement.contains(el)) return null;
        do {
            if (ancestor.matches(s)) return ancestor;
            ancestor = ancestor.parentElement;
        } while (ancestor !== null); 
        return null;
    };
}
