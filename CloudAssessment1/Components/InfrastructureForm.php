<div class="InputForm">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <h2 id="formtitle">
                ADD PROJECT
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
            <form id="project-form" class="form" action="/" method="POST" role="form">
                <div class="form-group" style="width:20%;display: none;">
                    <label class="form-label" for="id">Project ID:</label>
                    <input type="text" class="form-control" id="id" name="id" tabindex="1" value="" readonly>
                </div>
                <div class="form-inline">
                    <div class="form-group" style="width:60%">
                        <label class="form-label" for="form1">Project Name</label>
                        <input type="text" class="form-control" id="form1" name="form1" tabindex="1" value="" required>
                    </div>
                    <div class="form-group" style="width:32%">
                        <label class="form-label" for="form2">Subtype</label>
                        <input type="text" class="form-control" id="form2" name="form2" tabindex="2">
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group" style="width: 29%">
                        <label class="form-label" for="form3">Current Status</label>
                        <input type="text" class="form-control" id="form3" name="form3" tabindex="3">
                    </div>
                    <div class="form-group" style="width: 29%">
                        <label class="form-label" for="form4">Capacity (MW)</label>
                        <input type="text" class="form-control" id="form4" name="form4" tabindex="4">
                    </div>
                    <div class="form-group" style="width: 29%">
                        <label class="form-label" for="form5">Year of Completion</label>
                        <input type="text" class="form-control" id="form5" name="form5" tabindex="5">
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form6">Country list of Sponsor/Developer</label>
                        <textarea rows="5" cols="50" class="form-control" id="form6" name="form6"
                                  tabindex="6"></textarea>
                    </div>
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form7">Sponsor/Developer Company</label>
                        <textarea rows="5" cols="50" name="form7" class="form-control" id="form7"
                                  tabindex="7"></textarea>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form8">Country list of Lender/Financier</label>
                        <textarea rows="5" cols="50" class="form-control" id="form8" name="form8"
                                  tabindex="8"></textarea>
                    </div>
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form10">Country list of Construction/EPC</label>
                        <textarea rows="5" cols="50" class="form-control" id="form10" name="form10"
                                  tabindex="10"></textarea>
                    </div>

                </div>
                <div class="form-inline">
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form9">Lender/Financier Company</label>
                        <input type="text" class="form-control" id="form9" name="form9" tabindex="9">
                    </div>
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form11">Construction Company/EPC Participant</label>
                        <input type="text" class="form-control" id="form11" name="form11" tabindex="11">
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group" style="width: 29%">
                        <label class="form-label" for="form12">Country</label>
                        <input type="text" class="form-control" id="form12" name="form12" tabindex="12">
                    </div>
                    <div class="form-group" style="width: 29%">
                        <label class="form-label" for="form13">Province/State</label>
                        <input type="text" class="form-control" id="form13" name="form13" tabindex="13">
                    </div>
                    <div class="form-group" style="width: 29%">
                        <label class="form-label" for="form14">District</label>
                        <input type="text" class="form-control" id="form14" name="form14" tabindex="14">
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group" style="width: 29%">
                        <label class="form-label" for="form15">Tributary</label>
                        <input type="text" class="form-control" id="form15" name="form15" tabindex="15">
                    </div>
                    <div class="form-group" style="width: 29%">
                        <label class="form-label" for="form16">Latitude</label>
                        <input type="text" class="form-control" id="form16" name="form16" tabindex="16">
                    </div>
                    <div class="form-group" style="width: 29%">
                        <label class="form-label" for="form17">Longitude</label>
                        <input type="text" class="form-control" id="form17" name="form17" tabindex="17">
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form18">Proximity</label>
                        <input type="text" class="form-control" id="form18" name="form18" tabindex="18">
                    </div>
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form19">Avg. Annual Output (MWh)</label>
                        <input type="text" class="form-control" id="form18" name="form19" tabindex="19">
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form20">Data Source</label>
                        <textarea rows="5" cols="50" class="form-control" id="form20" name="form20"
                                  tabindex="20"> </textarea>
                    </div>
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form21">Announcement/More Information</label>
                        <textarea rows="5" cols="50" name="form21" class="form-control" id="form21"
                                  tabindex="21"></textarea>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group" style="width:46%">
                        <label class="form-label" for="form22">Link</label>
                        <input type="text" name="form22" class="form-control" id="form22"
                                  tabindex="22">
                    </div>
                <div class="form-group" style="width:46%">
                    <label class="form-label" for="form23">Latest Update</label>
                    <input type="text" class="form-control" id="form23" name="form23" tabindex="23">
                </div>
                </div>
                <div class="text-center" id="buttonFields">
                    <button id="formbuttons" type='submit' value="1" name='addNew' class="btn btn-start-order">Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var editingId = null;

    function updateForm(event, id) {
        event.preventDefault();
        event.stopPropagation();
        if (editingId !== id) {
            editingId = id;
            var data = $(`tr[data-id=${id}] td.info`);
            project = {
                'id':data.eq(0),
                'form1': data.eq(1),
                'form2': data.eq(2),
                'form3': data.eq(3),
                'form4': data.eq(4),
                'form5': data.eq(5),
                'form6': data.eq(6),
                'form7': data.eq(7),
                'form8': data.eq(8),
                'form9': data.eq(9),
                'form10': data.eq(10),
                'form11': data.eq(11),
                'form12': data.eq(12),
                'form13': data.eq(13),
                'form14': data.eq(14),
                'form15': data.eq(15),
                'form16': data.eq(16),
                'form17': data.eq(17),
                'form18': data.eq(18),
                'form19': data.eq(19),
                'form20': data.eq(20),
                'form21': data.eq(21),
                'form22': data.eq(22),
                'form23': data.eq(23)
            };
            $.map(project, function (val, i) {
                $(`#${i}`).val(val.html());
            });
            // $("#InputForm").attr('action','home.php');
            formtitle.innerText = 'Editing Project: ' + id;
            formbuttons.name = 'editProject';
            formbuttons.value = id;
            document.getElementById("buttonFields").innerHTML=`<button id="formbuttons" type='submit' value="`+id+`" name='editProject' class="btn btn-start-order">Save
                    </button>
                     <button id="formbuttons" onclick="Window.location='/'" type='submit' class="btn btn-start-order" style="background-color: #999999">Cancel
                    </button> `;
        } else {
            editingId = null;
            $('#InputForm').find("input.form-control,select").val("");
            $("#InputForm").attr('action', 'home.php');
            formtitle.innerText = "New Project";
            formbuttons.name = 'addNew';
            document.getElementById("buttonFields").innerHTML=`<button id="formbuttons" type='submit' value="1" name='addNew' class="btn btn-start-order">ADD
                    </button>`;
        }
    }
</script>