import './bootstrap';
import 'admin-lte';

 $(document).ready(function() {
    $('#type_handicap_select').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        multiple: true
    });
});

$(document).ready(function() {
    $('#services_select').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        multiple: true
    });
});



