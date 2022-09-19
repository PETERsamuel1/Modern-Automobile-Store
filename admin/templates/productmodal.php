<style type="text/css">

    .column img{
      margin-top: 12px;
      width: 100%;
      height: 250px;
      padding: 4px;
      object-fit: contain;
    }
    .modal-body {
        margin-left: 20px;
        margin-right: 20px;
    }
    .img-container {
        width: 100%;
        height: 300px;
        border-color: #8898aa;
        border-style: solid;
        border-width: 1px;
        border-radius: 5px;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        object-fit: contain;
    }
    .category {
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .category .input-group {
        min-width: 200px;
        display: flex;
        align-items: center;
    }
    .category .input-group-addon {
        border: none;
        border: none;
        background: transparent;
        position: absolute;
        z-index: 9;
    }
    .category .input-group-addon, .category select,.category input {
        border-color: #ddd;
        border-radius: 0;
    }
    .category select,.category input {
        height: 34px;
        padding-left: 28px;     
        box-shadow: none !important;
        border-width: 0 0 1px 0;
    }
    .category select,.category input:focus {
        border-color: #3FBAE4;
    }
    .category i {
        color: red;
        font-size: 25px;
        position: relative;
        left: -10px;
    }
    .category .b-text {
        position: relative;
        left: -1px;
    }
</style>   

<div id="addnewproduct" data-backdrop="static" data-keyboard="true" class="modal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Car Part</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <center><small class="form-text text-muted" id="alert"></small></center>
                <form id="newproductform" action="../includes/action.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="img-container">
                            <div class="column" id="image-display">
                                
                            </div>
                        </div>
                        <div class="imgF" style="display: none " id="img-clone">
                    <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Choose photo from pc</label>
                            <input type="file" class="form-control" name="productphoto" onchange="displayUpload(this)" id="productphoto" accept="image/*">
                            <small class="form-text text-muted" id="pphoto_error"></small>
                        </div>
                  <!--
                        <div class="form-group">
                            <label>Take a new photo</label>
                            <button type="button" class="btn btn-primary btn-small btn-flat"><i class="fas fa-camera"></i></button>
                        </div>
                  -->
                   </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="category">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-folder" style="color: #5e72e4;"></i></span>
                                <select class="form-control" id="select_cat" name="select_cat"></select>
                            </div>
                            <small class="form-text text-muted" id="pcat_error"></small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="category">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-book" style="color: #32325d;"></i></span>
                                <input class="form-control" placeholder="Spare Part Name" name="prod_name" id="prod_name">
                            </div>
                            <small class="form-text text-muted" id="pname_error"></small>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="category">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-at" style="color: #11cdef;"></i></span>
                                <input class="form-control" placeholder="Price" id="prod_price" name="prod_price">
                            </div>
                            <small class="form-text text-muted" id="pprice_error"></small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="category">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-suitcase" style="color: #fb6340;"></i></span>
                                <input class="form-control" placeholder="Stock Amount" name="prod_amount" id="prod_amount">
                            </div>
                            <small class="form-text text-muted" id="pamount_error"></small>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        <label>Description</label>
                    </div>
                    <div class="col-12">
                        <div class="category">
                            <textarea class="form-control" id="prod_description" name="prod_description"></textarea>
                            <small class="form-text text-muted" id="pdesc_error"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveprodbtn" class="btn btn-primary btn-sm">Save</button>   
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function displayUpload(input){
        if (input.files) {
                Object.keys(input.files).map(function(k){
                    var reader = new FileReader();
                     var t = input.files[k].type;
                        var _types = ['image/x-png','image/png','image/gif','image/jpeg','image/jpg'];
                        if(_types.indexOf(t) == -1)
                            return false;
                        reader.onload = function (e) {
                            // $('#cimg').attr('src', e.target.result);

                        var bin = e.target.result;
                        var fname = input.files[k].name;
                        var imgF = document.getElementById('img-clone');
                            imgF = imgF.cloneNode(true);
                          imgF.removeAttribute('id')
                          imgF.removeAttribute('style')
                            if(t == "video/mp4"){
                                var img = document.createElement("video");
                                }else{
                                var img = document.createElement("img");
                                }
                              var fileinput = document.createElement("input");
                              var fileinputName = document.createElement("input");
                              fileinput.setAttribute('type','hidden')
                              fileinputName.setAttribute('type','hidden')
                              fileinput.setAttribute('name','img[]')
                              fileinputName.setAttribute('name','imgName[]')
                              fileinput.value = bin
                              fileinputName.value = fname
                              img.classList.add("imgDropped")
                              img.src = bin;
                              imgF.appendChild(fileinput);
                              imgF.appendChild(fileinputName);
                              imgF.appendChild(img);
                              document.querySelector('#image-display').appendChild(imgF)
                        }
                reader.readAsDataURL(input.files[k]);
                })
                //rem_func()
            }
    }

     function rem_func(_this){
            _this.closest('.imgF').remove()
            $("#productphoto").val("");
    }
</script>