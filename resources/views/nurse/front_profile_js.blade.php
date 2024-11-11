<script>
 $(document).ready(function(){
// Mandatory Training and Education
$('.js-example-basic-multiple[data-list-id="mandatory_courses"]').on('change', function() {
        let selectedValues = $(this).val();
        
      console.log("selectedValues",selectedValues);
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
        if(selectedValues.includes("419")){
            $('.mandatory_tr_div_1').removeClass('d-none');
            // $('.license_number_acls').removeClass('d-none');
        }else{
            $('.mandatory_tr_div_1').addClass('d-none');
            // $('.license_number_acls').addClass('d-none');
            $('.well_self_care_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="well_self_care_data"]').select2().val(null).trigger('change');
        }
        if(selectedValues.includes("418")){
            $('.mandatory_tr_div_2').removeClass('d-none');
            // $('.license_number_bls').removeClass('d-none');
        }else{
            $('.mandatory_tr_div_2').addClass('d-none');
            // $('.license_number_bls').addClass('d-none');
            $('.tech_innvo_health_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').select2().val(null).trigger('change');
        }
        if(selectedValues.includes("417")){
            $('.mandatory_tr_div_3').removeClass('d-none');
            // $('.license_number_cpr').removeClass('d-none');
        }else{
            $('.mandatory_tr_div_3').addClass('d-none');
            // $('.license_number_cpr').addClass('d-none');
            $('.leader_pro_dev_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes("416")){
            $('.mandatory_tr_div_4').removeClass('d-none');
            // $('.license_number_nrp').removeClass('d-none');
            
        }else{
            $('.mandatory_tr_div_4').addClass('d-none');
            // $('.license_number_nrp').addClass('d-none');
            $('.mid_spec_tra_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').select2().val(null).trigger('change');
            
        }
        if(selectedValues.includes("415")){
            $('.mandatory_tr_div_5').removeClass('d-none');
            // $('.license_number_pals').removeClass('d-none');
            
            
        }else{
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
        $(".well_self_care_div h6").each(function(){
          var text = $(this).text();
          if(selectedValues.includes(text) == false){
            let res = text.split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one",res_one);

            $(".well_self_care_"+res_one).remove();
          }
          well_self_care.push(text);
        });
        console.log("selectedValues",selectedValues);
        
        $(".well_self_care_div").empty();
        
        for(var i = 0;i<selectedValues.length;i++){
          var selected_text = selectedValues[i].replace(/ .*/,'').replace(/[^\w\s]/gi, '').toLowerCase();
          let res = selectedValues[i].split(' ')[0];
          let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
          console.log("res_one",res_one);

          if(well_self_care.includes(selectedValues[i]) == false){
            
            var user_id = "{{ $user_id }}";
            var img_text = "well_self_care_imgs";
            $(".well_self_care_div").append('<div class="well_self_care_'+res_one+' well_div_'+selected_text+'"><h6 class="well_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="wellnamearr[]" class="wellness_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="wellness_inst_div row wellness_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control well_institution well_institution-'+i+'" type="text" name="well_institution[]"><span id="wellinstitutionvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control well_tra_start_date well_tra_start_date-'+i+'" type="date" name="well_tra_start_date[]"><span id="well_tra_start_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control tra_end_date well_tra_end_date-'+i+'" type="date" name="well_tra_end_date[]"><span id="well_tra_end_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control well_expiry well_expiry-'+i+'" type="date" name="well_expiry[]"><span id="wellexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control well_upload_certification well_imgs_'+res_one+' well_upload_certification-'+i+'" type="file" name="well_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqwelluploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="well_imgs'+res_one+'"></div></div></div></div>');

            
          }
        }

        
    });

    $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var tech_innvo_health = [];
        $('.tech_innvo_health_div').removeClass('d-none');
        $(".tech_innvo_health_div h6").each(function(){
          var text = $(this).text();
          if(selectedValues.includes(text) == false){
            let res = text.split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one",res_one);

            $(".tech_innvo_health_"+res_one).remove();
          }
          tech_innvo_health.push(text);
        });
        console.log("selectedValues",selectedValues);
        
        $(".tech_innvo_health_div").empty();
        for(var i = 0;i<selectedValues.length;i++){
          var selected_text = selectedValues[i].replace(/ .*/,'').replace(/[^\w\s]/gi, '').toLowerCase();
          let res = selectedValues[i].split(' ')[0];
          let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
          console.log("res_one",res_one);

          if(tech_innvo_health.includes(selectedValues[i]) == false){
            
            var user_id = "{{ $user_id }}";
            var img_text = "tech_innvo_health_imgs";
            $(".tech_innvo_health_div").append('<div class="tech_innvo_health_'+res_one+' tech_innvo_div_'+selected_text+'"><h6 class="tech_innvo_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="techinnvonamearr[]" class="tech_innvo_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="tech_innvo_div row tech_innvo_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control tech_innvo_institution tech_innvo-'+i+'" type="text" name="tech_innvo_institution[]"><span id="techinnvoinstitutionvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control tech_innvo_tra_start_date tech_innvo_tra_start_date-'+i+'" type="date" name="tech_innvo_tra_start_date[]"><span id="tech_innvo_tra_start_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control tech_innvo_tra_end_date tech_innvo_tra_end_date-'+i+'" type="date" name="tech_innvo_tra_end_date[]"><span id="tech_innvo_tra_end_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control tech_innvo_expiry tech_innvo_expiry-'+i+'" type="date" name="tech_innvo_expiry[]"><span id="techinnvoexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control tech_innvo_upload_certification tech_innvo_imgs_'+res_one+' tech_innvo_upload_certification-'+i+'" type="file" name="tech_innvo_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqtechinnvouploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="tech_innvo_imgs'+res_one+'"></div></div></div></div>');

            
          }
        }

        
    });

    $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var leader_pro_dev = [];
        $('.leader_pro_dev_div').removeClass('d-none');
        $(".leader_pro_dev_div h6").each(function(){
          var text = $(this).text();
          if(selectedValues.includes(text) == false){
            let res = text.split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one",res_one);

            $(".leader_pro_dev_"+res_one).remove();
          }
          leader_pro_dev.push(text);
        });
        console.log("selectedValues",selectedValues);
        
        $(".leader_pro_dev_div").empty();
        for(var i = 0;i<selectedValues.length;i++){
          var selected_text = selectedValues[i].replace(/ .*/,'').replace(/[^\w\s]/gi, '').toLowerCase();
          let res = selectedValues[i].split(' ')[0];
          let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
          console.log("res_one",res_one);

          if(leader_pro_dev.includes(selectedValues[i]) == false){
            
            var user_id = "{{ $user_id }}";
            var img_text = "leader_pro_dev_imgs";
            $(".leader_pro_dev_div").append('<div class="leader_pro_dev_'+res_one+' leader_pro_div_'+selected_text+'"><h6 class="leader_pro_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="leaderpronamearr[]" class="leader_pro_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="leader_pro_div row leader_pro_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control leader_pro_institution leader_pro-'+i+'" type="text" name="leader_pro_institution[]"><span id="leaderproinstivalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control leader_pro_tra_start_date leader_pro_tra_start_date-'+i+'" type="date" name="leader_pro_tra_start_date[]"><span id="leader_pro_tra_start_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control leader_pro_tra_end_date leader_pro_tra_end_date-'+i+'" type="date" name="leader_pro_tra_end_date[]"><span id="leader_pro_tra_end_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control leader_pro_expiry leader_pro_expiry-'+i+'" type="date" name="leader_pro_expiry[]"><span id="leaderproexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control leader_pro_upload_certification leader_pro_imgs_'+res_one+' leader_pro_upload_certification-'+i+'" type="file" name="leader_pro_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqleaderprouploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="leader_pro_imgs'+res_one+'"></div></div></div></div>');

            
          }
        } 
    });

    $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var mid_spec_tra = [];
        $('.mid_spec_tra_div').removeClass('d-none');
        $(".mid_spec_tra_div h6").each(function(){
          var text = $(this).text();
          if(selectedValues.includes(text) == false){
            let res = text.split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one",res_one);

            $(".mid_spec_tra_"+res_one).remove();
          }
          mid_spec_tra.push(text);
        });
        console.log("selectedValues",selectedValues);
        
        $(".mid_spec_tra_div").empty();
        for(var i = 0;i<selectedValues.length;i++){
          var selected_text = selectedValues[i].replace(/ .*/,'').replace(/[^\w\s]/gi, '').toLowerCase();
          let res = selectedValues[i].split(' ')[0];
          let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
          console.log("res_one",res_one);

          if(mid_spec_tra.includes(selectedValues[i]) == false){
            
            var user_id = "{{ $user_id }}";
            var img_text = "mid_spec_tra_imgs";
            $(".mid_spec_tra_div").append('<div class="mid_spec_tra_'+res_one+' mid_spec_div_'+selected_text+'"><h6 class="mid_spec_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="midspecnamearr[]" class="mid_spec_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="mid_spec_div row mid_spec_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control mid_spec_institution mid_spec-'+i+'" type="text" name="mid_spec_institution[]"><span id="midspecinstivalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control mid_spec_tra_start_date mid_spec_tra_start_date-'+i+'" type="date" name="mid_spec_tra_start_date[]"><span id="mid_spec_tra_start_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control mid_spec_tra_end_date mid_spec_tra_end_date-'+i+'" type="date" name="mid_spec_tra_end_date[]"><span id="mid_spec_tra_end_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control mid_spec_expiry mid_spec_expiry-'+i+'" type="date" name="mid_spec_expiry[]"><span id="midspecexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control mid_spec_upload_certification mid_spec_imgs_'+res_one+' mid_spec_upload_certification-'+i+'" type="file" name="mid_spec_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqmidspecuploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="mid_spec_imgs'+res_one+'"></div></div></div></div>');  
          }
        } 
    });

    $('.js-example-basic-multiple[data-list-id="clinic_skill_core_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var clinic_skill_core = [];
        $('.clinic_skill_core_div').removeClass('d-none');
        $(".clinic_skill_core_div h6").each(function(){
          var text = $(this).text();
          if(selectedValues.includes(text) == false){
            let res = text.split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one",res_one);

            $(".clinic_skill_core_"+res_one).remove();
          }
          clinic_skill_core.push(text);
        });
        console.log("selectedValues",selectedValues);
        
        $(".clinic_skill_core_div").empty();
        for(var i = 0;i<selectedValues.length;i++){
          var selected_text = selectedValues[i].replace(/ .*/,'').replace(/[^\w\s]/gi, '').toLowerCase();
          let res = selectedValues[i].split(' ')[0];
          let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
          console.log("res_one",res_one);

          if(clinic_skill_core.includes(selectedValues[i]) == false){
            
            var user_id = "{{ $user_id }}";
            var img_text = "clinic_skill_core_imgs";
            $(".clinic_skill_core_div").append('<div class="clinic_skill_'+res_one+' clinic_skill_div_'+selected_text+'"><h6 class="clinic_skill_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="clinicskillnamearr[]" class="clinic_skill_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="clinic_skill_div row clinic_skill_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control clinic_skill_institution clinic_skill-'+i+'" type="text" name="clinic_skill_institution[]"><span id="cliskillinstivalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control clinic_skill_tra_start_date clinic_skill_tra_start_date-'+i+'" type="date" name="clinic_skill_tra_start_date[]"><span id="clinic_skill_tra_start_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control clinic_skill_tra_end_date clinic_skill_tra_end_date-'+i+'" type="date" name="clinic_skill_tra_end_date[]"><span id="clinic_skill_tra_end_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control clinic_skill_expiry clinic_skill_expiry-'+i+'" type="date" name="clinic_skill_expiry[]"><span id="clinicskillexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control clinic_skill_upload_certification clinic_skill_imgs_'+res_one+' clinic_skill_upload_certification-'+i+'" type="file" name="clinic_skill_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqclinskilluploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="clinic_skill_imgs'+res_one+'"></div></div></div></div>');  
          }
        } 
    });

    $('.js-example-basic-multiple[data-list-id="mandatory_education"]').on('change', function() {
        let selectedValues = $(this).val();
        
      console.log("selectedValues",selectedValues);
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
        if(selectedValues.includes("440")){
            $('.mandatory_sub_edu_div_1').removeClass('d-none');
            // $('.license_number_acls').removeClass('d-none');
        }else{
            $('.mandatory_sub_edu_div_1').addClass('d-none');
            // $('.license_number_acls').addClass('d-none');
            $('.core_man_con_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="core_man_con_data"]').select2().val(null).trigger('change');
        }
        if(selectedValues.includes("441")){
            $('.mandatory_sub_edu_div_2').removeClass('d-none');
            // $('.license_number_bls').removeClass('d-none');
        }else{
            $('.mandatory_sub_edu_div_2').addClass('d-none');
            // $('.license_number_bls').addClass('d-none');
            $('.mid_spe_mandotry_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="mid_spe_mandotry_data"]').select2().val(null).trigger('change');
        }
        if(selectedValues.includes("442")){
            $('.mandatory_sub_edu_div_3').removeClass('d-none');
            // $('.license_number_cpr').removeClass('d-none');
        }else{
            $('.mandatory_sub_edu_div_3').addClass('d-none');
            // $('.license_number_cpr').addClass('d-none');
            $('.spec_area_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="spec_area_data"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes("443")){
            $('.mandatory_sub_edu_div_4').removeClass('d-none');
            // $('.license_number_nrp').removeClass('d-none');
            
        }else{
            $('.mandatory_sub_edu_div_4').addClass('d-none');
            // $('.license_number_nrp').addClass('d-none');
            $('.safety_com_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="safety_com_data"]').select2().val(null).trigger('change');
            
        }
        if(selectedValues.includes("444")){
            $('.mandatory_sub_edu_div_5').removeClass('d-none');
            // $('.license_number_pals').removeClass('d-none'); 
        }else{
            $('.mandatory_sub_edu_div_5').addClass('d-none');
            // $('.license_number_pals').addClass('d-none'); 
            $('.emerging_topic_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="emerging_topic_data"]').select2().val(null).trigger('change');  
        }   
        
    });

    $('.js-example-basic-multiple[data-list-id="core_man_con_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var core_man_con_data = [];
        $('.core_man_con_data_div').removeClass('d-none');
        $(".core_man_con_data_div h6").each(function(){
          var text = $(this).text();
          if(selectedValues.includes(text) == false){
            let res = text.split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one",res_one);

            $(".core_man_con_data_"+res_one).remove();
          }
          core_man_con_data.push(text);
        });
        console.log("selectedValues",selectedValues);
        
        $(".core_man_con_data_div").empty();
        
        for(var i = 0;i<selectedValues.length;i++){
          var selected_text = selectedValues[i].replace(/ .*/,'').replace(/[^\w\s]/gi, '').toLowerCase();
          let res = selectedValues[i].split(' ')[0];
          let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
          console.log("res_one",res_one);

          if(core_man_con_data.includes(selectedValues[i]) == false){            
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
                          <input class="form-control core_man_expiry well_expiry-${i}" type="date" name="well_expiry[]">
                          <span id="coremanexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control coreman_upload_certification coreman_imgs_${res_one} coreman_upload_certification-${i}" 
                                type="file" name="coreman_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqcoremanuploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="coreman_imgs${res_one}"></div>
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
        $(".mid_spe_mandotry_div h6").each(function(){
          var text = $(this).text();
          if(selectedValues.includes(text) == false){
            let res = text.split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one",res_one);

            $(".mid_spe_mandotry_data_"+res_one).remove();
          }
          mid_spe_mandotry_data.push(text);
        });
        console.log("selectedValues",selectedValues);
        
        $(".mid_spe_mandotry_div").empty();
        
        for(var i = 0;i<selectedValues.length;i++){
          var selected_text = selectedValues[i].replace(/ .*/,'').replace(/[^\w\s]/gi, '').toLowerCase();
          let res = selectedValues[i].split(' ')[0];
          let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
          console.log("res_one",res_one);

          if(mid_spe_mandotry_data.includes(selectedValues[i]) == false){            
            var user_id = "{{ $user_id }}";
            var img_text = "mid_spe_imgs";
            // $(".core_man_con_data_div").append('<div class="core_man_'+res_one+' core_man_'+selected_text+'"><h6 class="core_man_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="coremanarr[]" class="coreman_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="core_man_div row core_man_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control core_man_institution core_man_institution-'+i+'" type="text" name="core_man_institution[]"><span id="coreinstitutionvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Start Date</label><input class="form-control coreman_start_date coreman_start_date-'+i+'" type="date" name="coreman_start_date[]"><span id="coreman_start_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">End Date</label><input class="form-control coreman_end_date coreman_end_date-'+i+'" type="date" name="coreman_end_date[]"><span id="coreman_end_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control well_expiry well_expiry-'+i+'" type="date" name="well_expiry[]"><span id="wellexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control well_upload_certification well_imgs_'+res_one+' well_upload_certification-'+i+'" type="file" name="well_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqwelluploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="well_imgs'+res_one+'"></div></div></div></div>');
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
                          <input class="form-control midspe_upload_certification midspe_imgs_${res_one} midspe_upload_certification-${i}" 
                                type="file" name="midspe_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqmidspeuploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="midspe_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);

            
          }
        }

        
    });
 });
