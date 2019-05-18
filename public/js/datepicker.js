$('.datepicker').pickadate({
    monthsFull: [ 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' ],
    weekdaysShort: ['zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'],
    weekdaysFull: [ 'zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag' ],
    monthsShort: [ 'jan', 'feb', 'maart', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec' ],
    selectYears: 90,
    max: -6574,
    firstDay: 1,
    today: 'vandaag',
    clear: 'wis',
    close: 'sluiten',
    format: 'dddd d mmmm yyyy',
    formatSubmit: 'yyyy/mm/dd'
});