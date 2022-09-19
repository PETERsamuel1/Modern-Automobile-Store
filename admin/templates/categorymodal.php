<style type="text/css">
    .category {
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .category .input-group {
        min-width: 200px;
        display: flex;
        align-items: center;
    }
    .category .input-group-addon, .category input {
        border-color: #ddd;
        border-radius: 0;
    }
    .category .input-group-addon {
        border: none;
        border: none;
        background: transparent;
        position: absolute;
        z-index: 9;
    }
    .category input {
        height: 34px;
        padding-left: 28px;     
        box-shadow: none !important;
        border-width: 0 0 1px 0;
    }
    .category input:focus {
        border-color: #3FBAE4;
    }
    .category i {
        color: #5e72e4;
        font-size: 25px;
        position: relative;
        left: -10px;
    }
    .switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 21px;
}

.status{
    margin-left: 5px;
}
.switch, .status{
  display: inline-block;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 17px;
  width: 17px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 24px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<div id="addnewcategory" data-backdrop="static" data-keyboard="true" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="category">
                    <center><small class="form-text text-muted" id="success_msg"></small></center>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-folder"></i></span>
                        <input type="text" class="form-control" placeholder="New Category" id="txtCatname"> 
                    </div>
                    <small class="form-text text-muted" id="catname_error"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button id="savecatbtn" class="btn btn-primary btn-sm">Save</button>   
            </div>
        </div>
    </div>
</div>

<div id="editcategory" data-backdrop="static" data-keyboard="true" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="category">
                    <center><small class="form-text text-muted" id="success_msg"></small></center>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-folder"></i></span>
                        <input type="text" class="form-control" placeholder="Edit Category" id="txtEditCatname"> 
                    </div>
                    <small class="form-text text-muted" id="editcatname_error"></small>
                    <div class="statusupdate">
                        <label>Status</label>
                        <div class="updatestatus"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="savecatbtn" class="btn btn-primary btn-sm">Save</button>   
            </div>
        </div>
    </div>
</div>