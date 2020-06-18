$(document).ready(function () {
    $('#vehicle_images_add').change(function() {
        uploaded_images = [];
        var imgs = $(this).get(0);
        for (var i = 0; i < imgs.files.length; ++i) {
            var name = imgs.files.item(i).name;
            var image = { 'name': name, 'order': 1, 'uploaded_image': imgs.files.item(i)};
            uploaded_images.push(image);
        }
        drawImages();
    });
});

var images = window.images === undefined ? [] : window.images;
var uploaded_images = [];
var site_name = window.site_name;
console.log(images);

function drawRadioBtns(image, length) {
    var str = "";
    var checked = "";
    for (var i = 1; i <= length; i++) {
        checked = image.order == i ? "checked" : "";
        order_key = image.order_key === undefined ? image.name.split('.').join('_') + '_order' : image.order_key
        str+=`
        <div class="radio-inline">
            <label>
            <input ` + checked + ` type="radio" name="` + order_key + `" value="` + i + `"><p style="font-weight: 400; font-size: 1em; vertical-align: middle; margin: 0">` + i + `</p>
            </label>
        </div>`;
    }

    return str;
}

function drawImage(image) {
    var img = $('<img src="#" style="width: 100%">');
    if (image.uploaded_image === undefined) {
        img.attr('src', site_name + image.image_uri).show();
    }
    else {
        var reader = new FileReader();
        reader.onload = function (e) {
        img.attr('src', e.target.result).show();
        };
        reader.readAsDataURL(image.uploaded_image);
    }

    img.appendTo('#' + image.name.split(".")[0] + '_image_container');
}

function drawImages() {
    $('#vehicle_image_order_images').empty();
    if (images.length + uploaded_images.length > 0) { 
        $('#vehicle_image_order_container').css('display', 'block'); 
    }
    else { 
        $('#vehicle_image_order_container').css('display', 'none'); 
    }
    for (var i = 0; i < images.length; i++) {
        var html = 
        `<div class="row">
            <div class="col-sm-12 col-md-4">
            <div id="`+images[i].name.split(".")[0] +`_image_container">
            </div>  
            <table class="table table-condensed" style="margin-bottom: 5px">
                <tr>
                <td class="last">` + images[i].name +`</td>
                </tr>
            </table>   
            </div>
            <div id="" class="col-sm-12 col-md-6" style="margin-bottom: 10px">`
            + drawRadioBtns(images[i], images.length + uploaded_images.length) +
            `</div>
        </div>`
        ;
        $('#vehicle_image_order_images').append(html);
        drawImage(images[i]);
    }
    for (var i = 0; i < uploaded_images.length; i++) {
        var html = 
        `<div class="row">
            <div class="col-sm-12 col-md-4">
            <div id="`+uploaded_images[i].name.split(".")[0] +`_image_container">
            </div>  
            <table class="table table-condensed" style="margin-bottom: 5px">
                <tr>
                    <td class="last">` + uploaded_images[i].name +`</td>
                </tr>
            </table>   
            </div>
            <div id="" class="col-sm-12 col-md-6" style="margin-bottom: 10px">`
            + drawRadioBtns(uploaded_images[i], images.length + uploaded_images.length) +
            `</div>
        </div>`
        ;
        $('#vehicle_image_order_images').append(html);
        drawImage(uploaded_images[i]);
    }
}

drawImages();
