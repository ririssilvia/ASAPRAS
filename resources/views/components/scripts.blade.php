<!-- resources/views/includes/scripts.blade.php -->
<!--bootstrap js-->
<script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>

<!--plugins-->

<script src="{{ url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ url('assets/plugins/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ url('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ url('assets/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ url('assets/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
<script src="{{ url('assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
<script src="{{ url('assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
<script src="{{ url('assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
{{-- <script src="{{ url('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ url('assets/plugins/apexchart/apex-custom-chart.js') }}"></script> --}}
<script src="{{ url('assets/js/main.js') }}"></script>
{{-- <script src="{{ url('assets/js/dashboard1.js') }}"></script> --}}

@stack('scripts')

<script>
    // Get all the reset buttons from the dom
    var resetButtons = document.getElementsByClassName('reset');

    // Loop through each reset buttons to bind the click event
    for (var i = 0; i < resetButtons.length; i++) {
        resetButtons[i].addEventListener('click', resetForm);
    }

    /**
     * Function to hard reset the inputs of a form.
     *
     * @param object event The event object.
     * @return void
     */
    function resetForm(event) {
        event.preventDefault();
        var form = event.currentTarget.form;
        var inputs = form.querySelectorAll('input');
        inputs.forEach(function(input, index) {
            input.value = null;
        });
        var selects = form.querySelectorAll('select');
        selects.forEach(function(select, index) {
            select.value = "";
        });
        // var imgs = form.querySelectorAll('img');
        // imgs.forEach(function(img, index) {
        //     img.src = window.location.origin + 'assets/images/electrical_substation.png';
        // });
    }

    function displaySelectedImage(event, elementId) {
        const selectedImage = document.getElementById(elementId);
        const fileInput = event.target;

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                selectedImage.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    function formatDateTime(dateString, format = 'datetime') {
        if (!dateString) return '-'

        let dateOptions = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }
        let longDateOptions = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }
        let monthYearOptions = {
            year: 'numeric',
            month: 'long'
        }
        let timeOptions = {
            hour: '2-digit',
            minute: '2-digit'
        }
        let language = 'id'
        let dateFormat = new Date(dateString)

        let date = dateFormat.toLocaleDateString(language, dateOptions)
        let longDate = dateFormat.toLocaleDateString(language, longDateOptions)
        let time = dateFormat.toLocaleTimeString(language, timeOptions)

        if (format == 'date') return date
        else if (format == 'time') return time
        else if (format == 'month-year') return dateFormat.toLocaleDateString(language, monthYearOptions)
        else if (format == 'long-datetime') return longDate + ', ' + time
        //datetime
        return date + ', ' + time
    }

    function timeSince(time) {

        switch (typeof time) {
            case 'number':
                break;
            case 'string':
                time = +new Date(time);
                break;
            case 'object':
                if (time.constructor === Date) time = time.getTime();
                break;
            default:
                time = +new Date();
        }
        var time_formats = [
            [60, 'seconds', 1], // 60
            [120, '1 minute ago', '1 minute from now'], // 60*2
            [3600, 'minutes', 60], // 60*60, 60
            [7200, '1 hour ago', '1 hour from now'], // 60*60*2
            [86400, 'hours', 3600], // 60*60*24, 60*60
            [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
            [604800, 'days', 86400], // 60*60*24*7, 60*60*24
            [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
            [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
            [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
            [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
            [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
            [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
            [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
            [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
        ];
        var seconds = (+new Date() - time) / 1000,
            token = 'ago',
            list_choice = 1;

        if (seconds == 0) {
            return 'Just now'
        }
        if (seconds < 0) {
            seconds = Math.abs(seconds);
            token = 'from now';
            list_choice = 2;
        }
        var i = 0,
            format;
        while (format = time_formats[i++])
            if (seconds < format[0]) {
                if (typeof format[2] == 'string')
                    return format[list_choice];
                else
                    return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
            }
        format = time_formats[time_formats.length - 1];
        return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
    }


    $(".data-attributes span").peity("donut");

    // new PerfectScrollbar(".user-list");
</script>
