<template>
    <div class="uploader"
         @dragenter="OnDragEnter"
         @dragleave="OnDragLeave"
         @dragover.prevent
         @drop="onDrop"
         :class="{ dragging: isDragging }">

        <div class="upload-control" v-show="images.length">
            <label for="file">Select a file</label>
            <button @click="upload">Upload</button>
        </div>


        <div v-show="!images.length">
            <i class="fa fa-cloud-upload"></i>
            <p>Drag your images here</p>
            <div>OR</div>
            <div class="file-input">
                <label for="file">Select a file</label>
                <input type="file" id="file" @change="onInputChange" multiple>
            </div>
        </div>

        <!--<div class="images-preview" v-show="images.length">-->
        <!--<div class="img-wrapper" v-for="(image, index) in images" :key="index">-->
        <!--<img :src="image" :alt="`Image Uploader ${index}`">-->

        <!--<div class="details">-->
        <!--<span class="name" v-text="files[index].name"></span>-->
        <!--<span class="size" v-text="getFileSize(files[index].size)"></span>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->

        <div class="images-preview">
            <div class="img-wrapper" v-for="image in items">
                <div class="details">
                    <div class="container " v-show="items.length" @mouseenter="showDelBtn=true;" @mouseleave="showDelBtn=false;">
                        <img src="" :src="image.image_name"  :alt="image.image_name">
                        <!--<button class="btn btn-outline-warning" v-if="showDelBtn" @close="showDelBtn=false" @click="deleteImage(image.id, image.image_name)">Delete</button>-->
                        <div class="container-btn">
                            <div class="container-btn-relative ">
                                <button class="btn btn-primary" @click="showImageModal(image.image_name)">View</button>
                                <button class="btn btn-outliuploadPercentagene-warning" @click="deleteImage(image.id, image.image_name)">Delete</button>
                            </div>
                        </div>
                        <div class="container-btn">
                            <div v-bind:class="{'progressbar' : image.isShowProgress}">
                                <img src="/image/loading.gif" v-if="image.isShowProgress"/>
                                {{image.uploadPercentage}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="imageModal" class="modal fade">
            <img class="modal-dialog" id="imgModal">
            <span class="close" data-dismiss="modal">&times;</span>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getImages();
        },
        data: () => ({
            isDragging: false,
            uploadPercentage: 0,
            dragCount: 0,
            files: [],
            images: [],
            items: [],
            showDelBtn: false,
            showImage: false,
        }),
        methods: {
            OnDragEnter(e) {
                e.preventDefault();

                this.dragCount++;
                this.isDragging = true;
                return false;
            },
            OnDragLeave(e) {
                e.preventDefault();
                this.dragCount--;
                if (this.dragCount <= 0)
                    this.isDragging = false;
            },
            onInputChange(e) {
                const files = e.target.files;
                this.processFiles(files);
                // Array.from(files).forEach(file => this.addImage(file));
            },
            onDrop(e) {
                e.preventDefault();
                e.stopPropagation();
                this.isDragging = false;
                const files = e.dataTransfer.files;
                this.processFiles(files);
                // Array.from(files).forEach(file => this.addImage(file));
            },
            processFiles(files){
                var thisProcess = this;
                Array.from(files).forEach(function(file){
                    let fileData = {
                        // 'id' : '',
                        'name' : file.name,
                        'media' : '',
                        'isImage' : file.type == 'image/jpeg' || file.type == 'image/png' ? true : false,
                        'isLargeSize' : file.size > 10485760 ? true : false,
                        'isShowProgress' : true,
                        'percentProgress' : 0,
                    };
                    thisProcess.items.push(fileData);

                    if (!file.type.match('image.*')) {
                        // this.$toastr.e(`${file.name} is not an image`);
                        return;
                    }
                    thisProcess.files.push(file);

                    const formData = new FormData();
                    formData.append('images[]', file, file.name);

                    axios.post('/images/upload',
                        formData,
                        {
                            headers: {
                                'Content-Type':'multipart/form-data'
                            },
                            onUploadProgress: function(progressEvent){
                                thisProcess.uploadPercentage = parseInt(Math.round((progressEvent.loaded*100) / progressEvent.total));
                                fileData.percentProgress = thisProcess.uploadPercentage;
                                console.log(thisProcess.uploadPercentage);
                            }
                        }
                    ).then(response => {
                        // this.$toastr.s('All images uplaoded successfully');
                        thisProcess.images = [];
                        thisProcess.files = [];
                        // this.getImages();
                        // fileData.id = response.data.data.id;
                        fileData.name = response.data.data.name;
                        fileData.type = response.data.data.type;
                        fileData.isImage = response.data.data.isImage;
                        fileData.isLargeSize = response.data.data.isLargeSize;
                        fileData.isShowProgress = response.data.data.isShowProgress;
                        fileData.percentProgress = response.data.data.percentProgress;
                    })
                }.bind(thisProcess));
                // Array.from(files).forEach(file => this.addImage(file));
            },
            addImage(file) {

            },
            getFileSize(size) {
                const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
                let i = 0;

                while(size > 900) {
                    size /= 1024;
                    i++;
                }
                return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
            },
            uploadImage(file) {
                const formData = new FormData();
                formData.append('images[]', file, file.name);

                axios.post('/images/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type':'multipart/form-data'
                        },
                        onUploadProgress: function(progressEvent){
                            this.uploadPercentage = parseInt(Math.round((progressEvent.loaded*100) / progressEvent.total));
                            console.log(this.uploadPercentage);


                        }.bind(this)
                    }
                ).then(response => {
                    // this.$toastr.s('All images uplaoded successfully');
                    this.images = [];
                    this.files = [];
                    // this.getImages();

                    this.fileData.id = response.data.data.id;
                    this.fileData.name = response.data.data.name;
                    this.fileData.media = response.data.data.media;
                    this.fileData.isImage = response.data.data.isImage;
                    this.fileData.isLargeSize = response.data.data.isOverMaxSize;
                    this.fileData.isShowProgress = response.data.data.isUpload;
                    this.fileData.percentProgress = response.data.data.percentProgress;
                })
            },
            upload() {
                const formData = new FormData();

                this.files.forEach(file => {
                    formData.append('images[]', file, file.name);
                });
                axios.post('/images/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type':'multipart/form-data'
                        },
                        onUploadProgress: function(progressEvent){
                            this.uploadPercentage = parseInt(Math.round((progressEvent.loaded*100) / progressEvent.total));
                            console.log(this.uploadPercentage);
                        }.bind(this)
                    }
                ).then(response => {
                    // this.$toastr.s('All images uplaoded successfully');
                    this.images = [];
                    this.files = [];
                    this.getImages();
                })
            },
            getImages() {
                var this1 = this;
                axios.get('/images/index').then(function (response) {
                    this1.items = response.data;
                });
            },
            deleteImage: function deleteImage(id, image_name) {
                var this2 = this;
                var datas = {'id': id
                    , 'name': image_name};
                axios.post('/images/delete/'+ id).then(function (response) {
                    this2.getImages();
                });
            },
            showImageModal: function(url){
                $('#imageModal').modal('show');
                $('#imgModal').attr('src',url);
            },
        }
    }
