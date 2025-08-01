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
                    <label><input type="checkbox"> {{ $subsub_work->env_name }}</label>
                    @endforeach
                  </div>
                  
                  @endforeach
                 </div>
                </div>
                @endforeach
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
                        <input type="text" placeholder="Search">
                    </div>
                    @foreach($type_of_nurse as $nurse)
                    <div class="list-item" onclick="getNurseData({{ $nurse->id }},'{{ $nurse->name }}')">{{ $nurse->name }}</div>
                    @endforeach
                </div>

                <!-- Right Panel -->
                <div class="panel right col-md-6">
                    <div class="modal-header nurse_modal_header">Registered Nurses (RNs)</div>
                    <div class="search-box">
                        <input type="text" placeholder="Search">
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
                        <label><input type="checkbox" class="specialty">{{ $nurse_data->name }}</label>
                        @endforeach
                    </div>

                    <div class="modal-actions">
                        <button class="cancel-btn" id="cancelModal">Cancel</button>
                        <button class="apply-btn">Apply</button>
                    </div>
                </div>
            </div>
        </div>
@section('js')
<script>

    function openNurseModal(){
        $('#nurse_modal').show();
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
            sub_data += '<label><input type="checkbox"> '+sub_types[j].name+'</label>'
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
            ');
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
    $(".nurse_modal_header").text(nurse_type_name);
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
            sub_nurse_data += '<label><input type="checkbox" class="specialty">'+data1[i].name+'</label>'; 
        }
        $(".checkbox-list").html(sub_nurse_data);
      }
    });
  }

 


  function closeModal() {
    document.getElementById("employmentModal").style.display = "none";
    document.getElementById("shiftModal").style.display = "none";
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
</script>

@endsection        