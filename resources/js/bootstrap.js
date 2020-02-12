import $ from "jquery";
import Swal from "sweetalert2";

window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


try {
    
    require('select2');

    $('.districts').select2({
        width: "100%"
    });

    // changeSchool();
    // $('.districts').change(function () {
    //     changeSchool();
    // })

} catch (e) {
    console.log(e)
}

// function changeSchool() {
//     let baseURL = $('#baseUrl').data('url');
//     let distId = $('.districts option:selected').attr('value');
//     $('.school').children('option').remove();

//     $('#school').select2({
//         placeholder: 'Select Schools',
//         width: '100%',
//         delay: 500,
//         ajax: {
//             url: `${baseURL}/api/schools/${distId}`,
//             dataType: 'json',
//             processResults: function (data) {
//                 return{
//                     results: data.data
//                 };
//             }
//         }
//     });
// }
