            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <div class="container-xxl d-flex flex-column flex-md-row flex-stack">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-gray-400 fw-bold me-1">Created by</span>
                        <a href="https://www.sesasoft.com.tr/" target="_blank" class="text-muted text-hover-primary fw-bold me-2 fs-6">Sesasoft</a>
                    </div>
                    <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                        <li class="menu-item">
                            <a href="https://www.sesasoft.com.tr/hakkimizda" target="_blank" class="menu-link px-2">Hakkımızda</a>
                        </li>
                        <li class="menu-item">
                            <a href="https://www.sesasoft.com.tr/iletisim" target="_blank" class="menu-link px-2">Destek</a>
                        </li>
                        <li class="menu-item">
                            <a href="https://www.sesasoft.com.tr/" target="_blank" class="menu-link px-2">Bizi Ziyaret Edin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
        </svg>
    </span>
</div>

<script>var hostUrl = "assets/";</script>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<script src="assets/js/jquery-3.6.4.min.js"></script>
<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/modals/create-app.js"></script>
<script src="assets/js/custom/modals/upgrade-plan.js"></script>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>

<script>
    $(function() {
        // Dosya yüklemesi yapıldığında önizleme yap
        $("#photo-upload").on("change", function() {
            var files = $(this)[0].files;
            var preview = $(".photo-preview");
            preview.empty();
            if (files.length > 0) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = $("<img>").attr("src", e.target.result);
                        var item = $("<div>").addClass("photo-item").append(img);
                        var removeBtn = $("<button>").text("X").attr("type", "button").on("click", function() {
                            var remainingFiles = $(this).closest(".photo-preview").find(".photo-item img").map(function() {
                                return this.src;
                            }).get();

                            var index = remainingFiles.indexOf(img.attr("src"));
                            remainingFiles.splice(index, 1);

                            var newFileList = new DataTransfer();
                            for (var j = 0; j < remainingFiles.length; j++) {
                                var file = dataURItoBlob(remainingFiles[j]);
                                newFileList.items.add(new File([file], "image" + (j + 1) + ".png", {type: file.type}));
                            }
                            $("#photo-upload")[0].files = newFileList.files;

                            item.remove();
                        });
                        item.append(removeBtn);
                        preview.append(item);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        function dataURItoBlob(dataURI) {
            var byteString = atob(dataURI.split(",")[1]);
            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], { type: "image/png" });
        }



        // Seçilen dosyaları temizle
        $("#photo-clear").on("click", function() {
            var input = $("#photo-upload");
            input.val("");
            var preview = $(".photo-preview");
            preview.empty();
        });
    });
</script>

<script>
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // POST isteği ile yüklenecek dosya adı
        maxFilesize: 2, // MB cinsinden maksimum dosya boyutu
        maxFiles: 10, // aynı anda yüklenebilecek maksimum dosya sayısı
        acceptedFiles: ".jpeg,.jpg,.png,.gif", // kabul edilebilecek dosya türleri
        addRemoveLinks: true, // dosya yükleme işlemi tamamlandıktan sonra dosya silme işlemine olanak sağlar
        init: function() {
            this.on("success", function(file, response) {
                console.log(response); // yükleme işlemi başarılı olduğunda yapılacak işlemler
            });
            this.on("removedfile", function(file) {
                console.log(file.name + " dosyası silindi."); // dosya silme işlemi gerçekleştiğinde yapılacak işlemler
            });
        }
    };
</script>

<script>
    $('#urunvaryantlar').repeater({
        initEmpty: false,
        defaultValues: {
            'text-input': 'foo'
        },
        show: function () {
            $(this).slideDown();
            $(this).find('[data-kt-repeater="select2"]').select2();
            $(this).find('[data-kt-repeater="datepicker"]').flatpickr();
            new Tagify(this.querySelector('[data-kt-repeater="tagify"]'));
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        ready: function(){
            $('[data-kt-repeater="select2"]').select2();
            $('[data-kt-repeater="datepicker"]').flatpickr();
            new Tagify(document.querySelector('[data-kt-repeater="tagify"]'));
        }
    });
</script>

<script>
    $('#urunvaryantlar2').repeater({
        initEmpty: false,
        defaultValues: {
            'text-input': 'foo'
        },
        show: function () {
            $(this).slideDown();
            $(this).find('[data-kt-repeater="select2"]').select2();
            $(this).find('[data-kt-repeater="datepicker"]').flatpickr();
            new Tagify(this.querySelector('[data-kt-repeater="tagify"]'));
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        ready: function(){
            $('[data-kt-repeater="select2"]').select2();
            $('[data-kt-repeater="datepicker"]').flatpickr();
            new Tagify(document.querySelector('[data-kt-repeater="tagify"]'));
        }
    });
</script>

<script>
    "use strict";

    // Class definition
    var KTDatatablesExample = function () {
        // Shared variables
        var table;
        var datatable;

        // Private functions
        var initDatatable = function () {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                dateRow[3].setAttribute('data-order', realDate);
            });

            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "info": false,
                'order': [],
                'pageLength': 10,
            });
        }

        // Hook export buttons
        var exportButtons = () => {
            const documentTitle = 'Customer Orders Report';
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'excelHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'csvHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_buttons'));

            // Hook dropdown menu click event to datatable export buttons
            const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();

                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                    // Trigger click event on hidden datatable export buttons
                    target.click();
                });
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                datatable.search(e.target.value).draw();
            });
        }

        // Public methods
        return {
            init: function () {
                table = document.querySelector('#kt_datatable_example');

                if ( !table ) {
                    return;
                }

                initDatatable();
                exportButtons();
                handleSearchDatatable();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesExample.init();
    });
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
</html>