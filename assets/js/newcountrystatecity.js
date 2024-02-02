jQuery(function () {

    countrydata();

    jQuery(".countries").on("change", function (ev) {
        var countryId = jQuery("option:selected", this).attr('countryid');
        if (countryId != '') {
            getStates(countryId);
        }
        else {
            jQuery(".states option:gt(0)").remove();
        }
    });

    jQuery(".states").on("change", function (ev) {
        var stateId = jQuery("option:selected", this).attr('stateid');
        if (stateId != '') {
            getCities(stateId);
        }
        else {
            jQuery(".cities option:gt(0)").remove();
        }
    });

});

function countrydata() {
    var selected = $('.countries option:selected').val();
    // alert(selected);
    $.ajax({
        method: "POST",
        url: 'getCountryData',
        data: {
            table: 'countries',
            selected: selected,
        },
        success: function (data) {
            $('.countries').html(data);
            var countryId = $('.countries option:selected').attr('countryid');
            getStates(countryId);
        },
    });
}

function getStates(countryId) {
    var selected = $('.states option:selected').val();
    $.ajax({
        method: "POST",
        url: 'getStatesData',
        data: {
            table: 'states',
            countryId: countryId,
            selected: selected,
        },
        success: function (data) {
            $('.states').html(data);
            var stateId = $('.states option:selected').attr('stateid');
            getCities(stateId);
        },
    });
}

function getCities(stateId) {
    var selected = $('.cities option:selected').val();
    $.ajax({
        method: "POST",
        url: 'getCitiesData',
        data: {
            table: 'cities',
            stateId: stateId,
            selected: selected,
        },
        success: function (data) {
            $('.cities').html(data);
        },
    });
}


