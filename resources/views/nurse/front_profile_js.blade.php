<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<script>
    $(document).ready(function() {
        // Mandatory Training and Education
        $('.js-example-basic-multiple[data-list-id="mandatory_courses"]').on('change', function() {
            let selectedValues = $(this).val();

            //console.log("selectedValues", selectedValues);
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("419")) {
                $('.mandatory_tr_div_1').removeClass('d-none');
                // $('.license_number_acls').removeClass('d-none');
            } else {
                $('.mandatory_tr_div_1').addClass('d-none');
                // $('.license_number_acls').addClass('d-none');
                $('.well_self_care_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="well_self_care_data"]').select2().val(null).trigger('change');
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "well_imgs");
            }
            if (selectedValues.includes("418")) {
                $('.mandatory_tr_div_2').removeClass('d-none');
                // $('.license_number_bls').removeClass('d-none');
            } else {
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "tech_innvo_imgs");
                $('.mandatory_tr_div_2').addClass('d-none');
                // $('.license_number_bls').addClass('d-none');
                $('.tech_innvo_health_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("417")) {
                $('.mandatory_tr_div_3').removeClass('d-none');
                // $('.license_number_cpr').removeClass('d-none');
            } else {
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "leader_pro_imgs");
                $('.mandatory_tr_div_3').addClass('d-none');
                // $('.license_number_cpr').addClass('d-none');
                $('.leader_pro_dev_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("416")) {
                $('.mandatory_tr_div_4').removeClass('d-none');
                // $('.license_number_nrp').removeClass('d-none');

            } else {
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "mid_spec_imgs");
                $('.mandatory_tr_div_4').addClass('d-none');
                // $('.license_number_nrp').addClass('d-none');
                $('.mid_spec_tra_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').select2().val(null).trigger('change');

            }
            if (selectedValues.includes("415")) {
                $('.mandatory_tr_div_5').removeClass('d-none');
                // $('.license_number_pals').removeClass('d-none');


            } else {
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "clinic_skill_imgs");
                $('.mandatory_tr_div_5').addClass('d-none');
                // $('.license_number_pals').addClass('d-none'); 
                $('.clinic_skill_core_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="clinic_skill_core_data"]').select2().val(null).trigger('change');
            }

        });

        $('.js-example-basic-multiple[data-list-id="well_self_care_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var well_self_care = [];
            $('.well_self_care_div').removeClass('d-none');
            $(".well_self_care_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {

                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    //console.log("res_one", res_one);

                    $(".well_self_care_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "well_imgs");
                }
                well_self_care.push(text);
            });
            //console.log("selectedValues", selectedValues);

            // $(".well_self_care_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                //console.log("res_one", res_one);

                if (well_self_care.includes(selectedValues[i]) == false) {

                    var user_id = "{{ $user_id }}";
                    var img_text = "well_imgs";
                    $(".well_self_care_div").append('<div class="well_self_care_' + res_one + ' well_div_' + selected_text + '"><h6 class="well_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="wellnamearr[]" class="wellness_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="wellness_inst_div row wellness_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control well_institution well_institution-' + i + '" type="text" name="well_institution[]"><span id="wellinstitutionvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control well_tra_start_date well_tra_start_date-' + i + '" type="date" name="well_tra_start_date[]"><span id="well_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control well_tra_end_date well_tra_end_date-' + i + '" type="date" name="well_tra_end_date[]"><span id="well_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control well_expiry well_expiry-' + i + '" type="date" name="well_expiry[]"><span id="wellexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control well_upload_certification well_imgs_' + res_one + ' well_upload_certification-' + i + '" type="file" name="well_upload_certification[' + i + '][]" onchange="changetraImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqwelluploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="well_imgs' + res_one + '"></div></div></div></div>');
                }
            }


        });

        $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var tech_innvo_health = [];
            $('.tech_innvo_health_div').removeClass('d-none');
            $(".tech_innvo_health_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    //console.log("res_one", res_one);

                    $(".tech_innvo_health_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "tech_innvo_imgs");
                }
                tech_innvo_health.push(text);
            });
            //console.log("selectedValues", selectedValues);

            // $(".tech_innvo_health_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                //console.log("res_one", res_one);

                if (tech_innvo_health.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $user_id }}";
                    var img_text = "tech_innvo_imgs";
                    $(".tech_innvo_health_div").append('<div class="tech_innvo_health_' + res_one + ' tech_innvo_div_' + selected_text + '"><h6 class="tech_innvo_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="techinnvonamearr[]" class="tech_innvo_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="tech_innvo_div row tech_innvo_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control tech_innvo_institution tech_innvo-' + i + '" type="text" name="tech_innvo_institution[]"><span id="techinnvoinstitutionvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control tech_innvo_tra_start_date tech_innvo_tra_start_date-' + i + '" type="date" name="tech_innvo_tra_start_date[]"><span id="tech_innvo_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control tech_innvo_tra_end_date tech_innvo_tra_end_date-' + i + '" type="date" name="tech_innvo_tra_end_date[]"><span id="tech_innvo_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control tech_innvo_expiry tech_innvo_expiry-' + i + '" type="date" name="tech_innvo_expiry[]"><span id="techinnvoexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control tech_innvo_upload_certification tech_innvo_imgs_' + res_one + ' tech_innvo_upload_certification-' + i + '" type="file" name="tech_innvo_upload_certification[' + i + '][]" onchange="changetraImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqtechinnvouploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="tech_innvo_imgs' + res_one + '"></div></div></div></div>');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var leader_pro_dev = [];
            $('.leader_pro_dev_div').removeClass('d-none');
            $(".leader_pro_dev_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    // alert(text);

                    let res = text.split(' ')[0];

                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    let res_2 = text.split(' ')[1];

                    res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    let chunks = res_2.substring(0, 4);

                    let res_one = res_1 + '_' + chunks;

                    $(".leader_pro_dev_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "leader_pro_imgs");
                }
                leader_pro_dev.push(text);
            });
            //console.log("selectedValues", selectedValues);

            // $(".leader_pro_dev_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();

                let res = selectedValues[i].split(' ')[0];

                let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                let res_2 = selectedValues[i].split(' ')[1];

                res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                let chunks = res_2.substring(0, 4);

                let res_one = res_1 + '_' + chunks;

                if (leader_pro_dev.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $user_id }}";
                    var img_text = "leader_pro_imgs";
                    $(".leader_pro_dev_div").append('<div class="leader_pro_dev_' + res_one + ' leader_pro_div_' + selected_text + '"><h6 class="leader_pro_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="leaderpronamearr[]" class="leader_pro_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="leader_pro_div row leader_pro_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control leader_pro_institution leader_pro-' + i + '" type="text" name="leader_pro_institution[]"><span id="leaderproinstivalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control leader_pro_tra_start_date leader_pro_tra_start_date-' + i + '" type="date" name="leader_pro_tra_start_date[]"><span id="leader_pro_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control leader_pro_tra_end_date leader_pro_tra_end_date-' + i + '" type="date" name="leader_pro_tra_end_date[]"><span id="leader_pro_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control leader_pro_expiry leader_pro_expiry-' + i + '" type="date" name="leader_pro_expiry[]"><span id="leaderproexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control leader_pro_upload_certification leader_pro_imgs_' + res_one + ' leader_pro_upload_certification-' + i + '" type="file" name="leader_pro_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqleaderprouploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="leader_pro_imgs' + res_one + '"></div></div></div></div>');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var mid_spec_tra = [];
            $('.mid_spec_tra_div').removeClass('d-none');
            $(".mid_spec_tra_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    let res_2 = text.split(' ')[1];
                    res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    res_2 = res_2.substring(0, 2);

                    let res_3 = text.split(' ')[1];
                    res_3 = res_3.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    res_3 = res_3.substring(0, 4)

                    let res_one = res_1 + '_' + res_2 + '_' + res_3;

                    $(".mid_spec_tra_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "mid_spec_imgs");
                }
                mid_spec_tra.push(text);
            });
            //console.log("selectedValues", selectedValues);

            // $(".mid_spec_tra_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();


                let res_2 = selectedValues[i].split(' ')[1];
                res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                res_2 = res_2.substring(0, 2);

                let res_3 = selectedValues[i].split(' ')[1];
                res_3 = res_3.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                res_3 = res_3.substring(0, 4)

                let res_one = res_1 + '_' + res_2 + '_' + res_3;
                //console.log("res_one", res_one);

                if (mid_spec_tra.includes(selectedValues[i]) == false) {

                    var user_id = "{{ $user_id }}";
                    var img_text = "mid_spec_imgs";
                    $(".mid_spec_tra_div").append('<div class="mid_spec_tra_' + res_one + ' mid_spec_div_' + selected_text + '"><h6 class="mid_spec_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="midspecnamearr[]" class="mid_spec_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="mid_spec_div row mid_spec_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control mid_spec_institution mid_spec-' + i + '" type="text" name="mid_spec_institution[]"><span id="midspecinstivalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control mid_spec_tra_start_date mid_spec_tra_start_date-' + i + '" type="date" name="mid_spec_tra_start_date[]"><span id="mid_spec_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control mid_spec_tra_end_date mid_spec_tra_end_date-' + i + '" type="date" name="mid_spec_tra_end_date[]"><span id="mid_spec_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control mid_spec_expiry mid_spec_expiry-' + i + '" type="date" name="mid_spec_expiry[]"><span id="midspecexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control mid_spec_upload_certification mid_spec_imgs_' + res_one + ' mid_spec_upload_certification-' + i + '" type="file" name="mid_spec_upload_certification[' + i + '][]" onchange="changetraImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqmidspecuploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="mid_spec_imgs' + res_one + '"></div></div></div></div>');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="clinic_skill_core_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var clinic_skill_core = [];
            let selectedIds = [];
            let selectedDataIds = [];


            selectedValues.forEach(function(value) {
                // Use jQuery to find the <li> element by its text and get the data-value
                let dataId = $('#clinic_skill_core_data li').filter(function() {
                    return $(this).text() === value;
                }).data('id');
                //console.log('ggg', dataId);
                // Add the found dataId to the selectedIds array if it exists
                if (dataId !== undefined) {
                    selectedIds.push(dataId);
                }
            });

            $('.clinic_skill_core_div').removeClass('d-none');
            $(".clinic_skill_core_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    // //console.log("res_one",res_one);

                    // Find the corresponding dataId for the text from the list
                    let dataId = $('#clinic_skill_core_data li').filter(function() {
                        return $(this).text() === text;
                    }).data('id'); // Get the associated data-id

                    let res_one = res_1 + '_' + dataId;

                    $(".clinic_skill_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "clinic_skill_imgs");
                }
                clinic_skill_core.push(text);
            });
            //console.log("selectedValues", selectedValues);

            // $(".clinic_skill_core_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                // Get the corresponding selectedId
                let selectedId = selectedIds[i];

                let res_one = res_1 + '_' + selectedId;

                if (clinic_skill_core.includes(selectedValues[i]) == false) {

                    var user_id = "{{ $user_id }}";
                    var img_text = "clinic_skill_imgs";
                    $(".clinic_skill_core_div").append('<div class="clinic_skill_' + res_one + ' clinic_skill_div_' + selected_text + '"><h6 class="clinic_skill_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="clinicskillnamearr[]" class="clinic_skill_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="clinic_skill_div row clinic_skill_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control clinic_skill_institution clinic_skill-' + i + '" type="text" name="clinic_skill_institution[]"><span id="cliskillinstivalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control clinic_skill_tra_start_date clinic_skill_tra_start_date-' + i + '" type="date" name="clinic_skill_tra_start_date[]"><span id="clinic_skill_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control clinic_skill_tra_end_date clinic_skill_tra_end_date-' + i + '" type="date" name="clinic_skill_tra_end_date[]"><span id="clinic_skill_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control clinic_skill_expiry clinic_skill_expiry-' + i + '" type="date" name="clinic_skill_expiry[]"><span id="clinicskillexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control clinic_skill_upload_certification clinic_skill_imgs_' + res_one + ' clinic_skill_upload_certification-' + i + '" type="file" name="clinic_skill_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqclinskilluploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="clinic_skill_imgs' + res_one + '"></div></div></div></div>');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="mandatory_education"]').on('change', function() {
            let selectedValues = $(this).val();

            //console.log("selectedValues", selectedValues);
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("440")) {
                $('.mandatory_sub_edu_div_1').removeClass('d-none');
                // $('.license_number_acls').removeClass('d-none');
            } else {
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "core_man_imgs");
                $('.mandatory_sub_edu_div_1').addClass('d-none');
                // $('.license_number_acls').addClass('d-none');
                $('.core_man_con_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="core_man_con_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("441")) {
                $('.mandatory_sub_edu_div_2').removeClass('d-none');
                // $('.license_number_bls').removeClass('d-none');
            } else {
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "mid_spe_imgs");
                $('.mandatory_sub_edu_div_2').addClass('d-none');
                // $('.license_number_bls').addClass('d-none');
                $('.mid_spe_mandotry_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="mid_spe_mandotry_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("442")) {
                $('.mandatory_sub_edu_div_3').removeClass('d-none');
                // $('.license_number_cpr').removeClass('d-none');
            } else {
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "spec_area_imgs");
                $('.mandatory_sub_edu_div_3').addClass('d-none');
                // $('.license_number_cpr').addClass('d-none');
                $('.spec_area_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="spec_area_data"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("443")) {
                $('.mandatory_sub_edu_div_4').removeClass('d-none');
                // $('.license_number_nrp').removeClass('d-none');

            } else {
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "safety_com_imgs");
                $('.mandatory_sub_edu_div_4').addClass('d-none');
                // $('.license_number_nrp').addClass('d-none');
                $('.safety_com_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="safety_com_data"]').select2().val(null).trigger('change');

            }
            if (selectedValues.includes("444")) {
                $('.mandatory_sub_edu_div_5').removeClass('d-none');
                // $('.license_number_pals').removeClass('d-none'); 
            } else {
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "eme_topic_imgs");
                $('.mandatory_sub_edu_div_5').addClass('d-none');
                // $('.license_number_pals').addClass('d-none'); 
                $('.emerging_topic_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="emerging_topic_data"]').select2().val(null).trigger('change');
            }

        });

        $('.js-example-basic-multiple[data-list-id="core_man_con_data"]').on('change', function() {
            let selectedValues = $(this).val();
            let selectedIds = [];
            let selectedDataIds = [];


            selectedValues.forEach(function(value) {
                // Use jQuery to find the <li> element by its text and get the data-value
                let dataId = $('#core_man_con_data li').filter(function() {
                    return $(this).text() === value;
                }).data('id');

                // Add the found dataId to the selectedIds array if it exists
                if (dataId !== undefined) {
                    selectedIds.push(dataId);
                }
            });
            var core_man_con_data = [];
            $('.core_man_con_data_div').removeClass('d-none');
            $(".core_man_con_data_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    // //console.log("res_one",res_one);
                    // Find the corresponding dataId for the text from the list
                    let dataId = $('#core_man_con_data li').filter(function() {
                        return $(this).text() === text;
                    }).data('id'); // Get the associated data-id

                    let res_one = res_1 + '_' + dataId;

                    $(".core_man_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "core_man_imgs");
                }
                core_man_con_data.push(text);
            });
            //console.log("selectedValues", selectedValues);

            // $(".core_man_con_data_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                let selectedId = selectedIds[i];
                let res_one = res_1 + '_' + selectedId;

                if (core_man_con_data.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $user_id }}";
                    var img_text = "core_man_imgs";

                    // $(".core_man_con_data_div").append('<div class="core_man_'+res_one+' core_man_'+selected_text+'"><h6 class="core_man_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="coremanarr[]" class="coreman_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="core_man_div row core_man_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control core_man_institution core_man_institution-'+i+'" type="text" name="core_man_institution[]"><span id="coreinstitutionvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Start Date</label><input class="form-control coreman_start_date coreman_start_date-'+i+'" type="date" name="coreman_start_date[]"><span id="coreman_start_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">End Date</label><input class="form-control coreman_end_date coreman_end_date-'+i+'" type="date" name="coreman_end_date[]"><span id="coreman_end_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control well_expiry well_expiry-'+i+'" type="date" name="well_expiry[]"><span id="wellexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control well_upload_certification well_imgs_'+res_one+' well_upload_certification-'+i+'" type="file" name="well_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqwelluploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="well_imgs'+res_one+'"></div></div></div></div>');
                    $(".core_man_con_data_div").append(`
              <div class="core_man_${res_one} core_man_${selected_text}">
                  <h6 class="core_man_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="coremanarr[]" class="coreman_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="core_man_div row core_man_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control core_man_institution core_man_institution-${i}" type="text" name="core_man_institution[]">
                          <span id="coreinstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control coreman_start_date coreman_start_date-${i}" type="date" name="coreman_start_date[]">
                          <span id="coreman_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control coreman_end_date coreman_end_date-${i}" type="date" name="coreman_end_date[]">
                          <span id="coreman_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control coreman_status coreman_status-${i}" name="coreman_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="coreman_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control core_man_expiry core_man_expiry-${i}" type="date" name="core_man_expiry[]">
                          <span id="coremanexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control coreman_upload_certification core_man_imgs_${res_one} coreman_upload_certification-${i}" 
                                type="file" name="coreman_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqcoremanuploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="core_man_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);
                }
            }


        });

        $('.js-example-basic-multiple[data-list-id="mid_spe_mandotry_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var mid_spe_mandotry_data = [];
            $('.mid_spe_mandotry_div').removeClass('d-none');
            $(".mid_spe_mandotry_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    //console.log("res_one", res_one);
                    $(".mid_spe_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "mid_spe_imgs");
                }
                mid_spe_mandotry_data.push(text);
            });
            //console.log("selectedValues", selectedValues);

            // $(".mid_spe_mandotry_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                //console.log("res_one", res_one);

                if (mid_spe_mandotry_data.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $user_id }}";
                    var img_text = "mid_spe_imgs";
                    $(".mid_spe_mandotry_div").append(`
              <div class="mid_spe_${res_one} mid_spe_${selected_text}">
                  <h6 class="mid_spe_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="midspearr[]" class="midspe_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="mid_spe_div row mid_spe_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control mid_spe_institution mid_spe_institution-${i}" type="text" name="mid_spe_institution[]">
                          <span id="midspeinstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control mid_spe_start_date mid_spe_start_date-${i}" type="date" name="mid_spe_start_date[]">
                          <span id="mid_spe_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control mid_spe_end_date coreman_end_date-${i}" type="date" name="mid_spe_end_date[]">
                          <span id="mid_spe_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control mid_spe_status mid_spe_status-${i}" name="mid_spe_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="mid_spe_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control mid_spe_expiry mid_spe_expiry-${i}" type="date" name="mid_spe_expiry[]">
                          <span id="midspeexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control midspe_upload_certification mid_spe_imgs_${res_one} midspe_upload_certification-${i}" 
                                type="file" name="midspe_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqmidspeuploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="mid_spe_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);
                }
            }
        });

        // $('.js-example-basic-multiple[data-list-id="spec_area_data"]').on('change', function(){
        //     let selectedValues = $(this).val();
        //     var spec_area_data = [];
        //     $('.spec_area_div').removeClass('d-none');
        //     $(".spec_area_div h6").each(function(){
        //       var text = $(this).text();
        //       if(selectedValues.includes(text) == false){
        //         let res = text.split(' ')[0];
        //         let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        //         //console.log("res_one",res_one);
        //         $(".spec_area_"+res_one).remove();
        //       }
        //       spec_area_data.push(text);
        //     });
        //     //console.log("selectedValues",selectedValues);

        //     // $(".spec_area_div").empty();

        //     for(var i = 0;i<selectedValues.length;i++){
        //       var selected_text = selectedValues[i].replace(/ .*/,'').replace(/[^\w\s]/gi, '').toLowerCase();
        //       let res = selectedValues[i].split(' ')[0];
        //       let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
        //       //console.log("res_one",res_one);

        //       if(spec_area_data.includes(selectedValues[i]) == false){            
        //         var user_id = "{{ $user_id }}";
        //         var img_text = "spec_area_imgs";
        //         $(".spec_area_div").append(`
        //           <div class="spec_area_${res_one} spec_area_${selected_text}">
        //               <h6 class="mid_spe_head_${selected_text}">${selectedValues[i]}</h6>
        //               <input type="hidden" name="specareaarr[]" class="spec_area_input_${selectedValues[i]}" value="${selectedValues[i]}">

        //               <div class="spec_area_div row spec_area_institution">
        //                   <!-- Institution/Regulating Body -->
        //                   <div class="form-group col-md-12">
        //                       <label class="form-label" for="input-1">Institution/Regulating Body</label>
        //                       <input class="form-control spec_area_institution spec_area_institution-${i}" type="text" name="spec_area_institution[]">
        //                       <span id="specareainstitutionvalid-${i}" class="reqError text-danger valley"></span>
        //                   </div>

        //                   <!-- Start Date -->
        //                   <div class="form-group col-md-6">
        //                       <label class="form-label" for="input-1">Start Date</label>
        //                       <input class="form-control spec_area_start_date spec_area_start_date-${i}" type="date" name="spec_area_start_date[]">
        //                       <span id="spec_area_start_datevalid-${i}" class="reqError text-danger valley"></span>
        //                   </div>

        //                   <!-- End Date -->
        //                   <div class="form-group col-md-6">
        //                       <label class="form-label" for="input-1">End Date</label>
        //                       <input class="form-control spec_area_end_date spec_area_end_date-${i}" type="date" name="spec_area_end_date[]">
        //                       <span id="spec_area_end_datevalid-${i}" class="reqError text-danger valley"></span>
        //                   </div>

        //                   <!-- Status -->
        //                   <div class="form-group col-md-6">
        //                       <label class="form-label" for="input-1">Status</label>
        //                       <select class="form-control spec_area_status spec_area_status-${i}" name="spec_area_status[]">
        //                           <option value="Completed">Completed</option>
        //                           <option value="Ongoing">Ongoing</option>
        //                           <option value="Pending">Pending</option>
        //                       </select>
        //                       <span id="spec_area_statusvalid-${i}" class="reqError text-danger valley"></span>
        //                   </div>

        //                   <!-- Expiry -->
        //                   <div class="form-group col-md-6">
        //                       <label class="form-label" for="input-1">Expiry</label>
        //                       <input class="form-control spec_area_expiry spec_area_expiry-${i}" type="date" name="spec_area_expiry[]">
        //                       <span id="specareaexpiryvalid-${i}" class="reqError text-danger valley"></span>
        //                   </div>

        //                   <!-- Upload Certificate/Licence -->
        //                   <div class="form-group col-md-12">
        //                       <label class="form-label" for="input-1">Upload Certificate/Licence</label>
        //                       <input class="form-control specarea__upload_certification spec_area_imgs_${res_one} specarea_upload_certification-${i}" 
        //                             type="file" name="specarea_upload_certification[${i}][]" 
        //                             onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
        //                       <span id="reqspecarea uploadvalid-${i}" class="reqError text-danger valley"></span>
        //                       <div class="spec_area_imgs${res_one}"></div>
        //                   </div>
        //               </div>
        //           </div>
        //       `);


        //       }
        //     }      
        // });
        $('.js-example-basic-multiple[data-list-id="spec_area_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var spec_area_data = [];

            // Hide and clear unnecessary elements
            $('.spec_area_div').removeClass('d-none');
            $(".spec_area_div h6").each(function() {
                var text = $(this).text();
                if (!selectedValues.includes(text)) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    $(".spec_area_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "spec_area_imgs");
                }
                spec_area_data.push(text);
            });

            //console.log("selectedValues", selectedValues);

            // Accumulate HTML in a variable
            var newContent = "";

            // Loop through selected values and generate the necessary fields
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                //console.log("res_one", res_one);

                if (spec_area_data.indexOf(selectedValues[i]) === -1) {
                    var user_id = "{{ $user_id }}";
                    var img_text = "spec_area_imgs";

                    // Append HTML content for this selection
                    newContent += `
                <div class="spec_area_${res_one} spec_area_${selected_text}">
                    <h6 class="mid_spe_head_${selected_text}">${selectedValues[i]}</h6>
                    <input type="hidden" name="specareaarr[]" class="spec_area_input_${selectedValues[i]}" value="${selectedValues[i]}">
                    
                    <div class="spec_area_div row spec_area_institution">
                        <!-- Institution/Regulating Body -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Institution/Regulating Body</label>
                            <input class="form-control spec_area_institution spec_area_institution-${i}" type="text" name="spec_area_institution[]">
                            <span id="specareainstitutionvalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Start Date -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Start Date</label>
                            <input class="form-control spec_area_start_date spec_area_start_date-${i}" type="date" name="spec_area_start_date[]">
                            <span id="spec_area_start_datevalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- End Date -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">End Date</label>
                            <input class="form-control spec_area_end_date spec_area_end_date-${i}" type="date" name="spec_area_end_date[]">
                            <span id="spec_area_end_datevalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Status -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Status</label>
                            <select class="form-control spec_area_status spec_area_status-${i}" name="spec_area_status[]">
                                <option value="Completed">Completed</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Pending">Pending</option>
                            </select>
                            <span id="spec_area_statusvalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Expiry -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input class="form-control spec_area_expiry spec_area_expiry-${i}" type="date" name="spec_area_expiry[]">
                            <span id="specareaexpiryvalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Upload Certificate/Licence -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                            <input class="form-control specarea__upload_certification spec_area_imgs_${res_one} specarea_upload_certification-${i}" 
                                type="file" name="specarea_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                            <span id="reqspecarea uploadvalid-${i}" class="reqError text-danger valley"></span>
                            <div class="spec_area_imgs${res_one}"></div>
                        </div>
                    </div>
                </div>`;
                }
            }

            // Append all new content at once
            $(".spec_area_div").append(newContent);
        });


        $('.js-example-basic-multiple[data-list-id="safety_com_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var safety_com_data = [];
            $('.safety_com_div').removeClass('d-none');
            $(".safety_com_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    //console.log("res_one", res_one);
                    $(".safety_com_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "safety_com_imgs");
                }
                safety_com_data.push(text);
            });
            //console.log("selectedValues", selectedValues);

            // $(".safety_com_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                //console.log("res_one", res_one);

                if (safety_com_data.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $user_id }}";
                    var img_text = "safety_com_imgs";
                    $(".safety_com_div").append(`
              <div class="safety_com_${res_one} safety_com_${selected_text}">
                  <h6 class="safety_com_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="safetycomaarr[]" class="safety_com_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="safety_com_institution  row safety_com_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control safety_com_institution safety_com_institution-${i}" type="text" name="safety_com_institution[]">
                          <span id="safetycominstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control safety_com_start_date safety_com_start_date-${i}" type="date" name="safety_com_start_date[]">
                          <span id="safety_com_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control safety_com_end_date safety_com_end_date-${i}" type="date" name="safety_com_end_date[]">
                          <span id="safety_com_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control safety_com_status safety_com_status-${i}" name="safety_com_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="safety_com_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control safety_com_expiry safety_com_expiry-${i}" type="date" name="safety_com_expiry[]">
                          <span id="safetycomexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control safetycome_upload_certification safety_com_imgs_${res_one} safetycome_upload_certification-${i}" 
                                type="file" name="safetycome_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqsafetycome uploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="safety_com_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);


                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="emerging_topic_data"]').on('change', function() {
            let selectedValues = $(this).val();
            //     let selectedIds = [];
            //      let selectedDataIds = [];


            //    selectedValues.forEach(function(value) {
            //         // Use jQuery to find the <li> element by its text and get the data-value
            //         let dataId = $('#emerging_topic_data li').filter(function() {
            //             return $(this).text() === value;
            //         }).data('id');

            //         // Add the found dataId to the selectedIds array if it exists
            //         if (dataId !== undefined) {
            //             selectedIds.push(dataId);
            //         }
            //     });

            var emerging_topic_data = [];
            $('.emerging_topic_div').removeClass('d-none');
            $(".emerging_topic_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    // Find the corresponding dataId for the text from the list
                    // let dataId = $('#emerging_topic_data li').filter(function() {
                    //     return $(this).text() === text;
                    // }).data('id');  // Get the associated data-id

                    // let res_one = res_1 + '_' +dataId;

                    $(".eme_topic_" + res_one).remove();
                    var user_id = "{{ $user_id }}";
                    deleteDatabaseImgs(user_id, "eme_topic_imgs");
                }
                emerging_topic_data.push(text);
            });
            //console.log("selectedValues", selectedValues);

            // $(".emerging_topic_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                //   let selectedId = selectedIds[i];

                //   let res_one = res_1+'_'+selectedId;

                if (emerging_topic_data.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $user_id }}";
                    var img_text = "eme_topic_imgs";
                    $(".emerging_topic_div").append(`
              <div class="eme_topic_${res_one} eme_topic_${selected_text}">
                  <h6 class="eme_topic_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="emetopicarr[]" class="eme_topic_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="eme_topic_div row eme_topic_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control eme_topic_institution eme_topic_institution-${i}" type="text" name="eme_topic_institution[]">
                          <span id="emetopicinstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control eme_topic_start_date eme_topic_start_date-${i}" type="date" name="eme_topic_start_date[]">
                          <span id="eme_topic_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control eme_topic_end_date eme_topic_end_date-${i}" type="date" name="eme_topic_end_date[]">
                          <span id="eme_topic_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control eme_topic_status eme_topic_status-${i}" name="eme_topic_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="eme_topic_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control eme_topic_expiry eme_topic_expiry-${i}" type="date" name="eme_topic_expiry[]">
                          <span id="emetopicexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control emetopic_upload_certification eme_topic_imgs_${res_one} emetopic_upload_certification-${i}" 
                                type="file" name="emetopic_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqemetopic uploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="eme_topic_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);


                }
            }
        });

        if ($(".man_training").val() != "") {
            var man_training = JSON.parse($(".man_training").val());
            $('.js-example-basic-multiple[data-list-id="mandatory_courses"]').select2().val(man_training).trigger('change');
        }

        if ($(".man_education").val() != "") {
            var man_education = JSON.parse($(".man_education").val());
            $('.js-example-basic-multiple[data-list-id="mandatory_education"]').select2().val(man_education).trigger('change');
        }
        if ($(".emr_data").val() != "") {
            var emr_data = JSON.parse($(".emr_data").val());
            $('.js-example-basic-multiple[data-list-id="emerging_topic_data"]').select2().val(emr_data).trigger('change');
        }
        if ($(".safety_data").val() != "") {
            var safety_data = JSON.parse($(".safety_data").val());
            //console.log(safety_data);
            $('.js-example-basic-multiple[data-list-id="safety_com_data"]').select2().val(safety_data).trigger('change');
        }

        if ($(".well_sel_data").val() != "") {
            var well_data = JSON.parse($(".well_sel_data").val());
            $('.js-example-basic-multiple[data-list-id="well_self_care_data"]').select2().val(well_data).trigger('change');
        }

        if ($(".tech_innvo_data").val() != "") {
            var tech_data = JSON.parse($(".tech_innvo_data").val());
            $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').select2().val(tech_data).trigger('change');
        }

        if ($(".lead_data").val() != "") {
            var lead_data = JSON.parse($(".lead_data").val());
            $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').select2().val(lead_data).trigger('change');
        }

        if ($(".mid_data").val() != "") {
            var mid_data = JSON.parse($(".mid_data").val());
            $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').select2().val(mid_data).trigger('change');
        }

        if ($(".cli_data").val() != "") {
            var cli_data = JSON.parse($(".cli_data").val());
            $('.js-example-basic-multiple[data-list-id="clinic_skill_core_data"]').select2().val(cli_data).trigger('change');
        }

        if ($(".spec_area_data").val() != "") {
            var spec_area_data = JSON.parse($(".spec_area_data").val());
            $('.js-example-basic-multiple[data-list-id="spec_area_data"]').select2().val(spec_area_data).trigger('change');
        }

        if ($(".mid_spe_data").val() != "") {
            var mid_spe_data = JSON.parse($(".mid_spe_data").val());
            $('.js-example-basic-multiple[data-list-id="mid_spe_mandotry_data"]').select2().val(mid_spe_data).trigger('change');
        }


    });