</script>

<script type="text/javascript">
var training_div_count = $(".another_com_tra_div").length;
// console.log("training_div_count",training_div_count);
function add_listtraining(){

training_div_count++;
var user_id = "{{ $user_id }}";
$(".another_com_training").append('<div class="training_div training_div_'+training_div_count+' row another_com_tra_div"><div class="form-group col-md-6"><label class="form-label" for="input-1">Training '+training_div_count+'</label><input class="form-control additional_tra_field additional_tra_field-'+training_div_count+'" type="text" name="training[]"><span id="reqtraname-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control institution institution-'+training_div_count+'" type="text" name="institution[]"><span id="reqinstitution-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control tra_start_date tra_start_date-'+training_div_count+'" type="date" name="tra_start_date[]"><span id="reqtrastartdate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End Date</label><input class="form-control tra_end_date tra_end_date-'+training_div_count+'" type="date" name="tra_end_date[]"><span id="reqtraenddate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control tra_expiry tra_expiry-'+training_div_count+'" type="date" name="tra_expiry[]"><span id="reqtra_expiry-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control additional_certifications-'+training_div_count+'" type="file" name="certificate_upload_certification['+training_div_count+'][]" onchange="changeImg2('+user_id+','+training_div_count+')" multiple></div><div class="col-md-12"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_training('+training_div_count+')">- Delete certification/Licence</a></div></div></div>');

}

function delete_training(i,user_id,training_id){ 
   $(".training_div_"+i).remove();
}

// function delete_training(i,user_id,training_id){ 
//   $.ajax({
//     type: "post",
//     url: "{{ route('nurse.deleteTraining') }}",
//     data: {user_id:user_id,training_id:training_id,_token:'{{ csrf_token() }}'},
//     cache: false,
//     success: function(data){
//         if(data == 1){
//         $(".another_com_training"+i).remove();
//         }
        
//     }
//   });
// }

</script>

