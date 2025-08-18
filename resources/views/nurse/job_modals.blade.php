<!-- Modal Overlay -->
        <div id="employmentModal" class="modal-overlay" style="display: none;">
          <div class="modal-content">
           
          
          </div>
          
        </div>

        <div id="shiftModal" class="modal-overlay" style="display: none;">
          <div class="modal-content work_environment_modal" style="display:none">
            <div class="modal-header">
              <h2>Work Environment</h2>
              <button class="close-btn" onclick="closeModal()">×</button>
              </div>
              <p class="modal-subtext">Your saved preferences are pre-filled. You can adjust below.</p>
              <div class="modal-body">
                @foreach($work_environment_data as $work_environment)
                <div class="accordion-section">
                 <div class="accordion-header" onclick="toggleAccordion(this)">
                   <strong>{{ $work_environment->env_name }}</strong>
                 </div>
                 <?php
                    $sub_work_environment = DB::table("work_enviornment_preferences")
                                            ->where("sub_env_id", $work_environment->prefer_id)
                                            ->where("sub_envp_id", 0)
                                            ->get();
                 ?>
                 <div class="accordion-content" id="perm">
                  @foreach($sub_work_environment as $sub_work)
                  <label>
                    <input type="checkbox" value="{{ $sub_work->prefer_id }}" class="filter_checkbox" id="filter_checkbox_{{ $sub_work->prefer_id }}" onclick="showFilters({{ $sub_work->prefer_id }})"> {{ $sub_work->env_name }}
                  </label>
                  <?php
                      $subsub_work_environment = DB::table("work_enviornment_preferences")
                                              ->where("sub_env_id", $work_environment->prefer_id)
                                              ->where("sub_envp_id", $sub_work->prefer_id)
                                              ->get();
                  ?>
                  <div class="third-level third-level-{{ $sub_work->prefer_id }}" id="subsub_{{ $sub_work->prefer_id }}" style="display:none">
                    @foreach($subsub_work_environment as $subsub_work)
                    <label><input type="checkbox" name="subwork_environment" value="{{ $subsub_work->prefer_id }}"> {{ $subsub_work->env_name }}</label>
                    @endforeach
                  </div>
                  
                  @endforeach
                 </div>
                </div>
                @endforeach
              </div>
              <div class="modal-footer">
                <button class="apply-btn" id="applySector" onclick="applySector('work_environment')">Apply</button>
              </div>
          </div>
          <div class="modal-content work_shift_modal" style="display:none">
            <div class="modal-header">
              <h2>Shift Type</h2>
              <button class="close-btn" onclick="closeModal()">×</button>
              </div>
              <p class="modal-subtext">Your saved preferences are pre-filled. You can adjust below.</p>
              <div class="modal-body">
                @foreach($work_shift_data as $work_shift)
                <div class="accordion-section">
                 <div class="accordion-header" onclick="toggleAccordion(this)">
                   <strong>{{ $work_shift->shift_name }}</strong>
                 </div>
                 <?php
                    $sub_work_shift = DB::table("work_shift_preferences")
                                            ->where("shift_id", $work_shift->work_shift_id)
                                            ->where("sub_shift_id", NULL)
                                            ->get();
                 ?>
                 <div class="accordion-content" id="perm">
                  @foreach($sub_work_shift as $sub_works)
                  <label>
                    <input type="checkbox" value="{{ $sub_works->work_shift_id }}" class="filter_checkbox" id="filter_checkbox_{{ $sub_works->work_shift_id }}" onclick="showFilters({{ $sub_works->work_shift_id }})"> {{ $sub_works->shift_name }}
                  </label>
                  <?php
                      $subsub_work_shift = DB::table("work_shift_preferences")
                                              ->where("shift_id", $work_shift->work_shift_id)
                                              ->where("sub_shift_id", $sub_works->work_shift_id)
                                              ->get();
                                              
                  ?>
                  <div class="third-level third-level-{{ $sub_works->work_shift_id }}" id="subsub_{{ $sub_works->work_shift_id }}" style="display:none">
                    @foreach($subsub_work_shift as $subsub_works)
                    <label><input type="checkbox"> {{ $subsub_works->shift_name }}</label>
                    @endforeach
                  </div>
                  
                  @endforeach
                 </div>
                </div>
                @endforeach
              </div>
          </div>
        </div>

        <div class="modal-overlay" id="nurse_modal" style="display: none;">
            <div class="modal-content row">
                <!-- Left Panel -->
                <div class="panel left col-md-6">
                    <div class="modal-header">Type of Nurse</div>
                    <div class="search-box">
                        <input type="text" placeholder="Search" id="nurseSearch">
                    </div>
                    <div class="nurseList">
                    @foreach($type_of_nurse as $nurse)
                    <div class="list-item" onclick="getNurseData({{ $nurse->id }},'{{ $nurse->name }}')">{{ $nurse->name }}</div>
                    @endforeach
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="panel right col-md-6">
                    <div class="modal-header nurse_modal_header"><span>Registered Nurses (RNs)</span>
                      <button class="close-btn" onclick="closeModal()">×</button>
                    </div>
                    <div class="search-box">
                        <input type="text" placeholder="Search" id="sub_nurseSearch">
                    </div>

                    <div class="select-bar">
                        <div>Select all that apply</div>
                        <span id="selectAll">Select All</span>
                    </div>

                    <div class="checkbox-list">
                        <?php
                            $sub_nurse_data = DB::table("practitioner_type")->where("parent","1")->get();
                        ?>
                        
                        @foreach($sub_nurse_data as $nurse_data)
                        
                        <label class="nurse_list_name"><input type="checkbox" value="{{ $nurse_data->id }}" class="nurseCheck specialty nurse_type_data-{{ $nurse_data->id }}">{{ $nurse_data->name }}</label>
                        @endforeach
                        
                    </div>

                    <div class="modal-actions">
                        <button class="cancel-btn" id="cancelModal">Cancel</button>
                        <button class="apply-btn" onclick="applyNurse()">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-overlay" id="speciality_modal" style="display: none;">
            <div class="modal-content row">
                <!-- Left Panel -->
                <div class="panel left col-md-6">
                    <div class="modal-header">Speciality</div>
                    <div class="search-box">
                        <input type="text" placeholder="Search" id="specialitySearch">
                    </div>
                    <div class="specialityList">
                    @foreach($speciality as $spec)
                    <div class="list-item" onclick="getSpecialityData({{ $spec->id }},'{{ $spec->name }}')">{{ $spec->name }}</div>
                    @endforeach
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="panel right col-md-6">
                    <div class="modal-header speciality_modal_header">
                      <span>Adults</span>
                      <button class="close-btn" onclick="closeModal()">×</button>
                    </div>
                    <div class="search-box">
                        <input type="text" placeholder="Search" id="sub_specialitySearch">
                    </div>

                    <div class="select-bar">
                        <div>Select all that apply</div>
                        <span id="selectAll">Select All</span>
                    </div>

                    <div class="checkbox-list-spec">
                        <?php
                            $sub_speciality_data = DB::table("speciality")->where("parent","1")->get();
                        ?>
                        
                        @foreach($sub_speciality_data as $speciality_data)
                        <?php
                          $get_spec_count = DB::table("speciality")->where("parent",$speciality_data->id)->get();

                          if(count($get_spec_count)>0){
                            $get_spec_count_result = count($get_spec_count);
                          }
                        ?>
                        <label class="speciality_list_name"><input type="checkbox" class="specialty_check speciality_data-{{ $speciality_data->id }}" value="{{ $speciality_data->id }}">{{ $speciality_data->name }}
                          @if(count($get_spec_count)>0)
                          <span><i class="fa fa-angle-right"></i></span>
                          @endif
                      
                        </label>
                        @endforeach
                    </div>

                    <div class="modal-actions">
                        <button class="cancel-btn" id="cancelModal">Cancel</button>
                        <button class="apply-btn" onclick="applySpeciality()">Apply</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="sectorModal" style="display: none;">
          <div class="modal-content">
            <div class="modal-header">
              <h2>Select Sector</h2>
              <button class="close-btn" onclick="closeModal()">×</button>
            </div>
            <div class="modal-body">
              <label><input type="checkbox" class="sector_checkbox" name="sector[]" value="Public & Government"> Public & Government </label><br>
              <label><input type="checkbox" class="sector_checkbox" name="sector[]" value="Private"> Private </label><br>
              <label><input type="checkbox" class="sector_checkbox" name="sector[]" value="Public Government & Private"> Public Government & Private</label>
            </div>
            <div class="modal-footer">
              <button class="apply-btn" id="applySector" onclick="applySector()">Apply</button>
            </div>
          </div>
        </div>

        <div class="modal-overlay" id="salaryModal" style="display: none;">
          <div class="modal-content">
            <div class="modal-header">
              <h2>Salary Range ($/hr)</h2>
              <button class="close-btn" onclick="closeModal()">×</button>
            </div>
            <div class="modal-body">
              <div id="salarySlider" style="margin: 10px 0;"></div>
              <p id="salaryAmount">$100 - $500</p>
              <input type="hidden" id="minSalary" name="min_salary" value="100">
              <input type="hidden" id="maxSalary" name="max_salary" value="500">
            </div>
            <div class="modal-footer">
              <button class="apply-btn" id="applySector">Apply</button>
            </div>
          </div>
        </div>

        <div class="modal-overlay" id="yearExperienceModal" style="display: none;">
          <div class="modal-content">
            <div class="modal-header">
              <h2>Years of Experience</h2>
              <button class="close-btn" onclick="closeModal()">×</button>
            </div>
            <div class="modal-body">
              <select class="form-control assistent_level" name="assistent_level">
                        <option value="">Please Select</option>
                        @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                          @endfor
                      </select>
            </div>
            <div class="modal-footer">
              <button class="apply-btn" id="applySector" onclick="applyExperience()">Apply</button>
            </div>
          </div>
        </div>

        