</script>

<script type="text/javascript">
    var ano_img_txt = "other_tran_img";

    function add_listtraining() {
        var training_div_count = $(".another_com_tra_div").length;
        //console.log("training_div_count", training_div_count);
        training_div_count++;
        var user_id = "{{ $user_id }}";
        // var ano_img_txt = "other_tran_img";
        var name = 'tran' + '_' + training_div_count;
        // $(".another_com_training").append('<div class="training_div training_div_'+training_div_count+' row another_com_tra_div"><div class="form-group col-md-6"><label class="form-label" for="input-1">Training '+training_div_count+'</label><input class="form-control additional_tra_field additional_tra_field-'+training_div_count+'" type="text" name="training[]"><span id="reqtraname-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control institution institution-'+training_div_count+'" type="text" name="institution[]"><span id="reqinstitution-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control tra_start_date tra_start_date-'+training_div_count+'" type="date" name="tra_start_date[]"><span id="reqtrastartdate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End Date</label><input class="form-control tra_end_date tra_end_date-'+training_div_count+'" type="date" name="tra_end_date[]"><span id="reqtraenddate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control tra_expiry tra_expiry-'+training_div_count+'" type="date" name="tra_expiry[]"><span id="reqtra_expiry-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control '+name+' additional_certifications-'+training_div_count+'" type="file" name="certificate_upload_certification['+training_div_count+'][]" onchange="changeAnoImg('+user_id+','+training_div_count+','+ano_img_txt+','+name+')" multiple></div><div class="'+ano_img_txt+training_div_count+'"></div><div class="col-md-12"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_training('+training_div_count+')">- Delete Training</a></div></div></div>');
        $(".another_com_training").append(`
        <div class="training_div training_div_${training_div_count} row another_com_tra_div">
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Training ${training_div_count}</label>
                <input class="form-control additional_tra_field additional_tra_field-${training_div_count}" type="text" name="training[]">
                <span id="reqtraname-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                <input class="form-control institution institution-${training_div_count}" type="text" name="institution[]">
                <span id="reqinstitution-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Training Start Date</label>
                <input class="form-control tra_start_date tra_start_date-${training_div_count}" type="date" name="tra_start_date[]">
                <span id="reqtrastartdate-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Training End Date</label>
                <input class="form-control tra_end_date tra_end_date-${training_div_count}" type="date" name="tra_end_date[]">
                <span id="reqtraenddate-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Expiry</label>
                <input class="form-control tra_expiry tra_expiry-${training_div_count}" type="date" name="tra_expiry[]">
                <span id="reqtra_expiry-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Upload Certificate</label>
                <input class="form-control other_tran_img_${name} additional_certifications-${training_div_count}" 
                       type="file" 
                       name="certificate_upload_certification[${training_div_count}][]" 
                       onchange="changeAnoImg(${user_id}, ${training_div_count}, '${ano_img_txt}', '${name}')" 
                       multiple>
                <div class="other_tran_img${name} mt-2"></div>
            </div>
            
            <div class="col-md-12">
                <div class="add_new_certification_div mb-3 mt-3">
                    <a style="cursor: pointer;" onclick="delete_training(${training_div_count})">- Delete Training</a>
                </div>
            </div>
        </div>
    `);
    }

    function delete_training(i, user_id, training_id) {
        var user_id = "{{$user_id}}";
        var fldname = 'other_tran_img';
        var type = 'training';

        deleteDatabaseothimg(user_id, i, fldname, type)

        $(".training_div_" + i).remove();
    }

    function deleteDatabaseothimg(user_id, i, fldname, type) {

        var user_id = user_id;
        var tra_id = i;
        var fldname = fldname;
        var type = type;
        $.ajax({
            type: "post",
            url: "{{ route('nurse.deleteotherImg') }}",
            data: {
                user_id: user_id,
                training_id: tra_id,
                fldname: fldname,
                type: type,
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            success: function(data) {
                if (data == 1) {
                    // $(".another_com_training" + i).remove();
                }
            }
        });
    }

    // for education

    // //console.log("training_div_count",training_div_count);
    function add_listeduction() {
        var education_div_count = $(".another_edu_div").length;
        education_div_count++;
        var user_id = "{{ $user_id }}";
        var ano_edu_img_txt = 'ano_education_imgs'
        var name = 'edu' + '_' + education_div_count;
        // $(".another_education").append('<div class="training_div training_div_'+training_div_count+' row another_com_tra_div"><div class="form-group col-md-6"><label class="form-label" for="input-1">Training '+training_div_count+'</label><input class="form-control additional_tra_field additional_tra_field-'+training_div_count+'" type="text" name="training[]"><span id="reqtraname-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control institution institution-'+training_div_count+'" type="text" name="institution[]"><span id="reqinstitution-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control tra_start_date tra_start_date-'+training_div_count+'" type="date" name="tra_start_date[]"><span id="reqtrastartdate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End Date</label><input class="form-control tra_end_date tra_end_date-'+training_div_count+'" type="date" name="tra_end_date[]"><span id="reqtraenddate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control tra_expiry tra_expiry-'+training_div_count+'" type="date" name="tra_expiry[]"><span id="reqtra_expiry-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control additional_certifications-'+training_div_count+'" type="file" name="certificate_upload_certification['+training_div_count+'][]" onchange="changeImg2('+user_id+','+training_div_count+')" multiple></div><div class="col-md-12"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_training('+training_div_count+')">- Delete certification/Licence</a></div></div></div>');
        $(".another_education").append(`
    <div class="eduction_div eduction_div_${education_div_count} row another_edu_div">
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Course/Workshop ${education_div_count}</label>
            <input class="form-control additional_course_field additional_course_field-${education_div_count}" 
                   type="text" name="education[]">
            <span id="reqeduname-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Institution/Regulating Body</label>
            <input class="form-control institution institution-${education_div_count}" 
                   type="text" name="institution[]">
            <span id="reqinstitution-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Start Date</label>
            <input class="form-control start_date start_date-${education_div_count}" 
                   type="date" name="start_date[]">
            <span id="reqstartdate-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">End Date</label>
            <input class="form-control end_date end_date-${education_div_count}" 
                   type="date" name="end_date[]">
            <span id="reqenddate-${education_div_count}" class="reqError text-danger valley"></span>
        </div>

        <!-- Status -->
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Status</label>
            <select class="form-control edu_status edu_status-${education_div_count}" name="edu_status[]">
                <option value="Completed">Completed</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Pending">Pending</option>
            </select>
            <span id="edu_statusvalid-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Expiry</label>
            <input class="form-control edu_expiry edu_expiry-${education_div_count}" 
                   type="date" name="edu_expiry[]">
            <span id="reqedu_expiry-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Upload Certificate/Licence</label>
            <input class="form-control ano_education_imgs_${name} additional_cour_certifications-${education_div_count}" 
                   type="file" name="cour_certificate_upload_certification[${education_div_count}][]" 
                   onchange="changeAnoImg(${user_id}, ${education_div_count},'${ano_edu_img_txt}','${name}')" multiple>
                   <div class="ano_education_imgs${name}" ></div>
        </div>
        
        <div class="col-md-12">
            <div class="add_new_certification_div mb-3 mt-3">
                <a style="cursor: pointer;" onclick="delete_edu(${education_div_count})">
                    - Delete Continuing Education
                </a>
            </div>
        </div>
        
    </div>
`);
    }

    function delete_edu(i, user_id, education_id) {
        var user_id = "{{$user_id}}";
        var fldname = 'ano_education_imgs';
        var type = 'education';

        deleteDatabaseothimg(user_id, i, fldname, type)
        $(".eduction_div_" + i).remove();
    }

    function delete_certification1(i) {
        var user_id = "{{$user_id}}";
        var fldname = 'ano_certifi_imgs';
        var type = 'certificate';
        deleteDatabaseothimg(user_id, i, fldname, type)
        $(".license_number_div_" + i).remove();
    }


    function changetraImg1(user_id, i, field_name, cat_name) {

        var files = $('.' + field_name + '_' + cat_name)[0].files;

        var form_data = "";

        form_data = new FormData();

        for (var i = 0; i < files.length; i++) {
            form_data.append("upload_images[]", files[i], files[i]['name']);
        }

        form_data.append("user_id", user_id);
        form_data.append("cat_name", cat_name);
        form_data.append("field_name", field_name);
        form_data.append("_token", '{{ csrf_token() }}');

        $.ajax({
            type: "post",
            url: "{{ route('nurse.uploadmantraImgs1') }}",
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            data: form_data,

            success: function(data) {
                var image_array = JSON.parse(data);
                var htmlData = '';
                //console.log("data", image_array);
                for (var i = 0; i < image_array.length; i++) {
                    //console.log("degree_transcript", image_array[i]);
                    var img_name = image_array[i];
                    var img_text = field_name;
                    //console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
                    htmlData += '<div class="trans_img trans_img-' + (i + 1) + ' trans_img' + field_name + cat_name + i + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteImg1(' + i + ',' + user_id + ',\'' + image_array[i] + '\',\'' + cat_name + '\',\'' + img_text + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
                }
                $("." + field_name + cat_name).html(htmlData);


            }
        });

    }

    // change image for another training and education
    function changeAnoImg(user_id, i, field_name, cat_name) {
        var files = $('.' + field_name + '_' + cat_name)[0].files;

        var form_data = "";

        form_data = new FormData();

        for (var i = 0; i < files.length; i++) {
            form_data.append("upload_images[]", files[i], files[i]['name']);
        }

        form_data.append("user_id", user_id);
        form_data.append("cat_name", cat_name);
        form_data.append("field_name", field_name);
        form_data.append("_token", '{{ csrf_token() }}');

        $.ajax({
            type: "post",
            url: "{{ route('nurse.uploadAnotherImgs') }}",
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            data: form_data,

            success: function(data) {
                var image_array = JSON.parse(data);
                var htmlData = '';
                //console.log("data", image_array);
                for (var i = 0; i < image_array.length; i++) {
                    //console.log("degree_transcript", image_array[i]);
                    var img_name = image_array[i];
                    var img_text = field_name;
                    //console.log("img_name", 'deleteanoImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
                    htmlData += '<div class="trans_img edu_img-' + (i + 1) + ' edu_img' + field_name + 'tran_' + (i) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteanoImg1(' + i + ',' + user_id + ',\'' + image_array[i] + '\',\'' + cat_name + '\',\'' + img_text + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
                }
                $("." + field_name + cat_name).html(htmlData);
            }
        });

    }

    function ExpEmpStatus(value) {
        if (value == "Permanent") {
            $(".exp_permanent").show();
            $(".exp_temporary").hide();
        } else {
            if (value == "Temporary") {
                $(".exp_temporary").show();
                $(".exp_permanent").hide();
            }
        }
    }

    function add_work_experience() {
        var previous_employeers_head = $(".previous_employeers_head").length;

        previous_employeers_head++;
        $(".previous_employeers").append(`
            <div class="work_exp_${previous_employeers_head}">
            <h6 class="emergency_text previous_employeers_head">Work Experience ${previous_employeers_head}</h6>
            <div class="form-group drp--clr">
                <label class="form-label" for="input-1">Type of Nurse?</label>
                <input type="hidden" name="user_id" class="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
        
                <ul id="type-of-nurse-experience-${previous_employeers_head}" style="display:none;">
                @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                <?php
                $j = 1;
                ?>
                @foreach($specialty as $spl)
                <li id="nursing_menus-{{ $j }}" data-value="{{ $spl->id }}">{{ $spl->name }}</li>
                <?php
                $j++;
                ?>
                @endforeach
                </ul>
                <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="type-of-nurse-experience-${previous_employeers_head}" name="nurseType[${previous_employeers_head}][]" id="nurse_type_experience" multiple="multiple"></select>
            </div>
            <div class="result--show">
                <div class="container p-0">
                    <div class="row g-2">
                    @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                    <?php
                    $i = 1;
                    ?>

                    @foreach($specialty as $spl)
                    <?php
                    $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->orderBy('name')->get();
                    ?>
                    <input type="hidden" name="nursing_result_experience" class="nursing_result_experience-${previous_employeers_head}-{{ $i }}" value="{{ $spl->id }}">
                    <div class="nursing_data form-group drp--clr col-md-12 d-none drpdown-set nursing_{{ $spl->id }}" id="nursing_level_experience-${previous_employeers_head}-{{ $i }}">
                        <label class="form-label" for="input-2">{{ $spl->name }}</label>
                        <ul id="nursing_entry_experience-${previous_employeers_head}-{{ $i }}" style="display:none;">
                        @foreach($nursing_data as $nd)
                        <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                        @endforeach
                        </ul>
                        <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="nursing_entry_experience-${previous_employeers_head}-{{ $i }}" name="nursing_type_{{ $i }}[${previous_employeers_head}][]" multiple="multiple"></select>
                    </div>
                    <?php
                    $i++;
                    ?>
                    @endforeach
                    </div>

                </div>
            </div>
            <div class="np_submenu_experience_${previous_employeers_head} d-none">
                <div class="form-group drp--clr">
                    <?php
                    $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                    ?>
                    <label class="form-label" for="input-1">Nurse Practitioner (NP):</label>
                    <ul id="nurse_practitioner_menu_experience-${previous_employeers_head}" style="display:none;">
                    @foreach($np_data as $nd)
                    <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                    @endforeach
                    </ul>
                    <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="nurse_practitioner_menu_experience-${previous_employeers_head}" name="nurse_practitioner_menu_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                </div>
            </div>
            <div class="condition_set">
                <div class="form-group drp--clr">
                    <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                    <label class="form-label" for="input-1">Specialties</label>
                    <ul id="specialties_experience-${previous_employeers_head}" style="display:none;">
                        @php $JobSpecialties = JobSpecialties(); @endphp
                        <?php
                        $k = 1;
                        ?>
                        @foreach($JobSpecialties as $ptl)
                        <li id="nursing_menus-{{ $k }}" data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                        <?php
                        $k++;
                        ?>
                        @endforeach
                    </ul>
                    <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="specialties_experience-${previous_employeers_head}" name="specialties_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                </div>
                <span id="reqspecialties" class="reqError text-danger valley"></span>
            </div>
            <div class="speciality_boxes row result--show">
                <?php
                $l = 1;
                ?>
                @foreach($JobSpecialties as $ptl)
                <?php
                $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                ?>
                <input type="hidden" name="speciality_result" class="speciality_result_experience-${previous_employeers_head}-{{ $l }}" value="{{ $ptl->id }}">
                <div class="speciality_data form-group drp--clr drpdown-set d-none col-md-12 speciality_{{ $ptl->id }}" id="specility_level_experience-${previous_employeers_head}-{{ $l }}">
                    <label class="form-label" for="input-2">{{ $ptl->name }}</label>
                    <ul id="speciality_entry_experience-${previous_employeers_head}-{{ $l }}" style="display:none;">
                    @foreach($speciality_data as $sd)
                    <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>

                    @endforeach
                    </ul>
                    <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="speciality_entry_experience-${previous_employeers_head}-{{ $l }}" name="speciality_entry_experience_{{ $l }}[${previous_employeers_head}][]" multiple="multiple"></select>

                </div>
                <?php
                $l++;
                ?>
                @endforeach
            </div>
            <div class="specialty_entry_one_experience"></div>
            <div class="specialty_entry_two_experience"></div>
            <div class="surgical_div_experience">
                <div class="surgical_row_data_experience-${previous_employeers_head} form-group drp--clr d-none col-md-12">
                    <label class="form-label" for="input-1">Surgical Preoperative and Postoperative Care:</label>
                    <?php
                    $speciality_surgicalrow_data = DB::table("speciality")->where('parent', '96')->get();
                    $r = 1;
                    ?>
                    <ul id="surgical_row_box_experience-${previous_employeers_head}" style="display:none;">
                    @foreach($speciality_surgicalrow_data as $ssrd)
                      <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                    @endforeach
                    </ul>
                    <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_row_box_experience-${previous_employeers_head}" name="surgical_row_box_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                </div>
            </div>
            <div class="paediatric_surgical_div_experience-${previous_employeers_head}">
                <div class="surgicalpad_row_data_experience-${previous_employeers_head} form-group drp--clr d-none col-md-12">
                    <label class="form-label" for="input-1">Paediatric Surgical Preop. and Postop. Care:
                    </label>
                    <?php
                    $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                    $r = 1;
                    ?>
                    <ul id="surgical_rowpad_box_experience-${previous_employeers_head}" style="display:none;">
                    @foreach($speciality_padsurgicalrow_data as $ssrd)
                    <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                    @endforeach
                    </ul>
                    <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_rowpad_box_experience-${previous_employeers_head}" name="surgical_rowpad_box_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                </div>
            </div>
            
            <div class="specialty_sub_boxes_experience-${previous_employeers_head} row">
                <?php
                $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                $w = 1;
                ?>
                @foreach($speciality_surgical_data as $ssd)
                <input type="hidden" name="speciality_result" class="speciality_surgical_result_experience-${previous_employeers_head}-{{ $w }}" value="{{ $ssd->id }}">
                <div class="surgical_row_experience-${previous_employeers_head}-{{ $w }} surgical_sub-${previous_employeers_head}  surgicalopcboxes-{{ $ssd->id }} form-group drp--clr d-none drpdown-set">
                    <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                    <?php
                    $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                    ?>
                    <ul id="surgical_operative_care_experience-${previous_employeers_head}-{{ $w }}" style="display:none;">
                    @foreach($speciality_surgicalsub_data as $sssd)
                    <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                    @endforeach
                    </ul>
                    <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_operative_care_experience-${previous_employeers_head}-{{ $w }}" name="surgical_operative_care_exp_{{ $w }}[${previous_employeers_head}][]" multiple="multiple"></select>
                    @foreach($speciality_surgicalsub_data as $sssd)


                    <div class="d-none form-group level-drp level_id-{{ $sssd->id }}">
                    <label class="form-label" for="input-1">What is your Level of experience in {{ $sssd->name }}:

                    </label>
                    <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                    <select class="form-input mr-10 select-active" name="assistent_level">

                        @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if(Auth::guard('nurse_middle')->user()->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                        @endfor
                    </select>
                    </div>

                    @endforeach
                </div>
                <?php
                $w++;
                ?>

                @endforeach
                <div class="surgical_operative_care_level_experience"></div>
                <div class="surgical_operative_care_level_experience_two"></div>
                <div class="surgical_operative_care_level_experience_three"></div>
                <?php
                $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                $p = 1;
                ?>

                <div class="surgicalobs_row_experience-${previous_employeers_head} form-group drp--clr d-none drpdown-set col-md-12">
                    <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>

                    <ul id="surgicalobs_row_data_experience-${previous_employeers_head}" style="display:none;">
                    @foreach($speciality_surgical_datamater as $ssd)
                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                    @endforeach
                    </ul>
                    <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgicalobs_row_data_experience-${previous_employeers_head}" name="surgical_obs_care_exp[${previous_employeers_head}][]" multiple="multiple"></select>
                </div>
                <?php
                $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();

                ?>
                <div class="neonatal_row_experience-${previous_employeers_head} form-group drp--clr drpdown-set d-none col-md-12">
                    <label class="form-label" for="input-1">Neonatal Care:</label>

                    <ul id="neonatal_care_experience-${previous_employeers_head}" style="display:none;">
                    @foreach($speciality_surgical_datamater as $ssd)
                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                    @endforeach
                    </ul>
                    <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="neonatal_care_experience-${previous_employeers_head}" name="neonatal_care_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                </div>
                <div class="neonatal_care_experience_level-${previous_employeers_head}"></div>
                <?php
                $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                $q = 1;
                ?>
                @foreach($speciality_surgical_datap as $ssd)
                <input type="hidden" name="speciality_result" class="surgical_rowp_result_experience-${previous_employeers_head}-{{ $q }}" value="{{ $ssd->id }}">
                <div class="surgical_rowp_experience-${previous_employeers_head} surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_experience-${previous_employeers_head}-{{ $q }} form-group drp--clr d-none drpdown-set col-md-4">
                    <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                    <?php
                    $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                    ?>
                    <ul id="surgical_operative_carep_experience-${previous_employeers_head}-{{ $q }}" style="display:none;">
                    @foreach($speciality_surgicalsub_data as $sssd)
                    <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                    @endforeach
                    </ul>
                    <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_operative_carep_experience-${previous_employeers_head}-{{ $q }}" name="surgical_operative_carep_experience_{{ $q }}[${previous_employeers_head}][]" multiple="multiple"></select>
                </div>
                <?php
                $q++;
                ?>
                @endforeach
                <div class="surgical_operative_carep_level_one"></div>
                <div class="surgical_operative_carep_level_two"></div>
                <div class="surgical_operative_carep_level_three"></div>
            </div>
            <div class="form-group level-drp">
                <label class="form-label" for="input-1">What is your Level of experience in this specialty?
                </label>
                <select class="form-control mr-10 select-active" name="exper_assistent_level[${previous_employeers_head}]">
                    @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                    @endfor
                </select>
            </div>
            
            <div class="form-group level-drp">
                <label class="form-label" for="positions_held">Position Held</label>
                <select class="form-control" name="positions_held[${previous_employeers_head}]" id="positions_held">
                    <option value="">Position Held</option>
                    <option value="Team Member">Team Member</option>
                    <option value="Team Leader">Team Leader</option>
                    <option value="Educator">Educator</option>
                    <option value="Manager">Manager</option>
                    <option value="Clinical Specialist">Clinical Specialist</option>
                </select>
                <span id="reqpositionheld" class="reqError text-danger valley"></span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group level-drp">
                        <label class="form-label" for="start_date_${previous_employeers_head}">Employment Start Date</label>
                        <input class="form-control employeement_start_date employeement_start_date-${previous_employeers_head}" 
                                type="date" 
                                name="start_date[${previous_employeers_head}]" 
                                id="start_date_${previous_employeers_head}" 
                                onchange="changeEmployeementEndDate(${previous_employeers_head})">
                        <span id="reqempsdate" class="reqError text-danger valley"></span>
                    </div>
                </div>
                <div class="col-md-6 empl_end_date-${previous_employeers_head}">
                    <div class="form-group level-drp">
                        <label class="form-label" for="end_date_${previous_employeers_head}">Employment End Date</label>
                        <input class="form-control employeement_end_date-${previous_employeers_head}" 
                                type="date" 
                                name="end_date[${previous_employeers_head}]" 
                                id="end_date_${previous_employeers_head}">
                        <span id="reqemployeementenddate" class="reqError text-danger valley"></span>
                    </div>
                    <div class="declaration_box">
                        <input class="currently_position currently_position-${previous_employeers_head}" type="checkbox" name="present_box[${previous_employeers_head}][]" value="1" onclick="currently_position(${previous_employeers_head})">
                        I am currently in this position at the moment
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group level-drp">
                        <label class="form-label" for="employment_type">Employment type</label>
                          <select
                                class="form-control"
                                name="employeement_type[${previous_employeers_head}]"
                                id="employment_type_${previous_employeers_head}"
                                ">
                                <option value="">select</option>
                                <option value="Permanent" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Permanent") selected @endif>Permanent</option>
                                <option value="Temporary" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Temporary") selected @endif>Temporary</option>
                            </select>
                        <span id="reqemptype" class="reqError text-danger valley"></span>
                    </div>
                </div>
            </div>
            <div class="exp_permanent_${previous_employeers_head}" @if(Auth::guard('nurse_middle')->user()->permanent_status == NULL) style="display: none;" @endif>
            <div class="form-group col-md-12">
                <label class="form-label" for="input-1">Permanent</label>
                <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                <select class="form-control" name="permanent_status[${previous_employeers_head}]">
                <option value="">Select</option>
                <option value="Full-time" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Full-time") selected @endif>Full-time</option>
                <option value="Part-time" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Part-time") selected @endif>Part-time</option>
                <option value="Agency Nurse/Midwife" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Agency Nurse/Midwife") selected @endif>Agency Nurse/Midwife</option>
                <option value="Freelance" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Freelance") selected @endif>Freelance</option>
                <option value="Local" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Local") selected @endif>Local</option>
                <option value="Volunteer" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Volunteer") selected @endif>Volunteer</option>

                </select>
            </div>
            <span id="reqemployee_status" class="reqError text-danger valley"></span>
            </div>
            <div class="exp_temporary_${previous_employeers_head}" @if(Auth::guard('nurse_middle')->user()->temporary_status == NULL) style="display: none;" @endif>
            <div class="form-group col-md-12">
                <label class="form-label" for="input-1">Temporary</label>               
                <select class="form-control" name="temporary_status[${previous_employeers_head}]">
                <option value="">Select</option>
                <option value="Temporary">Temporary</option>
                <option value="Contract">Contract</option>
                <option value="Term Contract">Term Contract</option>
                <option value="Travel">Travel</option>
                <option value="Per Diem">Per Diem</option>
                <option value="Local">Local</option>
                <option value="On-Call">On-Call</option>
                <option value="PRN (Pro Re Nata)">PRN (Pro Re Nata)</option>
                <option value="Casual">Casual</option>
                <option value="Locum tenens (temporary substitute)">Locum tenens (temporary substitute)</option>
                <option value="Agency Nurse/Midwife">Agency Nurse/Midwife</option>
                <option value="Seasonal" >Seasonal</option>
                <option value="Freelance">Freelance</option>
                <option value="Internship">Internship</option>
                <option value="Apprenticeship">Apprenticeship</option>
                <option value="Residency">Residency</option>
                <option value="Volunteer">Volunteer</option>
                </select>
            </div>
            <span id="reqemployee_status" class="reqError text-danger valley"></span>
            </div>
            <h6 class="emergency_text">Detailed Job Descriptions</h6>
            <div class="form-group level-drp">
                <label class="form-label" for="job_responsibilities">Responsibilities</label>
                <textarea class="form-control" name="job_responeblities[${previous_employeers_head}]" id="job_responsibilities"></textarea>
                <span id="reqresposiblities" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group level-drp">
                <label class="form-label" for="achievements">Achievements</label>
                <textarea class="form-control" name="achievements[${previous_employeers_head}]" id="achievements"></textarea>
                <span id="reqachievements" class="reqError text-danger valley"></span>
            </div>
            <h6 class="emergency_text">
            Areas of Expertise
            </h6>
            <div class="form-group level-drp">
           
            <label class="form-label" for="input-1">Specific skills and competencies</label>
            <?php
            $skills = DB::table("skills")->where("parent_id", "1")->get();
            ?>
            <ul id="skills_compantancies-${previous_employeers_head}" style="display:none;">
                @foreach($skills as $cert)
                <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                @endforeach

            </ul>
            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="skills_compantancies-${previous_employeers_head}" name="skills_compantancies[${previous_employeers_head}][]" multiple="multiple"></select>
            </div>
            <span id="reqexpertise" class="reqError text-danger valley"></span>
            <div class="skills_compantancies_dropdowns-${previous_employeers_head}"></div>        
            <div class="form-group level-drp">
          
            <label class="form-label" for="input-1">Type of evidence</label>
            <?php
            $skills = DB::table("skills")->get();
            ?>
            <ul id="type_of_evidence" style="display:none;">
                <li data-value="Statement of Service">Statement of Service</li>
                <li data-value="Statutory Declaration">Statutory Declaration</li>
                <li data-value="Award">Award</li>
                <li data-value="Transcript">Transcript</li>
                <li data-value="Certificate">Certificate</li>
            </ul>
            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="type_of_evidence" name="type_of_evidence[${previous_employeers_head}][]" multiple="multiple"></select>
            <span id="reqtype_evidence" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group level-drp">
            <label class="form-label" for="input-1">Upload evidence</label>

            <input class="form-control" type="file" name="upload_evidence">
            
            <!-- <span id="reqachievements" class="reqError text-danger valley"></span> -->
            </div>

            <div class="col-md-12">
                    <!-- Add Delete Button -->
                    <div class="add_new_certification_div_2">
                        <a 
                            style="cursor: pointer; margin-bottom: 35px !important;" 
                            class="delete-work-experience_${previous_employeers_head}" 
                            data-index="${previous_employeers_head}">
                            - Delete Work Experience
                        </a>
                    </div>
                </div>
            </div>
        `);

        function ExpEmpStatus1(value, id) {
            if (value == "Permanent") {
                $(".exp_permanent_" + id).show();
                $(".exp_temporary_" + id).hide();
            } else {
                if (value == "Temporary") {
                    $(".exp_temporary_" + id).show();
                    $(".exp_permanent_" + id).hide();
                }
            }
        }

        $(document).on('change', '[id=employment_type_' + previous_employeers_head + ']', function() {
            var value = $(this).val();
            ExpEmpStatus1(value, previous_employeers_head);
        });




        $('.js-example-basic-multiple' + previous_employeers_head).each(function() {
            let listId1 = $(this).data('list-id');
            //alert(listId);
            let items1 = [];
            //console.log("listId1", listId1);
            $('#' + listId1 + ' li').each(function() {
                //console.log("value1", $(this).text());
                items1.push({
                    id: $(this).data('value'),
                    text: $(this).text()
                });
            });
            //console.log("items1", items1);
            $(this).select2({
                data: items1
            });
        });

        $('.js-example-basic-multiple' + previous_employeers_head).on('select2:open', function() {
            var searchBoxHtml = `
                            <div class="extra-search-container">
                            <input type="text" class="extra-search-box" placeholder="Search...">
                            <button class="clear-button" type="button">&times;</button>
                            </div>`;

            if ($('.select2-results').find('.extra-search-container').length === 0) {
                $('.select2-results').prepend(searchBoxHtml);
            }

            var $searchBox = $('.extra-search-box');
            var $clearButton = $('.clear-button');

            $searchBox.on('input', function() {

                var searchTerm = $(this).val().toLowerCase();
                $('.select2-results__option').each(function() {
                    var text = $(this).text().toLowerCase();
                    if (text.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                $clearButton.toggle($searchBox.val().length > 0);
            });

            $clearButton.on('click', function() {
                $searchBox.val('');
                $searchBox.trigger('input');
            });
        });

        // Add an additional search box and extra buttons to the dropdown
        $(".addAll_removeAll_btn").on("select2:open", function() {
            var $dropdown = $(this);
            var searchBoxHtml = `                    
                    <div class="extra-buttons">
                        <button class="select-all-button" type="button">Select All</button>
                        <button class="remove-all-button" type="button">Remove All</button>
                    </div>`;

            // Remove any existing extra buttons before adding new ones
            $(".select2-results .extra-search-container").remove();
            $(".select2-results .extra-buttons").remove();

            // Append the new extra buttons and search box
            $(".select2-results").prepend(searchBoxHtml);

            // Handle Select All button for the current dropdown
            $(".select-all-button").on("click", function() {
                var $currentDropdown = $dropdown;
                var allValues = $currentDropdown
                    .find("option")
                    .map(function() {
                        return $(this).val();
                    })
                    .get();
                $currentDropdown.val(allValues).trigger("change");
            });

            // Handle Remove All button for the current dropdown
            $(".remove-all-button").on("click", function() {
                var $currentDropdown = $dropdown;
                $currentDropdown.val(null).trigger("change");
            });
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="type-of-nurse-experience-' + previous_employeers_head + '"]').on('change', function() {
            // Your code here

            let selectedValues = $(this).val();

            var nurse_len = $("#type-of-nurse-experience-" + previous_employeers_head + " li").length;

            //console.log("nurse_len", nurse_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            for (var i = 1; i <= nurse_len; i++) {
                var nurse_result_val = $(".nursing_result_experience-" + previous_employeers_head + "-" + i).val();

                if (selectedValues.includes(nurse_result_val)) {
                    $('#nursing_level_experience-' + previous_employeers_head + '-' + i).removeClass('d-none');
                } else {
                    $('#nursing_level_experience-' + previous_employeers_head + '-' + i).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nursing_entry_experience-' + previous_employeers_head + " - " + i + '"]').select2().val(null).trigger('change');
                }
            }

            if (selectedValues.includes("3") == false) {
                $('.np_submenu_experience_' + previous_employeers_head).addClass('d-none');
                //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nurse_practitioner_menu_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nursing_entry_experience-' + previous_employeers_head + '-3"]').on('change', function() {
            let selectedValues = $(this).val();
            var nurse_len = $("#type-of-nurse-experience-" + previous_employeers_head + " li").length;
            //console.log("nurse_len", nurse_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("179")) {
                $('.np_submenu_experience_' + previous_employeers_head).removeClass('d-none');
                //console.log("selectedValues", selectedValues);
            } else {
                $('.np_submenu_experience_' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nurse_practitioner_menu_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="specialties_experience-' + previous_employeers_head + '"]').on('change', function() {

            let selectedValues = $(this).val();
            var speciality_len = $("#specialties_experience-" + previous_employeers_head + " li").length;

            //console.log("speciality_len", speciality_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            for (var k = 1; k <= speciality_len; k++) {
                var speciality_result_val = $(".speciality_result_experience-" + previous_employeers_head + '-' + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('#specility_level_experience-' + previous_employeers_head + '-' + k).removeClass('d-none');
                    //$(".sub_speciality_value").val(k);

                } else {
                    $('#specility_level_experience-' + previous_employeers_head + '-' + k).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-' + k + '"]').select2().val(null).trigger('change');

                    if (selectedValues.includes("1") == false) {
                        $('.surgical_row_experience-' + previous_employeers_head + k).addClass('d-none');
                        $('.surgical_row_data_experience-' + previous_employeers_head).addClass('d-none');
                        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
                    }
                }

            }

            if (selectedValues.includes("2") == false) {
                $('.surgicalobs_row_experience' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgicalobs_row_data_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("3") == false) {
                $('.surgicalpad_row_data_experience' + previous_employeers_head).addClass('d-none');
                $('.surgical_rowp_data_experience' + previous_employeers_head).addClass('d-none');
                $('.neonatal_row_experience' + previous_employeers_head).addClass('d-none');
                //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
            }


        });


        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-1"]').on('change', function() {
            let selectedValues = $(this).val();
            var speciality_entry = $("#speciality_entry_experience-" + previous_employeers_head + "-1 li").length;
            //console.log("speciality_entry", speciality_entry);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".surgical_row_data_experience-" + previous_employeers_head + "").insertAfter("#specility_level_experience-" + previous_employeers_head + "-1");
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues.includes("96"));
            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes("96")) {
                $('.surgical_row_data_experience-' + previous_employeers_head).removeClass('d-none');

            } else {
                $('.surgical_row_data_experience-' + previous_employeers_head).addClass('d-none ');
                $('.surgical_row_data_experience-' + previous_employeers_head).addClass('d-none ');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("96") == false) {
                // $('.surgical_row_experience' + previous_employeers_head).addClass('d-none ');
                $('.surgical_sub' + previous_employeers_head).addClass('d-none ');
                $('.js-example-basic-multiple1[data-list-id="surgical_row_box_experience' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
            // for(var k = 1;k<=speciality_entry;k++){
            //     var speciality_result_val = $(".speciality_result-"+k).val();
            //     //alert(speciality_result_val);
            //     if(selectedValues.includes(speciality_result_val)){

            //         $('#specility_level-'+k).removeClass('d-none');

            //     }else{
            //         $('#specility_level-'+k).addClass('d-none');
            //     }
            // }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience-' + previous_employeers_head + '"]').on('change', function() {
            let selectedValues = $(this).val();
            var speciality_entry = $("#surgical_row_box_experience-" + previous_employeers_head + " li").length;

            //console.log("surgical_row_data_experience-", previous_employeers_head);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".specialty_sub_boxes_experience-" + previous_employeers_head).insertAfter(".surgical_row_data_experience-" + previous_employeers_head);
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            // if(selectedValues.includes("97")){
            //     $('.surgical_row').removeClass('d-none');
            // }else{
            //     $('.surgical_row').addClass('d-none');
            // }

            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".speciality_surgical_result_experience-" + previous_employeers_head + '-' + k).val();
                //console.log("speciality_result_val", speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_row_experience-' + previous_employeers_head + '-' + k).removeClass('d-none');
                } else {
                    $('.surgical_row_experience-' + previous_employeers_head + '-' + k).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_operative_care_experience-' + previous_employeers_head + '-' + k + '"]').select2().val(null).trigger('change');
                }
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-2"]').on('change', function() {
            let selectedValues = $(this).val();

            var speciality_entry = $("#speciality_entry_experience-" + previous_employeers_head + "-2 li").length;

            //console.log("speciality_entry", speciality_entry);
            // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
            $(".surgicalobs_row_experience-" + previous_employeers_head).insertAfter("#specility_level_experience-" + previous_employeers_head + "-2");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes("233")) {
                $('.surgicalobs_row_experience-' + previous_employeers_head).removeClass('d-none');
            } else {
                $('.surgicalobs_row_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgicalobs_row_data_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-3"]').on('change', function() {
            let selectedValues = $(this).val();

            var speciality_entry = $("#speciality_entry_experience-" + previous_employeers_head + "-2 li").length;
            //console.log("speciality_entry", speciality_entry);
            $(".surgical_rowp_experience-" + previous_employeers_head).wrapAll("<div class='col-md-12 row surgical_rowp_data_experience-" + previous_employeers_head + "'>");
            $(".paediatric_surgical_div_experience-" + previous_employeers_head).insertAfter("#specility_level_experience-" + previous_employeers_head + "-3");


            //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
            $(".neonatal_row_experience-" + previous_employeers_head).insertAfter("#specility_level_experience-" + previous_employeers_head + "-3");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));


            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes('250')) {
                $('.neonatal_row_experience-' + previous_employeers_head).removeClass('d-none');
            } else {
                $('.neonatal_row_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="neonatal_care_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes('285')) {
                $('.surgicalpad_row_data_experience-' + previous_employeers_head).removeClass('d-none');
            } else {
                $('.surgicalpad_row_data_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_rowpad_box_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("285") == false) {
                $('.surgical_rowp_data_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_rowpad_box_experience-' + previous_employeers_head + '"]').on('change', function() {
            let selectedValues = $(this).val();

            var speciality_entry = $("#surgical_rowpad_box_experience-" + previous_employeers_head + " li").length;
            //console.log("speciality_entry", speciality_entry);
            // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
            $(".surgical_rowp_data_experience-" + previous_employeers_head).insertAfter(".surgicalpad_row_data_experience-" + previous_employeers_head);


            //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
            //     $(".neonatal_row_data").insertAfter("#specility_level-3");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //$('.result--show .form-group').addClass('d-none');



            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".surgical_rowp_result_experience-" + previous_employeers_head + '-' + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_rowp_experience-' + previous_employeers_head + '-' + k).removeClass('d-none');
                } else {
                    $('.surgical_rowp_experience-' + previous_employeers_head + '-' + k).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_operative_carep_experience-' + previous_employeers_head + '-' + k + '"]').select2().val(null).trigger('change');
                }
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="skills_compantancies-' + previous_employeers_head + '"]').on('change', function() {
            // Get selected values from the main category dropdown
            let selectedValues = $(this).val();

            // Keep track of existing dropdowns
            let existingDropdowns = [];
            $('.skills_compantancies_dropdowns-' + previous_employeers_head + ' .js-example-basic-multiple' + previous_employeers_head).each(function() {
                existingDropdowns.push($(this).data('list-id'));
            });

            // Loop through selected values
            selectedValues.forEach(function(value) {
                // Check if the dropdown for this ID already exists
                if (!existingDropdowns.includes(`skills_compantancies-${previous_employeers_head}-${value}`)) {
                    // Fetch submenu data for new IDs
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/nurse') }}/getSkillsData",
                        data: {
                            id: value,
                            _token: "{{ csrf_token() }}"
                        },
                        cache: false,
                        success: function(data) {
                            var skills = JSON.parse(data);
                            var skills_data = '';
                            skills.forEach(function(skill) {
                                skills_data += '<li data-value="' + skill.id + '">' + skill.name + '</li>';
                            });

                            // Create submenu HTML
                            var dropdownHtml = `
                                <div class="form-group level-drp">
                                <label class="form-label" for="input-1">${skills[0].parent_name}</label>
                                <ul id="skills_compantancies-${previous_employeers_head}-${skills[0].parent_id}" style="display:none;">
                                    ${skills_data}
                                </ul>
                                <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" 
                                        data-list-id="skills_compantancies-${previous_employeers_head}-${skills[0].parent_id}" 
                                        name="sub_skills_compantancies[${previous_employeers_head}][]" multiple="multiple">
                                </select>
                                </div>
                            `;

                            // Append the new dropdown
                            $(".skills_compantancies_dropdowns-" + previous_employeers_head).append(dropdownHtml);

                            // Populate the new dropdown with options
                            let listId1 = `skills_compantancies-${previous_employeers_head}-${skills[0].parent_id}`;
                            let items1 = [];

                            $('#' + listId1 + ' li').each(function() {
                                items1.push({
                                    id: $(this).data('value'),
                                    text: $(this).text()
                                });
                            });

                            let $newDropdown = $(`[data-list-id="${listId1}"]`);
                            $newDropdown.select2({
                                data: items1
                            });
                            // Add select all/remove all functionality
                            initializeSelect22($newDropdown);
                        }
                    });
                }
            });

            // Remove dropdowns for deselected IDs
            if (selectedValues && selectedValues.length > 0) {
                $('.skills_compantancies_dropdowns .js-example-basic-multiples' + previous_employeers_head).each(function() {
                    let listId2 = $(this).data('list-id');
                    let id = listId2.replace('skills_compantancies-', '');
                    if (!selectedValues.includes(id)) {
                        $(this).closest('.form-group').remove();
                    }
                });
            }
        });

        // Function to initialize Select2 for dynamically created select elements
        function initializeSelect22($dropdown) {
            $dropdown.on('select2:open', function() {
                var $currentDropdown = $(this);
                var searchBoxHtml = `
                <div class="extra-buttons">
                    <button class="select-all-button" type="button">Select All</button>
                    <button class="remove-all-button" type="button">Remove All</button>
                </div>`;

                // Add select all/remove all buttons
                $('.select2-results').prepend(searchBoxHtml);

                $('.select-all-button').on('click', function() {
                    var allValues = $currentDropdown.find('option').map(function() {
                        return $(this).val();
                    }).get();
                    $currentDropdown.val(allValues).trigger('change');
                });

                $('.remove-all-button').on('click', function() {
                    $currentDropdown.val(null).trigger('change');
                });
            });
        }


        $(document).on('click', '.delete-work-experience_' + previous_employeers_head, function() {
            delete_Exp(previous_employeers_head);
        });


    }
    // Function to delete the work experience section
    function delete_Exp(previous_employeers_head) {
        // Select and remove the work experience section using the unique ID
        $(".work_exp_" + previous_employeers_head).remove();
    }
</script>


<!-- vaccination Tab js -->
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple[data-list-id="vaccination_record"]').on('change', function() {
            let selectedValues = $(this).val(); // Get selected values (IDs)

            let processedIds = new Set(); // Track already processed IDs
            $(".vacc_rec_div").empty(); // Clear the current contents of the vaccination record container

            // Add new <h6> elements for IDs in selectedValues
            selectedValues.forEach(function(id, i) {
                if (!processedIds.has(id)) {
                    processedIds.add(id); // Mark this ID as processed

                    // Find the associated text using the `data-value` attribute
                    let datatext = $('#vaccination_record li').filter(function() {
                        return $(this).data('value') == id; // Compare the current `data-value` with the ID
                    }).text(); // Get the text content of the matched element

                    // Check if datatext is valid before appending
                    if (datatext) {
                        $(".vacc_rec_div").append(`
                    <div class="vacc_rec_${id}">
                        <h6 class="vacc_rec_head_${id}" data-id="${id}">${datatext}</h6>
                        <input type="hidden" name="vaccrecarr[]" class="vacc_rec_input_${id}" value="${id}">

                        <div class="row vacc_rec_institution">
                            <!-- Level of Requirement -->
                            <div class="form-group col-md-12">
                                <label class="form-label" for="level_req-${i}">Level of Requirement</label>
                                <select class="form-control mid_spe_status level_req-${i}" name="level_req[]">
                                    <option value="test1">test1</option>
                                    <option value="test2">test2</option>
                                    <option value="test3">test3</option>
                                    <option value="test4">test4</option>
                                </select>
                                <span id="level_req-${i}" class="reqError text-danger valley"></span>
                            </div>

                            <!-- Immunization Status -->
                            <div class="form-group col-md-12">
                                <label class="form-label" for="imm_status_status-${i}">Immunization Status</label>
                                <select class="form-control mid_spe_status imm_status_status-${i}" name="imm_status_status[]">
                                    <?php
                                    $get_imm_status = DB::table("imm_status")->get();
                                    foreach ($get_imm_status as $status) { ?>
                                        <option value="<?= htmlspecialchars($status->name) ?>"><?= htmlspecialchars($status->name) ?></option>
                                    <?php } ?>
                                </select>
                                <span id="imm_status_statusvalid-${i}" class="reqError text-danger valley"></span>
                            </div>

                            <!-- Dose -->
                            <div class="form-group col-md-12" style="display: ${id == 12 ? 'block' : 'none'}">
                                <label class="form-label" for="dose-${i}">How many doses of a TGA-recognised COVID-19 vaccine have you received?</label>
                                <select class="form-control mid_spe_status covid_dose-${i}" name="covid_dose[]"  onchange="handleDoseChange(this, ${id})">
                                    <option value="None">None</option>
                                    <option value="1">1 dose</option>
                                    <option value="2">2 dose</option>
                                    <option value="3">3 dose</option> 
                                    <option value="4">4 dose</option>
                                    <option value="5">5 dose</option>
                                    <option value="6">6 dose</option>
                                </select>
                                <span id="coviddosevalid-${i}" class="reqError text-danger valley"></span>
                            </div>

                           <!-- Evidence required --> 
                            <div class="col-md-12" style="display: ${id == 12 ? 'none' : 'block'}">
                                <label class="form-label" for="evidence_required-${i}">Evidence Requiredq:</label>
                                <div>
                                  ${<?php echo json_encode(DB::table("evidence_type")->get()); ?>.map((data, index) => {
                                  const adjustedIndex = 1; 
                                if (data.type === id) {
                                    return `
                                        <input type="radio" id="evidence_re-${adjustedIndex}-${i}" name="evidence_required[]" value="${data.name}">
                                        <label for="evidence_re-${adjustedIndex}-${i}">${data.name}</label><br>
                                    `;
                                    }
                                    return '';
                                    adjustedIndex++ ;
                                }).join('')}  
                                </div>
                                <div class="hep-b mt-2" style="display: none;">
                                    <p>If vaccination records are missing, a <a href="https://www.health.nsw.gov.au/immunisation/Documents/Occupational/appendix-9-declaration.pdf" target="_blank">NSW Health Hepatitis B Vaccination Declaration form</a>, signed by an approved assessor, may be accepted in certain cases. However, it is not sufficient by itself; additional evidence, such as serology results showing immunity, is usually required for full compliance
                                    </p>
                                </div>
                                <span id="evidence_requiredvalid-${i}" class="reqError text-danger valley"></span>
                            </div>

                            <!-- Evidence required --> 
                            <div class="col-md-12" id="evidence_required_container-${id}" style="display: none;">
                                <label class="form-label" for="evidence_requiredeee-${id}">Evidence Required:</label>
                                <div id="evidence_div_${id}">
                                    
                                </div>
                                <span id="evidence_requiredvalid-${i}" class="reqError text-danger valley"></span>
                            </div>


                            <!-- Evidence Upload required --> 
                            <div class="form-group col-md-12">
                             <label class="form-label" for="input-1">Upload Evidence</label>
                             <input class="form-control clinic_skill_upload_certification clinic_skill_imgs_' + res_one + ' clinic_skill_upload_certification-' + i + '" type="file" name="clinic_skill_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple>
                             <span id="reqclinskilluploadvalid-' + i + '" class="reqError text-danger valley"></span>
                             <div class="clinic_skill_imgs' + res_one + '"></div>
                            </div>
                        </div>
                    </div>
                `);
                    } else {
                        //console.log(`No matching text found for ID: ${id}`);
                    }
                }
            });
        });

        // Dynamically generated checkbox selectors based on adjusted index
        $(document).on('click', 'input[id^="evidence_re-1-0"]', function() {
            // Check the value of the clicked checkbox
            const checkboxId = $(this).attr('id');
            const adjustedIndex = checkboxId.split('-')[1]; // Extract the index from the ID
            var checkboxValue = $(this).val();

            // If the checkbox is checked, show the hep-b message
            if (checkboxValue == 'NSW Health Hepatitis B Vaccination Declaration formclaration' && $(this).prop('checked')) {
                $(".hep-b").show();
            } else {
                $(".hep-b").hide(); // Hide the .hep-b element if not checked
            }

        });

    })

    // Handle change event for dose selection
    function handleDoseChange(selectElement, i) {

        const selectedDose = selectElement.value; // Get selected dose value
        const evidenceRequiredContainer = $(`#evidence_required_container-${i}`);
        const evidenceRequiredDiv = $(`#evidence_div_${i}`);

        // If selected dose is "None", hide evidence section
        if (selectedDose === "None") {
            evidenceRequiredContainer.hide(); // Hide the evidence section
            evidenceRequiredDiv.html(''); // Clear the evidence options
        } else {
            // Show the evidence section
            evidenceRequiredContainer.show();

            // Get the evidence types related to the selected dose
            const evidenceTypes = <?php echo json_encode(DB::table("evidence_type")->where('type', 12)->get()); ?>;

            // Clear previous evidence before appending new ones
            evidenceRequiredDiv.html('');

            // Populate the evidence section dynamically based on the selected dose
            $.each(evidenceTypes, function(index, data) {
                // Ensure that data.dose exists and matches the selected dose
                if (data.dose == selectedDose) { // Use '==' to compare as strings and numbers might differ
                    evidenceRequiredDiv.append(`
                    <input type="radio" id="evidence_re-${index}-${i}" name="evidence_required[]" value="${data.name}">
                    <label for="evidence_re-${index}-${i}">${data.name}</label><br>
                `);
                }
            });

            // If no evidence found, add a message
            if (evidenceRequiredDiv.html() === '') {
                evidenceRequiredDiv.append('<p>No evidence required for this dose.</p>');
            }
        }
    }

    // exp tab changes
    $(document).ready(function() {

        var l = 1;
        $(".nurse_exp_type").each(function() {
            if ($(".nurse_exp_type-" + l).length > 0) {
                if ($(".type_nurse_ep-" + l).val() != "") {
                    // Initialize select2
                    var nurse_type1 = JSON.parse($(".type_nurse_ep-" + l).val());
                    $('#nurse_type_exp-' + l).select2().val(nurse_type1).trigger('change');
                }
            }
            l++;
        });

        var a = 1;
        var triggerCount = 0; // Initialize the counter
        $(".nurse-res-rex").each(function() {
            if ($(".nurse-res-rex-" + a).length > 0) {
                if ($(".nursing_result_one_experience_" + a).val() != "") {
                    // Initialize select2
                    var nurse_res1 = JSON.parse($(".nursing_result_one_experience_" + a).val());
                    $('.nur_exp_res_2_' + a).select2().val(nurse_res1).trigger('change');
                }
            }
            a++;
        });


        var b = 1;
        $(".nurse-res-rex").each(function() {
            if ($(".nurse-res-rex-" + b).length > 0) {
                if ($(".nursing_result_two_experience_" + b).val() != "") {
                    var nurse_res2 = JSON.parse($(".nursing_result_two_experience_" + b).val());
                    $('.nur_exp_res_1_' + b).select2().val(nurse_res2).trigger('change');
                }
            }
            b++;
        });

        var c = 1;
        $(".nurse-res-rex").each(function() {
            if ($(".nurse-res-rex-" + c).length > 0) {
                if ($(".nursing_result_three_experience_" + c).val() != "") {
                    var nurse_res3 = JSON.parse($(".nursing_result_three_experience_" + c).val());
                    $('.nur_exp_res_3_' + c).select2().val(nurse_res3).trigger('change');
                    if (Array.isArray(nurse_res3) && nurse_res3.includes("179")) {
                        if ($(".np_result_experience_" + c).val() != "") {
                            var nurse_res4 = JSON.parse($(".np_result_experience_" + c).val());
                            $('.nurse_prax_exp_' + c).select2().val(nurse_res4).trigger('change');
                        }
                        $('.np_submenu_experience').removeClass('d-none');
                    } else {
                        $('.np_submenu_experience').addClass('d-none');
                    }
                }
            }
            c++;
        });


        var d = 1;
        $(".condition_set").each(function() {
            if ($(".exp_tab-" + d).length > 0) {
                if ($(".speciality_exp_value-" + d).val() != "") {
                    var spec_type = JSON.parse($(".speciality_exp_value-" + d).val());
                    $('.exp_spe_type_' + d).select2().val(spec_type).trigger('change');
                }
            }
            d++;
        });


        var e = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + e).length > 0) {
                if ($(".adults_result_experience_" + e).val() != "") {
                    var adult_type = JSON.parse($(".adults_result_experience_" + e).val());
                    $('.specility_sub_type_1_' + e).select2().val(adult_type).trigger('change');
                    $('.specility_sub_type_2_' + e).select2().val(adult_type).trigger('change');
                    $('.specility_sub_type_3_' + e).select2().val(adult_type).trigger('change');
                    $('.specility_sub_type_4_' + e).select2().val(adult_type).trigger('change');
                }
            }
            e++;
        });

        var e = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + e).length > 0) {
                if ($(".adults_result_experience_" + e).val() != "") {
                    var adult_type = JSON.parse($(".adults_result_experience_" + e).val());
                    $('.specility_sub_type_1_' + e).select2().val(adult_type).trigger('change');
                    $('.specility_sub_type_2_' + e).select2().val(adult_type).trigger('change');
                    $('.specility_sub_type_3_' + e).select2().val(adult_type).trigger('change');
                    $('.specility_sub_type_4_' + e).select2().val(adult_type).trigger('change');
                }
            }
            e++;
        });

        var e = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + e).length > 0) {
                if ($(".adults_result_experience_" + e).val() != "") {
                    var adult_type = JSON.parse($(".adults_result_experience_" + e).val());
                    $('.specility_sub_type_1_' + e).select2().val(adult_type).trigger('change');
                    $('.specility_sub_type_2_' + e).select2().val(adult_type).trigger('change');
                    $('.specility_sub_type_3_' + e).select2().val(adult_type).trigger('change');
                    $('.specility_sub_type_4_' + e).select2().val(adult_type).trigger('change');
                }
            }
            e++;
        });

        var e = 1; // Initialize the counter
        $(".exp_tab").each(function(index) {
            if ($(".exp_tab-" + e).length > 0) {
                if ($(".adults_result_experience_" + e).val() != "") {
                    var adult_type = JSON.parse($(".adults_result_experience_" + e).val());
                    $('.specility_sub_type_1_' + e).select2().val(adult_type).trigger('change');

                    if (adult_type.includes("96")) {
                        $('.surgical_row_data_experience_' + e).removeClass('d-none');
                        var sur_type = JSON.parse($(".surgical_preoperative_result_experience-" + e).val());
                        $('.sur_exp_' + e).select2().val(sur_type).trigger('change');
                    } else {
                        $('.surgical_row_data_experience_' + e).addClass('d-none');
                    }
                } else {
                    $('.surgical_row_data_experience_' + e).addClass('d-none');
                    // Optional: Uncomment this line if you want to clear the select2 values
                    // $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(null).trigger('change');
                }
            }
            e++; // Increment the counter inside the loop
        });


        var f = 1; // Initialize the counter
        $(".exp_tab").each(function(index) {
            if ($(".exp_tab-" + f).length > 0) {
                var surgicalResult = $(".surgical_preoperative_result_experience-" + f).val();
                if (surgicalResult != "") {
                    var sur_opr_type = JSON.parse(surgicalResult);

                    if (sur_opr_type.includes("97")) {
                        $('.sur_sub_type_97_' + f).removeClass('d-none');
                        var surgicalsubvalue = $(".operatingroom_result_experience-" + f).val();
                        if (surgicalsubvalue != "") {
                            var getvalue1 = JSON.parse($(".operatingroom_result_experience-" + f).val());

                            $('.spec_sub_value_97_' + f).select2().val(getvalue1).trigger('change');
                        }
                    }

                    if (sur_opr_type.includes("98")) {
                        $('.sur_sub_type_98_' + f).removeClass('d-none');
                        var surgicalsubvalue1 = $(".operatingscout_result_experience-" + f).val();
                        if (surgicalsubvalue1 != "") {
                            var getvalue2 = JSON.parse($(".operatingscout_result_experience-" + f).val());

                            $('.spec_sub_value_98_' + f).select2().val(getvalue2).trigger('change');
                        }
                    }
                    if (sur_opr_type.includes("99")) {
                        $('.sur_sub_type_99_' + f).removeClass('d-none');
                        var surgicalsubvalue2 = $(".operatingscrub_result_experience-" + f).val();
                        if (surgicalsubvalue2 != "") {
                            var getvalue3 = JSON.parse($(".operatingscrub_result_experience-" + f).val());

                            $('.spec_sub_value_99_' + f).select2().val(getvalue3).trigger('change');
                        }
                    }
                } else {
                    // Optional: Handle case when the value is empty
                    // $('.surgical_row_data_experience_' + f).addClass('d-none');
                    // $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(null).trigger('change');
                }
            }
            f++; // Increment the counter inside the loop
        });








    })

    function handleNurseTypeChange(index) {
        // alert();
        // Get the select element using the index
        let selectElement = document.getElementById(`nurse_type_exp-${index}`);
        // Get the associated `data-list-id` for the current dropdown
        let listId = selectElement.getAttribute('data-list-id');
        // Retrieve selected values from the dropdown
        let selectedValues = $(selectElement).val() || []; // Ensure selectedValues is an array
        // Get the length of nursing result items
        let nurseLen = $(`#${listId} li`).length;

        for (let i = 1; i <= nurseLen; i++) {
            let nurseResultVal = $(`.nursing_result_experience-${i}`).val();

            if (Array.isArray(selectedValues) && selectedValues.includes(nurseResultVal)) {

                // Show the corresponding section
                $(`#nursing_level_experience-${i}-${index}`).removeClass('d-none');
            } else {
                // Hide the section and clear associated select2 values
                $(`#nursing_level_experience-${i}-${index}`).addClass('d-none');
                $(`.js-example-basic-multiple[data-list-id="nursing_entry_experience-${i}"]`)
                    .select2()
                    .val(null)
                    .trigger('change');
            }
        }

        if (selectedValues.includes("3") == false) {
            $('.np_submenu_experience').addClass('d-none');
            //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
            // $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
        }
    }
</script>