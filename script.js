/**
 * Custom toolbar picker that supports both icon-only and text-only entries.
 * DokuWiki's stock picker treats object entries as toolbar buttons, which do
 * not display their labels when no icon is defined.
 */
function addBtnActionSnips($btn, props, edid) {
    const pickerId = 'snips-picker-' + (window.pickercounter++);
    const $picker = jQuery('<div>')
        .attr('id', pickerId)
        .addClass('picker a11y snips-picker')
        .prop('hidden', true)
        .css('position', 'absolute');

    jQuery.each(props.list || [], function (_, item) {
        const title = String(item.title || '');
        const $choice = jQuery('<button>')
            .attr('type', 'button')
            .attr('title', title)
            .attr('aria-controls', edid)
            .addClass('pickerbutton');

        if (item.icon) {
            let iconUrl = String(item.icon);
            if (iconUrl.charAt(0) !== '/') {
                iconUrl = DOKU_BASE + 'lib/images/toolbar/' + iconUrl;
            }
            jQuery('<img>').attr('src', iconUrl).attr('alt', '').appendTo($choice);
        } else {
            $choice.text(title);
        }

        $choice.on('click', function (event) {
            event.preventDefault();
            if (item.mode === 'wrap') {
                insertTags(edid, fixtxt(item.open || ''), fixtxt(item.close || ''), fixtxt(item.sample || title));
            } else {
                insertAtCarret(edid, fixtxt(item.insert || ''));
            }
            pickerClose();
            return false;
        });

        $picker.append($choice);
    });

    jQuery('body').append($picker);
    $btn.on('click', function (event) {
        event.preventDefault();
        pickerToggle(pickerId, $btn);
        return false;
    });
    return pickerId;
}
