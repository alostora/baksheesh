<script>
    function getCompenies(client_id) {

        if (client_id) {

            $.ajax({

                url: '{{url("api/client-list-companies")}}/' + client_id + '?perpage=1000',
                type: 'GET',
                data: {},
                dataType: 'json',
                success: function(response) {

                    let result = response.data;

                    console.log(result)

                    $("#company_id").html(`<option value=''>@lang('filter.select')</option>`)

                    for (let i = 0; i < result.length; i++) {

                        $("#company_id").append(`<option value='${result[i].id}'>${result[i].name}</option>`);
                        console.log(result[i]);
                    }

                },
                error: function(request, error) {
                    console.log("Request: " + JSON.stringify(request));
                }
            });
        } else {}
    }

    function getCompenyEmployees(company_id) {

        if (company_id) {

            $.ajax({

                url: '{{url("api/company-list-employees")}}?company_id=' + company_id + '&perpage=1000',
                type: 'GET',
                data: {},
                dataType: 'json',
                success: function(response) {

                    let result = response.data;

                    console.log(result)

                    $("#employee_id").html(`<option value=''>@lang('filter.select')</option>`)

                    for (let i = 0; i < result.length; i++) {

                        $("#employee_id").append(`<option value='${result[i].id}'>${result[i].name}</option>`);
                        console.log(result[i]);
                    }

                },
                error: function(request, error) {
                    console.log("Request: " + JSON.stringify(request));
                }
            });
        } else {}
    }
</script>
