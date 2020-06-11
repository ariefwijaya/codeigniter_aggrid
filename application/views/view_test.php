<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]> <html lang="en"><![endif]-->
<!-- Begin Head -->

<head>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Musica Admin | Manage Artists</title>
        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/izitoast/css/iziToast.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/select2/dist/css/select2.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/aggrid/ag-theme-balham.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <style>
            .ag-theme-balham .ag-header-cell {
                color: #000;
                font-weight: bold;
            }

            .btn-progress {
                position: relative;
                background-image: url("<?php echo base_url(); ?>assets/spinner-white.svg");
                background-position: center;
                background-repeat: no-repeat;
                background-size: 30px;
                color: transparent !important;
                pointer-events: none
            }
        </style>
    </head>

<body>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Codeigniter Aggrid Server Side</h4>
                        <div class="card-header-action">
                            <button id="apply-filter" class="btn btn-primary">Refresh</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <input type="text" class="form-control col-sm-12" id="filter-text-box" placeholder="Search..." />
                            </div>
                        </div>
                        <div style="width:100%; height: 350px;" class="p-t-10">
                            <div id="ag-table" style="height: 100%; width: 100%; box-sizing: border-box;" class="ag-theme-balham"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var BASE_URL = "<?php echo base_url(); ?>";
        var API_KEY = "1cf0d517e7bcb9e358d0664f647ff0d6bbdbc71c92fce0e27c24ed2ef455cb230e2871b73d15ef79f563947c11589cdc9c1d511dda8b0831b2deb0072786d3b0XlevwAesDmdlV1h1iz9V6HtVpswYr8CO2YvUMVo7lhs=";
        var STREAM_URL = BASE_URL;
    </script>
    <!-- General JS Scripts -->
    <!-- Page Specific JS File -->
    <script src="<?php echo base_url(); ?>assets/izitoast/js/iziToast.min.js"></script>
    <!-- Custom JS File -->
    <script src="<?php echo base_url(); ?>assets/custom.js"></script>
    <div class="modal fade" id="formModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="formModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="" id="formData" method="POST">
                    <div class="modal-header">
                        <h5 id="formModalTitle" class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" />
                        <div class="form-group">
                            <label>Nationality</label>
                            <select name="nationality[]" class="form-control select2" multiple="multiple">
                            </select>
                            <div class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="save_btn btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formDeleteModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="formDeleteModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="" id="formDeleteData" method="POST">
                    <div class="modal-header">
                        <h5 id="formDeleteModalTitle" class="modal-title">Delete this data?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" />
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea name="remarkdeleted" class="form-control" placeholder="Please give remarks to delete data!"></textarea>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="save_btn btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/aggrid/ag-grid-enterprisev20.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/select2/dist/js/select2.full.min.js"></script>
    <script>
        "use strict";
        // let the grid know which columns and what data to use
        var gridOptions = {
            columnDefs: [],
            // rowData: rowData,
            rowModelType: 'serverSide',
            purgeClosedRowNodes: false,
            rowHeight: 40,
            pagination: true,
            paginationPageSize: 50,
            cacheOverflowSize: 1,
            maxBlocksInCache: 4,
            infiniteInitialRowCount: 1,
            maxConcurrentDatasourceRequests: 2,
            cacheBlockSize: 50,
            enableCellChangeFlash: true,
            // serverSideSortingAlwaysResets: true,
            suppressEnterpriseResetOnNewColumns: true,
            blockLoadDebounceMillis: 300,
            // suppressPivots:true,
            // getRowNodeId: function(item) {
            //     return item.username.toString();
            // },
            getChildCount: function(data) {
                if (data === undefined) {
                    return null;
                } else {
                    return data.childCount;
                }
            },
            animateRows: false,
            multiSortKey: 'ctrl',
            components: {
                'actionCellRenderer': actionCellRenderer,
                'thumbImageRenderer': thumbImageRenderer,
                'booleanCellRenderer': booleanCellRenderer
            },
            // rowSelection: 'multiple',
            rowDeselection: true,
            enableRangeSelection: true,
            // enableCellTextSelection: true,
            clipboardDeliminator: ',',
            sideBar: true,
            onGridReady: function(params) {
                params.api.closeToolPanel();
            },
            deltaRowDataMode: true,
            overlayLoadingTemplate: '<span class="ag-overlay-loading-center">Something Error happened</span>',
            overlayNoRowsTemplate: '<span class="ag-overlay-loading-center">No Rows Found</span>'
        };


        function actionCellRenderer(params) {
            if (params.data != undefined && params.data.id != undefined) {
                var idVal = encodeURI(params.data.id);
                return '<div  class="btn-group" role="group" aria-label="Basic example">' +
                    '<button onclick="showNationalityModal(this)" data-id="' + idVal + '" class="btn btn-icon btn-primary btn-sm edit_modal"><i class="fa fa-edit"></i>Show</button>' +
                    '<button onclick="deleteFormModal(this)" data-id="' + idVal + '" class="btn btn-icon btn-danger btn-sm delete_modal"><i class="fa fa-trash"></i></button>' +
                    '</div>';
            } else {
                return '';
            }
        }

        function booleanCellRenderer(params) {
            if (params.value != undefined) {
                var valData = encodeURI(params.value);
                return (valData == 1) ? '1 | YES' : (valData == 0) ? '0 | NO' : null;
            } else {
                return '';
            }
        }

        function thumbImageRenderer(params) {
            if (params.value != undefined) {
                var valData = encodeURI(params.value);
                return '<a ' + (params.value ? 'href="' + (STREAM_URL + 'images/user/' + valData) + '" target="_blank"' : 'href="javascript:;"') + '> <div class="small-avatar zoomhover" alt="image" style="background-image:url(' + STREAM_URL + 'thumb/user/' + valData + ');" ></div></a>';
            } else {
                return '';
            }
        }

        var formState;
        var goToPageGrid = null;
        var apiGrid = BASE_URL + "api/rows";
        var apiDelete = BASE_URL + "api/rows/delete";

        $(document).ready(function() {
            $("[name='nationality[]'].select2").select2({
                width: "100%",
                dropdownParent: $("#formData"),
                allowClear: true,
                ajax: {
                    type: "POST",
                    delay: 250,
                    url: BASE_URL + 'api/nationality/search',
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1
                        }
                        return query;
                    },
                    headers: {
                        api_key: API_KEY
                    },
                },
                cache: true,
                minimumInputLength: 0,
                placeholder: 'Search for Nationality',
                templateResult: function(data) {
                    if (data.loading) {
                        return data.text;
                    }
                    return data.text;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });

            $('#filter-text-box').change(350, $.debounce(function() {
                gridOptions.api.onFilterChanged();
            }));

            $("#apply-filter").click(function(e) {
                e.preventDefault();
                if (gridOptions.api !== undefined) {
                    gridOptions.api.destroy();
                }
                var eGridDiv = document.querySelector('#ag-table');
                new agGrid.Grid(eGridDiv, gridOptions);

                const datasource = {
                    getRows: (params) => getRowsData(params),
                };
                gridOptions.api.setServerSideDatasource(datasource);
            });

            $("#formDeleteData").submit(function(e) {
                var form = $(this);
                var formSelector = "#" + $(this).attr("id");
                e.preventDefault();
                e.stopPropagation();
                $(formSelector + " button[type='submit']").addClass("btn-progress");
                $(formSelector + " input").removeClass("d-block");
                $(formSelector + ' div.invalid-feedback').html('');
                $.ajax({
                    type: "POST",
                    url: apiDelete,
                    data: new FormData(form[0]),
                    processData: false,
                    contentType: false,
                    // cache:false,
                    // async:false,
                    dataType: 'json',
                    headers: {
                        api_key: API_KEY
                    },
                    success: function(response, status, xhr) {
                        if (response.status) {
                            var currentPage = gridOptions.api.paginationGetCurrentPage();
                            var totalPage = gridOptions.api.paginationGetTotalPages();
                            gridOptions.api.purgeServerSideCache();
                            if (totalPage > currentPage) {
                                goToPageGrid = currentPage;
                            } else {
                                goToPageGrid = null;
                            }

                            $.showToast(response.data, 'success');
                            $("#formDeleteModal").modal('hide');
                        } else {
                            var validationMessage = response.validation;
                            if (validationMessage) {
                                var idx = 0;
                                for (const key in validationMessage) {
                                    if (validationMessage.hasOwnProperty(key)) {
                                        const element = validationMessage[key];
                                        if (idx == 0) {
                                            $("[name='" + key + "']").focus();
                                        }
                                        var inputEl = $("[name='" + key + "']").siblings('div.invalid-feedback');
                                        inputEl.html(element);
                                        inputEl.addClass("d-block");
                                    }
                                    idx++;
                                }
                            } else {
                                $.showToast(response.error, 'error');
                            }
                        }
                    },
                    complete: function(jqXHR, textStatus) {
                        $(formSelector + " button[type='submit']").removeClass("btn-progress");
                    },
                    error: function(httpRequest, textStatus, errorThrown) {
                        // "We couldn't complete your request"
                        var errorMsg = textStatus + " " + errorThrown;
                        $.showToast(errorMsg, 'error');
                    }
                });
            });

            $("#apply-filter").click();
        });


        function deleteFormModal(thisData) {
            var thisEl = $(thisData);
            var id = thisEl.data('id');
            $("#formDeleteData [name='id']").val(id);
            $("#formDeleteModal").modal('show');
        }


        function showNationalityModal(element) {
            $("#formModal").modal('show');
        }

        function getRowsData(params) {
            var applyBtn = $("#apply-filter");
            applyBtn.addClass("btn-progress");
            gridOptions.api.hideOverlay();

            var quickFilterVal = $('#filter-text-box').val();
            var paramsRequest = params.request;
            paramsRequest['quickFilter'] = quickFilterVal;
            $.ajax({
                method: "POST",
                url: apiGrid,
                data: {
                    request: JSON.stringify(paramsRequest)
                },
                dataType: 'json',
                headers: {
                    api_key: API_KEY
                },
                success: function(response) {
                    if (response.status) {
                        var resData = response.data;
                        gridOptions.api.setColumnDefs(resData.columns);
                        gridOptions.columnApi.setSecondaryColumns(resData.secondColumns);
                        params.successCallback(resData.rows, resData.lastRow);
                        if ((resData.rows).length == 0) gridOptions.api.showNoRowsOverlay();
                        if (goToPageGrid != null && goToPageGrid >= 0) {
                            gridOptions.api.paginationGoToPage(goToPageGrid);
                            goToPageGrid = null;
                        }
                    } else {
                        params.failCallback();
                        gridOptions.api.showLoadingOverlay();
                    }
                },
                complete: function(jqXHR, textStatus) {
                    applyBtn.removeClass("btn-progress");
                },
                error: function(httpRequest, textStatus, errorThrown) {
                    params.failCallback();
                    gridOptions.api.showLoadingOverlay();
                }
            });
        }
    </script>
</body>

</html>