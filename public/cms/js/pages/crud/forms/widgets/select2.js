// Class definition
var KTSelect2 = function() {
    // Private functions
    var demos = function() {
        // basic
        $('#kt_select2_1, #kt_select2_1_validate').select2({
            placeholder: "Select a state"
        });

        // nested
        $('#kt_select2_2, #kt_select2_2_validate').select2({
            placeholder: "Select a state"
        });

        // multi select
        $('#kt_select2_3, #kt_select2_3_validate').select2({
            placeholder: "Select a state",
        });

        // basic
        $('#kt_select2_4').select2({
            placeholder: "Select a state",
            allowClear: true
        });

        // loading data from array
        var data = [{
            id: 0,
            text: 'Enhancement'
        }, {
            id: 1,
            text: 'Bug'
        }, {
            id: 2,
            text: 'Duplicate'
        }, {
            id: 3,
            text: 'Invalid'
        }, {
            id: 4,
            text: 'Wontfix'
        }];

        $('#kt_select2_5').select2({
            placeholder: "Select a value",
            data: data
        });

        // loading remote data

        function formatRepo(repo) {
            if (repo.loading) return repo.text;
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.email + "</div>";
            if (repo.name) {
                markup += "<div class='select2-result-repository__description'>" + repo.name + "</div>";
            }
            if (repo.surname) {
                markup += "<div class='select2-result-repository__description'>" + repo.surname + "</div>";
            }
            markup += "</div></div>";
            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.email || repo.text;
        }

        function formatTag(repo) {
            console.log(repo);
            if (repo.loading) return null; //repo.text;
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + (repo.tag || repo.text) + "</div>";
            markup += "</div></div>";
            return markup;
        }

        function formatTagSelection(repo) {
            return repo.tag || repo.text;
        }

function selectyap(nerede) {
    nerede.find(".email-select").select2({
        placeholder: "Email Adress",
        allowClear: true,
        ajax: {
            url: "/user/get_user_mail",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: 1
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.items.map(a => ({id: a.email, email: a.email, name: a.name, surname: a.surname, utitle: a.utitle}))
                        .filter(a => $(".email-select").toArray().map(a => a.value).indexOf(a.email) == -1),
                    pagination: {
                        more: false,
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 3,
        templateResult: formatRepo, // omitted for brevity, see the source of this page
        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    })
        .on('select2:select', function (e) {
            if (e.params.data.name || e.params.data.surname) {
                $(this).parents('tr').find('.name').attr('disabled', true);
                $(this).parents('tr').find('.surname').attr('disabled', true);
                $(this).parents('tr').find('.name').val(e.params.data.name);
                $(this).parents('tr').find('.surname').val(e.params.data.surname);
            } else {
                $(this).parents('tr').find('.name').attr('disabled', false);
                $(this).parents('tr').find('.surname').attr('disabled', false);
            }
        });

        nerede.find('.keyword-select').select2({
            tags: true,
            tokenSeparators: [',', ' '],
            placeholder: "Keywords...",
            ajax: {
                url: "/user/get_tags",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: 1
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    console.log(data.items);
                    return {
                        results: data.items.map(a => ({ id: a.tag, tag: a.tag })),
                        pagination: {
                            more: false,
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatTag, // omitted for brevity, see the source of this page
            templateSelection: formatTagSelection // omitted for brevity, see the source of this page
        });
}
selectyap($("body"));


        $(".ekleme").on('click', function(e) {
            e.preventDefault();
            var num = $(".tablo tbody tr").length + 1;
            var degeer = `

                                                                                        <tr>
                                                                                            <td>Author ${num}</td>
                                                                                            <td>

                                                                                                <div class="row">
                                                                                                    <select class="col-md-12 form-control
                                                                                                        kt-select2
                                                                                                        email-select" name="a_email[${num}]">
                                                                                                        <option></option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </td>

                                                                                            <td><input class="form-control col-md-12 col-xs-12
                                                                                            error name"
                                                                                                       name="a_name[${num}]" type="text"
                                                                                                       value="" aria-invalid="true" required></td>

                                                                                            <td><input class="form-control col-md-12 col-xs-12
                                                                                            error surname"
                                                                                                       name="a_surname[${num}]" type="text"
                                                                                                       value="" aria-invalid="true" required></td>

                                                                                            <td>
                                                                                                <label class=" border-success">
                                                                                                    <input type="radio" class="flat"
                                                                                                           name="correspond"
                                                                                                           value="${num}"
                                                                                                           required>
                                                                                                </label>
                                                                                            </td>
                                                                                            <td>
                                                                                                <label class=" border-success">
                                                                                                    <input type="radio" class="flat"
                                                                                                           name="presenter"
                                                                                                           value="${num}"
                                                                                                           required>
                                                                                                </label>

                                                                                            </td>
                                                                                        </tr>
                                                                                        
                                                                                        
            `;
            var yapilideger = $(degeer);
            $(".tablo tbody").append(yapilideger);
            selectyap(yapilideger);
        });

        // custom styles

        // tagging support
        $('#kt_select2_12_1, #kt_select2_12_2, #kt_select2_12_3, #kt_select2_12_4').select2({
            placeholder: "Select an option",
        });

        // disabled mode
        $('#kt_select2_7').select2({
            placeholder: "Select an option"
        });

        // disabled results
        $('#kt_select2_8').select2({
            placeholder: "Select an option"
        });

        // limiting the number of selections
        $('#kt_select2_9').select2({
            placeholder: "Select an option",
            maximumSelectionLength: 2
        });

        // hiding the search box
        $('#kt_select2_10').select2({
            placeholder: "Select an option",
            minimumResultsForSearch: Infinity
        });

        // tagging support
        $('#kt_select2_11').select2({
            placeholder: "Add a tag",
            tags: true
        });

        // disabled results
        $('.kt-select2-general').select2({
            placeholder: "Select an option"
        });
    }

    var modalDemos = function() {
        $('#kt_select2_modal').on('shown.bs.modal', function () {
            // basic
            $('#kt_select2_1_modal').select2({
                placeholder: "Select a state"
            });

            // nested
            $('#kt_select2_2_modal').select2({
                placeholder: "Select a state"
            });

            // multi select
            $('#kt_select2_3_modal').select2({
                placeholder: "Select a state",
            });

            // basic
            $('#kt_select2_4_modal').select2({
                placeholder: "Select a state",
                allowClear: true
            });
        });
    }

    // Public functions
    return {
        init: function() {
            demos();
            modalDemos();
        }
    };
}();

// Initialization
jQuery(document).ready(function() {
    KTSelect2.init();
});