@section('js')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>

   $('#sectorFilter').on('click', function() {
    // Toggle the checkboxes
    $('.sector-options').slideToggle(200);

    // Rotate the arrow
    $(this).find('.arrow').toggleClass('rotated');
  });     

    function openSectorModal(){
      $('#sectorModal').show();
    }

    function openSalaryModal(){
      $('#salaryModal').show();
    }

    function openYearExperienceModal(){
      $('#yearExperienceModal').show();
    }

    $("#salarySlider").slider({
      range: true,
      min: 0,
      max: 1000,
      step: 10,
      values: [100, 500],
      slide: function(event, ui) {
        $("#salaryAmount").text("$" + ui.values[0] + " - $" + ui.values[1]);
        $("#minSalary").val(ui.values[0]);
        $("#maxSalary").val(ui.values[1]);
      }
    });

    $('#specialitySearch').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      
      $('.specialityList .list-item').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    $('#sub_specialitySearch').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      
      $('.speciality_list_name').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    $('#nurseSearch').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      
      $('.nurseList .list-item').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    $('#sub_nurseSearch').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      
      $('.nurse_list_name').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    function openNurseModal(){
        $('#nurse_modal').show();
    }

    function openSpecialityModal(){
        $('#speciality_modal').show();
    }
    
    $('#cancelModal').on('click', function () {
        $('#nurse_modal').hide();
    });
  function openModal(filter_type,table_name,column_name,main_column_id,column_type) {
    // var modal_heading = $("#"+filter_id+" .modal-header h2").text();
    console.log("modal_heading",filter_type);
    // if(filter_type == modal_heading){
    //   $(".modal-content").hide();
    //   $("#"+filter_id).show();
    // }
    document.getElementById("employmentModal").style.display = "flex";
    $.ajax({
      type: "post",
      url: "{{ url('/nurse/getWorkFlexiblityData') }}",
      data: {filter_type:filter_type,table_name:table_name,column_name:column_name,main_column_id:main_column_id,column_type:column_type,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
        var data1 = JSON.parse(data);
        console.log("data",data1);
        var accordian_section = '';

        for(var i = 0;i<data1.length;i++){
          var sub_types = data1[i].sub_types;
          var sub_data = '';

          for(var j = 0;j<sub_types.length;j++){
            sub_data += '<label><input type="checkbox" class="sector_checkbox" value="'+sub_types[j].id+'"> '+sub_types[j].name+'</label>'
          }
          console.log("data.id",data1[i].id);
          if(data1[i].name != "Other" && data1[i].name != "All/No Preference"){
            
            accordian_section += '<div class="accordion-section">\
                <div class="accordion-header" onclick="toggleAccordion(this)">\
                  <strong>'+data1[i].name+'</strong>\
                </div>\
                <div class="accordion-content" id="perm">'+sub_data+'</div>\
              </div>';
          }

        }



        $(".modal-content").html('\<div class="modal-header">\
              <h2>'+filter_type+'</h2>\
              <button class="close-btn" onclick="closeModal()">×</button>\
            </div>\
            <p class="modal-subtext">Your saved preferences are pre-filled. You can adjust below.</p>\
            <div class="modal-body">'+accordian_section+'</div>\
            <div class="modal-footer" style="text-align: right; margin-top: 10px;">\
              <button class="apply-btn" onclick="applySector()">Apply</button>\
            </div>');
      }
    });      

  }

  function openModal_enviroment(filter_type) {
    
    if(filter_type == "Work Environment"){
      $(".modal-content").hide();
      $(".work_environment_modal").show();
    }
    if(filter_type == "Shift Type"){
      $(".modal-content").hide();
      $(".work_shift_modal").show();
    }
    document.getElementById("shiftModal").style.display = "flex";

  }

  function showFilters(prefer_id){

    if ($("#filter_checkbox_"+prefer_id).prop('checked')) {
      $(".third-level-"+prefer_id).show();
    } else {
      $(".third-level-"+prefer_id).hide();
    }
    
  }

  function getNurseData(nurse_id,nurse_type_name){
    $(".nurse_modal_header span").text(nurse_type_name);
    $.ajax({
      type: "post",
      url: "{{ url('/nurse/getNurseData') }}",
      data: {nurse_id:nurse_id,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
        var data1 = JSON.parse(data);
        console.log("data1",data1);
        var sub_nurse_data = '';
        for(var i = 0;i<data1.length;i++){
            if(data1[i].get_nurse_count == 0){
              var get_nurse_count = '';
            }else{
              var get_nurse_count = '<span><i class="fa fa-angle-right"></i></span>'
            }
            var get_nurse = data1[i].get_nurse;
            var subsub_nurse_data = '';
            if(get_nurse.length>0){
              for(var j=0;j<get_nurse.length;j++){
                subsub_nurse_data += '<label class="subsub_checkbox subsub_checkbox-'+data1[i].id+'" style="display:none;"><input type="checkbox" class="specialty">'+get_nurse[j].name+'</label>'; 
              }
              console.log("subsub_nurse_data",subsub_nurse_data);
              var data_name = data1[i].name;
              var type = "nurse_type";
              var onclickfun = 'showSubCheckbox('+data1[i].id+',\''+data_name+'\',\''+type+'\')';
            }else{
              var onclickfun = '';
            }
            
            sub_nurse_data += '<label class="sub_checkbox"><input type="checkbox" class="specialty sub_checkbox-'+data1[i].id+'" onclick="'+onclickfun+'">'+data1[i].name+get_nurse_count+'</label>'+subsub_nurse_data; 
        }
        $(".checkbox-list").html(sub_nurse_data);
      }
    });
  }

  function getSpecialityData(speciality_id,speciality_name){
    $(".speciality_modal_header span").text(speciality_name);
    $.ajax({
      type: "post",
      url: "{{ url('/nurse/getSpecialityData') }}",
      data: {speciality_id:speciality_id,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
        var data1 = JSON.parse(data);
        console.log("data1",data1);
        var sub_spec_data = '';
        for(var i = 0;i<data1.length;i++){
            if(data1[i].get_spec_count == 0){
              var get_spec_count = '';
            }else{
              var get_spec_count = '<span><i class="fa fa-angle-right"></i></span>'
            }
            var get_spec = data1[i].get_spec;
            var subsub_spec_data = '';
            if(get_spec.length>0){
              for(var j=0;j<get_spec.length;j++){
                subsub_spec_data += '<label class="subsub_checkbox subsub_checkbox-'+data1[i].id+'" style="display:none;"><input type="checkbox" class="specialty">'+get_spec[j].name+'</label>'; 
              }
              console.log("subsub_spec_data",subsub_spec_data);
              var data_name = data1[i].name;
              var type = "speciality_type";
              var onclickfun = 'showSubCheckbox('+data1[i].id+',\''+data_name+'\',\''+type+'\')';
            }else{
              var onclickfun = '';
            }
            
            sub_spec_data += '<label class="sub_checkbox"><input type="checkbox" class="specialty sub_checkbox-'+data1[i].id+'" onclick="'+onclickfun+'">'+data1[i].name+get_spec_count+'</label>'+subsub_spec_data; 
        }
        $(".checkbox-list-spec").html(sub_spec_data);
      }
    });
  }

  function applyNurse(){
    var selectedValues = [];

    $(".nurseCheck:checked").each(function(){
        selectedValues.push($(this).val());
    });

    if(selectedValues.length > 0){
        
      $.ajax({
        type: "POST",
        url: "{{ url('/nurse/getFilterNurseData') }}",
        data: {nurse_data:selectedValues,_token:'{{ csrf_token() }}'},
        cache: false,
        success: function(data){
          $(".job-listings").html(data);
          $("#nurse_modal").hide();
          
        }
      });    
    }
  }

  function applySpeciality(){
    var selectedValues = [];

    $(".specialty_check:checked").each(function(){
        selectedValues.push($(this).val());
    });

    if(selectedValues.length > 0){
        
      $.ajax({
        type: "POST",
        url: "{{ url('/nurse/getFilterSpecialityData') }}",
        data: {speciality_data:selectedValues,_token:'{{ csrf_token() }}'},
        cache: false,
        success: function(data){
          $(".job-listings").html(data);
          $("#speciality_modal").hide();
          
        }
      });    
    }
  }

  function showSubCheckbox(check_value,check_name,type){
    
    if(type == "speciality_type"){
      
      var nurse_modal_header = $(".speciality_modal_header span").text();
      $(".speciality_modal_header span").text(nurse_modal_header+" > "+check_name);
    }else{
      var nurse_modal_header = $(".nurse_modal_header span").text();
      $(".nurse_modal_header span").text(nurse_modal_header+" > "+check_name);
    }
    
    
    if ($('.sub_checkbox-'+check_value).is(':checked')) {
        $(".sub_checkbox").hide();
        $(".subsub_checkbox-"+check_value).show();
    }
  }

 


  function closeModal() {
    $(".modal-overlay").hide();
    //document.getElementsByClassName("modal-overlay").style.display = "none";
    //document.getElementById("shiftModal").style.display = "none";
  }

  function toggleAccordion(header) {
    const content = header.nextElementSibling;
    const isOpen = content.style.display === 'block';
    content.style.display = isOpen ? 'none' : 'block';
  }

  function selectAll(e, id) {
    e.preventDefault();
    const section = document.getElementById(id);
    section.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = true);
  }

  function clearAll(e, id) {
    e.preventDefault();
    const section = document.getElementById(id);
    section.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
  }

  function toggleSpecificDays() {
    const checkbox = document.getElementById("specificDaysToggle");
    const section = document.getElementById("specificDaysSection");
    section.style.display = checkbox.checked ? "block" : "none";
  }

  function applySector(){
    var selectedValues = [];
        
    // Get all checked checkboxes inside the modal
    $(".sector_checkbox:checked").each(function() {
        selectedValues.push($(this).val());
    });

    console.log(selectedValues); // Array of checked values
    
    $.ajax({
      type: "POST",
      url: "{{ url('/nurse/getFilterData') }}",
      data: {selectedValues:selectedValues,_token:'{{ csrf_token() }}'},
      cache: false,
      success: function(data){
        $(".job-listings").html(data);
        $("#sectorModal").hide();
        $("#employmentModal").hide();
      }
    });    
  }

  function applyExperience(){
    var experience = $(".assistent_level").val();
    $.ajax({
      type: "POST",
      url: "{{ url('/nurse/getExperienceData') }}",
      data: {experience:experience,_token:'{{ csrf_token() }}'},
      cache: false,
      success: function(data){
        $(".job-listings").html(data);
        $("#yearExperienceModal").hide();
        
      }
    });    
  }
</script>

@endsection        
