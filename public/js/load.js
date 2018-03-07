/**
 * Created by anil on 6/19/17.
 */
var albumBucketName = $('#amazon-web-bucket').val();
var cvBucketName = $('#amazon-cv-bucket').val();
var web_image_url = $('#amazon-web-bucket-url').val();
var IdentityPoolId = $('#amazon-identity-pool-id').val();

var awsregion = $('#amazon-region').val();
var cognito_role = $('#amazon-cognito-role').val();
var account_id = $('#amazon-account-id').val();
AWS.config.region = awsregion; // Region
AWS.config.credentials = new AWS.CognitoIdentityCredentials({
    AccountId:account_id,
    IdentityPoolId: IdentityPoolId,
    RoleArn:cognito_role
});

AWS.config.credentials.get(function(err) {
    if (err) alert(err);
    console.log(AWS.config.credentials);
});

var bucketName = albumBucketName; // Enter your bucket name
var bucket = new AWS.S3({
    params: {
        Bucket: bucketName
    }
});
var cv = new AWS.S3({
    params: {
        Bucket: cvBucketName
    }
});


function upload_file() {
    var fileChooser = document.getElementById('file-chooser');


    for (var i = 0; i < fileChooser.files.length; i++) {
        var file = fileChooser.files[i];
        var number = 1 + Math.floor(Math.random() * 999999999999);

    if (file) {
        console.log(file.name);
        var ext = file.name.split('.').pop();

        var objKey = '' + file.name;
        var uname = number + '.' + ext;
        console.log(uname);
        var params = {
            Key: uname,
            ContentType: file.type,
            Body: file,
            ACL: 'public-read'
        };
        (function (uname) {

        bucket.putObject(params, function (err, data) {
            if (err) {
                console.log(err);
            } else {
                console.log(data);
                axios.get('/user/image/add', {
                    params: {image: uname}
                })
                    .then(function (response) {
                        console.log(response);

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                $(".row-images").prepend('<div class="col-sm-3"><div class="cross-mark">X</div><input type="hidden" name="images[]" value="' + uname + '"><img src="'+web_image_url+'/' + uname + '"></div>');
                //  $("#advert-form").append('<input type="hidden" name="images[]" value="'+uname+'">');

            }
        });
        })(uname);

    } else {
        console.log("nothing to upload");
    }
    }
}
function upload_cv() {
    var fileChooser = document.getElementById('upload-cv');


        var file = fileChooser.files[0];
        var number = 1 + Math.floor(Math.random() * 999999999999);

        if (file) {
            console.log(file.name);
            var ext = file.name.split('.').pop();

            var objKey = '' + file.name;
            var uname = number + '.' + ext;
            console.log(uname);
            var params = {
                Key: uname,
                ContentType: file.type,
                Body: file,
                ACL: 'public-read'
            };
            (function (uname) {

                cv.putObject(params, function (err, data) {
                    if (err) {
                        console.log(err);
                    } else {
                        console.log(data);
                        var title = $('#title').val();
                        var category=$('#category').val();
                        var profile = $('#profile').val();
                        axios.get('/user/cvs/add', {
                            params: {file_name: uname,title:title,category:category, profile:profile}
                        })
                        .then(function (response) {
                            console.log(response);
                            location.reload();

                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    }
                });
            })(uname);

        } else {
            console.log("nothing to upload");
        }

}
function upload_profile() {
    var fileChooser = document.getElementById('upload-profile');


    var file = fileChooser.files[0];
    var number = 1 + Math.floor(Math.random() * 999999999999);

    if (file) {
        console.log(file.name);
        var ext = file.name.split('.').pop();

        var objKey = '' + file.name;
        var uname = number + '.' + ext;
        console.log(uname);
        var params = {
            Key: uname,
            ContentType: file.type,
            Body: file,
            ACL: 'public-read'
        };
        (function (uname) {

            bucket.putObject(params, function (err, data) {
                if (err) {
                    console.log(err);
                } else {
                    console.log(data);
                    $('#image').val(uname);
                    $('.add-profile-image').attr('src',web_image_url+'/' + uname);

                }
            });
        })(uname);

    } else {
        console.log("nothing to upload");
    }

}
function upload_image_chat() {
    var fileChooser = document.getElementById('upload-image-chat');


    var file = fileChooser.files[0];
    var number = 1 + Math.floor(Math.random() * 999999999999);

    if (file) {
        console.log(file.name);
        var ext = file.name.split('.').pop();

        var objKey = '' + file.name;
        var uname = number + '.' + ext;
        console.log(uname);
        var params = {
            Key: uname,
            ContentType: file.type,
            Body: file,
            ACL: 'public-read'
        };
        (function (uname) {

            bucket.putObject(params, function (err, data) {
                if (err) {
                    console.log(err);
                } else {
                    console.log(data);
                    add_message(web_image_url+'/' + uname);
                   $('#all-msg').append('<div class="right-message clearfix"><img src="'+web_image_url+'/' + uname + '" style="float: right; max-width: 90%;"></div>');

                }
            });
        })(uname);

    } else {
        console.log("nothing to upload");
    }
}
function uploadImage(selectorInputImage, selectorImage) {
    var fileChooser = selectorInputImage;
    var file = fileChooser.files[0];
    var number = 1 + Math.floor(Math.random() * 999999999999);
    if (file) {
        console.log(file.name);
        var ext = file.name.split('.').pop();
        var objKey = '' + file.name;
        var uname = number + '.' + ext;
        console.log(uname);
        var params = {
            Key: uname,
            ContentType: file.type,
            Body: file,
            ACL: 'public-read'
        };
        (function (uname) {

            bucket.putObject(params, function (err, data) {
                if (err) {
                    console.log(err);
                } else {
                    console.log(data);
                   selectorImage.attr('src', web_image_url+"/"+uname);
                }
            });
        })(uname);

    } else {
        console.log("nothing to upload");
    }
}
function uploadCvOthers(fileName, fileType, data) {
    var number = 1 + Math.floor(Math.random() * 999999999999);
    if (fileName) {
        var uname = fileName.replace(' ','');
        console.log(uname);
        console.log(fileType);
        var params = {
            Key: uname,
            ContentType: fileType,
            //ContentEncoding: 'base64',
            Body: data,
            ACL: 'public-read'
        };
        (function (uname) {

            cv.putObject(params, function (err, data) {
                if (err) {
                    console.log(err);
                } else {
                    console.log(data);
                    saveCV(uname);
                }
            });
        })(uname);

    } else {
        console.log("nothing to upload");
    }
}
function deleteImage(image, deleteDatabase){
    console.log(image);
    if(image){
        var params = {
            Key: image
        };
        bucket.deleteObject(params, function(err, data){
            if(err){
                console.log(err);
            }
            else if(deleteDatabase){
                //TODO delete from database
                axios.get('/user/delete/image/' + image)
                .then(function (response) {
                    console.log(data.msg);
                })
                .catch(function (error) {
                    console.log(error);
                });

            }
        });
    }
    else {
        console.log('nothing to delete')
    }
}
function saveCV(fileName){
    var title = $('#title').val();
    var category=$('#category').val();
    var profile = $('#profile').val();
    var type = $('#type').val();
    axios.get('/user/cvs/add', {
        params: {file_name: fileName,title:title,category:category, profile:profile}
    })
    .then(function (response) {
        console.log(response);
        location.reload();
    })
    .catch(function (error) {
        console.log(error);
    });
}

class FileUpload{
    constructor(fileName, fileId, fileUrl){
        this.fileName = fileName;
        this.fileId = fileId;
        this.fileUrl = fileUrl;
    }
    saveDB(title,category){
        axios.get('/user/cvs/add', {
        params: {file_name: this.fileName,title:title,category:category}
        })
        .then(function (response) {
            console.log(response);
            location.reload();
        })
        .catch(function (error) {
            console.log(error);
        });
    }
    uploadAWS(title, category, load, data) {
        var number = 1 + Math.floor(Math.random() * 999999999999);
        console.log('upload aws');
        var upload = this;
        if (this.fileName) {
            var uname = this.fileName.replace(' ','');
            console.log(uname);
            var params = {
                Key: uname,
                //ContentType: 'blob',
                //ContentEncoding: 'base64',
                Body: data,
                ACL: 'public-read'
            };
            (function (uname) {
                cv.putObject(params, function (err, data) {
                    if (err) {
                        console.log(err);
                    } else {
                        console.log(data);
                        upload.saveDB(title, category);
                        load();
                    }
                });
            })(uname);
        } else {
            console.log("nothing to upload");
        }
    }
    upload(title,category, load){
        var xhr = new XMLHttpRequest();
        var upload = this;
        xhr.open("GET", this.fileUrl);
        xhr.responseType = 'blob';
        xhr.onload = function(){
            var data = xhr.response;
            upload.uploadAWS(title, category, load, data);
        }
        xhr.send();
    }
}
class UploadDrive extends FileUpload{
    constructor(fileName, fileId, fileUrl, token){
        super(fileName, fileId, fileUrl);
        this.token;
    }
    upload(title, category, load){
        var accessToken = this.token;
        console.log(accessToken);
        var xhr = new XMLHttpRequest();
        var upload = this;
        xhr.open("GET", "https://www.googleapis.com/drive/v3/files/"+this.fileId+'?alt=media');
        xhr.setRequestHeader('Authorization','Bearer '+accessToken);
        xhr.responseType = 'blob';
        xhr.onload = function(){
            var data = xhr.response;
            upload.uploadAWS(title, category, load, data);
            //uploadCvOthers(this.fileName, '', data)
        }
        xhr.send();
    }
    type(){
        return 'google-drive';
    }
}
class UploadOnedrive extends FileUpload{
    type(){
        return 'one-drive';
    }
}
class UploadDropbox extends FileUpload{
    type(){
        return 'dropbox';
    }
}