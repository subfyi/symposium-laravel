@extends('cms.app')
@section('content')

    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
													<span class="kt-portlet__head-icon kt-hide">
														<i class="la la-gear"></i>
													</span>
                            <h3 class="kt-portlet__head-title">
                                Send New Article
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">

                            <div class="kt-section__content">

                                <div class="right_col" role="main">
                                    <div class="">

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">

                                                <div class="x_panel">


                                                    <div class="x_content">


                                                        <form method="post" id="demo-form2" data-parsley-validate
                                                              class="form-horizontal form-label-left">

                                                            {{csrf_field()}}
                                                            <div class="row">


                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="x_panel tile">
                                                                        <div class="x_content">
                                                                            <div class="col-md-12 col-sm-12 col-xs-12">

                                                                                <div class="form-group row">
                                                                                    <label class="col-md-3 col-sm-3 col-xs-3">Article Title (ENG) *
                                                                                        :</label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                                                                        <input class="form-control col-md-12 col-xs-12 error"
                                                                                               name="pap_title" type="text"
                                                                                               value="" aria-invalid="true" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-3 col-sm-3 col-xs-3">Abstract Text (ENG) *
                                                                                        :</label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                                        <textarea id="summernote2" name="pap_abstract"
                                                                  class="form-control">
                                                        </textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-form-label col-lg-3 col-sm-12">Keywords (ENG)
                                                                                        *</label>
                                                                                    <div class=" col-lg-9 col-md-9 col-sm-12">
                                                                                        <select class="keyword-select"
                                                                                                multiple="multiple" name="pap_keyword[]" required></select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                                        Topic *
                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-6">

                                                                                        <select class="form-control kt-select2"
                                                                                                name="pap_topic_p" required>

                                                                                            <option disabled selected value> -- Select --</option>
                                                                                            @foreach(App\Models\Parameters::where('type', 'keywordcon')->get() as $topic)
                                                                                                <option value="{{ $topic->id }}">{{ $topic->value }}</option>
                                                                                            @endforeach
                                                                                        </select>

                                                                                    </div>
                                                                                </div>


                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                                        Presentation Type*:
                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-6">

                                                                                        <select class="form-control"
                                                                                                name="pre_type" required>
                                                                                            <option disabled selected value> -- Select --</option>
                                                                                            @foreach($uygulamacon as $val)
                                                                                                <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Abstract
                                                                                        (.doc, .docx)
                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                        <file-picker id="dosyalar" name="dosyalar"
                                                                                                     accepts="application/msword,.docx"
                                                                                                     desc="Abstract
                                                                                        (.doc, .docx)"
                                                                                                     required></file-picker>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Full
                                                                                        Paper (.doc, .docx)
                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                        <file-picker id="fdosyalar" name="fdosyalar"
                                                                                                     accepts="application/msword,.docx"
                                                                                                     desc="Full
                                                                                        Paper (.doc, .docx)"
                                                                                                     required></file-picker>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Poster
                                                                                        Presentation (.pdf)

                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                        <file-picker id="pdosyalar" name="pdosyalar"
                                                                                                     accepts="application/pdf"
                                                                                                     desc="Poster
                                                                                        Presentation (.pdf)"
                                                                                                     required></file-picker>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3
                                                                                    col-xs-12">Prefered Publish Type *

                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-6">

                                                                                        <select class="form-control"
                                                                                                name="pap_type" required>
                                                                                            <option disabled selected value> -- Select --</option>
                                                                                            @foreach($birimcon as $val)

                                                                                                <option value='{{$val->item_num}}'> {{$val->value}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                                                        Message To Congress
                                                                                    </label>
                                                                                    <div class="col-md-9 col-sm-9 col-xs-6">
                                                                                        <input class="form-control col-md-12 col-xs-12 error"
                                                                                               name="mes_congress" type="text"
                                                                                               value="" aria-invalid="true">

                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <table class="table table-striped tablo">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>Mail</th>
                                                                                            <th>Name</th>
                                                                                            <th>Surname</th>
                                                                                            <th>Correspond</th>
                                                                                            <th>Presenter</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>Author 1</td>
                                                                                            <td>

                                                                                                <div class="row">
                                                                                                    <select class="col-md-12 form-control
                                                                                                        kt-select2
                                                                                                        email-select" name="a_email[1]">
                                                                                                        <option></option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td><input class="form-control col-md-12 col-xs-12
                                                                                            error name"
                                                                                                       name="a_name[1]" type="text"
                                                                                                       value="" aria-invalid="true" required></td>

                                                                                            <td><input class="form-control col-md-12 col-xs-12
                                                                                            error surname"
                                                                                                       name="a_surname[1]" type="text"
                                                                                                       value="" aria-invalid="true" required></td>

                                                                                            <td>
                                                                                                <label class=" border-success">
                                                                                                    <input type="radio" class="flat"
                                                                                                           name="correspond"
                                                                                                           value="1"
                                                                                                           required>
                                                                                                </label>
                                                                                            </td>
                                                                                            <td>
                                                                                                <label class=" border-success">
                                                                                                    <input type="radio" class="flat"
                                                                                                           name="presenter"
                                                                                                           value="1"
                                                                                                           required>
                                                                                                </label>

                                                                                            </td>
                                                                                        </tr>

                                                                                        </tbody>
                                                                                    </table>
                                                                                    <button class="btn btn-primary ekleme">Add</button>

                                                                                </div>


                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                                                            <button type="submit" class="col-md-12 btn
                                                                            btn-success">Save
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- page content -->
    <!-- /page content -->

@endsection
@section('css')
    <style>
        .select2-container {
            width: 100% !important;
        }


    </style>

@endsection
@section('js')
    <script>
        $('#summernote2').summernote({
            // Toolbar here
            dom: 'frtip',
            "pagingType": "full_numbers",
            tabsize: 3,
            maxHeight: null,             // set maximum height of editor
            minHeight: 250,             // set minimum height of editor
            airMode: false,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                // ['fontname', ['fontname']],
                // ['fontsize', ['fontsize']],
                ['color', ['color']],
                // ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                // ['table', ['table']],
                // ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen'/*, 'codeview' */]],   // remove codeview button
                //['help', ['help']]
            ]
        });

        $(document).ready(function () {
            $('form').on('submit', function (e) {
                if (document.getElementById('dosyalar').$controller.$state !== 3 &&
                    document.getElementById('fdosyalar').$controller.$state !== 3 &&
                    document.getElementById('pdosyalar').$controller.$state !== 3) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    swal.fire('Warning', 'You need to upload at least one file.', 'error');
                    return;
                }

                var radio1 = $("input[name=correspond]");
                var radio2 = $("input[name=presenter]");

                var ok = false;

                for (var i = 0; i < radio1.length; ++i) {
                    if (radio1[i].checked) {
                        ok = true;
                    }
                }

                if (!ok) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    swal.fire('Warning', 'Select Corresponder.', 'error');
                    return;
                }

                ok = false;

                for (var i = 0; i < radio2.length; ++i) {
                    if (radio2[i].checked) {
                        ok = true;
                    }
                }

                if (!ok) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    swal.fire('Warning', 'Select Presenter.', 'error');
                    return;
                }

            });

            $('form').validate();
            $('form').ajaxForm({
                beforeSubmit: function () {

                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    swal.fire({
                        title: percentVal + ' Loading',
                        text: ' Please wait..',
                        icon: 'info',
                    })
                },
                success: function (response) {
                    swal.fire({
                        title: response.baslik,
                        text: response.icerik,
                        icon: response.durum,
                    }).then(function () {
                        if (response.slugurl)
                            location.replace('{{url('/user/papers')}}');
                    });
                },
            });

        });

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' '],
            placeholder: "Select a topic"
        })

    </script>
@endsection