</script>

<style lang="scss" scoped>
    .container{
        position: relative;
        width: 250px;
        height: 250px;
        padding-left: 0px;
        padding-right: 0px;
     }
    .container img{
        width: 250px;
        height: 250px;
    }
    .container-btn{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 12px 24px;
        border: none;
        border-radius: 5px;
        /*visibility: hidden;*/
    }
    .container-btn-relative{
        position: relative;
        /*visibility: hidden;*/
    }
    .container-btn-relative .btn{
        background-color: #555;
        color: white;
        /*visibility: hidden;*/
    }
    .progressbar{
        position: absolute;
        width: 200px;
        height: 200px;
    }
    /*.container:hover .btn{*/
        /*visibility: visible;*/
    /*}*/
    /*.container button{*/
        /*visibility: hidden;*/
    /*}*/

    /*.container:hover button{*/
        /*visibility: visible;*/
    /*}*/
    .uploader {
        width: 100%;
        /*background: #2196F3;*/
        color: black;
        padding: 40px 15px;
        text-align: center;
        border-radius: 3px;
        border: 2px solid;
        font-size: 20px;
        position: relative;
        &.dragging {
            background: #fff;
            color: #2196F3;
            border: 3px dashed #2196F3;
            .file-input label {
                background: #2196F3;
                color: #fff;
            }
        }
        i {
            font-size: 85px;
        }
        .file-input {
            width: 200px;
            margin: auto;
            height: 68px;
            position: relative;
            label,
            input {
                background: #fff;
                color: #2196F3;
                width: 100%;
                position: absolute;
                left: 0;
                top: 0;
                padding: 10px;
                border-radius: 4px;
                margin-top: 7px;
                cursor: pointer;
            }
            input {
                opacity: 0;
                z-index: -2;
            }
        }
        .images-preview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
            .img-wrapper {
                width: 250px;
                display: flex;
                flex-direction: column;
                margin: 10px;
                height: 250px;
                justify-content: space-between;
                background: #fff;
                box-shadow: 5px 5px 20px #3e3737;
                img {
                    height: 100%;
                    width: 100%;
                }
            }
            .details {
                font-size: 12px;
                background: #fff;
                color: #000;
                display: flex;
                flex-direction: column;
                align-items: self-start;
                /*padding: 3px 6px;*/
                .name {
                    overflow: hidden;
                    height: 18px;
                }
            }
        }
        .upload-control {
            position: absolute;
            width: 100%;
            background: #fff;
            top: 0;
            left: 0;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
            padding: 10px;
            padding-bottom: 4px;
            text-align: right;
            button, label {
                background: #2196F3;
                border: 2px solid #03A9F4;
                border-radius: 3px;
                color: #fff;
                font-size: 15px;
                cursor: pointer;
            }
            label {
                padding: 2px 5px;
                margin-right: 10px;
            }
        }
    }
</style>